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

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('getBannerByType');
	}

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

		if ($banner) {
			$this->set('banner', $banner);
		} else {
			$this->Session->setFlash('No existe banner con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/banners/index');
		}

		if (!empty($this->data)) {
			if (empty($this->data['Banner']['image']['name'])) {
				unset($this->request->data['Banner']['image']);
			}
			if (!$this->Banner->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el banner :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se edit&oacute; el nuevo Banner!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/banners/index');
		}
	}

	public function delete($id) {
		$this->autoRender = false;
		$banner = $this->Banner->find('first', array(
			'conditions' => array(
				'Banner.id' => $id
			),
			'fields' => array(
				'Banner.id',
				'Banner.status'
			)
		));

		if ($banner) {
			$banner['Banner']['status'] = 0;
			$this->Banner->save($banner);
			$this->Session->setFlash('Se desactiv&oacute; el banner con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/banners/index');
		} else {
			$this->Session->setFlash('No existe banner con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/banners/index');
		}
	}

	public function getBannerByType($type) {
		$this->autoRender =  false;
		$banner = $this->Banner->find('first', array('conditions' => array('type' => $type, 'status' => 1, 'banner_date <=' => date('Y-m-d')), 'order' => array('banner_date' => 'desc')));

		if ($this->request->is('requested')) {
			return $banner;
		} else {
			$this->set('banner', $banner);
		}
	}
}