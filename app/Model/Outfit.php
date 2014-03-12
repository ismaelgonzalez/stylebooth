<?php
class Outfit extends AppModel{
	public $name = 'Outfit';
	public $useTable = 'outfits';
	public $actsAs = array('Upload');

	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Nombre es requerido',
			),
		),
		'image' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La imagen es requerida',
			),
		)
	);

	public function beforeSave() {
		parent::beforeSave();

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('outfits');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}
}