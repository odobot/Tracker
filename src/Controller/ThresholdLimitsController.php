<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ThresholdLimits Controller
 *
 * @property \App\Model\Table\ThresholdLimitsTable $ThresholdLimits
 * @method \App\Model\Entity\ThresholdLimit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThresholdLimitsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $thresholdLimits = $this->paginate($this->ThresholdLimits);

        $this->set(compact('thresholdLimits'));
    }

    /**
     * View method
     *
     * @param string|null $id Threshold Limit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $thresholdLimit = $this->ThresholdLimits->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('thresholdLimit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $thresholdLimit = $this->ThresholdLimits->newEmptyEntity();
        if ($this->request->is('post')) {
            $thresholdLimit = $this->ThresholdLimits->patchEntity($thresholdLimit, $this->request->getData());
            if ($this->ThresholdLimits->save($thresholdLimit)) {
                $this->Flash->success(__('The threshold limit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The threshold limit could not be saved. Please, try again.'));
        }
        $this->set(compact('thresholdLimit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Threshold Limit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $thresholdLimit = $this->ThresholdLimits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $thresholdLimit = $this->ThresholdLimits->patchEntity($thresholdLimit, $this->request->getData());
            if ($this->ThresholdLimits->save($thresholdLimit)) {
                $this->Flash->success(__('The threshold limit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The threshold limit could not be saved. Please, try again.'));
        }
        $this->set(compact('thresholdLimit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Threshold Limit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $thresholdLimit = $this->ThresholdLimits->get($id);
        if ($this->ThresholdLimits->delete($thresholdLimit)) {
            $this->Flash->success(__('The threshold limit has been deleted.'));
        } else {
            $this->Flash->error(__('The threshold limit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Get thresholds for a specific device
     *
     * @param string|null $deviceId Device ID
     * @return \Cake\Http\Response|null|void
     */
    public function getByDevice($deviceId = null)
    {
        $this->request->allowMethod(['get']);
        
        $thresholds = $this->ThresholdLimits->find()
            ->where(['device_id' => $deviceId])
            ->all();

        $this->set([
            'thresholds' => $thresholds,
            '_serialize' => ['thresholds']
        ]);
    }

    /**
     * Set threshold limits for a device and variable
     *
     * @return \Cake\Http\Response|null|void
     * @throws \Cake\Http\Exception\BadRequestException When missing required fields
     */
    // public function setThresholds()
    // {
    //     $this->request->allowMethod(['post']);
    //     $data = $this->request->getData();

    //     // Validate required fields more strictly
    //     if (empty($data['device_id']) || empty($data['variable'])) {
    //         throw new BadRequestException("device_id and variable are required fields.");
    //     }

    //     // Ensure numeric values for limits
    //     $data['lower_limit'] = isset($data['lower_limit']) ? (float)$data['lower_limit'] : null;
    //     $data['upper_limit'] = isset($data['upper_limit']) ? (float)$data['upper_limit'] : null;

    //     // Find existing or create new threshold
    //     $threshold = $this->ThresholdLimits->find()
    //         ->where([
    //             'device_id' => $data['device_id'],
    //             'variable' => $data['variable']
    //         ])
    //         ->first();

    //     if (!$threshold) {
    //         $threshold = $this->ThresholdLimits->newEmptyEntity();
    //     }

    //     $threshold = $this->ThresholdLimits->patchEntity($threshold, $data);

    //     if (!$this->ThresholdLimits->save($threshold)) {
    //         $this->response = $this->response->withStatus(400);
    //         $response = [
    //             'status' => 'error',
    //             'message' => 'Validation failed',
    //             'errors' => $threshold->getErrors()
    //         ];
    //     } else {
    //         $response = [
    //             'status' => 'success',
    //             'data' => $threshold
    //         ];
    //     }

    //     $this->set(compact('response'));
    //     $this->viewBuilder()->setOption('serialize', ['response']);
    // }
    // src/Controller/ThresholdLimitsController.php
    public function setThresholds()
    {
        $this->request->allowMethod(['post']);
        
        // Get raw input to verify
        $rawInput = $this->request->input('json_decode');
        error_log('Raw input: ' . print_r($rawInput, true));
        
        // Get parsed data
        $data = $this->request->getData();
        error_log('Parsed data: ' . print_r($data, true));
        
        // Validate required fields
        if (empty($data['device_id'])) {
            throw new BadRequestException('device_id is required');
        }
        if (empty($data['variable'])) {
            throw new BadRequestException('variable is required');
        }
        
        // Force type casting
        $data['device_id'] = (int)$data['device_id'];
        $data['variable'] = (string)$data['variable'];
        
        // Find or create entity
        $threshold = $this->ThresholdLimits->find()
            ->where([
                'device_id' => $data['device_id'],
                'variable' => $data['variable']
            ])
            ->first();
        
        if (!$threshold) {
            $threshold = $this->ThresholdLimits->newEmptyEntity();
        }
        
        // Patch entity with validated data
        $threshold = $this->ThresholdLimits->patchEntity($threshold, $data, [
            'validate' => true,
            'fields' => ['device_id', 'variable', 'lower_limit', 'upper_limit']
        ]);
        
        // Debug final entity state
        error_log('Entity before save: ' . print_r($threshold->toArray(), true));
        
        // Save with transaction
        $connection = $this->ThresholdLimits->getConnection();
        $connection->begin();
        
        try {
            if ($this->ThresholdLimits->save($threshold)) {
                $connection->commit();
                $response = [
                    'status' => 'success',
                    'data' => $threshold
                ];
            } else {
                $connection->rollback();
                $this->response = $this->response->withStatus(400);
                $response = [
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $threshold->getErrors()
                ];
            }
        } catch (\Exception $e) {
            $connection->rollback();
            error_log('Database error: ' . $e->getMessage());
            throw $e;
        }
        
        $this->set(compact('response'));
        $this->viewBuilder()->setOption('serialize', ['response']);
    }
}
