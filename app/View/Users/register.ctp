<style type="text/css">
	input{
		font-family: "Times New Roman", Times, serif;
	}
</style>
<?php
	echo "<h2>Registrate como usuario de Stylebooth</h2>";
	echo $this->Form->Create('User',
		array(
			'type' => 'file',
			'class' => 'form-horizontal',
			'role' => 'form',
			'inputDefaults' => array(
				'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
				'div' => array('class' => 'form-group'),
				'class' => array('form-control'),
				'label' => array('class' => 'col-lg-1 control-label'),
				'between' => '<div class="col-lg-1">',
				'after' => '</div>',
				'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
			)
		)
	);
	echo $this->Form->input('first_name', array(
		'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'between' => '<div class="col-lg-4">',
		'placeholder' => 'Nombre',
	));
	echo $this->Form->input('last_name', array(
		'label' => array('text' => 'Apellido', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'between' => '<div class="col-lg-4">',
		'placeholder' => 'Apellidos',
	));
	echo $this->Form->input('email', array(
		'label' => array('text' => 'Email', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'between' => '<div class="col-lg-4">',
		'placeholder' => 'nombre@email.com',
	));
	echo $this->Form->input('password', array(
		'label' => array('text' => 'Password', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'between' => '<div class="col-lg-4">',
		'placeholder' => 'Clave',
	));
	echo $this->Form->input('role', array(
		'type' => 'hidden',
		'value' => 'user',
	));

	echo "<div class='form-group col-lg-8'>";
	echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success pull-left'));
	echo "</div>";
	echo $this->Form->end();
