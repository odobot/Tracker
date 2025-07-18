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
        $this->loadModel('ThresholdLimits');
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
    public function view($deviceId = null, $variable = null)
    {
        $thresholdLimit = $this->ThresholdLimits->get([
            'device_id' => $deviceId,
            'variable' => $variable
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
    public function delete($deviceId = null, $variable = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $thresholdLimit = $this->ThresholdLimits->get([
            'device_id' => $deviceId,
            'variable' => $variable
        ]);

        if ($this->ThresholdLimits->delete($thresholdLimit)) {
            $this->Flash->success(__('The threshold limit has been deleted.'));
        } else {
            $this->Flash->error(__('The threshold limit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function saveThreshold()
    {
        $this->request->allowMethod(['post']);
        $data = $this->request->input('json_decode', true);

        if (!$data || !isset($data['device_id'], $data['variable'], $data['lower_limit'], $data['upper_limit'])) {
            throw new BadRequestException('Invalid JSON or missing fields');
        }

        // Check if threshold exists
        $existing = $this->ThresholdLimits->find()
            ->where([
                'device_id' => $data['device_id'],
                'variable' => $data['variable']
            ])
            ->first();

        if ($existing) {
            $threshold = $this->ThresholdLimits->patchEntity($existing, [
                'lower_limit' => $data['lower_limit'],
                'upper_limit' => $data['upper_limit']
            ]);
        } else {
            $threshold = $this->ThresholdLimits->newEntity([
                'device_id' => $data['device_id'],
                'variable' => $data['variable'],
                'lower_limit' => $data['lower_limit'],
                'upper_limit' => $data['upper_limit']
            ]);
        }

        if ($this->ThresholdLimits->save($threshold)) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'success'
                ]));
        } else {
            $errors = $threshold->getErrors();
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]));
        }
    }
}
