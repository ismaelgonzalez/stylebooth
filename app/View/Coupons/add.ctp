<script src="/js/chosen.jquery.js"></script>
<link rel="stylesheet" href="/css/chosen.css">
<link rel="stylesheet" href="/css/chosen.bootstrap.css">
<?php
echo $this->Form->Create('Coupon',
	array(
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
echo $this->Form->input('title', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
));
echo $this->Form->input('store_id', array(
	'label' => array('text' => 'Tienda', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array($stores),
	'empty' => array('' => '-- Elige una Tienda --'),
));
echo $this->Form->input('product_id', array(
	'label' => array('text' => 'Producto', 'class' => 'control-label my-label col-lg-2'),
	'options' => array($products),
	'empty' => array('' => '-- Elige un Producto --'),
	'class' => 'form-control'
));
echo $this->Form->input('discount_percentage', array(
	'label' => array('text' => 'Descuento (%)', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
));
echo $this->Form->input('number_coupons', array(
	'label' => array('text' => 'Numero de Cupones', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control'
));
echo $this->Form->input('start_date', array(
	'type' => 'text',
	'label' => array('text' => 'Comienzo de Promoción', 'class' => 'control-label my-label col-lg-2'),
));
echo $this->Form->input('end_date', array(
	'type' => 'text',
	'label' => array('text' => 'Final de Promoción', 'class' => 'control-label my-label col-lg-2'),
));

echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success pull-right'));
echo "</div>";
echo $this->Form->end();
?>
<script type="text/javascript">
	$(function () {
		$('#CouponStartDate').datepicker({dateFormat:'dd-mm-yy'});
		$('#CouponEndDate').datepicker({dateFormat:'dd-mm-yy'});
		$('#CouponProductId').chosen({allow_single_deselect: true, autocomplete: true});

		$('#CouponStoreId').change(function() {
			var $store_id = $(this).val();

			$.ajax({
				type:    "POST",
				url:     "/products/getProductsByStoreId/"+$store_id,
				success: function(html) {

					$('#CouponProductId')
						.empty()
						.append(html)
						.chosen({allow_single_deselect: true, autocomplete: true})
						.trigger('chosen:updated');
				}
			});
		});
	});
</script>