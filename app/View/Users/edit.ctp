<?php
echo $this->Form->Create('User',
	array(
		'type' => 'file',
		'class' => 'form-horizontal',
		'role' => 'form',
		'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'form-group'),
			'class' => array('form-control'),
			'label' => array('class' => 'col-lg-2 control-label'),
			'between' => '<div class="col-lg-2">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
		)
	)
);
echo $this->Form->input('id', array(
	'default' => array($user['User']['id']),
));
echo $this->Form->input('first_name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => array($user['User']['first_name']),
));
echo $this->Form->input('last_name', array(
	'label' => array('text' => 'Apellido', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => array($user['User']['last_name']),
));
echo $this->Form->input('email', array(
	'label' => array('text' => 'Email', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => array($user['User']['email']),
));
echo $this->Form->input('passwd', array(
	'label' => array('text' => 'Cambiar el Password@', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
));
echo $this->Form->input('role', array(
	'label' => array('text' => 'Rol', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array(
		"" => "-- Elegir Rol --",
		'admin' => 'Admin',
		'user' => 'Usuario',
	),
	'default' => array($user['User']['role']),
));
if ($user['User']['image']){
	echo "<div class='row'><div class='col-lg-2'></div><div class='col-lg-10'>";
	$this->Product->avatar_thumbnail($user, 250);
	echo "</div></div>";
}
echo $this->Form->input('image', array(
	'label' => array('text' => 'Avatar', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));

echo $this->Form->input('job', array(
	'label' => array('text' => 'Ocupación', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => array($user['User']['job']),
));
echo $this->Form->input('age', array(
	'label' => array('text' => 'Edad', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => array($user['User']['age']),
));
echo $this->Form->input('zip', array(
	'label' => array('text' => 'Código Postal', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => array($user['User']['zip']),
));
echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success'));
echo "</div>";
echo $this->Form->end();
?>