<div class="row">
	<div class="col-md-12 text-center">
		<div class="col-mod-12 styleheader">
			<img src="/files/styles/<?php echo $style['Style']['image'] ?>" alt="<?php echo $style['Style']['name'] ?>"/>
		</div>
		<h4>Sugerencias de Outfits</h4>
		<div class="row" >
			<?php foreach ($outfits as $o) { ?>
			<div class="col-md-4">
				<div class="thumbnail outfit_thumb">
					<img src="/files/outfits/<?php echo $o['Outfit']['image']; ?>" alt="<?php echo $o['Outfit']['name']; ?>">
					<div class="caption" style="display: none">
						<?php echo $o['Outfit']['name']; ?><br/>$<?php echo $o['Outfit']['budget']; ?> MXN
						<div class="social_thumbs">
							<img src="/img/social_thumbs_sb.jpg" alt="Stylebooth" border="0"/>
							<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst.jpg" alt="Instagram" border="0"/></a>
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/outfits/detail/<?php echo $o['Outfit']['id']; ?>"><img src="/img/social_thumbs_fb.jpg" alt="Facebook" border="0"/></a>
							<a target="_blank" href="https://twitter.com/home?status=Nuevo outfit de Stylebooth http://stylebooth.mx/outfits/detail/<?php echo $o['Outfit']['id']; ?>"><img src="/img/social_thumbs_tw.jpg" alt="Twitter" border="0"/></a>
							<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/outfits/detail/<?php echo $o['Outfit']['id']; ?>"><img src="/img/social_thumbs_go.jpg" alt="Google+" border="0"/></a>
							<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/outfits/detail/<?php echo $o['Outfit']['id']; ?>&media=http://stylebooth.mx/files/outfits/<?php echo $o['Outfit']['image']; ?>&description=<?php echo $o['Outfit']['name']; ?>"><img src="/img/social_thumbs_pin.jpg" alt="Pinterest" border="0"/></a>
						</div>
					</div>
					<a href="/outfits/detail/<?php echo $o['Outfit']['id']; ?>" class="thumb_click"></a>
				</div>
			</div>
			<?php } ?>
			<div class="clearfix"></div>
			<h4>Resultados de Productos</h4>
			<div class="dotted">
				<?php echo $this->Breadcrumbs->getBreadcrumbs($style['Style']['name'], $this->Session->read('Visit.budget'), $this->Session->read('Visit.size'), $this->Session->read('Visit.foot_size'), $skin['SkinHairType']['name'], $body['BodyType']['name']); ?>
			</div>
			<div class="row">
				<div class="col-md-3 col_busqueda">
					<h5>BÚSQUEDA DE <br/>PRODUCTOS</h5>
					<div class="btn-group">
						<?php echo $this->element('products_category'); ?>
						<input type="hidden" id="sizes" value='<?php echo json_encode($sizes); ?>'>
						<input type="hidden" id="style" value="<?php echo $chosen_style; ?>">
						<a href="/users/register" class="col-mod-12"><img src="files/banners/banner_registrate.jpg" alt="¡Regístrate!" border="0" /></a>
					</div>
				</div>
				<div class="col-md-8">
					<div id="productsResults" class="row">
						<?php foreach ($products as $p) { ?>
						<div class="col-md-3">
							<div class="thumbnail products-thumb outfit_pieces">
								<img src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['name']; ?>">
								<div class="caption">
									<?php echo $p['Product']['name']; ?>.<br/>$<?php echo $p['Product']['price']; ?>
									<div class="social_thumbs">
										<img src="/img/social_thumbs_sb.jpg" alt="Stylebooth" border="0" class="stylebooth_thumb"/>
										<a target="_blank" href="http://instagram.com/styleboothmx"><img src="/img/social_thumbs_inst.jpg" alt="Instagram" border="0"/></a>
										<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://stylebooth.mx/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/img/social_thumbs_fb.jpg" alt="Facebook" border="0"/></a>
										<a target="_blank" href="https://twitter.com/home?status=Nuevo producto de Stylebooth http://stylebooth.mx/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/img/social_thumbs_tw.jpg" alt="Twitter" border="0"/></a>
										<a target="_blank" href="https://plus.google.com/share?url=http://stylebooth.mx/products/detail/<?php echo $p['Product']['id']; ?>"><img src="/img/social_thumbs_go.jpg" alt="Google+" border="0"/></a>
										<a target="_blank" href="https://pinterest.com/pin/create/button/?url=http://stylebooth.mx/products/detail/<?php echo $p['Product']['id']; ?>&media=http://stylebooth.mx/files/products/<?php echo $p['Product']['image']; ?>&description=<?php echo $p['Product']['name']; ?>"><img src="/img/social_thumbs_pin.jpg" alt="Pinterest" border="0"/></a>
									</div>
								</div>
								<a href="/products/detail/<?php echo $p['Product']['id']; ?>" class="thumb_click"></a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</div>
</div>