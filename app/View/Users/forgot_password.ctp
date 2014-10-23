<div class="row">
	<div class="row titles">
		<h1>RECUPERA TU CLAVE</h1>
	</div>
</div>
<div class="row">
	<div class="row site_txts">
		<div class="col-md-6">
			<p></p>
			<p>¿Olvidaste tu clave? Escribe tu correo y en breve recibirás un correo de nosotros.</p>
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
			echo $this->Form->input('email', array(
				'label' => '',
				'class' => 'form-control',
				'between' => '<div class="col-lg-12">',
				'placeholder' => "Dirección de Correo",
			));
			?>
			<div class="submit contact_btn registro_btn">
				<input  formnovalidate="formnovalidate" class="btn btn-lg btn-primary" type="submit" value="Enviar Contraseña"/>
			</div>
			<?php
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>