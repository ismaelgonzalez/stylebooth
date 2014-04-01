<?php
class StyleboothController extends AppController
{
	public $uses = array('Banner', 'Style', 'SkinHairType', 'BodyType', 'Product', 'Outfit');

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

	public function filter1($style_id = null){

		$this->getBanners();

		$style = $this->Session->read('Visit.style');

		if (empty($style)) {
			$this->Session->write('Visit.style', $style_id);
		}
	}

	public function filter2($budget = null, $size = null, $foot_size = null){
		$this->getBanners();

		$b = $this->Session->read('Visit.budget');
		$s = $this->Session->read('Visit.size');
		$f = $this->Session->read('Visit.foot_size');

		if (empty($b) || empty($s) || empty($f)) {
			$this->Session->write('Visit.budget', $budget);
			$this->Session->write('Visit.size', $size);
			$this->Session->write('Visit.foot_size', $foot_size);
		}

		$this->SkinHairType->recursive = -1;
		$skin_hair_types = $this->SkinHairType->find('all');

		$this->set('skin_hair_types', $skin_hair_types);
	}

	public function filter3($skin_hair_type = null){
		$this->getBanners();

		$sk = $this->Session->read('Visit.skin_hair_type');

		if (empty($sk)) {
			$this->Session->write('Visit.skin_hair_type', $skin_hair_type);
		}

		$this->BodyType->recursive = -1;
		$body_types = $this->BodyType->find('all');

		$this->set('body_types', $body_types);
	}

	public function filter4($body_type = null){
		$this->layout = 'filter4_layout';
		$this->getBanners();

		$bt = $this->Session->read('Visit.body_type');

		if (empty($bt)) {
			$this->Session->write('Visit.body_type', $body_type);
		}

		//get related outfits from session data
		$visit = $this->Session->read('Visit');

		debug($visit);

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

		$query = "SELECT Product.*"
		. " FROM products Product LEFT JOIN product_styles s ON Product.id = s.product_id"
		. " LEFT JOIN products_skin_hair_types sht ON Product.id = sht.product_id"
		. " LEFT JOIN products_body_types bt ON Product.id = bt.product_id"
		. " LEFT JOIN product_sizes z ON Product.id = z.product_id"
		. " WHERE s.style_id = " . $visit['style']
		. " AND sht.skin_hair_type_id = " . $visit['skin_hair_type']
		. " AND bt.body_type_id = " . $visit['body_type'];

		if (!empty($visit['size']) && !empty($visit['foot_size'])) {
			$query .= " AND (z.size = '" . $visit['size'] . "' OR z.size = '" . $visit['foot_size'] . "')";
		}

		if ($budget) {
			$query .= ' AND ' . $budget;
		}

		debug($query);
		$products = $this->Product->query($query);

		$arr_products = array();
		foreach ($products as $p) {
			$arr_products[] = $p['Product']['id'];
		}

		$outfits = $this->Outfit->find('all', array(
			'conditions' => array(
				'OutfitProduct.product_id' => $arr_products
			)
		));

		debug($outfits);

		/*$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
			),
			'contain' => array(
				'ProductStyle' => array('conditions' => array('ProductStyle.style_id' => $visit['style'])),
			),
		));*/

		$this->set('products', $products);

		debug($products);

		//save session data to users_stats
		//get products from related outfits
		//build breadcrumbs
		//if signed in remove data from right column
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
