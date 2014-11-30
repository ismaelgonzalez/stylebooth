<?php
class ProductsController extends AppController
{
	public $uses = array('Product', 'ProductsCategory', 'Store', 'Style', 'SkinHairType', 'BodyType',
		'ProductStyle', 'ProductsSkinHairType', 'ProductsBodyType', 'ProductSize', 'Coupon', 'Wishlist', 'Outfit',
		'ProductImage'
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
		$this->Auth->allow('lista', 'detail', 'getProductsByFilter', 'addToWishList', 'getProductsByOutfit', 'getNameById', 'getSkinAndBodyType', 'getProductsByStore',
			'filterAllProducts', 'filterAllProductsFromWishlist', 'check_if_in_wishlist');
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

			//save all images here
			if (!empty($this->data['Product']['OtherImage'])) {
				foreach ($this->data['Product']['OtherImage'] as $image) {
					$this->ProductImage->create();
					$this->ProductImage->save(
						$this->ProductImage->set(
							array(
								'product_id' => $this->Product->id,
								'image' => $image
							)
						)
					);
				}
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

		$product_images = $this->ProductImage->find('list', array(
			'conditions' => array('ProductImage.product_id' => $id)
		));

		$this->set('product_images', $product_images);

		if (!empty($this->data)) {
			if (empty($this->data['Product']['image']['name'])) {
				unset($this->request->data['Product']['image']);
			}

			if (!$this->Product->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Producto  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			//delete what ever images have been chosen.
			$chosen_images = explode(",", $this->data['Product']['ChosenImages']);
			foreach ($product_images as $pi) {
				if (!in_array($pi, $chosen_images)) {
					$this->ProductImage->delete($pi);
				}
			}

			//add new other image here
			if (!empty($this->data['Product']['OtherImage'])) {
				foreach ($this->data['Product']['OtherImage'] as $image) {
					$this->ProductImage->create();
					$this->ProductImage->save(
						$this->ProductImage->set(
							array(
								'product_id' => $this->Product->id,
								'image' => $image
							)
						)
					);
				}
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
				'Coupon' => array(
					'conditions' => array(
						'Coupon.start_date <=' => date('Y-m-d'),
						'Coupon.end_date >' => date('Y-m-d'),
					),
				),
			),
		));

		$this->set('products', $products);
		$this->set('seo_keyword', 'Accesorios de moda');
		$this->set('seo_title', 'Nuestra lista general de ropa y accesorios de moda.');
		$this->set('seo_description', 'Encuentra aquí la ropa y accesorios de moda de algunas de las tiendas de ropa en Hermosillo.');
	}

	public function detail($id){
		$product = $this->Product->find('first', array(
			'conditions' => array(
				'Product.id' => $id,
				'Product.status' => 1
			)
		));

		if (empty($product)) {
			//$this->Session->setFlash('No existe producto con este ID :(', 'default', array('class'=>'alert alert-danger'));

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
		error_log(__CLASS__ . ' ' . __FUNCTION__);
		$this->add_num_view($product['Product']['id'], $product['Product']['num_views']);

		$this->layout = 'filter4_layout';
		$this->set('title_for_layout', 'Detalle de ' . $product['Product']['name']);
		$this->set('product', $product);
		$this->set('coupon', $coupon);
		$this->set('seo_keyword', 'Accesorios de moda');
		$this->set('seo_title', $product['Product']['name']);
		$this->set('seo_description', empty($product['Product']['blurb']) ? $product['Product']['name'] : $product['Product']['blurb']);
	}

	private function add_num_view($product_id, $num_views) {
		error_log(__CLASS__ . ' ' . __FUNCTION__);
		$num_views++;

		$product = array(
			'Product' => array(
				'id'           => $product_id,
				'num_views'    => $num_views,
				'update_count' => true
			)
		);

		$this->Product->save($product);
	}

	public function getProductsByFilter($filter, $sizes, $style){
		$this->autoRender = false;

		switch ($filter) {
			case 'Todos los Productos':
				$product_category = '';
				break;
			case 'Solo Blusas':
				$product_category = 'Product.products_categories_id = 1';
				break;
			case 'Solo Pantalones':
				$product_category = 'Product.products_categories_id = 2';
				break;
			case 'Solo Faldas':
				$product_category = 'Product.products_categories_id = 3';
				break;
			case 'Solo Vestidos':
				$product_category = 'Product.products_categories_id = 4';
				break;
			case 'Solo Accesorios y Bolsas':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
			case 'Solo Prendas íntimas':
				$product_category = 'Product.products_categories_id = 7';
				break;
			case 'Solo Vestidos de noche':
				$product_category = 'Product.products_categories_id = 8';
				break;
			case 'Solo Trajes de baño':
				$product_category = 'Product.products_categories_id = 9';
				break;
		}

		$joins = array(
			array(
				'table' => 'product_styles',
				'alias' => 'ProductStyle',
				'type' => 'left',
				'conditions' => array(
					'ProductStyle.product_id = Product.id',
				),
			),
			array(
				'table' => 'product_sizes',
				'alias' => 'ProductSize',
				'type' => 'left',
				'conditions' => array(
					'ProductSize.product_id = Product.id',
				),
			),
		);

		$products = $this->Product->find('all', array(
			'fields' => array('DISTINCT *', 'Store.name'),
			'joins' => $joins,
			'conditions' => array(
				'Product.status' => 1,
				$product_category,
				'OR' => array('ProductSize.size' => json_decode($sizes)),
				'OR' => array('ProductStyle.style_id' => $style)
				//'Product.price <=' => $budget,
			),
		));
		//debug($this->Product->getLastQuery());
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
			case 'Solo Blusas':
				$product_category = 'Product.products_categories_id = 1';
				break;
			case 'Solo Pantalones':
				$product_category = 'Product.products_categories_id = 2';
				break;
			case 'Solo Faldas':
				$product_category = 'Product.products_categories_id = 3';
				break;
			case 'Solo Vestidos':
				$product_category = 'Product.products_categories_id = 4';
				break;
			case 'Solo Accesorios y Bolsas':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
			case 'Solo Prendas íntimas':
				$product_category = 'Product.products_categories_id = 7';
				break;
			case 'Solo Vestidos de noche':
				$product_category = 'Product.products_categories_id = 8';
				break;
			case 'Solo Trajes de baño':
				$product_category = 'Product.products_categories_id = 9';
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
					'Store' => array(
						'fields' => array(
							'Store.name'
						),
					),
					'Coupon' => array(
						'conditions' => array(
							'Coupon.start_date <=' => date('Y-m-d'),
							'Coupon.end_date >' => date('Y-m-d'),
							'Coupon.status' => 1,
						),
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
			case 'Solo Blusas':
				$product_category = 'Product.products_categories_id = 1';
				break;
			case 'Solo Pantalones':
				$product_category = 'Product.products_categories_id = 2';
				break;
			case 'Solo Faldas':
				$product_category = 'Product.products_categories_id = 3';
				break;
			case 'Solo Vestidos':
				$product_category = 'Product.products_categories_id = 4';
				break;
			case 'Solo Accesorios y Bolsas':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
			case 'Solo Prendas íntimas':
				$product_category = 'Product.products_categories_id = 7';
				break;
			case 'Solo Vestidos de noche':
				$product_category = 'Product.products_categories_id = 8';
				break;
			case 'Solo Trajes de baño':
				$product_category = 'Product.products_categories_id = 9';
				break;
		}

		$outfits = $this->Product->find('all', array(
			'conditions' => array(
				'Product.store_id' => $store_id,
				'Product.status' => 1,
				$product_category,
			),
			'contain' => array('Coupon' => array(
				'conditions' => array(
					'Coupon.start_date <=' => date('Y-m-d'),
					'Coupon.end_date >' => date('Y-m-d'),
					'Coupon.status' => 1,
				),
			)),
		));

		return json_encode($outfits);
	}

	public function filterAllProductsFromWishlist($filter, $user_id) {
		$this->autoRender = false;
		$product_category = $this->filter_product_category($filter);

		$wishlist_products = $this->Wishlist->find('all', array(
			'conditions' => array(
				'Wishlist.user_id' => $user_id,
			),
			'recursive' => -1
		));

		$products = array();

		foreach ($wishlist_products as $w) {
			$product = $this->Product->find('first', array(
				'conditions' => array(
					$product_category,
					'Product.status' => 1,
					'Product.id' => $w['Wishlist']['product_id']
				),
			));

			if ($product) {
				$products[] = $product;
			}
		}

		return json_encode($products);
	}

	public function filterAllProducts($filter) {
		$this->autoRender = false;
		$product_category = $this->filter_product_category($filter);

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
				$product_category,
			),
		));

