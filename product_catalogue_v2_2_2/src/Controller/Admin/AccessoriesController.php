<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Accessories Controller
 *
 * @property \App\Model\Table\AccessoriesTable $Accessories
 *
 * @method \App\Model\Entity\Accessory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccessoriesController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $accessories = $this->paginate($this->Accessories);

        $this->set(compact('accessories'));
    }

    /**
     * View method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $accessory = $this->Accessories->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('accessory', $accessory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $accessory = $this->Accessories->newEntity();
        if ($this->request->is('post')) {
            $accessory = $this->Accessories->patchEntity($accessory, $this->request->getData());
            if ($this->Accessories->save($accessory)) {
                $this->Flash->success(__('The accessory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessory could not be saved. Please, try again.'));
        }
        $products = $this->Accessories->Products->find('list', ['limit' => 200]);
        $this->set(compact('accessory', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $accessory = $this->Accessories->get($id, [
            'contain' => ['Products'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessory = $this->Accessories->patchEntity($accessory, $this->request->getData());
            if ($this->Accessories->save($accessory)) {
                $this->Flash->success(__('The accessory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The accessory could not be saved. Please, try again.'));
        }
        $products = $this->Accessories->Products->find('list', ['limit' => 200]);
        $this->set(compact('accessory', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Accessory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $accessory = $this->Accessories->get($id);
        if ($this->Accessories->delete($accessory)) {
            $this->Flash->success(__('The accessory has been deleted.'));
        } else {
            $this->Flash->error(__('The accessory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
