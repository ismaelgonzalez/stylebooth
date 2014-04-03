<?php
class ProductsController extends AppController
{
	public $uses = array('Product', 'ProductsCategory', 'Store', 'Style', 'SkinHairType', 'BodyType',
		'ProductStyle', 'ProductsSkinHairType', 'ProductsBodyType', 'ProductSize', 'Banner'
	);

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status', 'Checkbox');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Product.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Product.id' => 'DESC'
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('lista', 'detail');
	}

	public function getbyid($product_id){
		$this->autoRender = false;
		$this->Product->recursive = -1;
		$product = $this->Product->findById($product_id);

		$div = "<div class='thumbnail col-md-1' style='margin-left:10px' id='prod_".$product['Product']['id']."'>
			<img src='/files/products/".$product['Product']['image']."' alt='".$product['Product']['name']."' width='75' class='img-thumbnail'>
			<p>".$product['Product']['name']."<a class='close' onclick='delProd(".$product['Product']['id'].")'>x</a></p>
		</div>";

		echo $div;
	}

	public function index(){
		$this->set('title_for_layout', 'Administrar Productos');
		$this->set('pageHeader', 'Productos');
		$this->set('sectionTitle', 'Lista de Productos');

		$products = $this->paginate('Product');

		$this->set('products', $products);
	}

	public function add(){
		$this->set('title_for_layout', 'Agregar Producto');
		$this->set('pageHeader', 'Productos');
		$this->set('sectionTitle', 'Agregar Productos');

		$stores             = $this->Store->find('list');
		$product_categories = $this->ProductsCategory->find('list');
		$styles             = $this->Style->find('list');
		$skin_hair_types    = $this->SkinHairType->find('list');
		$body_types         = $this->BodyType->find('list');

		$this->set('stores', $stores);
		$this->set('product_categories', $product_categories);
		$this->set('styles', $styles);
		$this->set('skin_hair_types', $skin_hair_types);
		$this->set('body_types', $body_types);

		if (!empty($this->data)) {
			$this->Product->create();
			if (empty($this->data['Product']['image']['name'])) {
				unset($this->request->data['Product']['image']);
			}

			if (!$this->Product->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Producto  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			if (!empty($this->request->data['ProductStyle']['style_id'])) {
				for($i=0; $i<sizeof($this->request->data['ProductStyle']['style_id']); $i++) {
					$this->ProductStyle->create();
					$this->ProductStyle->save(
						$this->ProductStyle->set(
							array(
								'style_id' => $this->data['ProductStyle']['style_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductsSkinHairType']['skin_hair_type_id'])) {
				for($i=0; $i<sizeof($this->request->data['ProductsSkinHairType']['skin_hair_type_id']); $i++) {
					$this->ProductsSkinHairType->create();
					$this->ProductsSkinHairType->save(
						$this->ProductsSkinHairType->set(
							array(
								'skin_hair_type_id' => $this->data['ProductsSkinHairType']['skin_hair_type_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductsBodyType']['body_type_id'])) {
				for($i=0; $i<sizeof($this->request->data['ProductsBodyType']['body_type_id']); $i++) {
					$this->ProductsBodyType->create();
					$this->ProductsBodyType->save(
						$this->ProductsBodyType->set(
							array(
								'body_type_id' => $this->data['ProductsBodyType']['body_type_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductSize']['size'])) {
				for($i=0; $i<sizeof($this->request->data['ProductSize']['size']); $i++) {
					$this->ProductSize->create();
					$this->ProductSize->save(
						$this->ProductSize->set(
							array(
								'size' => $this->data['ProductSize']['size'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			$this->Session->setFlash('Se agreg&oacute; el Producto!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/products/index');
		}
	}

	public function edit($id){
		$this->set('title_for_layout', 'Editar Productos');
		$this->set('pageHeader', 'Productos');
		$this->set('sectionTitle', 'Editar Productos');

		$product = $this->Product->findById($id);

		if (empty($product)) {
			$this->Session->setFlash('No existe producto con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/products/index');
		}

		$stores             = $this->Store->find('list');
		$product_categories = $this->ProductsCategory->find('list');
		$styles             = $this->Style->find('list');
		$skin_hair_types    = $this->SkinHairType->find('list');
		$body_types         = $this->BodyType->find('list');

		$this->set('product', $product);
		$this->set('stores', $stores);
		$this->set('product_categories', $product_categories);
		$this->set('styles', $styles);
		$this->set('skin_hair_types', $skin_hair_types);
		$this->set('body_types', $body_types);

		if (!empty($this->data)) {
			if (empty($this->data['Product']['image']['name'])) {
				unset($this->request->data['Product']['image']);
			}

			if (!$this->Product->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Producto  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			if (!empty($this->request->data['ProductStyle']['style_id'])) {
				$this->ProductStyle->deleteAll(array(
					'product_id' => $this->request->data['Product']['id']
				), false, false);
				for($i=0; $i<sizeof($this->request->data['ProductStyle']['style_id']); $i++) {
					$this->ProductStyle->create();
					$this->ProductStyle->save(
						$this->ProductStyle->set(
							array(
								'style_id' => $this->data['ProductStyle']['style_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductsSkinHairType']['skin_hair_type_id'])) {
				$this->ProductsSkinHairType->deleteAll(array(
					'product_id' => $this->request->data['Product']['id']
				), false, false);
				for($i=0; $i<sizeof($this->request->data['ProductsSkinHairType']['skin_hair_type_id']); $i++) {
					$this->ProductsSkinHairType->create();
					$this->ProductsSkinHairType->save(
						$this->ProductsSkinHairType->set(
							array(
								'skin_hair_type_id' => $this->data['ProductsSkinHairType']['skin_hair_type_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductsBodyType']['body_type_id'])) {
				$this->ProductsBodyType->deleteAll(array(
					'product_id' => $this->request->data['Product']['id']
				), false, false);
				for($i=0; $i<sizeof($this->request->data['ProductsBodyType']['body_type_id']); $i++) {
					$this->ProductsBodyType->create();
					$this->ProductsBodyType->save(
						$this->ProductsBodyType->set(
							array(
								'body_type_id' => $this->data['ProductsBodyType']['body_type_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductSize']['size'])) {
				$this->ProductSize->deleteAll(array(
					'product_id' => $this->request->data['Product']['id']
				), false, false);
				for($i=0; $i<sizeof($this->request->data['ProductSize']['size']); $i++) {
					$this->ProductSize->create();
					$this->ProductSize->save(
						$this->ProductSize->set(
							array(
								'size' => $this->data['ProductSize']['size'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			$this->Session->setFlash('Se agreg&oacute; el Producto!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/products/index');
		}
	}

	public function delete($id) {
		$this->autoRender = false;

		$this->Product->recursive = -1;
		$product = $this->Product->find('first', array(
			'conditions' => array(
				'Product.id' => $id
			),
			'fields' => array(
				'Product.id',
				'Product.status'
			)
		));

		if ($product) {
			$product['Product']['status'] = 0;
			$this->Product->save($product);
			$this->Session->setFlash('Se desactiv&oacute; el Producto con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/products/index');
		} else {
			$this->Session->setFlash('No existe Producto con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/products/index');
		}
	}

	public function lista(){
		echo __CLASS__ . ' ' . __FUNCTION__;
		$this->layout = 'default';
	}

	public function detail($id){
		$product = $this->Product->findById($id);

		if (empty($product)) {
			$this->Session->setFlash('No existe producto con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/');
		}

		$this->getBanners();
		$this->layout = 'default';
		$this->set('title_for_layout', 'Detalle de ' . $product['Product']['name']);
		$this->set('product', $product);

		debug($product);
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