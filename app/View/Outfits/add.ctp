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
echo $this->Form->input('name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control'
));
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));
echo $this->Form->input('budget', array(
	'type' => 'hidden',
	'class' => 'form-control',
	'default' => '0',
));
echo $this->Form->input('budget_disabled', array(
	'label' => array('text' => 'Presupuesto del Outfit $', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'disabled' => 'disabled',
	'default' => '0',
));
//echo "<hr>";
echo "<div class='well'>
<div class='row hidden' id='accepted_products'>
	<input type='hidden' name='data[OutfitProducts][OutfitId]' id='OutfitProductsOutfitId' value=''>
</div>
<h4>Productos para el Outfit</h4>";
echo $this->Form->input('product_category_id', array(
	'label' => array('text' => 'Categoría', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control col-lg-3',
	'options' => $products_categories,
	'empty' => array('' => '-- Elige una Categoría --'),
));
echo $this->Form->input('store_id', array(
	'label' => array('text' => 'Tiendas', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control col-lg-3',
	'empty' => array('' => '-- Elige una Tienda --'),
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
				url:     "/outfits/getStoresByCategoryId/"+catid,
				success: function(html) {

					$('#OutfitStoreId')
						.empty()
						.append(html)
						.chosen({allow_single_deselect: true, autocomplete: true})
						.trigger('chosen:updated');

					$('#OutfitProductId').empty()
						.chosen({allow_single_deselect: true, autocomplete: true})
						.trigger('chosen:updated');
				}
			});
		});

		$('#OutfitStoreId').change(function() {
			var $store_id = $(this).val();
			var $cat_id   = $("#OutfitProductCategoryId").val();

			$.ajax({
				type:    "POST",
				url:     "/outfits/getproducts/"+$store_id+"/"+$cat_id,
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
					get_budget(product_id);
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

		rest_budget(prod_id);
	}

	function get_budget(product_id){
		var $budget = $("#OutfitBudget");
		var $budget_disabled = $("#OutfitBudgetDisabled");
		$.ajax({
			type: 'post',
			url: '/products/getPriceById/' + product_id,
			success: function(price) {
				total = parseFloat($budget.val()) + parseFloat(price);
				$budget.val(total);
				$budget_disabled.val(total).fadeIn('slow');
			}
		});
	}

	function rest_budget(product_id){
		var $budget = $("#OutfitBudget");
		var $budget_disabled = $("#OutfitBudgetDisabled");
		$.ajax({
			type: 'post',
			url: '/products/getPriceById/' + product_id,
			success: function(price) {
				total = parseFloat($budget.val()) - parseFloat(price);
				console.log(total);
				$budget.val(total);
				$budget_disabled.val(total).fadeIn('slow');
			}
		});
	}
</script>