<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel
{
	public $name = 'User';
	public $useTable = 'users';
	public $actsAs = array('Upload', 'Containable');

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

	public $hasMany = array(
		'UserStat' => array(
			'order' => array(
				'UserStat.stat_date' => 'desc',
			),
			'limit' => 1,
		),
		'Wishlist');

	public $hasAndBelongsToMany = array(
		'Coupon' => array(
			'className' => 'Coupon',
			'joinTable' => 'coupon_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'coupon_id',
			'unique' => true,
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
		$confirm_url = 'http://www.stylebooth.mx/users/confirm/' . $reg_key . '/' . $email;

		$mail_txt = "¡Gracias por registrarte en Stylebooth!\n"
		. "Da click en el siguiente link para acompletar tu registro:\n"
		. "$confirm_url\n"
		. "Si no se abre el link, por favor copialo y pegalo en tu navegador.\n"
		. "¡Gracias!";

		return $mail_txt;
	}

	public function forgotPasswordEmail($user){
		$email = $user['User']['email'];
		$salt        = Configure::read('Security.salt');
		$passwd_key = md5($user['User']['id'] . $email .$salt );

		$mail_txt = "Has solicitado recuperar tu contraseña.\n"
			."Favor de dar click en el siguiente link:\n"
			."http://".$_SERVER['SERVER_NAME']."/users/renewPassword/".$email."/".$passwd_key."\n"
			. "Si no se abre el link, por favor copialo y pegalo en tu navegador.\n"
			. "Si no mandaste esta peticion de recuperar contraseña, ignora este email.\n"
			. "¡Gracias!";

		return $mail_txt;
	}
}