<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->viewBuilder()->setLayout('cakephp_default');
        $this->Auth->allow(['getByCategory', 'view', 'logout', 'index']);
        $this->Auth->deny(['add', 'edit', 'delete']);
        if ($this->Auth->user('id') > 0) {
            $this->Auth->allow(['add']);
        }
    }
    
    public function isAuthorized($user) {
        if ($user['role_id'] < 3) {
            return true;
        }
        
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the product belongs to the current user.
        $product = $this->Products->findBy_id($slug)->first();

        return $product->user_id === $user['id'];
    }
    
    public function getByCategory() {
        $category_id = $this->request->query('category_id');

        $products = $this->Products->find('all', [
            'conditions' => ['Products.category_id' => $category_id],
        ]);
        $this->set('products', $products);
        $this->set('_serialize', ['products']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Categories', 'Photos'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Users', 'Categories', 'Accessories', 'Issues', 'Photos'],
        ]);

        $this->set('product', $product);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $accessories = $this->Products->Accessories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'users', 'categories', 'accessories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => ['Accessories', 'Categories'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $users = $this->Products->Users->find('list', ['limit' => 200]);
        $categories = $this->Products->Categories->find('list', ['limit' => 200]);
        $accessories = $this->Products->Accessories->find('list', ['limit' => 200]);
        $this->set(compact('product', 'users', 'categories', 'accessories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
