<?php
class Style extends AppModel
{
	public $name = 'Style';
	public $useTable = 'styles';

	public $hasMany = array(
		'ProductStyle' => array(
			'className' => 'ProductStyle',
			'foreignKey' => 'style_id'
		),
	);
}