		return json_encode($products);
	}

	private function filter_product_category($filter) {
		switch ($filter) {
			case 'Todos los Productos':
				$product_category = '';
				break;
			case 'Solo Blusas':
				$product_category = 'Product.products_categories_id = 1';
				break;
			case 'Solo Pantalones':
				$product_category = 'Product.products_categories_id = 2';
				break;
			case 'Solo Faldas':
				$product_category = 'Product.products_categories_id = 3';
				break;
			case 'Solo Vestidos':
				$product_category = 'Product.products_categories_id = 4';
				break;
			case 'Solo Accesorios y Bolsas':
				$product_category = 'Product.products_categories_id = 5';
				break;
			case 'Solo Calzado':
				$product_category = 'Product.products_categories_id = 6';
				break;
			case 'Solo Prendas íntimas':
				$product_category = 'Product.products_categories_id = 7';
				break;
			case 'Solo Vestidos de noche':
				$product_category = 'Product.products_categories_id = 8';
				break;
			case 'Solo Trajes de baño':
				$product_category = 'Product.products_categories_id = 9';
				break;
		}

		return $product_category;
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

	public function getProductsByStoreId($store_id){
		$this->autoRender = false;

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
				'Product.store_id' => $store_id,
			),
		));

		$options = "<option value=''>-- Elige un Producto --</option>";
		foreach ($products as $p) {
			$options .= "<option value='".$p['Product']['id']."'>".$p['Product']['name']."</option>";
		}

		echo $options;
	}

	public function batch_delete($id_list) {
		$this->autoRender = false;
		$id_arr = explode("_", $id_list);

		foreach ($id_arr as $id) {
			if (!empty($id)) {
				$product = $this->Product->find('first', array(
					'conditions' => array(
						'Product.id' => $id
					),
					'fields' => array(
						'Product.id',
						'Product.status'
					),
					'recursive' => '1',
				));

				$product['Product']['status'] = 0;
				$this->Product->save($product);
			}
		}

		$this->Session->setFlash('Se desactivaron los Productos con exito!', 'default', array('class'=>'alert alert-success'));
		return $this->redirect('/products/');
	}

	public function check_if_in_wishlist($product_id, $user_id) {
		$this->autoRender = false;

		$wishlist = $this->Wishlist->find('first', array(
			'recursive'  => -1,
			'conditions' => array(
				'product_id' => $product_id,
				'user_id'    => $user_id
			),
		));

		if (!empty($wishlist)) {
			return true;
		}

		return false;
	}
}