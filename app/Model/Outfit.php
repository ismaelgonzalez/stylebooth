<?php
class Outfit extends AppModel{
	public $name = 'Outfit';
	public $useTable = 'outfits';

	public $validate = array(
		/*'title' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Nombre es requerido',
			),
		),
		'product_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Producto es requerido',
			),
		),
		'number_coupons' => array(
			'required' => array(
				'rule' => 'naturalNumber',
				'message' => 'El número de cupones disponibles tiene que ser por lo menos 1',
			),
		),                   */
	);

	public function beforeSave() {
		parent::beforeSave();
		return true;
	}
}