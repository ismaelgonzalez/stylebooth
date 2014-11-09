<div class="row">
	<div class="col-md-12 text-center">
		<div class="row titles">
			<h1>GALERÍA</h1>
		</div>
		<div class="row busqueda_top">
			BÚSQUEDA DE PRODUCTOS
			<div class="btn-group">
				<?php echo $this->element('products_category'); ?>
			</div>
			<input type="hidden" id="hasAllProducts" value="1">
		</div>
		<div id="productsResults" class="row galeria_full">
			<?php
			$first = true;
			foreach ($products as $p) {
				if ($first) { ?>
					<div class="col-md-3 pull-left">
						<div class="galeria_banner">
							<a href="/users/register"><img src="/img/galeria_banner.jpg" alt="Stylebooth" border="0"></a>
						</div>
					</div>
			<?php
					$first = false;
				}
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
	</div>
</div>