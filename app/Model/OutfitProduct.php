<?php
class OutfitProduct extends AppModel
{
	public $name = 'OutfitProduct';
	public $useTable = 'outfit_products';

	/*public $hasAndBelongsToMany = array(
		'Outfit' => array(
			'className' => 'Outfit',
			'foreignKey' => 'id'
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'id'
		)
	);*/
}