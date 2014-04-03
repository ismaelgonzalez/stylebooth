<?php
class Outfit extends AppModel{
	public $name = 'Outfit';
	public $useTable = 'outfits';
	public $actsAs = array('Upload');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Nombre es requerido',
			),
		),
	);

	public $hasMany = array(
		'OutfitProduct' => array(
			'className' => 'OutfitProduct',
			'foreignKey' => 'outfit_id'
		)
	);

	public function beforeSave() {
		parent::beforeSave();

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('outfits');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}

	public function getOutfitPrice($outfit_id) {
		$outfit = $this->findById($outfit_id);

		debug($outfit);

		App::import('Model', 'Product');
		$product = new Product();

		$outfit_price = 0;
		foreach ($outfit['OutfitProduct'] as $op) {
			$price = $product->getPrice($op['product_id']);
			$outfit_price += $price;
		}

		return $outfit_price;
	}
}