<?php
App::uses('AppController', 'Controller');

class CouponsController extends AppController {
	public $uses = array('Coupon', 'Product');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Coupon.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Coupon.start_date' => 'DESC',
			'Coupon.id' => 'DESC'
		)
	);

	public function index() {
		$this->set('title_for_layout', 'Lista de Cupones');

		$coupons = $this->paginate('Coupon');
		$this->set('coupons', $coupons);
	}

	public function add() {
		$this->set('title_for_layout', 'Agregar Cupones');
		$products = $this->Product->find('list');
		$this->set('products', $products);

		if (!empty($this->data)) {
			$this->Coupon->create();
			if (!$this->Coupon->save($this->data)) {
				$this->Session->setFlash('No se pudo guardar el banner :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; el nuevo Coupon!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/coupons/index');
		}
	}

	public function edit($id) {
		$banner = $this->Coupon->findById($id);

		if ($banner) {
			$this->set('banner', $banner);
		} else {
			$this->Session->setFlash('No existe banner con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/coupons/index');
		}

		if (!empty($this->data)) {
			if (empty($this->data['Coupon']['image']['name'])) {
				unset($this->request->data['Coupon']['image']);
			}
			if (!$this->Coupon->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el banner :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se edit&oacute; el nuevo Coupon!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/coupons/index');
		}
	}

	public function delete($id) {
		$this->autoRender = false;
		$banner = $this->Coupon->find('first', array(
			'conditions' => array(
				'Coupon.id' => $id
			),
			'fields' => array(
				'Coupon.id',
				'Coupon.status'
			)
		));

		if ($banner) {
			$banner['Coupon']['status'] = 0;
			$this->Coupon->save($banner);
			$this->Session->setFlash('Se desactiv&oacute; el banner con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/coupons/index');
		} else {
			$this->Session->setFlash('No existe banner con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/coupons/index');
		}
	}
}