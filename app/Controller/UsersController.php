<?php
class UsersController extends AppController
{
	public $uses = array('User');

	public $components = array(
		'Session',
		'Auth' => array(
			'authorize' => array('Controller'),
			'authenticate' => array(
				'Form' => array(
					'fields' => array(
						'username' => 'email',
						'password' => 'password'
					),
					'scope' => array(
						'User.status' => 1,
						'User.signin_complete' => 1,
					),
				),
			),
		),
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout', 'register', 'registered', 'confirm');
	}

	public function isAuthorized($user) {
		if ($this->action === 'add' || $this->action === 'delete') {
			return parent::isAuthorized($user);
		}

		return true;
	}

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

			$this->Session->setFlash('Se editó al Usuario!', 'default', array('class'=>'alert alert-success'));

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
		$this->layout = 'login';

		if($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->Auth->User('role') === 'admin') {
					return $this->redirect('/admin');
				} elseif ($this->Auth->User('role') === 'user') {
					return $this->redirect('/mi_booth/' . $this->Auth->User('id'));
				}
				//return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Email o passowrd incorrectos, por favor intente de nuevo.'), 'default', array('class' => 'alert alert-danger'));
		}

		$this->set('title_for_layout', 'Accesa a tu cuenta');
	}

	public function logout(){
		$this->autoRender = false;
		return $this->redirect($this->Auth->logout());
	}

	public function cupones($id){
		$this->autoRender = false;
		echo __FUNCTION__;
	}

	public function stats($id){
		$this->autoRender = false;
		echo __FUNCTION__;
	}

	public function register(){
		$this->layout = 'default';
		$this->set('title_for_layout', 'Registrate como Usuario de Stylebooth');

		if (!empty($this->data)) {
			$user = $this->User->findByEmail($this->data['User']['email']);
			if ($this->data['User']['email'] != $user['User']['email']) {
				$this->User->create();
				if (!$this->User->save($this->data)) {
					$this->Session->setFlash('No se pudo guardar al Usuario', 'default', array('class'=>'alert alert-danger'));

					return false;
				}

				$user = $this->User->findById($this->User->getInsertID());
				$salt        = Configure::read('Security.salt');
				$reg_key     = md5($user['User']['email'] . $user['User']['id'] . $salt);

				$user['User']['reg_key'] = $reg_key;
				$this->User->save($user);

				$register_email = $this->User->confirmEmail($user);

				App::uses('CakeEmail', 'Network/Email');
				$Email = new CakeEmail('smtp');
				$Email->from(array('no-reply@stylebooth.com' => 'Stylebooth'))
					->to($user['User']['email'])
					->subject('Confirma tu registro en Stylebooth')
					->send($register_email);

				$this->Session->setFlash('Tu Usuario ha sido registrado. Sigue las siguientes instrucciones.', 'default', array('class'=>'alert alert-success'));

				return $this->redirect('/users/registered');
			} else {
				$this->Session->setFlash('¡¡Ya existe un usuario con este email!!', 'default', array('class'=>'alert alert-danger'));

				return false;
			}
		}
	}

	public function registered(){
		$this->layout = 'default';
		$this->set('title_for_layout', 'Confirma tu cuenta de Usuario de Stylebooth');
	}

	public function confirm($reg_key, $email){
		$this->autoRender = false;
		$salt             = Configure::read('Security.salt');
		$user             = $this->User->findByEmailAndStatusAndSigninComplete($email, 1, 0);
		$confirm_key      = md5($user['User']['email'].$user['User']['id'].$salt);

		if ($reg_key == $confirm_key) {
			$user_confirm = array('User' => array(
				'id'              => $user['User']['id'],
				'signin_complete' => 1,
			));
			if ($this->User->save($user_confirm)) {
				$this->Auth->login($user['User']);
				$this->Session->setFlash('Validación de Usuario Completa!', 'default', array('class'=>'alert alert-success'));
				return $this->redirect('/');
			}

		} else {
			$this->Session->setFlash('Usuario Invalido :(', 'default', array('class'=>'alert alert-danger'));
			return $this->redirect('/');
		}
	}
}