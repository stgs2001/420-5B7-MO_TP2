<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Photos Controller
 *
 * @property \App\Model\Table\PhotosTable $Photos
 *
 * @method \App\Model\Entity\Photo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhotosController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function initialize() {
        parent::initialize();

        // Include the FlashComponent
        $this->loadComponent('Flash');

        // Load Photos model
        $this->loadModel('Photos');

        // Set the layout
        $this->layout = 'default';
        $this->viewBuilder()->setLayout('cakephp_default');
    }
    
    public function isAuthorized($user) {
        if ($user['role_id'] < 3) {
            return true;
        }
        return false;
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Products'],
        ];
        $photos = $this->paginate($this->Photos);

        $this->set(compact('photos'));
        
    }

    /**
     * View method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $photo = $this->Photos->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set('photo', $photo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $uploadData = '';
        if ($this->request->is('post')) {
            if (!empty($this->request->data['file']['name'])) {
                $fileName = $this->request->data['file']['name'];
                $uploadPath = 'img/Photos/index/';
                $uploadFile = $uploadPath . $fileName;
                if (move_uploaded_file($this->request->data['file']['tmp_name'], $uploadFile)) {
                    $uploadData = $this->Photos->newEntity();
                    $uploadData->filename = $fileName;
                    $uploadData->path = $uploadPath;
                    $uploadData->created = date("Y-m-d H:i:s");
                    $uploadData->modified = date("Y-m-d H:i:s");
                    if ($this->Photos->save($uploadData)) {
                        return $this->redirect(['action' => 'index']);
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
                    } else {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            } else {
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        }
        $this->set('uploadData', $uploadData);

        $photos = $this->Photos->find('all', ['order' => ['Photos.created' => 'DESC']]);
        $photosRowNum = $photos->count();
        $this->set('photos', $photos);
        $this->set('photosRowNum', $photosRowNum);
    }

    /**
     * Edit method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $photo = $this->Photos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
            if ($this->Photos->save($photo)) {
                $this->Flash->success(__('The photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photo could not be saved. Please, try again.'));
        }
        $products = $this->Photos->Products->find('list', ['limit' => 200]);
        $this->set(compact('photo', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $photo = $this->Photos->get($id);
        if ($this->Photos->delete($photo)) {
            $this->Flash->success(__('The photo has been deleted.'));
        } else {
            $this->Flash->error(__('The photo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
