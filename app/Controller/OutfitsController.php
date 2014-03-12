<?php

class OutfitsController extends AppController
{
	public $uses = array('Outfit', 'Product', 'ProductsCategory');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Outfit.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Coupon.id' => 'DESC'
		)
	);

	public function index() {
		$this->set('title_for_layout', 'Administrar Outfits');

		$outfits = $this->paginate('Outfit');
		$this->set('outfits', $outfits);
	}

	public function add() {
		$this->set('title_for_layout', 'Agregar Outfits');

		$products_categories = $this->ProductsCategory->find('list');
		$this->set('products_categories', $products_categories);

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
}
