<h1>Mi Booth Personal</h1>
<div class="row">
	<div class="col-md-3">
		<span class="thumbnail">
			<?php if (empty($user['User']['image'])) {
					echo '<img class="media-object" src="/files/users/user.jpg">';
				} else {
					echo '<img class="media-object" src="/files/users/' . $user['User']['image'] . '">';
				}
			?>
			<h6><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></h6>
		</span>
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
	<div class="col-md-9" align="left">
		<h5> <b>Mi estilo:</b> <?php echo $style['Style']['name']; ?></h5>
		<h5> <b>Mis gustos:</b> </h5>
		<div class="row">
			<?php if (!empty($user['Wishlist'])) {
				foreach ($products as $p) { ?>
					<div class="col-md-4" id="product_<?php echo $p['Product']['id']; ?>">
					<span class="thumbnail">
						<?php if(empty($p['Product']['image'])) { ?>
							<a class="thumbnail" href="/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/files/products/imagecara.jpg" alt="/products/detail/<?php echo $p['Product']['title']; ?>"/></a>
						<?php } else { ?>
							<a class="thumbnail" href="/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['title']; ?>"/></a>
						<?php }
						echo '<h6 class="center">' . $p['Product']['name'] . '</h6>';
						if (!empty($logged_user) && $logged_user['id'] == $user['User']['id']) {
						?>

						<h6><a href="#" onclick="deleteFromWishlist(<?php echo $p['Product']['id']; ?>);">Eliminar</a></h6>
						<?php } ?>
					</span>
				</div>
				<?php } ?>
			<?php } else { ?>
				<h6>Por el momento no tienes nada agregado a tu Wishlist. Te invitamos a ver los <a href="/products/lista">productos disponibles</a>.</h6>
			<?php } ?>

		</div>
	</div>
</div>
	<script type="text/javascript">
		function deleteFromWishlist(product_id){
			$.ajax({
				type: 'post',
				url: '/stylebooth/deleteFromWishlist/' + product_id,
				success: function(html) {
					if ( html == 'ok' ) {
						$('#product_' + product_id).fadeOut('slow');
					}
				}
			});

		}
	</script>