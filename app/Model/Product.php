<?php
class Product extends AppModel{
	public $name = 'Product';
	public $useTable = 'products';
	public $actsAs = array('Upload', 'Containable');

	public $validate = array(
		'products_categories_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La Categoría del Producto es requerido',
			),
		),
		'store_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La Tienda es requerida',
			),
		),
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El nombre es requerido',
			),
		),
		'price' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El precio es requerido',
			),
		),
	);

	public $hasMany = array(
		'OutfitProduct' => array(
			'className' => 'OutfitProduct',
			'foreignKey' => 'product_id'
		),
		'ProductSize' => array(
			'className' => 'ProductSize',
			'foreignKey' => 'product_id'
		),
		'ProductStyle' => array(
			'className' => 'ProductStyle',
			'foreignKey' => 'product_id'
		),
		'ProductsBodyType' => array(
			'className' => 'ProductsBodyType',
			'foreignKey' => 'product_id'
		),
		'ProductSkinHairType' => array(
			'className' => 'ProductSkinHairType',
			'foreignKey' => 'product_id'
		),
	);

	public $belongsTo = array(
		'Store' => array(
			'className' => 'Store',
			'foreignKey' => 'store_id'
		),
		'ProductsCategory' => array(
			'className' => 'ProductsCategory',
			'foreignKey' => 'products_categories_id'
		)
	);

	public function beforeSave() {
		parent::beforeSave();

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('products');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}

	public function getPrice($product_id) {
		$price = $this->find('first', array(
			'fields' => array('Product.price'),
			'conditions' => array('Product.id' => $product_id),
			'recursive' => -1,
		));

		return $price['Product']['price'];
	}
}