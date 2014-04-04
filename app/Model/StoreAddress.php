<?php
class StoreAddress extends AppModel {
	public $name = 'StoreAddress';
	public $useTable = 'store_addresses';

	public $belongsTo = array(
		'Store' => array(
			'className' => 'Store',
			'foreignKey' => 'id'
		),
	);
}