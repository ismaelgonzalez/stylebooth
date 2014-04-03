<?php
class StyleboothController extends AppController
{
	public $uses = array('Style', 'SkinHairType', 'BodyType', 'Product', 'Outfit', 'OutfitProduct', 'UserStat');

	public $components = array(
		'Session',
	);

	public $helpers = array('Paginator', 'Js', 'Breadcrumbs');

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
		$this->Style->recursive = -1;
		$styles = $this->Style->find('all');

		$this->set('styles', $styles);
	}

	public function filter1(){
		if (!empty($this->data)) {
			$this->Session->write('Visit.style', $this->data['style_id']);
		}
	}

	public function filter2(){
		if (!empty($this->data)) {
			$this->Session->write('Visit.budget', $this->data['budget']);
			$this->Session->write('Visit.size', $this->data['size']);
			$this->Session->write('Visit.foot_size', $this->data['foot_size']);
		}

		$this->SkinHairType->recursive = -1;
		$skin_hair_types = $this->SkinHairType->find('all');

		$this->set('skin_hair_types', $skin_hair_types);
	}

	public function filter3(){
		if (!empty($this->data)) {
			$this->Session->write('Visit.skin_hair_type', $this->data['skin_hair_type']);
		}

		$this->BodyType->recursive = -1;
		$body_types = $this->BodyType->find('all');

		$this->set('body_types', $body_types);
	}

	public function filter4(){
		$this->layout = 'filter4_layout';

		if (!empty($this->data)) {
			$this->Session->write('Visit.body_type', $this->data['body_type']);
		}

		//get related outfits from session data
		$visit = $this->Session->read('Visit');

		$budget = null;
		if (!strstr($visit['budget'], 'cualquier')) {
			if (strstr($visit['budget'], 'menos')) {
				$budget = "Product.price <= 500";
			} elseif (strstr($visit['budget'], 'mas')) {
				$budget = "Product.price >= 2000";
			} else {
				$values = split("_", $visit['budget']);
				$budget = "Product.price BETWEEN '" . $values[0] . "' AND '". $values[1] . "'";
			}
		}

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
				$budget,
			),
			'contain' => array(
				'ProductStyle' => array(
					'conditions' => array(
						'ProductStyle.style_id' => $visit['style'],
						'not' => array(
							'ProductStyle.style_id' => null,
						),
					),
				),
				'ProductSkinHairType' => array(
					'conditions' => array(
						'ProductSkinHairType.skin_hair_type_id' => $visit['skin_hair_type'],
					),
				),
				'ProductsBodyType' => array(
					'conditions' => array(
						'ProductsBodyType.body_type_id' => $visit['body_type'],
					),
				),
				'ProductSize' => array(
					'conditions' => array(
						'OR' => array(
							'ProductSize.size' => $visit['size'],
							'ProductSize.size' => $visit['foot_size'],
						),
					),
				),
				'Store',
			),
		));

		$product_ids = array();
		foreach ($products as $p) {
			$product_ids[] = $p['Product']['id'];
		}

		$product_ids = array_unique($product_ids);

		/*
		$this->OutfitProduct->recursive = -1;
		$outfit_products = $this->OutfitProduct->find('all', array(
			'conditions' => array(
				'OutfitProduct.product_id' => $product_ids,
			),
		));

		$outfit_ids = array();
		foreach ($outfit_products as $op) {
			$outfit_ids[] = $op['OutfitProduct']['outfit_id'];
			//$this->Outfit->getOutfitPrice($op['OutfitProduct']['outfit_id']);
		}

		$outfit_ids = array_unique($outfit_ids);

		//search all outfits from set of id's
		$this->Outfit->recursive = -1;
		$outfits = $this->Outfit->find('all', array(
			'conditions' => array(
				'Outfit.id' => $outfit_ids,
			),
		));
		*/
		$outfits = $this->Outfit->find('all', array(
			'contain' => array(
				'Product' => array(
					'conditions' => array(
						'Product.id' => $product_ids,
					)
				),
			),
		));

		//cleanup outfits remove the ones with empty product
		for ($i = 0; $i < sizeof($outfits); $i++) {
			if (empty($outfits[$i]['Product'])) {
				unset($outfits[$i]);
			}
		}

		$this->set('products', $products);
		$this->set('outfits', $outfits);

		$this->getFilterNames($visit['style'], $visit['skin_hair_type'], $visit['body_type']);

		//save session data to users_stats
		$user = $this->Session->read('Auth.User');
		if (empty($user)){
			$user['id'] = 0;
		}

		$us = $this->UserStat->find('first', array(
			'conditions' => array(
				'UserStat.user_id'    => $user['id'],
				'UserStat.stat_date'  => date('Y-m-d'),
				'UserStat.ip_address' => $this->request->clientIp(),
			),
		));

		if (empty($us)) {
			$this->UserStat->create();
			$userStat['UserStat'] = array(
				'product_size'             => $visit['size'],
				'product_foot_size'        => $visit['foot_size'],
				'products_styles'          => $visit['style'],
				'products_skin_hair_types' => $visit['skin_hair_type'],
				'products_body_types'      => $visit['body_type'],
				'product_budget'           => $visit['budget'],
				'user_id'                  => $user['id'],
				'stat_date'                => date('Y-m-d'),
				'ip_address'               => $this->request->clientIp(),
			);

			$this->UserStat->save($userStat);
		}
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

	private function getFilterNames($style_id, $skin_hair_type_id, $body_type_id) {
		$this->Style->recursive = -1;
		$this->SkinHairType->recursive = -1;
		$this->BodyType->recursive = -1;

		$style = $this->Style->findById($style_id);
		$skin  = $this->SkinHairType->findById($skin_hair_type_id);
		$body  = $this->BodyType->findById($body_type_id);

		$this->set('style', $style);
		$this->set('skin', $skin);
		$this->set('body', $body);
	}
}
