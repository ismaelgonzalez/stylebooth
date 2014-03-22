<?php
class SkinHairType extends AppModel
{
	public $name = 'SkinHairType';
	public $useTable = 'skin_hair_types';

	public $hasMany = array(
		'ProductSkinHairType' => array(
			'className' => 'ProductSkinHairType',
			'foreignKey' => 'skin_hair_type_id'
		),
	);
}
