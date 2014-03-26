<?php
class StyleboothController extends AppController
{
	public $uses = array('Banner');

	public $components = array(
		'Session',
	);

	public $helpers = array('Paginator', 'Js', 'Banner');

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
		$this->getBanners();
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

	private function getBanners(){
		$bannerTop   = $this->Banner->findByType('U');
		$bannerDown  = $this->Banner->findByType('D');
		$bannerLeft  = $this->Banner->findByType('L');
		$bannerRight = $this->Banner->findByType('R');

		$this->set('bannerTop', $bannerTop);
		$this->set('bannerDown', $bannerDown);
		$this->set('bannerLeft', $bannerLeft);
		$this->set('bannerRight', $bannerRight);
	}
}