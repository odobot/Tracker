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
}
