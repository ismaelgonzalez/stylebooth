<?php
class StoresController extends AppController
{
	public $uses = array('Store', 'StoreAddress', 'Product');

	public $components = array('Session', 'Paginator');

	public $helpers = array('Paginator', 'Js', 'Status', 'Product');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Store.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Store.id'   => 'DESC'
		)
	);

	public function index(){
		$this->set('title_for_layout', 'Administrar Tiendas');
		$this->set('pageHeader', 'Tiendas');
		$this->set('sectionTitle', 'Lista de Tiendas');

		$this->Paginator->settings= array(
			'conditions' => array(
				'Store.status' => 1,
			),
		);
		$stores = $this->Paginator->paginate('Store');

		$this->set('stores', $stores);
	}

	public function add(){
		$this->set('title_for_layout', 'Agregar Tienda');

		if (!empty($this->data)) {
			$this->Store->create();
			if (empty($this->data['Store']['image']['name'])) {
				unset($this->request->data['Store']['image']);
			}
			if (!$this->Store->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar la Tienda  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$store_id = $this->Store->getInsertID();
			$this->request->data['StoreAddress']['store_id'] = $store_id;
			$this->StoreAddress->save($this->request->data['StoreAddress']);

			$this->Session->setFlash('Se agreg&oacute; la nueva Tienda!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/stores/index');
		}
	}

	public function edit($id){
		$this->set('title_for_layout', 'Editar Tienda');

		$store = $this->Store->findById($id);
		//debug($store);
		//exit();
		if ($store) {
			$this->set('store', $store);
		} else {
			$this->Session->setFlash('No existe tienda con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/stores/index');
		}

		if (!empty($this->data)) {
			//debug($this->data);
			//exit();
			if (empty($this->data['Store']['image']['name'])) {
				unset($this->request->data['Store']['image']);
			}
			if (!$this->Store->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar la tienda :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->StoreAddress->save($this->request->data['StoreAddress']);

			$this->Session->setFlash('Se editó la tienda!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/stores/index');
		}
	}

	public function delete($id){
		$this->autoRender = false;
		$store = $this->Store->find('first', array(
			'conditions' => array(
				'Store.id' => $id
			),
			'fields' => array(
				'Store.id',
				'Store.status'
			)
		));

		if ($store) {
			$store['Store']['status'] = 0;
			$this->Store->save($store);
			$this->Session->setFlash('Se desactiv&oacute; la Tienda con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/stores/index');
		} else {
			$this->Session->setFlash('No existe Tienda con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/stores/index');
		}
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getStoreAddress', 'getStoreName', 'lista', 'products', 'getStoreNameByProductId');
	}

	public function getStoreAddress($store_id) {
		$this->autoRender = false;
		$store_address = $this->StoreAddress->find('first', array(
			'conditions' => array(
				'StoreAddress.store_id' => $store_id,
			),
		));

		if ($this->request->is('requested')) {
			return $store_address;
		} else {
			$this->set('store_address', $store_address);
		}
	}

	public function getStoreName($id) {
		$this->autoRender = false;
		$storeName = $this->Store->find('first', array(
			'conditions' => array(
				'Store.id' => $id,
			),
			'fields' => array(
				'Store.name'
			),
		));

		if ($this->request->is('requested')) {
			return $storeName;
		} else {
			echo $storeName['Store']['name'];
		}
	}

	public function lista(){
		$this->layout = 'default';

		$stores_norte    = $this->paginate('Store', array('Store.zone' => 'N', 'Store.status' => 1));
		$stores_sur      = $this->paginate('Store', array('Store.zone' => 'S', 'Store.status' => 1));
		$stores_poniente = $this->paginate('Store', array('Store.zone' => 'P', 'Store.status' => 1));
		$stores_oriente  = $this->paginate('Store', array('Store.zone' => 'O', 'Store.status' => 1));

		$this->set(compact('stores_norte', 'stores_sur', 'stores_poniente', 'stores_oriente'));
	}

	public function products($id){
		$this->layout = 'default';

		$store = $this->Store->findByIdAndStatus($id, 1);

		if (empty($store)) {
			$this->Session->setFlash('No existe Tienda con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/stores/lista');
		}

		$this->Product->recursive = -1;
		$products = $this->Product->find('all', array('conditions' => array('Product.store_id' => $id, 'Product.status' => 1)));

		$this->set(compact('products', 'store'));
	}

	public function getStoreNameByProductId($product_id){
		$this->autoRender = false;
		$this->Product->recursive = -1;
		$product = $this->Product->findById($product_id);

		$this->Store->recursive = -1;
		$store = $this->Store->findById($product['Product']['store_id']);

		if ($this->request->is('requested')) {
			return $store;
		} else {
			echo $store['Store']['name'];
		}
	}
}