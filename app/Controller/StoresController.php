<?php
class StoresController extends AppController
{
	public $uses = array('Store');

	public $components = array('Session');

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

		$stores = $this->Store->find('all', array(
			'conditions' => array(
				'Store.status' => 1,
			),
		));

		$this->set('stores', $stores);
	}

	public function add(){
		$this->set('title_for_layout', 'Agregar Tienda');

		if (!empty($this->data)) {
			$this->Store->create();
			if (empty($this->data['Store']['image']['name'])) {
				unset($this->request->data['Store']['image']);
			}
			if (!$this->Store->save($this->data)) {
				$this->Session->setFlash('No se pudo guardar la Tienda  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; la nueva Tienda!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/stores/index');
		}
	}

	public function edit($id){
		$this->set('title_for_layout', 'Editar Tienda');

		$store = $this->Store->findById($id);

		if ($store) {
			$this->set('store', $store);
		} else {
			$this->Session->setFlash('No existe tienda con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/stores/index');
		}

		if (!empty($this->data)) {
			if (empty($this->data['Store']['image']['name'])) {
				unset($this->request->data['Store']['image']);
			}
			if (!$this->Store->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar la tienda :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

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
}