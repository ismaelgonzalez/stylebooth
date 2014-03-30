<?php
class Banner extends AppModel{
	public $name = 'Banner';
	public $useTable = 'banners';
	public $actsAs = array('Upload');

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

	public function beforeSave($options=array()) {
		parent::beforeSave();

		if (!empty($this->data[$this->alias]['banner_date'])) {
			$this->data[$this->alias]['banner_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['banner_date']));
		} else {
			$this->data[$this->alias]['banner_date'] = date("Y-m-d");
		}

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('banners');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}

	/*public function beforeFind($query){
		parent::beforeFind($query);
		$query['conditions'] = array(
			'status' => 1,
			'banner_date <= ' => date('Y-m-d')
		);

		return $query;
	}*/
}