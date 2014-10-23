<div class="row">
	<div class="row titles">
		<h1>REGÍSTRATE</h1>
	</div>
</div>
<div class="row site_txts">
	<div class="col-md-8" align="center">
		<div class="row">
			<p>¡Regístrate como usuario de Stylebooth!</p>
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
				'between' => '<div class="col-lg-10">',
				'placeholder' => 'Nombre',
			));
			echo $this->Form->input('last_name', array(
				'label' => array('text' => 'Apellido', 'class' => 'control-label my-label col-lg-2'),
				'class' => 'form-control',
				'between' => '<div class="col-lg-10">',
				'placeholder' => 'Apellidos',
			));
			?>
			<div class="form-group required">
				<label for="UserLastName" class="control-label">Fecha de Nacimiento:</label>
				<div class="col-md-10">
					<div class="registro_nacimiento">
						<select name="dia">
							<?php for ($m=1; $m <= 31; $m++) {
								if ($m < 10) {
									echo '<option value="0' . $m . '">0' . $m . '</option>';
								} else {
									echo '<option value="' . $m . '">' . $m . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="registro_nacimiento">
						<select name="mes">
							<?php
							$meses =  array('Ene', 'Feb', 'Mar', 'Abr',  'May',  'Jun',  'Jul',  'Ago',  'Sep',  'Oct',  'Nov',  'Dic' );
							for ($m=1; $m < 13; $m++) {
								if ($m < 10) {
									echo '<option value="0' . $m . '">' . $meses[$m-1] . '</option>';
								} else {
									echo '<option value="' . $m . '">' . $meses[$m-1] . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="registro_nacimiento">
						<select name="ano">
							<?php for ($m=1970; $m <= date('Y'); $m++) {
									echo '<option value="' . $m . '">' . $m . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<?php
			echo $this->Form->input('email', array(
				'label' => array('text' => 'Email', 'class' => 'control-label my-label col-lg-2'),
				'class' => 'form-control',
				'between' => '<div class="col-lg-10">',
				'placeholder' => 'nombre@email.com',
			));
			echo $this->Form->input('password', array(
				'label' => array('text' => 'Password', 'class' => 'control-label my-label col-lg-2'),
				'class' => 'form-control',
				'between' => '<div class="col-lg-10">',
				'placeholder' => 'Clave',
			));
			echo $this->Form->input('role', array(
				'type' => 'hidden',
				'value' => 'user',
			));
			?>
			<div class="form-group col-lg-10">
				<div class="submit contact_btn registro_btn">
					<input formnovalidate="formnovalidate" class="btn btn-success pull-left" type="submit" value="Enviar">
				</div>
			</div>
			<?php
			echo $this->Form->end();
			?>

</div>
	</div>
</div>
<hr>

<style type="text/css">
	input{
		font-family: "Times New Roman", Times, serif;
	}
</style>
