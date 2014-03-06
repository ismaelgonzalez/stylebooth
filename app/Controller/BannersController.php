<?php
App::uses('AppController', 'Controller');

class BannersController extends AppController {
	public $uses = array('Banner');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Banner.banner_date' => 'DESC'
		)
	);

	public function index() {
		echo __FILE__;
	}
}