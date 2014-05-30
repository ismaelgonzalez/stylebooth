<?php

class OutfitsController extends AppController
{
	public $uses = array('Outfit', 'OutfitProduct', 'Product', 'ProductsCategory');

	public $components = array('Paginator', 'Session');

	public $helpers = array('Paginator', 'Js', 'Status', 'Product');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Outfit.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Outfit.id' => 'DESC'
		)
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('detail', 'getOutfitTotalPrice');
	}

	public function index() {
		$this->set('title_for_layout', 'Administrar Outfits');

		$this->Paginator->settings = $this->paginate;
		$outfits = $this->Paginator->paginate('Outfit');
		$this->set('outfits', $outfits);
	}

	public function add() {
		$this->set('title_for_layout', 'Agregar Outfits');

		$products_categories = $this->ProductsCategory->find('list');
		$this->set('products_categories', $products_categories);

		if (!empty($this->data)) {
			$this->Outfit->create();

			if (empty($this->data['Outfit']['image']['name'])) {
				unset($this->request->data['Outfit']['image']);
			}

			if (!$this->Outfit->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Outfit :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			//OUTFIT_PRODUCTS
			$outfit_id = $this->Outfit->getInsertID();
			$products = explode(',', $this->data['OutfitProducts']['OutfitId']);

			$outfit_products = array();

			foreach ($products as $key => $value) {
				$outfit_products[] = array(
					'OutfitProduct' => array(
						'outfit_id' => $outfit_id,
						'product_id' => $value
					)
				);
			}

			if (!$this->OutfitProduct->saveAll($outfit_products)) {
				$this->Session->setFlash('No se pudo guardar el Outfit PRODUCT :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; el nuevo Outfit!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/outfits/index');
		}
	}

	public function edit($id) {
		$this->set('title_for_layout', 'Editar Outfit');
		$outfit = $this->Outfit->findById($id);

		if ($outfit) {
			$this->set('outfit', $outfit);
			$products_categories = $this->ProductsCategory->find('list');
			$this->set('products_categories', $products_categories);

			$outfit_products = array();
			foreach ($outfit['Product'] as $o) {
				$outfit_products[] = $o['id'];
			}

			$outfit_products = implode(',', $outfit_products);
			$this->set('outfit_products', $outfit_products);
		} else {
			$this->Session->setFlash('No existe outfit con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/outfits/index');
		}

		if (!empty($this->data)) {
			$outfit_id = $this->data['Outfit']['id'];

			if (empty($this->data['Outfit']['image']['name'])) {
				unset($this->request->data['Outfit']['image']);
			}
			if (!$this->Outfit->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Outfit :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			//OUTFIT_PRODUCTS
			$outfit_id       = $this->data['Outfit']['id'];
			$products        = explode(',', $this->data['OutfitProducts']['OutfitId']);
			$outfit_products = array();
			$this->OutfitProduct->deleteAll(array('OutfitProduct.outfit_id' => $outfit_id), false);

			foreach ($products as $key => $value) {
				$outfit_products[] = array(
					'OutfitProduct'  => array(
						'outfit_id'  => $outfit_id,
						'product_id' => $value
					)
				);
			}

			if (!$this->OutfitProduct->saveAll($outfit_products)) {
				$this->Session->setFlash('No se pudo guardar el Outfit PRODUCT :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; el nuevo Outfit!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/outfits/index');
		}
	}

	public function delete($id) {
		$this->autoRender = false;
		$this->Outfit->recursive = -1;
		$outfit = $this->Outfit->find('first', array(
			'conditions' => array(
				'Outfit.id' => $id
			),
			'fields' => array(
				'Outfit.id',
				'Outfit.status'
			)
		));

		if ($outfit) {
			$outfit['Outfit']['status'] = 0;
			$this->Outfit->save($outfit);
			$this->Session->setFlash('Se desactiv&oacute; el outfit con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/outfits/index');
		} else {
			$this->Session->setFlash('No existe outfit con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/outfits/index');
		}
	}

	public function getStoresByCategoryId($category_id){
		$this->autoRender = false;
		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.products_categories_id' => $category_id,
				'Product.status' => 1,
			),
		));

		$arr_stores = array();
		foreach($products as $p){
			$arr_stores[] = array($p['Store']['id'], $p['Store']['name']);
		}

		$arr_stores = array_intersect_key( $arr_stores , array_unique( array_map('serialize' , $arr_stores ) ) );

		$options = "<option value=''>-- Elige una Tienda --</option>";
		foreach ($arr_stores as $s) {
			$options .= "<option value='". $s[0] ."'>". $s[1] ."</option>";
		}

		echo $options;
	}

	public function getproducts($store_id, $category_id){
		$this->autoRender = false;

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.products_categories_id' => $category_id,
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

	public function detail($id) {
		$this->layout = 'filter4_layout';
		$outfit = $this->Outfit->findById($id);

		if (empty($outfit)) {
			$this->Session->setFlash('No existe outfit con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/');
		}

		$this->layout = 'default';
		$this->set('title_for_layout', 'Detalle de ' . $outfit['Outfit']['name']);

		$this->set('outfit', $outfit);
	}

	public function getOutfitTotalPrice($id){
		$this->autoRender = false;
		$outfits = $this->Outfit->find('first', array(
			'conditions' => array(
				'Outfit.status' => 1,
				'Outfit.id' => $id,
			),
			'contain' => array(
				'Product' => array(
					'conditions' => array(
						'Product.status' => 1,
					),
				),
			),
		));

		$total_price = 0;
		$products    = $outfits['Product'];

		foreach ($products as $p) {
			$total_price += $p['price'];
		}

		if ($this->request->is('requested')) {
			return $total_price;
		} else {
			$this->set('total_price', $total_price);
		}

	}

	public function batch_delete($id_list) {
		$this->autoRender = false;
		$id_arr = explode("_", $id_list);

		foreach ($id_arr as $id) {
			if (!empty($id)) {
				$outfit = $this->Outfit->find('first', array(
					'conditions' => array(
						'Outfit.id' => $id
					),
					'fields' => array(
						'Outfit.id',
						'Outfit.status'
					),
					'recursive' => '1',
				));

				$outfit['Outfit']['status'] = 0;
				$this->Outfit->save($outfit);
			}
		}

		$this->Session->setFlash('Se desactivaron los Outfits con exito!', 'default', array('class'=>'alert alert-success'));
		return $this->redirect('/outfits/');
	}
}
