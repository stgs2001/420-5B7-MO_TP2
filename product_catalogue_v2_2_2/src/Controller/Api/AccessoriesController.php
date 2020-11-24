<?php

namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * Accessories Controller
 *
 * @property \App\Model\Table\AccessoriesTable $accessories
 *
 * @method \App\Model\Entity\Accessory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccessoriesController extends AppController {

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    
    public function isAuthorized($user) {
        if ($user['role_id'] < 3) {
            return true;
        }
        return false;
    }

    public function index()
    {
        $accessories = $this->Accessories->find('all');
        $this->set([
            'accessories' => $accessories,
            '_serialize' => ['accessories']
        ]);
    }

    public function view($id)
    {
        $accessory = $this->Accessories->get($id);
        $this->set([
            'accessory' => $accessory,
            '_serialize' => ['accessory']
        ]);
    }

    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $accessory = $this->Accessories->newEntity($this->request->getData());
        if ($this->Accessories->save($accessory)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'accessory' => $accessory,
            '_serialize' => ['message', 'accessory']
        ]);
    }

    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $accessory = $this->Accessories->get($id);
        $accessory = $this->Accessories->patchEntity($accessory, $this->request->getData());
        if ($this->Accessories->save($accessory)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $accessory = $this->Accessories->get($id);
        $message = 'Deleted';
        if (!$this->Accessories->delete($accessory)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}
