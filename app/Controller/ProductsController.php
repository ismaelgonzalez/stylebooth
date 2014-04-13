<?php
class ProductsController extends AppController
{
	public $uses = array('Product', 'ProductsCategory', 'Store', 'Style', 'SkinHairType', 'BodyType',
		'ProductStyle', 'ProductsSkinHairType', 'ProductsBodyType', 'ProductSize', 'Coupon', 'Wishlist', 'Outfit'
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
		$this->Auth->allow('lista', 'detail', 'getProductsByFilter', 'addToWishList', 'getProductsByOutfit', 'getNameById', 'getSkinAndBodyType', 'getProductsByStore');
	}

	public function getbyid($product_id){
		$this->autoRender = false;
		$this->Product->recursive = -1;
		$product = $this->Product->findById($product_id);

		$div = "<div class='thumbnail col-md-1' style='margin-left:10px' id='prod_".$product['Product']['id']."'>
			<img src='/files/products/".$product['Product']['image']."' alt='".$product['Product']['name']."' width='75' class='img-thumbnail'>
			<p>Precio: $".$product['Product']['price']."
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

		$stores             = $this->Store->find('list', array('conditions' => array('Store.status' => 1)));
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
		$this->layout = 'default';

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
			),
			'order' => array(
				'Product.id' => 'desc'
			),
			//'recursive' => -1,
			'contain' => array(
				'Store',
				'Coupon'
			),
		));

		$this->set('products', $products);
	}

	public function detail($id){
		$product = $this->Product->findById($id);

		if (empty($product)) {
			$this->Session->setFlash('No existe producto con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/');
		}

		$coupon = $this->Coupon->find('first', array(
			'conditions' => array(
				'Coupon.product_id' => $id,
				'Coupon.status' => 1,
				'Coupon.number_coupons >' => 0,
				'and' => array(
					'Coupon.start_date <=' => date('Y-m-d'),
					'Coupon.end_date >=' => date('Y-m-d'),
				),
			),
		));

		$this->layout = 'default';
		$this->set('title_for_layout', 'Detalle de ' . $product['Product']['name']);
		$this->set('product', $product);
		$this->set('coupon', $coupon);
	}

	public function getProductsByFilter($filter){
		$this->autoRender = false;

		$visit = $this->Session->read('Visit');

		switch ($filter) {
			case 'Todos los Productos':
				$product_category = '';
				break;
			case 'Solo Accesorios':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
		}

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
				$product_category,
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

		return json_encode($products);
	}

	public function addToWishList($id) {
		$this->autoRender = false;
		$user = $this->Session->read( 'Auth.User' );

		if ( empty( $user ) ) {
			echo "noUser";
			return;
		}

		$product = $this->Product->findById($id);

		if ( empty( $product ) ) {
			echo "noProduct";
			return;
		}

		$wishlistProduct = $this->Wishlist->find('first', array(
			'conditions' => array(
				'Wishlist.user_id' => $user['id'],
				'Wishlist.product_id' => $id,
			),
		));

		if (empty($wishlistProduct)) {
			$wl['Wishlist'] = array(
				'user_id' => $user['id'],
				'product_id' => $id,
			);

			$this->Wishlist->save($wl);
			echo "saved";
			return;
		}
	}

	public function getProductsByOutfit($outfit_id, $filter){
		$this->autoRender = false;

		switch ($filter) {
			case 'Todos los Productos':
				$product_category = '';
				break;
			case 'Solo Accesorios':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
		}

		$outfits = $this->Outfit->find('first', array(
			'conditions' => array(
				'Outfit.id' => $outfit_id,
			),
			'contain' => array(
				'Product' => array(
					'conditions' => array(
						$product_category,
					),
				),
			),
		));

		return json_encode($outfits);
	}

	public function getNameById($id){
		$this->autoRender = false;
		$this->Product->recursive = -1;
		$product = $this->Product->findById($id);

		if ($this->request->is('requested')) {
			return $product;
		} else {
			echo $product['Product']['name'];
		}
	}

	public function getSkinAndBodyType($skin_hair_type_id, $body_type_id){
		$this->autoRender = false;
		$this->SkinHairType->recursive = -1;
		$sht = $this->SkinHairType->findById($skin_hair_type_id);
		$this->BodyType->recursive = -1;
		$bt = $this->BodyType->findById($body_type_id);

		$result = array($sht, $bt);

		if ($this->request->is('requested')) {
			return $result;
		}
	}

	public function getProductsByStore($store_id, $filter){
		$this->autoRender = false;

		switch ($filter) {
			case 'Todos los Productos':
				$product_category = '';
				break;
			case 'Solo Accesorios':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
		}

		$outfits = $this->Product->find('all', array(
			'conditions' => array(
				'Product.store_id' => $store_id,
				$product_category,
			),
			'recursive' => -1,
		));

		return json_encode($outfits);
	}

	public function getPriceById($id){
		$this->autoRender = false;
		$price = $this->Product->find('first', array(
			'conditions' => array(
				'Product.id' => $id,
			),
			'fields' => array(
				'Product.price'
			),
			'recursive' => -1
		));

		echo $price['Product']['price'];
	}
}