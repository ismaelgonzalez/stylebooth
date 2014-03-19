<?php
class ProductSkinHairType extends AppModel
{
	public $name = 'ProductSkinHairType';
	public $useTable = 'product_skin_hair_types';

	public $belongsTo = array(
		'SkinHairType' => array(
			'className' => 'SkinHairType',
			'foreignKey' => 'id'
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'id'
		)
	);
}