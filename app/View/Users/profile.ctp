<style type="text/css">
	.form-group{
		margin-bottom: 5px;
		width: 99%;
	}
	.control-label{
		padding-top: 0!important;
	}
</style>
<h3>Mi Booth</h3>
<div class="row" align="left">
	<div class="col-md-3">
		<span class="thumbnail">
			<?php if (empty($user['User']['image'])) {
				echo '<img class="media-object" src="/files/users/user.jpg">';
			} else {
				echo '<img class="media-object" src="/files/users/' . $user['User']['image'] . '">';
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

		echo "<div class='form-group col-lg-5'>";
		echo $this->Form->submit('Actualizar Cambios', array('formnovalidate' => true, 'class' => 'btn btn-default'));
		echo "</div>";
		echo $this->Form->end();
		?>
	</div>
</div>

<h3>Historial de Cupones</h3>
	<?php if (!empty($user['Coupon'])) { ?>
<table class="table">
	<thead>
	<tr>
		<th>Numero de Cupon</th>
		<th>Nombre Producto</th>
		<th>Fecha generado</th>
		<th>Tienda</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($user['Coupon'] as $c) { ?>
	<tr>
		<td><?php echo $c['id']; ?></td>
		<td><?php echo $this->element('product_name', array('get_product_name' => true, 'id' => $c['product_id'])); ?></td>
		<td><?php echo date('d M Y', strtotime($c['start_date'])); ?></td>
		<td><?php echo $this->element('store_address', array('get_store_name_by_product_id' => true, 'product_id' => $c['product_id'])); ?></td>
		<td><a href="/getcoupon/<?php echo $c['id']; ?>">Imprimir</a></td>
	</tr>
	<?php } ?>
	</tbody>
</table>
	<?php } else { echo '<h4>Aún no tienes cupones generados.</h4>'; } ?>

<h3>Booth Personal</h3>
<div align="left">
	<h4><a href="/mi_booth/<?php echo $user['User']['id']; ?>">Ver mi Booth Personal</a> </h4>
	Compartir  mi Booth en redes sociales:
	<!-- AddToAny BEGIN -->
	<div class="a2a_kit a2a_kit_size_32 a2a_default_style" >

		<a class="a2a_dd" href="http://www.addtoany.com/share_save"></a>
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_google_plus"></a>
		<a class="a2a_button_email"></a>
	</div>
	<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
	<!-- AddToAny END -->
</div>


<h3>Asesoria de Imágen</h3>
<?php if (!empty($user['UserStat'])) { ?>
<div class="row" >
	<?php echo $this->element('product_name', array('get_skin_body_types' => true, 'skin_hair_type_id' => $user['UserStat'][0]['products_skin_hair_types'], 'body_type_id' => $user['UserStat'][0]['products_body_types'])); ?>
</div>
<?php } else { echo '<h4>Aún no has elegido tu estilo, <a href="/">Regresa a seleccionar tu estilo</a></h4>'; } ?>