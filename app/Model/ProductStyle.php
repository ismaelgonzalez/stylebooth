<?php
class ProductStyle extends AppModel
{
	public $name = 'ProductStyle';
	public $useTable = 'product_styles';

	public $belongsTo = array(
		'Style' => array(
			'className' => 'Style',
			'foreignKey' => 'id'
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'id'
		)
	);

	public function beforeSave(){
		parent::beforeSave();

		return true;
	}

	public function afterSave(){
		parent::afterSave(true);

		//it creates a row with style_id = null for some reason here i delete it
		$this->deleteAll(array(
			'style_id' => null
		), false, false);

		return true;
	}
}