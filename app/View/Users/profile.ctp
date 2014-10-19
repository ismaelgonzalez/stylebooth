<div class="row">
	<div class="col-md-9" align="center">
		<div class="row">
			<div class="row titles">
				<h1>MI BOOTH</h1>
			</div>
		</div>
		<div class="row">
			<div class="row" align="left">
				<div class="col-md-3">
					<span class="thumbnail thumbs_editbooth">
						<?php if (empty($user['User']['image'])) {
							echo '<img class="media-object" src="/files/users/user.jpg">';
							$user_image = "http://stylebooth.mx/files/users/user.jpg";
						} else {
							echo '<img class="media-object" src="/files/users/' . $user['User']['image'] . '">';
							$user_image = "http://stylebooth.mx/files/users/". $user['User']['image'];
						}
						?>
					</span>
				</div>
				<div class="col-md-9" align="left">
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
								'label' => array('class' => 'control-label'),
								'before' => '<h6>',
								'after' => '</h6>',
								'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
							)
						)
					);
					echo $this->Form->input('id', array(
						'default' => array($user['User']['id']),
					));
					echo $this->Form->input('first_name', array(
						'label' => array('text' => 'Nombre', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'default' => array($user['User']['first_name']),
						'placeholder' => "Nombre",
					));
					echo $this->Form->input('last_name', array(
						'label' => array('text' => 'Apellido', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'default' => array($user['User']['last_name']),
						'placeholder' => "Apellido",
					));
					echo $this->Form->input('age', array(
						'label' => array('text' => 'Edad', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'default' => array($user['User']['age']),
						'placeholder' => "Edad",
					));
					echo $this->Form->input('job', array(
						'label' => array('text' => 'Ocupación', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'default' => array($user['User']['job']),
						'placeholder' => "Ocupación",
					));
					echo $this->Form->input('zip', array(
						'label' => array('text' => 'Código Postal', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'default' => array($user['User']['zip']),
						'placeholder' => "Código Postal",
					));
					echo $this->Form->input('email', array(
						'label' => array('text' => 'Email', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'default' => array($user['User']['email']),
						'placeholder' => "Email",
					));
					echo $this->Form->input('old_password', array(
						'label' => array('text' => 'Si desea cambiar su contraseña, escriba su contraseña anterior aqui', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'placeholder' => "Contraseña Anterior",
					));
					echo $this->Form->input('new_password', array(
						'label' => array('text' => 'y escriba su nueva contraseña aqui:', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'placeholder' => "Nueva Contraseña",
					));
					echo $this->Form->input('image', array(
						'label' => array('text' => 'Avatar', 'class' => 'control-label my-label'),
						'class' => 'form-control',
						'type' => 'file',

					));

					echo '<div class="form-group col-lg-12">
							<div class="submit contact_btn editbooth_btn">
								<input formnovalidate="formnovalidate" class="btn btn-default" type="submit" value="Actualizar Cambios">
							</div>
						</div>';
					echo $this->Form->end();
					?>
				</div>
			</div>
		</div>

		<h3>Booth Personal<br/>¨¨¨¨¨¨¨¨¨¨¨¨¨</h3>
		<div align="left" class="mibooth_share_social">
			<h4><a href="/mi_booth/<?php echo $user['User']['id']; ?>">Ver mi Booth Personal</a> </h4>
			Compartir  mi Booth en redes sociales:
			<div class="social_thumbs">
				<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst_w.jpg" alt="Instagram" border="0"/></a>
				<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>"><img src="/img/social_thumbs_fb_w.jpg" alt="Facebook" border="0"/></a>
				<a target="_blank" href="https://twitter.com/home?status=Checa Mi Booth en Stylebooth http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>"><img src="/img/social_thumbs_tw_w.jpg" alt="Twitter" border="0"/></a>
				<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>"><img src="/img/social_thumbs_go_w.jpg" alt="Google+" border="0"/></a>
				<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>&media=<?php echo $user_image; ?>&description=Checa Mi Booth en Stylebooth"><img src="/img/social_thumbs_pin_w.jpg" alt="Pinterest" border="0"/></a>
			</div>
		</div>

		<h3>Asesoria de Imágen<br/>¨¨¨¨¨¨¨¨¨¨¨¨</h3>
		<div class="row" >
			<?php echo $this->element('product_name', array('get_skin_body_types' => true, 'skin_hair_type_id' => $user['UserStat'][0]['products_skin_hair_types'], 'body_type_id' => $user['UserStat'][0]['products_body_types'])); ?>
		</div>
	</div>
</div>