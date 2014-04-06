<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel
{
	public $name = 'User';
	public $useTable = 'users';
	public $actsAs = array('Upload');

	public $validate = array(
		'first_name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Nombre es requerido',
			),
		),
		'last_name' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Apellido es requerido',
			),
		),
		'email' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El email es requerido',
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Necesita ser un email valido!'
			),
		),
		'password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'La password es requerida',
			),
			'minLength' => array(
				'rule' => array('minLength', 8),
				'message' => 'La password ocupa mínimo 8 caracteres.',
			),
		),
		'role' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'El Rol es requerido',
			),
		),
	);

	public function beforeSave() {
		parent::beforeSave();

		$this->data[$this->alias]['status'] = isset($this->data[$this->alias]['status']) ? $this->data[$this->alias]['status'] : 1;

		if(!empty($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}

		if (!empty($this->data[$this->alias]['image']['name'])) {
			$image_name = $this->uploadPic('users');
			$this->data[$this->alias]['image'] = $image_name;
		}

		return true;
	}

	public function confirmEmail($user){
		$reg_key     = $user['User']['reg_key'];
		$email       = $user['User']['email'];
		$confirm_url = 'http://stylebooth/users/confirm/' . $reg_key . '/' . $email;

		$mail_txt = "¡Gracias por registrarte en Stylebooth!\n"
		. "Da click en el siguiente link para acompletar tu registro:\n"
		. "$confirm_url\n"
		. "Si no se abre el link, por favor copialo y pegalo en tu navegador.\n"
		. "¡Gracias!";

		return $mail_txt;
	}
}