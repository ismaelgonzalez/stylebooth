<?php
class StyleboothController extends AppController
{
	public $uses = array();

	public $components = array(
		'Session',
	);

	public $helpers = array('Paginator', 'Js');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	public function isAuthorized($user) {
		if ($this->action === 'dashboard') {

			return parent::isAuthorized($user);
		}else if ($this->action === "my_booth" && ($user['role'] === 'admin' || $user['role'] === 'user')) {

			return true;
		}

		return true;
	}

	public function index(){

	}

	public function dashboard(){
		$this->layout = 'admin';
		$this->set('title_for_layout', 'Administrador de Stylebooth');
		$this->set('pageHeader', 'Dashboard');
		$this->set('sectionTitle', 'Dashboard');
	}

	public function my_booth($user_id){
		$this->autoRender = false;
		echo __FUNCTION__;
		var_dump($user_id);
	}
}