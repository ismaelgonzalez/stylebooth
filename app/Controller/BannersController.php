<?php
App::uses('AppController', 'Controller');

class BannersController extends AppController {
	public $uses = array('Banner');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Banner.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Banner.banner_date' => 'DESC'
		)
	);

	public function index() {
		$this->set('title_for_layout', 'Lista de Banners');

		$banners = $this->paginate('Banner');
		$this->set('banners', $banners);
	}

	public function add() {

	}
}