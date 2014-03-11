<?php

class OutfitsController extends AppController
{
	public $uses = array('Outfit', 'Product');

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
}
