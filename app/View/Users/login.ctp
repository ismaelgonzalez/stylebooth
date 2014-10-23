<div class="row">
	<div class="row titles">
		<h1>INGRESA A TU CUENTA</h1>
	</div>
</div>

<div class="row site_txts">
	<div class="col-md-6">
		<p></p>
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
			'between' => '<div class="col-lg-12">',
			'placeholder' => "Dirección de Correo",
		));
		echo $this->Form->input('password', array(
			'label' => '',
			'class' => 'form-control',
			'between' => '<div class="col-lg-12">',
			'placeholder' => "Clave de Acceso",
		));
		?>
		<p>
			<a href="/users/forgotPassword">¿Se te olvido tu contraseña?</a>
		</p>
		<div class="submit contact_btn registro_btn">
			<input formnovalidate="formnovalidate" class="btn btn-lg btn-primary" type="submit" value="Ingresar">
		</div>
		<?php
			echo $this->Form->end();
		?>
</div>
</div>

