<?php
App::uses('AppController', 'Controller');

class BannersController extends AppController {
	public $uses = array('Banner');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Banner.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Banner.banner_date' => 'DESC',
			'Banner.id' => 'DESC'
		)
	);

	public function index() {
		$this->set('title_for_layout', 'Lista de Banners');

		$banners = $this->paginate('Banner');
		$this->set('banners', $banners);
	}

	public function add() {
		$this->set('title_for_layout', 'Agregar Banners');

		if (!empty($this->data)) {
			$this->Banner->create();
			if (!$this->Banner->save($this->data)) {
				$this->Session->setFlash('No se pudo guardar el banner :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; el nuevo Banner!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/banners/index');
		}
	}

	public function edit($id) {
		$banner = $this->Banner->findById($id);
		$this->set('banner', $banner);
	}

	public function delete($id) {

	}
}