<div class="row">
	<div class="row titles">
		<h1>MI BOOTH PERSONAL</h1>
		<div class="user_name_singout">
			Hola <?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?> | <a href="/users/logout">SALIR</a>
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
					<div class="col-md-12 mi_booth_cards left">
						<h5>ASESORÍA DE IMAGEN<br/>¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨</h5>
						<div class="row">
							<?php echo $this->element('product_name', array('get_skin_body_types' => true, 'skin_hair_type_id' => $user['UserStat'][0]['products_skin_hair_types'], 'body_type_id' => $user['UserStat'][0]['products_body_types'])); ?>
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
				<div class="dotted">MIS GUSTOS</div>
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
											<a class="thumb-booth" href="/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/files/products/imagecara.jpg" alt="/products/detail/<?php echo $p['Product']['title']; ?>"/></a>
										<?php } else { ?>
											<a class="thumb-booth" href="/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['title']; ?>"/></a>
										<?php }
										?>
										<div class="caption">
											<div class="galeria_thumb_specs">
												<?php echo $p['Product']['name']; ?>.<br/>$<?php echo $p['Product']['price']; ?><br/>
											</div>
											<a href="/products/detail/<?php echo $p['Product']['id']; ?>">Ver producto</a>
											<?php if (!empty($logged_user) && $logged_user['id'] == $user['User']['id']) { ?>
												<a onclick="deleteFromWishlist(<?php echo $p['Product']['id']; ?>);">Eliminar de Wishlist</a>
											<?php } ?>
										</div>
										<a href="/products/detail/<?php echo $p['Product']['id']; ?>" class="thumb_click"></a>

									</div>
								</div>
							<?php } ?>
						<?php } else { ?>
							<h6>Por el momento no tienes nada agregado a tu Wishlist. Te invitamos a ver los <a href="/products/lista">productos disponibles</a>.</h6>
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