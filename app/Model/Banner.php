<?php
class Banner extends AppModel{
	public $name = 'Banner';
	public $useTable = 'banners';
	public $actsAs = array('Uploadable');

	public $validate = array(
		'link' => array(
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
		),
	);

	public function beforeSave() {
		parent::beforeSave();
		echo __CLASS__.' '.__FUNCTION__;
		if (!empty($this->data[$this->alias]['banner_date'])) {
			$this->data[$this->alias]['banner_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['banner_date']));
		} else {
			$this->data[$this->alias]['banner_date'] = date("Y-m-d");
		}

		$this->data[$this->alias]['status'] = 1;

		$image_name = $this->uploadPic($this->data, 'banners');

		$this->data[$this->alias]['image'] = $image_name;
		print_r($this->data);
		exit();
		return true;

	}
}