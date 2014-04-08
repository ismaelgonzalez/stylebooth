<?php
class PostComment extends AppModel {
	public $name = 'PostComment';
	public $useTable = 'post_comments';

	public $actsAs = array('Containable');

	public $validate = array(
		'user_id' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'Necesitas estar logueado para comentar',
			),
		),
		'comment' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'No has escrito un comentario',
			),
		),
	);

	public $belongsTo = array('Post', 'User');

	public function beforeSave() {
		parent::beforeSave();

		if (!empty($this->data[$this->alias]['comment_date'])) {
			$this->data[$this->alias]['comment_date'] = date("Y-m-d", strtotime($this->data[$this->alias]['comment_date']));
		} else {
			$this->data[$this->alias]['comment_date'] = date("Y-m-d");
		}

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		return true;
	}
}