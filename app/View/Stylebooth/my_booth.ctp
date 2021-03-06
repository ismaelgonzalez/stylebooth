<div class="row">
	<div class="row titles">
		<h1>MI BOOTH PERSONAL</h1>
		<div class="user_name_singout">
			Hola <?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?>
			<?php if ($user['User']['role'] == 'admin') { echo ' | <a href="/admin">Ir al Admin</a>'; } ?>
			| <a href="/users/logout">SALIR</a>
		</div>
	</div>
</div>
<div class="row site_txts">
	<div class="col-md-12" align="center">
		<div class="row">
			<div class="col-md-2">
				<span class="thumbnail user_img">
					<?php echo $this->element('user_name', array('get_image' => true, 'id' => $user['User']['id'])); ?>
				</span>
				<p><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></p>
				<div class="dotted_line"></div>
				<a href="/users/profile/<?php echo $user['User']['id']; ?>" class="user_registro">EDITAR PERFIL</a>
				<p>Mi estilo:<br/> <?php echo $style['Style']['name']; ?></p>
			</div>
			<div class="col-md-10" align="left">
				<div class="row">
					<div class="col-md-12 mi_booth_cards">
						<h5>ASESORÍA DE IMAGEN<br/>¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨</h5>
						<div class="row">
							<?php
							$skin_hair_type = !empty($user['UserStat'][0]['products_skin_hair_types']) ? $user['UserStat'][0]['products_skin_hair_types'] : null;
							$body_type      = !empty($user['UserStat'][0]['products_body_types']) ? $user['UserStat'][0]['products_body_types'] : null;
							?>
							<?php echo $this->element('product_name', array('get_skin_body_types' => true, 'skin_hair_type_id' => $skin_hair_type, 'body_type_id' => $body_type)); ?>
						</div>
					</div>

					<div class="col-md-12 mi_booth_cards">
						<h5>HiSTORAL DE CUPONES<br/>¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨</h5>
						<div class="col-md-12">
							<?php if (!empty($user['Coupon'])) { ?>
								<table class="table table-responsive table-striped table-hover">
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
											<td><?php echo $c['CouponUser']['generated_key']; ?></td>
											<td><?php echo $this->element('product_name', array('get_product_name' => true, 'id' => $c['product_id'])); ?></td>
											<td><?php echo date('d M Y', strtotime($c['start_date'])); ?></td>
											<td><?php echo $this->element('store_address', array('get_store_name_by_product_id' => true, 'product_id' => $c['product_id'])); ?></td>
											<td><a href="/getcoupon/<?php echo $c['id']; ?>">Imprimir</a></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							<?php } else { echo 'Aún no tienes cupones generados.'; } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 misgustos">
				<div class="dotted">
					MIS GUSTOS | COMPARTIR:
					<div class="social_thumbs social_thumbs_inline">
						<img src="/img/social_thumbs_sb_w.jpg" alt="Stylebooth" border="0"/>
						<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst_w.jpg" alt="Instagram" border="0"/></a>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>"><img src="/img/social_thumbs_fb_w.jpg" alt="Facebook" border="0"/></a>
						<a target="_blank" href="https://twitter.com/home?status=Checa mi booth personal en Stylebooth http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>"><img src="/img/social_thumbs_tw_w.jpg" alt="Twitter" border="0"/></a>
						<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>"><img src="/img/social_thumbs_go_w.jpg" alt="Google+" border="0"/></a>
						<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/mi_booth/<?php echo $user['User']['id']; ?>&media=http://stylebooth.mx/img/stylebooth_logo.png&description=checa mi booth personal de stylebooth"><img src="/img/social_thumbs_pin_w.jpg" alt="Pinterest" border="0"/></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<h5>BÚSQUEDA DE PRODUCTOS</h5>
						<div class="btn-group">
							<?php echo $this->element('products_category'); ?>
							<input type="hidden" id="user-id" value="<?php echo $user['User']['id']; ?>">
						</div>
					</div>
					<div class="col-md-9" id="productsResults">
						<?php if (!empty($user['Wishlist'])) {
							foreach ($products as $p) { ?>
								<div class="col-md-3 product_<?php echo $p['Product']['id']; ?>">
									<div class="thumbnail mibooth_thumb">
										<?php if(empty($p['Product']['image'])) { ?>
											<a class="thumb-booth" href="/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>"><img src="/files/products/imagecara.jpg" alt="/products/detail/<?php echo $p['Product']['title']; ?>"/></a>
										<?php } else { ?>
											<a class="thumb-booth" href="/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>"><img src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['title']; ?>"/></a>
										<?php }
										?>
										<div class="caption">
											<div class="galeria_thumb_specs">
												<?php echo $p['Product']['name']; ?>.<br/>$<?php echo $p['Product']['price']; ?><br/>
											</div>
											<a href="/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>">Ver producto</a>
											<?php if (!empty($logged_user) && $logged_user['id'] == $user['User']['id']) { ?>
												<a onclick="deleteFromWishlist(<?php echo $p['Product']['id']; ?>);">Eliminar de Wishlist</a>
											<?php } ?>
										</div>
										<a href="/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>" class="thumb_click"></a>

									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<h6>Por el momento no tienes nada agregado a tu Wishlist. Te invitamos a ver los <a href="/productosyaccesoriosdemoda">productos disponibles</a>.</h6>
						<?php } ?>
					</div>
				</div>
			</div>
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
						$('.product_' + product_id).fadeOut('slow');
					}
				}
			});

		}
	</script>