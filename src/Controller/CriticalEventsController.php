<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * CriticalEvents Controller
 *
 * @property \App\Model\Table\CriticalEventsTable $CriticalEvents
 * @method \App\Model\Entity\CriticalEvent[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CriticalEventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $criticalEvents = $this->paginate($this->CriticalEvents);

        $this->set(compact('criticalEvents'));
    }

    /**
     * View method
     *
     * @param string|null $id Critical Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $criticalEvent = $this->CriticalEvents->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('criticalEvent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $criticalEvent = $this->CriticalEvents->newEmptyEntity();
        if ($this->request->is('post')) {
            $criticalEvent = $this->CriticalEvents->patchEntity($criticalEvent, $this->request->getData());
            if ($this->CriticalEvents->save($criticalEvent)) {
                $this->Flash->success(__('The critical event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The critical event could not be saved. Please, try again.'));
        }
        $this->set(compact('criticalEvent'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Critical Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $criticalEvent = $this->CriticalEvents->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $criticalEvent = $this->CriticalEvents->patchEntity($criticalEvent, $this->request->getData());
            if ($this->CriticalEvents->save($criticalEvent)) {
                $this->Flash->success(__('The critical event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The critical event could not be saved. Please, try again.'));
        }
        $this->set(compact('criticalEvent'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Critical Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $criticalEvent = $this->CriticalEvents->get($id);
        if ($this->CriticalEvents->delete($criticalEvent)) {
            $this->Flash->success(__('The critical event has been deleted.'));
        } else {
            $this->Flash->error(__('The critical event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
