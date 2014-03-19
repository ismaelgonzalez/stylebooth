<?php
class ProductsBodyType extends AppModel
{
	public $name = 'ProductsBodyType';
	public $useTable = 'products_body_types';

	public $belongsTo = array(
		'BodyType' => array(
			'className' => 'BodyType',
			'foreignKey' => 'id'
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'id'
		)
	);
}