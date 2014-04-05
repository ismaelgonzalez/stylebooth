<h3>Zona Norte</h3>
	<?php foreach($stores_norte as $s) { ?>
	<div class="row" align="left">
		<div class="col-md-4">
			  <span class="thumbnail">
		  <img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
		</span>
			<a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver Productos de Boutique</a>
		</div>
		<div class="col-md-8" align="left">
			<h5><b><?php echo $s['Store']['name']; ?></b></h5>
			<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
			<a href="<?php echo $s['Store']['url']; ?>"  target="_blank"><?php echo $s['Store']['url']; ?></a> </h5>
			<?php echo $s['Store']['google_maps']; ?>
			<br />
		</div>
	</div>
	<?php } ?>

<h3>Zona Poniente</h3>
<?php foreach($stores_poniente as $s) { ?>
<div class="row" align="left">
	<div class="col-md-4">
			  <span class="thumbnail">
		  <img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
		</span>
		<a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver Productos de Boutique</a>
	</div>
	<div class="col-md-8" align="left">
		<h5><b><?php echo $s['Store']['name']; ?></b></h5>
		<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
		<a href="<?php echo $s['Store']['url']; ?>"  target="_blank"><?php echo $s['Store']['url']; ?></a> </h5>
		<?php echo $s['Store']['google_maps']; ?>
		<br />
	</div>
</div>
<?php } ?>

<h3>Zona Oriente</h3>
<?php foreach($stores_oriente as $s) { ?>
<div class="row" align="left">
	<div class="col-md-4">
			  <span class="thumbnail">
		  <img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
		</span>
		<a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver Productos de Boutique</a>
	</div>
	<div class="col-md-8" align="left">
		<h5><b><?php echo $s['Store']['name']; ?></b></h5>
		<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
		<a href="<?php echo $s['Store']['url']; ?>"  target="_blank"><?php echo $s['Store']['url']; ?></a> </h5>
		<?php echo $s['Store']['google_maps']; ?>
		<br />
	</div>
</div>
<?php } ?>

<h3>Zona Sur</h3>
<?php foreach($stores_sur as $s) { ?>
<div class="row" align="left">
	<div class="col-md-4">
			  <span class="thumbnail">
		  <img src="/files/stores/<?php echo $s['Store']['image']; ?>" alt="<?php echo $s['Store']['name']; ?>"/>
		</span>
		<a href="/stores/products/<?php echo $s['Store']['id']; ?>">Ver Productos de Boutique</a>
	</div>
	<div class="col-md-8" align="left">
		<h5><b><?php echo $s['Store']['name']; ?></b></h5>
		<?php echo $this->element('store_address', array('store_address' => $s['StoreAddress'][0])); ?>
		<a href="<?php echo $s['Store']['url']; ?>"  target="_blank"><?php echo $s['Store']['url']; ?></a> </h5>
		<?php echo $s['Store']['google_maps']; ?>
		<br />
	</div>
</div>
<?php } ?>