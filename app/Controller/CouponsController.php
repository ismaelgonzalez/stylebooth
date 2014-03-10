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
		$this->set('title_for_layout', 'Administrar Cupones');

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
				$this->Session->setFlash('No se pudo guardar el cupon :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; el nuevo Cupon!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/coupons/index');
		}
	}

	public function edit($id) {
		$this->set('title_for_layout', 'Editar Cupones');
		$coupon = $this->Coupon->findById($id);

		if ($coupon) {
			$this->set('coupon', $coupon);
			$products = $this->Product->find('list');
			$this->set('products', $products);
		} else {
			$this->Session->setFlash('No existe cupon con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/coupons/index');
		}

		if (!empty($this->data)) {
			if (empty($this->data['Coupon']['image']['name'])) {
				unset($this->request->data['Coupon']['image']);
			}
			if (!$this->Coupon->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el cupon :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se edit&oacute; el Cupon!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/coupons/index');
		}
	}

	public function delete($id) {
		$this->autoRender = false;
		$coupon = $this->Coupon->find('first', array(
			'conditions' => array(
				'Coupon.id' => $id
			),
			'fields' => array(
				'Coupon.id',
				'Coupon.status'
			)
		));

		if ($coupon) {
			$coupon['Coupon']['status'] = 0;
			$this->Coupon->save($coupon);
			$this->Session->setFlash('Se desactiv&oacute; el cupon con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/coupons/index');
		} else {
			$this->Session->setFlash('No existe cupon con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/coupons/index');
		}
	}
}