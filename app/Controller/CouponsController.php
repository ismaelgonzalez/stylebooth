<?php
App::uses('AppController', 'Controller');

class CouponsController extends AppController {
	public $uses = array('Coupon', 'Product', 'CouponUser');

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

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'getByProductId');
	}

	public function index() {
		$this->set('title_for_layout', 'Administrar Cupones');

		$coupons = $this->paginate('Coupon');
		//echo '<pre>'; print_r($coupons); exit();
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

	public function register($id) {
		$user = $this->Session->read( 'Auth.User' );

		if ( empty( $user ) ) {
			$this->Session->setFlash('¡Necesitas estar registrado para generar cupones!', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/');
		}

		$this->layout = 'login';
		$coupon = $this->Coupon->findById($id);

		if ( empty( $coupon ) ) {
			$this->Session->setFlash('¡Este cupon no existe!', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/');
		}

		$usedCoupon = $this->CouponUser->find('first', array(
			'conditions' => array(
				'CouponUser.user_id' => $user['id'],
				'CouponUser.coupon_id' => $id,
			),
		));

		if (empty($usedCoupon)) {
			$cu['CouponUser'] = array(
				'user_id' => $user['id'],
				'coupon_id' => $id,
				'generated_key' => date('YmdHis') . $user['id'] . $id . rand(0,9),
			);

			$this->CouponUser->save($cu);

			$use_coupon['Coupon'] = array(
				'id' => $coupon['Coupon']['id'],
				'number_coupons' => $coupon['Coupon']['number_coupons']-1,
			);

			$this->Coupon->save($use_coupon);
		}

		//find updated with generated_key
		$usedCoupon = $this->CouponUser->find('first', array(
			'conditions' => array(
				'CouponUser.user_id' => $user['id'],
				'CouponUser.coupon_id' => $id,
			),
		));

		$this->set('coupon', $coupon);
		$this->set('usedCoupon', $usedCoupon);
	}

	public function generated($id){
		$coupon = $this->Coupon->findById($id);
		$this->set(compact('coupon'));
	}

	public function getByProductId($product_id){
		$this->autoRender = false;
		$coupon = $this->Coupon->find('first', array(
			'conditions' => array(
				'Coupon.product_id' => $product_id,
				'Coupon.start_date <=' => date('Y-m-d'),
				'Coupon.end_date >' => date('Y-m-d'),
				'Coupon.status' => 1,
			),
			'recursive' => -1,
		));

		if ($this->request->is('requested')) {
			return $coupon;
		} else {
			debug($coupon);
			if (!empty($coupon)) {
				echo '<h5><a href="/products/detail/' . $product_id . '">Ve Por Tu Cupon!</a></h5>';
			} else {
				echo '';
			}

		}
	}
}