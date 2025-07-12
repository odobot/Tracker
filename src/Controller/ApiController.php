<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Http\Exception\BadRequestException;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Text;

/**
 * Api Controller
 *
 * @method \App\Model\Entity\Api[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->autoRender = false;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $api = $this->paginate($this->Api);

        $this->set(compact('api'));
    }

    /**
     * View method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $api = $this->Api->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('api'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $api = $this->Api->newEmptyEntity();
        if ($this->request->is('post')) {
            $api = $this->Api->patchEntity($api, $this->request->getData());
            if ($this->Api->save($api)) {
                $this->Flash->success(__('The api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The api could not be saved. Please, try again.'));
        }
        $this->set(compact('api'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $api = $this->Api->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $api = $this->Api->patchEntity($api, $this->request->getData());
            if ($this->Api->save($api)) {
                $this->Flash->success(__('The api has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The api could not be saved. Please, try again.'));
        }
        $this->set(compact('api'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Api id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $api = $this->Api->get($id);
        if ($this->Api->delete($api)) {
            $this->Flash->success(__('The api has been deleted.'));
        } else {
            $this->Flash->error(__('The api could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function receive()
    {
        $this->request->allowMethod(['post']);
        $data = $this->request->getData();

        // Validate required fields
        if (!isset($data['I'], $data['T'], $data['H'], $data['C'], $data['S'])) {
            throw new BadRequestException("Missing required fields.");
        }

        $uuid = Text::uuid();
        $conn = ConnectionManager::get('default');
        $criticalEvents = [];

        // Start transaction
        $conn->begin();

        try {
            // MERGE into live_data
            $conn->execute(
                'MERGE INTO live_data AS target 
                 USING (SELECT ? AS device_id) AS source 
                 ON target.device_id = source.device_id 
                 WHEN MATCHED THEN 
                   UPDATE SET uuid=?, temperature=?, humidity=?, current_reading=?, status=?, timestamp=GETDATE()
                 WHEN NOT MATCHED THEN 
                   INSERT (uuid, device_id, temperature, humidity, current_reading, status, timestamp)
                   VALUES (?, ?, ?, ?, ?, ?, GETDATE());',
                [
                    $data['I'], $uuid, $data['T'], $data['H'], $data['C'], $data['S'],
                    $uuid, $data['I'], $data['T'], $data['H'], $data['C'], $data['S']
                ]
            );

            // Get thresholds using the Table class instead of raw SQL
            $thresholdsTable = $this->fetchTable('ThresholdLimits');
            $thresholds = $thresholdsTable->find()
                ->where(['device_id' => $data['I']])
                ->all();

            foreach ($thresholds as $threshold) {
                $value = null;
                $thresholdType = null;
                $thresholdValue = null;

                // Check temperature thresholds
                if ($threshold->variable === 'temperature') {
                    $value = (float)$data['T'];
                    if ($threshold->lower_limit !== null && $value < $threshold->lower_limit) {
                        $thresholdType = 'lower';
                        $thresholdValue = $threshold->lower_limit;
                    } elseif ($threshold->upper_limit !== null && $value > $threshold->upper_limit) {
                        $thresholdType = 'upper';
                        $thresholdValue = $threshold->upper_limit;
                    }
                }
                // Check humidity thresholds
                elseif ($threshold->variable === 'humidity') {
                    $value = (float)$data['H'];
                    if ($threshold->lower_limit !== null && $value < $threshold->lower_limit) {
                        $thresholdType = 'lower';
                        $thresholdValue = $threshold->lower_limit;
                    } elseif ($threshold->upper_limit !== null && $value > $threshold->upper_limit) {
                        $thresholdType = 'upper';
                        $thresholdValue = $threshold->upper_limit;
                    }
                }

                if ($thresholdType !== null) {
                    $criticalEvents[] = [
                        'uuid' => $uuid,
                        'device_id' => $data['I'],
                        'variable' => $threshold->variable,
                        'value' => $value,
                        'threshold_type' => $thresholdType,
                        'threshold_value' => $thresholdValue
                    ];
                }
            }

            // Insert critical events using Table class
            if (!empty($criticalEvents)) {
                $criticalEventsTable = $this->fetchTable('CriticalEvents');
                foreach ($criticalEvents as $event) {
                    $entity = $criticalEventsTable->newEntity($event);
                    if (!$criticalEventsTable->save($entity)) {
                        error_log('Failed to save critical event: ' . print_r($entity->getErrors(), true));
                    }
                }
            }

            // Check if we should insert into ten_minute_data
            $recent = $conn->execute(
                'SELECT TOP 1 timestamp FROM ten_minute_data WHERE device_id = ? ORDER BY timestamp DESC',
                [$data['I']]
            )->fetch('assoc');

            $shouldInsert = false;
            if (!$recent) {
                $shouldInsert = true;
            } else {
                $last = new \DateTime($recent['timestamp']);
                $now = new \DateTime();
                $interval = $now->getTimestamp() - $last->getTimestamp();
                if ($interval >= 600) {
                    $shouldInsert = true;
                }
            }

            if ($shouldInsert) {
                $conn->execute(
                    'INSERT INTO ten_minute_data (uuid, device_id, temperature, humidity, current_reading, status, timestamp)
                     VALUES (?, ?, ?, ?, ?, ?, GETDATE())',
                    [
                        $uuid,
                        $data['I'],
                        $data['T'],
                        $data['H'],
                        $data['C'],
                        $data['S']
                    ]
                );
            }

            $conn->commit();
        } catch (\Exception $e) {
            $conn->rollback();
            error_log('Transaction failed: ' . $e->getMessage());
            throw $e;
        }

        $this->response = $this->response->withType('application/json');
        $this->response = $this->response->withStringBody(json_encode([
            'status' => 'success',
            'uuid' => $uuid,
            'logged_to_10_minute_data' => $shouldInsert,
            'critical_events' => $criticalEvents
        ]));
        return $this->response;
    }
}
