<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * TenMinuteData Controller
 *
 * @property \App\Model\Table\TenMinuteDataTable $TenMinuteData
 * @method \App\Model\Entity\TenMinuteData[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TenMinuteDataController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tenMinuteData = $this->paginate($this->TenMinuteData);

        $this->set(compact('tenMinuteData'));
    }

    /**
     * View method
     *
     * @param string|null $id Ten Minute Data id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tenMinuteData = $this->TenMinuteData->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tenMinuteData'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tenMinuteData = $this->TenMinuteData->newEmptyEntity();
        if ($this->request->is('post')) {
            $tenMinuteData = $this->TenMinuteData->patchEntity($tenMinuteData, $this->request->getData());
            if ($this->TenMinuteData->save($tenMinuteData)) {
                $this->Flash->success(__('The ten minute data has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ten minute data could not be saved. Please, try again.'));
        }
        $this->set(compact('tenMinuteData'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ten Minute Data id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tenMinuteData = $this->TenMinuteData->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tenMinuteData = $this->TenMinuteData->patchEntity($tenMinuteData, $this->request->getData());
            if ($this->TenMinuteData->save($tenMinuteData)) {
                $this->Flash->success(__('The ten minute data has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ten minute data could not be saved. Please, try again.'));
        }
        $this->set(compact('tenMinuteData'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ten Minute Data id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tenMinuteData = $this->TenMinuteData->get($id);
        if ($this->TenMinuteData->delete($tenMinuteData)) {
            $this->Flash->success(__('The ten minute data has been deleted.'));
        } else {
            $this->Flash->error(__('The ten minute data could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
