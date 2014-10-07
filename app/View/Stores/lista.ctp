<div class="row titles">
	<h1>TIENDAS</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<a href="#" class="col-md-3 tiendas_btns tiendas_btn_norte" id="btn_norte">Zona Norte</a>
		<a href="#" class="col-md-3 tiendas_btns tiendas_btn_poniente" id="btn_poniente">Zona Poniente</a>
		<a href="#" class="col-md-3 tiendas_btns tiendas_btn_oriente" id="btn_oriente">Zona Oriente</a>
		<a href="#" class="col-md-3 tiendas_btns tiendas_btn_sur" id="btn_sur">Zona Sur</a>
	</div>
</div>
<div id="brands" class="row">
	<div class="col-md-12 tiendas_banner" id="stores_banner">
		<?php foreach ($stores as $s) { ?>
			<a href="/stores/products/<?php echo $s['Store']['id']; ?>"><img src="/files/stores/<?php echo $s['Store']['image']; ?>" width="150px" alt="<?php echo $s['Store']['name']; ?>"/></a>
		<?php } ?>
		<?php if (sizeof($stores) < 6 ) {
			$stores_left = 6 - sizeof($stores);
			for ($i=1; $i<= $stores_left; $i++) {
				echo '<img src="/files/stores/logo_stylebooth_small.jpg" alt="Stylebooth"/>';
			}
		} else {
			echo '<img src="/files/stores/logo_stylebooth_small.jpg" alt="Stylebooth"/>';
		}
		?>
	</div>
</div>
<div class="row">
	<div class="col-md-12 tiendas_norte">
		<a name="tiendas_norte" class="anchor_tienda"></a>
		<h3>Zona Norte</h3>
		<?php foreach($stores_norte as $s) {
		$has_http = strstr($s['Store']['url'], 'http://');
		if (!$has_http) {
			$url = 'http://' . $s['Store']['url'];
		} else {
			$url = $s['Store']['url'];
		}
		?>
		<div class="row tienda_indiv">
			<h3>¨¨¨¨¨¨¨¨¨¨¨¨¨</h3>
			<div id="bannerLeft" class="col-md-3">
				<div class="row">
					<a class="thumbnail" href="/stores/products/<?php echo $s['Store']['id']; ?>">
						<img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
					</a>
				</div>
			</div>
			<div class="col-md-3 tiendas_specs">
				<h5><?php echo $s['Store']['name']; ?></h5>
				<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
				<a href="<?php echo $url; ?>"  target="_blank" class="fb_store"><img src="/img/fb_store_icon.png" border="0"/> /<?php echo $s['Store']['name']; ?></a>
				<br><a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver productos Boutique</a>
			</div>
			<div class="col-md-6">
				<?php echo $s['Store']['google_maps']; ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="col-md-12 tiendas_poniente">
		<a name="tiendas_poniente" class="anchor_tienda"></a>
		<h3>Zona Poniente</h3>
		<?php foreach($stores_poniente as $s) {
			$has_http = strstr($s['Store']['url'], 'http://');
			if (!$has_http) {
				$url = 'http://' . $s['Store']['url'];
			} else {
				$url = $s['Store']['url'];
			}
			?>
			<div class="row tienda_indiv">
				<h3>¨¨¨¨¨¨¨¨¨¨¨¨¨</h3>
				<div id="bannerLeft" class="col-md-3">
					<div class="row">
						<a class="thumbnail" href="/stores/products/<?php echo $s['Store']['id']; ?>">
							<img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
						</a>
					</div>
				</div>
				<div class="col-md-3 tiendas_specs">
					<h5><?php echo $s['Store']['name']; ?></h5>
					<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
					<a href="<?php echo $url; ?>"  target="_blank" class="fb_store"><img src="/img/fb_store_icon.png" border="0"/> /<?php echo $s['Store']['name']; ?></a>
					<br><a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver productos Boutique</a>
				</div>
				<div class="col-md-6">
					<?php echo $s['Store']['google_maps']; ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-12 tiendas_oriente">
		<a name="tiendas_oriente" class="anchor_tienda"></a>
		<h3>Zona Oriente</h3>
		<?php foreach($stores_oriente as $s) {
			$has_http = strstr($s['Store']['url'], 'http://');
			if (!$has_http) {
				$url = 'http://' . $s['Store']['url'];
			} else {
				$url = $s['Store']['url'];
			}
			?>
			<div class="row tienda_indiv">
				<h3>¨¨¨¨¨¨¨¨¨¨¨¨¨</h3>
				<div id="bannerLeft" class="col-md-3">
					<div class="row">
						<a class="thumbnail" href="/stores/products/<?php echo $s['Store']['id']; ?>">
							<img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
						</a>
					</div>
				</div>
				<div class="col-md-3 tiendas_specs">
					<h5><?php echo $s['Store']['name']; ?></h5>
					<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
					<a href="<?php echo $url; ?>"  target="_blank" class="fb_store"><img src="/img/fb_store_icon.png" border="0"/> /<?php echo $s['Store']['name']; ?></a>
					<br><a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver productos Boutique</a>
				</div>
				<div class="col-md-6">
					<?php echo $s['Store']['google_maps']; ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-12 tiendas_sur">
		<a name="tiendas_sur" class="anchor_tienda"></a>
		<h3>Zona Sur</h3>
		<?php foreach($stores_sur as $s) {
			$has_http = strstr($s['Store']['url'], 'http://');
			if (!$has_http) {
				$url = 'http://' . $s['Store']['url'];
			} else {
				$url = $s['Store']['url'];
			}
			?>
			<div class="row tienda_indiv">
				<h3>¨¨¨¨¨¨¨¨¨¨¨¨¨</h3>
				<div id="bannerLeft" class="col-md-3">
					<div class="row">
						<a class="thumbnail" href="/stores/products/<?php echo $s['Store']['id']; ?>">
							<img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
						</a>
					</div>
				</div>
				<div class="col-md-3 tiendas_specs">
					<h5><?php echo $s['Store']['name']; ?></h5>
					<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
					<a href="<?php echo $url; ?>"  target="_blank" class="fb_store"><img src="/img/fb_store_icon.png" border="0"/> /<?php echo $s['Store']['name']; ?></a>
					<br><a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver productos Boutique</a>
				</div>
				<div class="col-md-6">
					<?php echo $s['Store']['google_maps']; ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>