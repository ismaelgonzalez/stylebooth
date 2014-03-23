<?php
class UsersController extends AppController
{
	public $uses = array('User');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status', 'Product');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'User.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'User.id'   => 'DESC'
		)
	);

	public function index(){
		$this->set('title_for_layout', 'Administrar Usuarios');
		$this->set('pageHeader', 'Usuarios');
		$this->set('sectionTitle', 'Lista de Usuarios');

		$users = $this->paginate('User');

		$this->set('users', $users);
	}

	public function add(){
		$this->set('title_for_layout', 'Administrar Usuarios');
		$this->set('pageHeader', 'Usuarios');
		$this->set('sectionTitle', 'Agregar Usuarios');

		if (!empty($this->data)) {
			$this->User->create();
			if (empty($this->data['User']['image']['name'])) {
				unset($this->request->data['User']['image']);
			}
			if (!$this->User->save($this->data)) {
				$this->Session->setFlash('No se pudo guardar al Usuario  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; al nuevo Usuario!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/users/index');
		}
	}

	public function edit($id){
		$this->set('title_for_layout', 'Administrar Usuarios');
		$this->set('pageHeader', 'Usuarios');
		$this->set('sectionTitle', 'Editar Usuario');

		$user = $this->User->findById($id);
		if (empty($user)) {
			$this->Session->setFlash('No existe Usuario con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/users/index');
		}

		$this->set('user', $user);

		if (!empty($this->data)) {
			if (empty($this->data['User']['image']['name'])) {
				unset($this->request->data['User']['image']);
			}
			if (empty($this->data['User']['password'])) {
				unset($this->request->data['User']['password']);
			}
			if (!$this->User->save($this->data)) {
				$this->Session->setFlash('No se pudo guardar al Usuario  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; al nuevo Usuario!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/users/index');
		}
	}

	public function delete($id){
		$this->autoRender = false;
		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $id
			),
			'fields' => array(
				'User.id',
				'User.status'
			)
		));

		if ($user) {
			$user['User']['status'] = 0;
			$this->User->save($user);
			$this->Session->setFlash('Se desactiv&oacute; al Usuario con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/users/index');
		} else {
			$this->Session->setFlash('No existe Usuario con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/users/index');
		}
	}

	public function login(){

	}

	public function logout(){

	}

	public function cupones_generados($id){
		$this->autoRender = false;
		echo __FUNCTION__;
	}

	public function stats($id){
		$this->autoRender = false;
		echo __FUNCTION__;
	}
}