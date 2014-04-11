<div class="row">
	<div class="col-md-5">
		<div class="thumbnail">
			<img src="/files/products/<?php echo $product['Product']['image']; ?>" alt="<?php echo $product['Product']['name']; ?>">
		</div>
		<?php if (!empty($coupon['Coupon'])) { ?>
		<div class="alert alert-danger" style="border: 1px dashed;">
			<?php echo $coupon['Coupon']['title']; ?>
			<?php if (empty($logged_user['id'])) { ?>
				<p><a href="/users/register">  Regístrese para obtener el cupón</a></p>
			<?php } else { ?>
				<p><a href="/getcoupon/<?php echo $coupon['Coupon']['id']; ?>">  Genera tu cupón aqui</a></p>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-7" align="left">
		<h3><b><?php echo $product['Product']['name']; ?></b></h3>
		<h4><b><?php echo $this->Number->currency($product['Product']['price'], 'USD'); ?></b></h4>
		<?php if (!empty($logged_user['id'])) { ?>
			<button type="button" class="btn btn-default btn-xs" onclick="javascript:addToWishList(<?php echo $product['Product']['id']; ?>)">
				<span class="glyphicon glyphicon-heart" style="color: #F92672;"></span> Agregar a mi Booth Personal
			</button>
		<?php } ?>
		<h4>Tienda Disponible:</h4>
		<h5><b><a href="/stores/products/<?php echo $product['Store']['id']; ?>"><?php echo $product['Store']['name']; ?></a></b></h5>
		<?php echo $this->element('store_address', array('get_store_address' => true, 'store_id' => $product['Store']['id'])); ?>
		<h5> <a href="<?php echo $product['Store']['url']; ?>"  target="_blank"><?php echo $product['Store']['url']; ?></a> </h5>
		<p>
			<?php echo $product['Store']['google_maps']; ?>
		</p>
	</div>
</div>
<p>
	<ul class="pager">
		<li><a href="javascript:history.back();">Anterior</a></li>
	</ul>
</p>
<div id="errorMessage" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth - Booth Personal</h4>
			</div>
			<div class="modal-body"></div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
		function addToWishList(product_id){
			$.ajax({
				url: '/products/addToWishList/' + product_id,
				type: 'post',
				success: function(html) {
					if (html == 'noUser') {
						$('.modal-body').append('¡Necesitas iniciar sesion para guardar este producto a tu Booth Personal');
						$('#errorMessage').dialog({modal:true});
					} else if (html == 'noProduct') {
						$('.modal-body').append('¡Este producto no es valido para agregar a tu Booth Personal!');
						$('#errorMessage').dialog({modal:true});
					} else if (html == 'saved') {
						$('.modal-body').append('¡Este producto se agregó a tu Booth Personal!');
						$('#errorMessage').modal('show');
						$('.btn-default').attr('disabled', 'disabled');
					}
				}
			});
		}
	</script>