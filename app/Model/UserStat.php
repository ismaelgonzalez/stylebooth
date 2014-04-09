<?php
class UserStat extends AppModel {
	public $name = 'UserStat';
	public $useTable = 'user_stats';

	public $belongsTo = array(
		'Style' => array(
			'className' => 'Style',
			'foreignKey' => 'products_styles',
			'associationForeignKey' => 'id',
		),
		'SkinHairType' => array(
			'className' => 'SkinHairType',
			'foreignKey' => 'products_skin_hair_types',
			'associationForeignKey' => 'id',
		),
		'BodyType' => array(
			'className' => 'BodyType',
			'foreignKey' => 'products_body_types',
			'associationForeignKey' => 'id',
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'id',
		),
	);
}