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
	);

	public $hasMany = array(
		'OutfitProduct' => array(
			'className' => 'OutfitProduct',
			'foreignKey' => 'outfit_id'
		)
	);

	public function beforeSave() {
		parent::beforeSave();

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['image']['name'])){
			$image_name = $this->uploadPic('outfits');
			$this->data[$this->alias]['image'] = $image_name;
		}

		/*echo "<pre>".__CLASS__.__FUNCTION__;
		print_r($this->data);
		exit();*/
		return true;
	}
}