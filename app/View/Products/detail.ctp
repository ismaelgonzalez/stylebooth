<div class="row" style="margin-top: 50px;">
	<div id="bannerLeft" class="col-md-3">
		<div class="row producto_left">
			<a class="thumbnail" href="/stores/products/<?php echo $product['Store']['id']; ?>/<?php echo $product['Store']['name']; ?>">
				<img src="/files/stores/<?php echo $product['Store']['image']; ?>" alt="<?php echo $product['Product']['name']; ?>"/>
			</a>
			<h5><?php echo $product['Store']['name']; ?></h5>
			<?php echo $this->element('store_address', array('get_store_address' => true, 'store_id' => $product['Store']['id'])); ?>
			<a href="<?php echo $product['Store']['url']; ?>"  target="_blank" class="fb_store"><img src="/img/fb_store_icon.png" border="0"/> /<?php echo $product['Store']['name']; ?></a>
			<a href="/stores/products/<?php echo $product['Store']['id']; ?>/<?php echo $product['Store']['name']; ?>">Ver productos Boutique</a>
		</div>
	</div>
	<div class="col-md-8" align="center">
		<div class="row">
			<div class="row">
				<div class="col-md-6">
					<div class="thumbnail">
						<img src="/files/products/<?php echo $product['Product']['image']; ?>" alt="<?php echo $product['Product']['name']; ?>">
					</div>
				</div>
				<div class="col-md-6" align="left">
					<ul class="pager">
						<li><a href="javascript:history.back();">VOLVER << </a></a></li>
					</ul>
					<div class="producto_specs">
						<?php echo $product['Product']['name']; ?><br/>
						$<?php echo $product['Product']['price']; ?> MXN
						<p><?php echo $product['Product']['blurb']; ?></p>
						<p class="wishlist-button-container">
							<?php echo $this->element('wishlist', array('product_id' => $product['Product']['id'], 'user' => $logged_user)); ?>
						</p>
						<div class="social_thumbs">
							<img src="/img/social_thumbs_sb_w.jpg" alt="Stylebooth" border="0"/>
							<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst_w.jpg" alt="Instagram" border="0"/></a>
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/products/detail/<?php echo $product['Product']['id']; ?>/<?php echo $product['Product']['name']; ?>"><img src="/img/social_thumbs_fb_w.jpg" alt="Facebook" border="0"/></a>
							<a target="_blank" href="https://twitter.com/home?status=Nuevo producto de Stylebooth http://stylebooth.mx/outfits/detail/<?php echo $product['Product']['id']; ?>"><img src="/img/social_thumbs_tw_w.jpg" alt="Twitter" border="0"/></a>
							<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/outfits/detail/<?php echo $product['Product']['id']; ?>"><img src="/img/social_thumbs_go_w.jpg" alt="Google+" border="0"/></a>
							<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/outfits/detail/<?php echo $product['Product']['id']; ?>&media=http://stylebooth.mx/files/outfits/<?php echo $product['Product']['image']; ?>&description=<?php echo $product['Product']['name']; ?>"><img src="/img/social_thumbs_pin_w.jpg" alt="Pinterest" border="0"/></a>
						</div>
						<div class="row" style="margin:10px 0px;"></div>
					</div>
					<?php if (!empty($coupon['Coupon'])) { ?>
						<div class="alert alert-danger" style="border: 1px dashed;">
							<?php echo $coupon['Coupon']['title']; ?>
							<?php if (empty($logged_user['id'])) { ?>
								<p><a href="/users/register">  Regístrese para obtener el cupón</a></p>
								<p><a href="/users/login">&iquest;Ya estas registrado? Inicia Sesion</a></p>
							<?php } else { ?>
								<p><a href="/getcoupon/<?php echo $coupon['Coupon']['id']; ?>">  Genera tu cupón aqui</a></p>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row col-md-12">
		<?php echo $product['Store']['google_maps']; ?>
	</div>
</div>
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
<div tabindex="-1" class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
		function addToWishList(product_id){
			$.ajax({
				url: '/products/addToWishList/' + product_id,
				type: 'post',
				success: function(html) {
					if (html == 'noUser') {
						$('.modal-body').append('¡Necesitas iniciar sesion para guardar este producto a tu Booth Personal');
						$('#errorMessage').modal({modal:true});
					} else if (html == 'noProduct') {
						$('.modal-body').append('¡Este producto no es valido para agregar a tu Booth Personal!');
						$('#errorMessage').modal({modal:true});
					} else if (html == 'saved') {
						$('.modal-body').append('¡Este producto se agregó a tu Booth Personal!');
						$('#errorMessage').modal('show');
						$('#errorMessage').on('hidden.bs.modal', function () {
							$('.wishlist-button-container')
								.empty()
								.fadeIn(300)
								.append('<button type="button" class="btn btn-default btn-xs" disabled="disabled"><span class="icon-heart" style="color: limegreen;"></span> Agregado a mi Booth Personal</button>');
						});
					}
				}
			});
		}
	$(function(){
		/*
		* This part makes a pop up with the store logo
		* I'm blocking it out
		$('.thumbnail').click(function(){
			$('.modal-body').empty();
			var src = $(this).find('img').attr('src');
			var img = '<img src="' + src + '" width="550">'
			$('.modal-body').append(img);
			$('#myModal').modal({show:true});
		});*/
	});
</script>