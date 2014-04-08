<?php
class Post extends AppModel
{
	public $name = 'Post';
	public $useTable = 'posts';
	public $actsAs = array('Upload');

	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Titulo es requerido',
			),
		),
		'text' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El texto es principal',
			),
		),
	);

	public $hasMany = array(
		'PostComment' => array(
			'order' => array(
				'PostComment.id' => 'desc',
			),
		),
	);

	public function beforeSave() {
		parent::beforeSave();

		if (!empty($this->data[$this->alias]['post_date'])) {
			$this->data[$this->alias]['post_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['post_date']));
		} else {
			$this->data[$this->alias]['post_date'] = date("Y-m-d");
		}

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if (!empty($this->data[$this->alias]['image']['name'])) {
			$image_name = $this->uploadPic('posts');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}
}