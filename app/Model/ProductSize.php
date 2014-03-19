<?php
class ProductSize extends AppModel
{
	public $name = 'ProductSize';
	public $useTable = 'product_sizes';

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'id'
		)
	);
}