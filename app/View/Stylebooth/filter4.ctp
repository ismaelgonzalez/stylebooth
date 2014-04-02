<h3><?php echo $style['Style']['name']; ?></h3>
<h4><b>Sugerencias de Outfits</b></h4>
<div class="row" >
	<?php foreach ($outfits as $o) { ?>
	<div class="col-md-4">
		<div class="thumbnail">
			<a href="/outfits/detail/<?php echo $o['Outfit']['id']; ?>"> <img style="min-height:286px;height:286px;" src="/files/outfits/<?php echo $o['Outfit']['image']; ?>" alt="<?php echo $o['Outfit']['name']; ?>"></a>
			<div class="caption">
				<h5><b><?php echo $o['Outfit']['name']; ?>: $1650 MXN</b></h5>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<h4><b>Resultados de Productos</b></h4>
<a href="/" > <?php echo $style['Style']['name']; ?> </a> -> <a href="/filter1" > <?php echo $this->Session->read('Visit.budget'); ?>, <?php echo $this->Session->read('Visit.size'); ?>, <?php echo $this->Session->read('Visit.foot_size'); ?> </a>-> <a href="/filter2" > <?php echo $skin['SkinHairType']['name']; ?> </a> -><a href="/filter3" >  <?php echo $body['BodyType']['name']; ?> </a> ->  Outfits ->
<!-- Single button -->
<div class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		Todos los Productos <span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu">
		<li><a href="#">Todos los Productos</a></li>
		<li><a href="#">Solo Accesorios</a></li>
		<li><a href="#">Solo calzado</a></li>
	</ul>
</div>
<br />
<div class="row">
	<?php foreach ($products as $p) { ?>
	<div class="col-md-3">
		<div class="thumbnail">
			<a href="/products/detail/<?php echo $p['Product']['id']; ?>"> <img style="min-height:210px;height:210px;" src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['name']; ?>"></a>
			<div class="caption">
				<h5><b><?php echo $p['Product']['name']; ?></b></h5>
				<h5><?php echo $p['Store']['name']; ?></h5>
				<h5>$<?php echo $p['Product']['price']; ?></h5>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<ul class="pager">
	<li><a href="/filter3">Anterior</a></li>
</ul>