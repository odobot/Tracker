<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * LiveData Controller
 *
 * @property \App\Model\Table\LiveDataTable $LiveData
 * @method \App\Model\Entity\LiveData[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LiveDataController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('LiveData');
        $this->request->allowMethod(['post']);
        $this->autoRender = false;
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $liveData = $this->paginate($this->LiveData);

        $this->set(compact('liveData'));
    }

    /**
     * View method
     *
     * @param string|null $id Live Data id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $liveData = $this->LiveData->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('liveData'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $liveData = $this->LiveData->newEmptyEntity();
        if ($this->request->is('post')) {
            $liveData = $this->LiveData->patchEntity($liveData, $this->request->getData());
            if ($this->LiveData->save($liveData)) {
                $this->Flash->success(__('The live data has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The live data could not be saved. Please, try again.'));
        }
        $this->set(compact('liveData'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Live Data id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $liveData = $this->LiveData->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $liveData = $this->LiveData->patchEntity($liveData, $this->request->getData());
            if ($this->LiveData->save($liveData)) {
                $this->Flash->success(__('The live data has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The live data could not be saved. Please, try again.'));
        }
        $this->set(compact('liveData'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Live Data id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $liveData = $this->LiveData->get($id);
        if ($this->LiveData->delete($liveData)) {
            $this->Flash->success(__('The live data has been deleted.'));
        } else {
            $this->Flash->error(__('The live data could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function receive()
    {
        $this->request->allowMethod(['post']);
        $data = $this->request->input('json_decode', true);

        if (!$data || !isset($data['I'], $data['T'], $data['H'], $data['C'], $data['R'], $data['L'], $data['S'])) {
            throw new BadRequestException('Invalid JSON or missing fields');
        }

        $status = (int)$data['S'];
        $uuid = \Cake\Utility\Text::uuid();

        // --- LIVE DATA UPSERT ---
        $existing = $this->LiveData->find()
            ->where(['device_id' => $data['I']])
            ->first();

        if ($existing) {
            $liveData = $this->LiveData->patchEntity($existing, [
                'uuid' => $uuid,
                'temperature' => $data['T'],
                'humidity' => $data['H'],
                'current_reading' => $data['C'],
                'GpsX' => $data['R'],
                'GpsY' => $data['L'],
                'status' => $status,
            ]);
        } else {
            $liveData = $this->LiveData->newEntity([
                'uuid' => $uuid,
                'device_id' => $data['I'],
                'temperature' => $data['T'],
                'humidity' => $data['H'],
                'current_reading' => $data['C'],
                'GpsX' => $data['R'],
                'GpsY' => $data['L'],
                'status' => $status,
            ]);
        }

        $this->LiveData->saveOrFail($liveData);

        // --- TEN_MINUTE_DATA INSERT CONDITIONALLY ---
        $tenMinuteTable = $this->fetchTable('TenMinuteData');
        $lastEntry = $tenMinuteTable->find()
            ->where(['device_id' => $data['I']])
            ->order(['timestamp' => 'DESC'])
            ->first();

        $now = new \DateTimeImmutable();
        $shouldInsert = false;

        if (!$lastEntry) {
            $shouldInsert = true;
        } else {
            $lastTimestamp = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $lastEntry->timestamp->format('Y-m-d H:i:s'));
            if ($now->getTimestamp() - $lastTimestamp->getTimestamp() >= 600) {
                $shouldInsert = true;
            }
        }

        if ($shouldInsert) {
            $tenMinuteEntity = $tenMinuteTable->newEntity([
                'uuid' => $uuid,
                'device_id' => $data['I'],
                'temperature' => (float)$data['T'],
                'humidity' => (float)$data['H'],
                'current_reading' => (float)$data['C'],
                'GpsX' => (float)$data['R'],
                'GpsY' => (float)$data['L'],
                'status' => $status
            ]);
            $tenMinuteTable->saveOrFail($tenMinuteEntity);
        }

        // --- THRESHOLD CHECK & CRITICAL EVENTS ---
        $thresholds = $this->fetchTable('ThresholdLimits')->find()
            ->where(['device_id' => $data['I']])
            ->all();

        foreach ($thresholds as $threshold) {
            $value = null;
            if ($threshold->variable === 'temperature') {
                $value = (float)$data['T'];
            } elseif ($threshold->variable === 'humidity') {
                $value = (float)$data['H'];
            } elseif ($threshold->variable === 'current') {
                $value = (float)$data['C'];
            }

            if ($value !== null && (
                ($threshold->lower_limit !== null && $value < $threshold->lower_limit) ||
                ($threshold->upper_limit !== null && $value > $threshold->upper_limit)
            )) {
                $criticalData = $this->fetchTable('CriticalEvents')->newEntity([
                    'uuid' => $uuid,
                    'device_id' => $data['I'],
                    'temperature' => (float)$data['T'],
                    'humidity' => (float)$data['H'],
                    'current_reading' => (float)$data['C'],
                    'gps_x' => (float)$data['R'],
                    'gps_y' => (float)$data['L'],
                    'status' => $status === 0 ? 'Close' : 'Open',
                    'critical_label' => ucfirst($threshold->variable)
                ]);
                $this->fetchTable('CriticalEvents')->saveOrFail($criticalData);
            }
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'status' => 'success',
                'uuid' => $uuid
            ]));
    }
}
