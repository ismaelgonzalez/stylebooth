<?php
class Product extends AppModel{
	public $name = 'Product';
	public $useTable = 'products';

	public $validate = array(
		/*'link' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Link es requerido',
			),
		),
		'type' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La posición es requerida',
			),
		),*/
	);

	public function beforeSave() {
		parent::beforeSave();

		/*if (!empty($this->data[$this->alias]['banner_date'])) {
			$this->data[$this->alias]['banner_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['banner_date']));
		} else {
			$this->data[$this->alias]['banner_date'] = date("Y-m-d");
		}

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('banners');
			$this->data[$this->alias]['image'] = $image_name;
		} */

		return true;
	}
}