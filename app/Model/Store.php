<?php
class Store extends AppModel
{
	public $name = 'Store';
	public $useTable = 'stores';
	public $actsAs = array('Upload');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Nombre es requerido',
			),
		),
		'url' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El URL es requerido',
			),
		),
		'zone' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La Zona es requerida',
			),
		),
	);

	public function beforeFind($query){
		parent::beforeFind($query);
		$query['conditions'] = array(
			'status' => 1
		);

		return $query;
	}

	public function beforeSave() {
		parent::beforeSave();

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if (!empty($this->data[$this->alias]['image']['name'])) {
			$image_name = $this->uploadPic('stores');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}
}