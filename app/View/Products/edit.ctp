<script src="/js/chosen.jquery.js"></script>
<link rel="stylesheet" href="/css/chosen.css">
<link rel="stylesheet" href="/css/chosen.bootstrap.css">
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
echo $this->Form->input('id', array(
	'default' => $product['Product']['id'],
));
echo $this->Form->input('store_id', array(
	'label' => array('text' => 'Tienda', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array($stores),
	'empty' => array('' => '-- Elige una Tienda --'),
	'between' => '<div class="col-lg-4">',
	'default' => $product['Product']['store_id'],
));
echo $this->Form->input('products_categories_id', array(
	'label' => array('text' => 'Categoría del Producto', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array($product_categories),
	'empty' => array('' => '-- Elige una Categoría --'),
	'between' => '<div class="col-lg-4">',
	'default' => $product['Product']['products_categories_id'],
));
echo $this->Form->input('name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => $product['Product']['name'],
));
echo $this->Form->input('blurb', array(
	'label' => array('text' => 'Descripción', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-8">',
	'default' => $product['Product']['blurb'],
));
echo "<div class='row'>";
$this->Product->product_thumbnail($product, 250);
echo "</div>";
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));
echo $this->Form->input('price', array(
	'label' => array('text' => 'Precio $', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'default' => $product['Product']['price'],
));
?>
<div class="panel panel-default panel-info">
	<div class="panel-heading">Imagenes Adicionales</div>
	<div class="panel-body">
		<div class="row" style="padding: 10px;">
			<h5>Imagenes del Producto Adicionales</h5>
			<?php
				foreach ($product['ProductImage'] as $p) {
					$this->Product->product_images_thumbnail($p, 75);
				}
			?>
			<input type="hidden" name="data[Product][ChosenImages]" id="ProductChosenImages" value="<?php echo implode(",",$product_images); ?>">
		</div>
		<p><a id="addAdditionalImage" class="btn btn-success"><i class="icon-plus"></i></a> Agregar Imagen Adicional</p>
	</div>
</div>
<div class="well">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default panel-info">
				<div class="panel-heading">Estilos</div>
				<div class="panel-body">
					<?php
					echo $this->Form->select('ProductStyle.style_id', $styles, array(
						'multiple' => 'checkbox',
						'default' => $this->Checkbox->getChecked($product['ProductStyle'], 'style_id'),
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
					echo $this->Form->select('ProductSkinHairType.skin_hair_type_id', $skin_hair_types, array(
						'multiple' => 'checkbox',
						'default' => $this->Checkbox->getChecked($product['ProductSkinHairType'], 'skin_hair_type_id'),
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
						'multiple' => 'checkbox',
						'default' => $this->Checkbox->getChecked($product['ProductsBodyType'], 'body_type_id'),
					));
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<?php if ($product['Product']['products_categories_id'] != 5 && $product['Product']['products_categories_id'] != 6 ) { ?>
			<div class="col-md-4 panel-talla" style="display: block;">
				<div class="panel panel-default panel-info">
					<div class="panel-heading">Talla</div>
					<div class="panel-body">
						<?php foreach($talla as $t) { ?>
						<div class="checkbox">
							<label>
								<input type="checkbox" class="checkbox" name="data[ProductSize][size][]" id="ProductSizeSize" value="<?php echo $t; ?>" <?php if ( in_array( $t, $this->Checkbox->getSizeChecked( $product['ProductSize'], 'size' ) ) ) { echo 'checked'; } ?>><?php echo ucwords($t); ?>
							</label>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php }
			if ($product['Product']['products_categories_id'] == 6) {
		?>
			<div class="col-md-4 panel-calzado" style="display: block;">
				<div class="panel panel-default panel-info">
					<div class="panel-heading">Calzado</div>
					<div class="panel-body">
						<?php foreach($calzado as $c) { ?>
						<div class="checkbox">
							<label>
								<input type="checkbox" class="checkbox" name="data[ProductSize][size][]" id="ProductSizeSize" value="<?php echo $c; ?>" <?php if ( in_array( $c, $this->Checkbox->getSizeChecked( $product['ProductSize'], 'size' ) ) ) { echo 'checked'; } ?>><?php echo ucwords($c); ?>
							</label>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<?php
echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success'));
echo "</div>";
echo $this->Form->end();
?>
<script type="text/javascript">
	$(function (){
		$('#ProductStoreId').chosen({allow_single_deselect: true, autocomplete: true});
		$('#ProductProductsCategoriesId').change(function() {
			$category = $(this).val();

			if ($category == 5) {
				$('.panel-talla').hide();
				$('.panel-calzado').hide();
			} else if ($category == 6) {
				$('.panel-talla').hide();
				$('.panel-calzado').show();
			} else {
				$('.panel-talla').show();
				$('.panel-calzado').hide();
			}
		});

		var cx = 1;
		$("#addAdditionalImage").click(function(){
			$(this).before("<div class='col-lg-12 ai_" + cx + "' style='margin-bottom: 10px'><label for='ProductOtherImage'>Imagen Adicional</label><div class=''><input name='data[Product][OtherImage][]' type='file' id='ProductOtherImage' style='margin-right: 0px; display: inline-block;'><button type='button' class='btn-sm btn-danger' onclick='removeThis(" + cx + ")'>X</button></div></div>");
			cx++;
			console.log(cx);
		});
	});

	function removeThis(cx_value) {
		console.log(cx_value);
		var $image_row = $(".ai_" + cx_value);
		$image_row.remove();
	}

	function delProd(prod_id){
		$("#prod_"+prod_id).remove();
		var arrProd = $("#ProductChosenImages").val().split(',');

		for (i=0; i<arrProd.length; i++) {
			if (arrProd[i] == prod_id) {
				arrProd.splice(i, 1);
			}
		}

		$('#ProductChosenImages').val(arrProd.toString());

		rest_budget(prod_id);
	}
</script>