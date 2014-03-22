<?php
class BodyType extends AppModel
{
	public $name = 'BodyType';
	public $useTable = 'body_types';

	public $hasMany = array(
		'ProductsBodyType' => array(
			'className' => 'ProductsBodyType',
			'foreignKey' => 'body_type_id'
		),
	);
}
