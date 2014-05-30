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
	'label' => '',
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'placeholder' => "Dirección de Correo",
));
echo $this->Form->input('password', array(
	'label' => '',
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'placeholder' => "Clave de Acceso",
));
?>
<p>
	<h4><a href="/users/forgotPassword">¿Se te olvido tu contraseña?</a> </h4>
</p>
<?php
echo $this->Form->submit('Ingresar', array('formnovalidate' => true, 'class' => 'btn btn-lg btn-primary'));
echo $this->Form->end();
