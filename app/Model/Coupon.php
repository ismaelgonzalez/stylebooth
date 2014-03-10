<?php
class Coupon extends AppModel{
	public $name = 'Coupon';
	public $useTable = 'coupons';

	public $belongsTo = array('Product');

	public $validate = array(
		'title' => array(
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
		),
	);

	public function beforeSave() {
		parent::beforeSave();

		if (!empty($this->data[$this->alias]['start_date'])) {
			$this->data[$this->alias]['start_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['start_date']));
		}
		if (!empty($this->data[$this->alias]['end_date'])) {
			$this->data[$this->alias]['end_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['end_date']));
		}

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		return true;
	}
}