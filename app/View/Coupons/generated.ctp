<div class="table-response">
	<h3>Información General del Cupon</h3>
	<table class="table table-striped table-hover">
		<tbody>
		<tr>
			<th>Nombre Cupon</th><td><a href="/coupons/edit/<?php echo $coupon['Coupon']['id']; ?>"><?php echo $coupon['Coupon']['title']; ?></a></td>
		</tr>
		<tr>
			<th>Tienda</th><td><?php echo $this->element('store_address', array('get_store_name_by_product_id' => true, 'product_id' => $coupon['Coupon']['product_id'])); ?></td>
		</tr>
		<tr>
			<th>Producto</th><td><?php echo $coupon['Product']['name']; ?></td>
		</tr>
		<tr>
			<th>Descuento</th><td><?php echo $coupon['Coupon']['discount_percentage']; ?></td>
		</tr>
		</tbody>
	</table>
</div>
<div class="table-responsive">
	<h3>Usuarios Que Han Generado Este Cupon</h3>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Numero de Cupon Generado</th>
			<th>Usuario que Generó el Cupon</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($coupon['User'] as $c) { ?>
		<tr>
			<td><?php echo $c['CouponUser']['generated_key']; ?></td>
			<td><a href="/users/edit/<?php echo $c['id']; ?>"><?php echo $c['first_name'].' '.$c['last_name']; ?></a></td>
		</tr>
			<?php } ?>
		</tbody>
	</table>
</div>