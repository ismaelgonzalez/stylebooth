<script src="/js/chosen.jquery.js"></script>
<link rel="stylesheet" href="/css/chosen.css">
<link rel="stylesheet" href="/css/chosen.bootstrap.css">
<?php
echo $this->Form->Create('Outfit',
	array(
		'type' => 'file',
		'class' => 'form-horizontal',
		'role' => 'form',
		'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'form-group'),
			'class' => array('form-control'),
			'label' => array('class' => 'col-lg-3 control-label'),
			'between' => '<div class="col-lg-3">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
		)
	)
);
echo $this->Form->input('id', array(
	'default' => $outfit['Outfit']['id']
));
echo $this->Form->input('name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'default' => $outfit['Outfit']['name'],
));
//SHOW IMAGE HERE 'default' => $outfit['Outfit']['imagen'],
echo "<div class='row'>";
$this->Product->outfit_thumbnail($outfit, 250);
echo "</div>";
echo $this->Form->input('image', array(
	'label' => array('text' => 'Cambiar Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));

//echo "<hr>";
echo "<div class='well'>
<div class='row' id='accepted_products'>
	<input type='hidden' name='data[OutfitProducts][OutfitId]' id='OutfitProductsOutfitId' value='".$outfit_products."'>
	<h5>Productos Existentes</h5>";
//product thumbnails
foreach ($products as $p) {
	$this->Product->outfit_product_thumbnail($p, 75);
}
echo "</div>
<h4>Productos para el Outfit</h4>";
echo $this->Form->input('product_category_id', array(
	'label' => array('text' => 'Categoría', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control col-lg-3',
	'options' => $products_categories,
	'empty' => array('' => '-- Elige una Categoría --'),
));
echo $this->Form->input('product_id', array(
	'label' => array('text' => 'Producto', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control col-lg-3',
	'empty' => array('' => '-- Elige un Producto --'),
));
echo $this->Form->button("Agregar Producto al Outfit", array(
	'class' => 'btn btn-info',
	'type'  => 'button',
	'id'    => 'AddProduct'
));
echo "</div>";
echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success'));
echo "</div>";
echo $this->Form->end();
?>

<script type="text/javascript">
	$(function () {
		$('#OutfitProductCategoryId').change(function (){
			var catid = $(this).val();
			$.ajax({
				type:    "POST",
				url:     "/outfits/getproducts/"+catid,
				success: function(html) {

					$('#OutfitProductId')
						.empty()
						.append(html)
						.chosen({allow_single_deselect: true, autocomplete: true})
						.trigger('chosen:updated');

				}
			});
		});

		$("#AddProduct").click(function(){
			var product_id = $('#OutfitProductId').val();
			$.ajax({
				type:    "POST",
				url:     "/products/getbyid/"+product_id,
				success: function(html) {
					$("#accepted_products").append(html).fadeIn().removeClass('hidden');
					var op = $("#OutfitProductsOutfitId").val();
					$("#OutfitProductsOutfitId").val(function(e, val) {
						return val + (val ? ',' : '') + product_id
					});
				}
			});
		});
	});

	function delProd(prod_id){
		$("#prod_"+prod_id).remove();
		var arrProd = $("#OutfitProductsOutfitId").val().split(',');

		for (i=0; i<arrProd.length; i++) {
			if (arrProd[i] == prod_id) {
				arrProd.splice(i, 1);
			}
		}

		$('#OutfitProductsOutfitId').val(arrProd.toString());
	}
</script>