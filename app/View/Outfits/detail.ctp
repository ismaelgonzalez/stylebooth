<div class="row" style="margin-top: 50px;">
	<div class="col-md-3 col_busqueda busqueda_left">
		<a href="#" class="col-mod-12"><img src="/files/banners/banner_registrate.jpg" alt="¡Regístrate!" border="0" /></a>
		<h5>BÚSQUEDA DE <br/>PRODUCTOS</h5>
		<div class="btn-group">
			<?php echo $this->element('products_category'); ?>
		</div>
	</div>
	<div class="col-md-8" align="center">
		<div class="row">
			<div class="row">
				<div class="col-md-6 col-md-offset-6">
					<div class="thumbnail outfit_thumb">
						<a href="#"><img src="/files/outfits/<?php echo $outfit['Outfit']['image']; ?>" alt="<?php echo $outfit['Outfit']['name']; ?>"></a>
					</div>
				</div>
				<div class="col-md-6">
					<ul class="pager">
						<li><a href="#">VOLVER << </a> | <a href="#"> >> SIGUIENTE</a></li>
					</ul>

					<div class="caption outfit_specs">
						<?php echo $outfit['Outfit']['name']; ?><br/>$<?php echo $outfit['Outfit']['budget']; ?> MXN
						<div class="social_thumbs">
							<img src="/img/social_thumbs_sb_w.jpg" alt="Stylebooth" border="0"/>
							<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst_w.jpg" alt="Instagram" border="0"/></a>
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/outfits/detail/<?php echo $outfit['Outfit']['id']; ?>"><img src="/img/social_thumbs_fb_w.jpg" alt="Facebook" border="0"/></a>
							<a target="_blank" href="https://twitter.com/home?status=Nuevo outfit de Stylebooth http://stylebooth.mx/outfits/detail/<?php echo $outfit['Outfit']['id']; ?>"><img src="/img/social_thumbs_tw_w.jpg" alt="Twitter" border="0"/></a>
							<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/outfits/detail/<?php echo $outfit['Outfit']['id']; ?>"><img src="/img/social_thumbs_go_w.jpg" alt="Google+" border="0"/></a>
							<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/outfits/detail/<?php echo $outfit['Outfit']['id']; ?>&media=http://stylebooth.mx/files/outfits/<?php echo $outfit['Outfit']['image']; ?>&description=<?php echo $outfit['Outfit']['name']; ?>"><img src="/img/social_thumbs_pin_w.jpg" alt="Pinterest" border="0"/></a>
						</div>
					</div>
				</div>
				<input type="hidden" id="outfitID" value="<?php echo $outfit['Outfit']['id']; ?>">
			</div>
		</div>
		<div id="productsResults" class="row">
			<?php foreach ($outfit['Product'] as $p) { ?>
				<div class="col-md-3">
					<div class="thumbnail products-thumb outfit_pieces">
						<img src="/files/products/<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>">
						<div class="caption">
							<?php echo $p['name']; ?>.<br/>$<?php echo $p['price']; ?>
							<div class="social_thumbs">
								<img src="/img/social_thumbs_sb.jpg" alt="Stylebooth" border="0" class="stylebooth_thumb"/>
								<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst.jpg" alt="Instagram" border="0"/></a>
								<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['id']; ?>/<?php echo $p['name']; ?>"><img src="/img/social_thumbs_fb.jpg" alt="Facebook" border="0"/></a>
								<a target="_blank" href="https://twitter.com/home?status=Nuevo producto de Stylebooth http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['id']; ?>/<?php echo $p['name']; ?>"><img src="/img/social_thumbs_tw.jpg" alt="Twitter" border="0"/></a>
								<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['id']; ?>/<?php echo $p['name']; ?>"><img src="/img/social_thumbs_go.jpg" alt="Google+" border="0"/></a>
								<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/productosyaccesoriosdemoda/<?php echo $p['id']; ?>/<?php echo $p['name']; ?>&media=http://stylebooth.mx/files/products/<?php echo $p['image']; ?>&description=<?php echo $p['name']; ?>"><img src="/img/social_thumbs_pin.jpg" alt="Pinterest" border="0"/></a>
							</div>
						</div>
						<a href="/productosyaccesoriosdemoda/<?php echo $p['id']; ?>/<?php echo $p['name']; ?>" class="thumb_click"></a>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>