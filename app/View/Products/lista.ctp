<h4><b>Todos los Productos</b></h4>

<div id="productsResults" class="row">
	<?php
	foreach ($products as $p) {
		?>
		<div class="col-md-4">
			<div class="thumbnail">
				<a href="/products/detail/<?php echo $p['Product']['id']; ?>"> <img style="min-height:210px;height:210px;" src="/files/products/<?php echo $p['Product']['image']; ?>" alt="<?php echo $p['Product']['name']; ?>"></a>
				<div class="caption">
					<h5><b><?php echo $p['Product']['name']; ?></b></h5>
					<h5><?php echo $p['Store']['name']; ?></h5>
					<h5>$<?php echo $p['Product']['price']; ?></h5>
					<?php if (!empty($p['Coupon'])) { ?>
					<h5><a href="/products/detail/<?php echo $p['Product']['id']; ?>"><strong>Ve por tu cupon!</strong></a></h5>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
</div>
<ul class="pager">
	<li><a href="/">Anterior</a></li>
</ul>
