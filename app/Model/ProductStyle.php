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
}