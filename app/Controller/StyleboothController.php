<?php
class StyleboothController extends AppController
{
	public $uses = array('Banner', 'Style');

	public $components = array(
		'Session',
	);

	public $helpers = array('Paginator', 'Js', 'Banner');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','filter1','filter2','filter3','filter4');
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
		$this->Style->recursive = -1;
		$styles = $this->Style->find('all');

		$this->set('styles', $styles);
	}

	public function filter1($style_id){
		if (empty($style_id)) {
			return $this->redirect('/');
		}

		$this->getBanners();
	}

	public function filter2($budget = null, $size = null, $foot_size = null){
		$this->getBanners();
	}

	public function filter3(){
		$this->getBanners();
	}

	public function filter4(){
		$this->layout = 'filter4_layout';
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
		$bannerTop   = $this->Banner->find('first', array('conditions' => array('type' => 'U', 'status' => 1, 'banner_date <=' => date('Y-m-d')), 'order' => array('banner_date' => 'desc')));
		$bannerDown  = $this->Banner->find('first', array('conditions' => array('type' => 'D', 'status' => 1, 'banner_date <=' => date('Y-m-d')), 'order' => array('banner_date' => 'desc')));
		$bannerLeft  = $this->Banner->find('first', array('conditions' => array('type' => 'L', 'status' => 1, 'banner_date <=' => date('Y-m-d')), 'order' => array('banner_date' => 'desc')));
		$bannerRight = $this->Banner->find('first', array('conditions' => array('type' => 'R', 'status' => 1, 'banner_date <=' => date('Y-m-d')), 'order' => array('banner_date' => 'desc')));

		$this->set('bannerTop', $bannerTop);
		$this->set('bannerDown', $bannerDown);
		$this->set('bannerLeft', $bannerLeft);
		$this->set('bannerRight', $bannerRight);
	}
}
