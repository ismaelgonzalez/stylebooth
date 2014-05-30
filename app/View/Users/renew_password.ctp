<?php
echo $this->Form->create('User', array(
	'type'=>'post',
	'class' => 'form-horizontal',
	'role' => 'form',
	'inputDefaults' => array(
		'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
		'div' => array('class' => 'form-group'),
		'class' => array('form-control'),
		'label' => array('class' => 'col-lg-2 control-label'),
		'between' => '<div class="col-lg-12">',
		'after' => '</div>',
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
	)
));
echo "<h2 class='form-sigin-heading'>Ingresar a Stylebooth</h2>";
echo $this->Form->input('email', array(
	'type' => 'hidden',
	'default' => $email,
));
echo $this->Form->input('passwd_key', array(
	'type' => 'hidden',
	'default' => $passwd_key,
));
echo $this->Form->input('password', array(
	'label' => '',
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'placeholder' => "Nueva Clave de Acceso",
));
echo $this->Form->input('confirm_password', array(
	'type' => 'password',
	'label' => '',
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'placeholder' => "Confirme su Nueva Clave de Acceso",
));
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-lg btn-primary'));
echo $this->Form->end();
