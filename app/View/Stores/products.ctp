<div class="row col-md-12">
	<h3><?php echo $store['Store']['name']; ?></h3>
	<?php
	$has_http = strstr($store['Store']['url'], 'http://');
	if (!$has_http) {
		$url = 'http://' . $store['Store']['url'];
	} else {
		$url = $store['Store']['url'];
	}

	if (!empty($store['Store']['redes_sociales'])) {
		$rs_has_http = strstr($store['Store']['redes_sociales'], 'http://');
		if (!$rs_has_http) {
			$redes_sociales = 'http://' . $store['Store']['redes_sociales'];
		} else {
			$redes_sociales = $store['Store']['redes_sociales'];
		}
	} else {
		$redes_sociales = '';
	}
	?>
	<div class="row" align="left">
		<div class="col-md-4">
			<span class="thumbnail">
				<img src="/files/stores/<?php echo $store['Store']['image']; ?>" alt="<?php echo $store['Store']['name']; ?>"/>
				<input type="hidden" id="store_id" value="<?php echo $store['Store']['id']; ?>">
				<input type="hidden" id="store_name" value="<?php echo $store['Store']['name']; ?>">
			</span>
		</div>
		<div class="col-md-8" align="left">
			<h5><b><?php echo $store['Store']['name']; ?></b></h5>
			<?php echo $this->element('store_address', array('store_address' => $store['StoreAddress'][0])); ?>
			<h5><a href="<?php echo $url; ?>"  target="_blank"><?php echo $url; ?></a> </h5>
			<?php if (!empty($redes_sociales)) { ?>
				<p><a href="<?php echo $redes_sociales; ?>"  target="_blank" class="fb_store"><img src="/img/fb_store_icon.png" border="0"/> <?php echo $redes_sociales; ?></a></p>
			<?php } ?>
			<?php echo $store['Store']['google_maps']; ?>
			<br />
		</div>
	</div>
</div>
<div class="row col-md-12">
	<h4><b>Productos de la Tienda</b></h4>
	<!-- Single button -->
	<div class="row">
		<div class="btn-group">
			<?php echo $this->element('products_category'); ?>
		</div>
	</div>
</div>
<div id="productsResults" class="row col-md-12">
	<?php
	foreach ($products as $p) {
		?>
		<div class="col-md-3">
			<div class="thumbnail galeria_thumb">
				<img src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['name']; ?>">
				<div class="caption">
					<div class="galeria_thumb_specs">
						<?php echo $p['Product']['name']; ?>.<br/>$<?php echo $p['Product']['price']; ?>
					</div>
					<div class="social_thumbs">
						<img src="/img/social_thumbs_sb.jpg" alt="Stylebooth" border="0" class="stylebooth_thumb"/>
						<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst.jpg" alt="Instagram" border="0"/></a>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>"><img src="/img/social_thumbs_fb.jpg" alt="Facebook" border="0"/></a>
						<a target="_blank" href="https://twitter.com/home?status=Nuevo producto de Stylebooth http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>"><img src="/img/social_thumbs_tw.jpg" alt="Twitter" border="0"/></a>
						<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>"><img src="/img/social_thumbs_go.jpg" alt="Google+" border="0"/></a>
						<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>&media=http://stylebooth.mx/files/products/<?php echo $p['Product']['image']; ?>&description=<?php echo $p['Product']['name']; ?>"><img src="/img/social_thumbs_pin.jpg" alt="Pinterest" border="0"/></a>
					</div>
				</div>
				<a href="/productosyaccesoriosdemoda/<?php echo $p['Product']['id']; ?>/<?php echo $p['Product']['name']; ?>" class="thumb_click"></a>
			</div>
		</div>
		<?php } ?>
</div>
<ul class="pager">
	<li><a href="/filter4">Anterior</a></li>
</ul>