<?php
$talla = array(
	'chica',
	'mediana',
	'grande',
	'extra grande',
	'cualquier talla'
);

$calzado = array(
	'3',
	'3.5',
	'4',
	'4.5',
	'5',
	'5.5',
	'6',
	'6.5',
	'7',
	'7.5',
	'cualquier talla calzado',
);

echo $this->Form->Create('Product',
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
echo $this->Form->input('store_id', array(
	'label' => array('text' => 'Tienda', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array($stores),
	'empty' => array('' => '-- Elige una Tienda --'),
));
echo $this->Form->input('products_categories_id', array(
	'label' => array('text' => 'Categoría del Producto', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array($product_categories),
	'empty' => array('' => '-- Elige una Categoría --'),
));
echo $this->Form->input('name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">'
));
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));
echo $this->Form->input('price', array(
	'label' => array('text' => 'Precio $', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
));
?>
<div class="well">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Estilos</div>
				<div class="panel-body">
					<?php
						echo $this->Form->select('ProductStyle.style_id', $styles, array(
							'multiple' => 'checkbox'
						));
					?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Piel y Cabello</div>
				<div class="panel-body">
					<?php
					echo $this->Form->select('ProductsSkinHairType.skin_hair_type_id', $skin_hair_types, array(
						'multiple' => 'checkbox'
					));
					?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Cuerpo</div>
				<div class="panel-body">
					<?php
					echo $this->Form->select('ProductsBodyType.body_type_id', $body_types, array(
						'multiple' => 'checkbox'
					));
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Talla</div>
				<div class="panel-body">
					<?php foreach($talla as $t) { ?>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkbox" name="data[ProductSize][size][]" id="ProductSizeSize" value="<?php echo $t; ?>"><?php echo ucwords($t); ?>
						</label>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Calzado</div>
				<div class="panel-body">
					<?php foreach($calzado as $c) { ?>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkbox" name="data[ProductSize][size][]" id="ProductSizeSize" value="<?php echo $c; ?>"><?php echo ucwords($c); ?>
						</label>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success'));
echo "</div>";
echo $this->Form->end();
?>