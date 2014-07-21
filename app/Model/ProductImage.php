<?php
class ProductImage extends AppModel {
	public $name = 'ProductImage';
	public $useTable = 'product_images';
	public $actsAs = array('Upload');

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'id'
		)
	);

	public function beforeSave() {
		parent::beforeSave();

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('products');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}
}