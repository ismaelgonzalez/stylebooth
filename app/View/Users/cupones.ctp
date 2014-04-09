<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Nombre Cupon</th>
			<th>Tienda</th>
			<th>Producto</th>
			<th>Descuento</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($user['Coupon'] as $c) { ?>
		<tr>
			<td><a href="/coupons/edit/<?php echo $c['id']; ?>"><?php echo $c['title']; ?></a></td>
			<td><?php echo $this->element('store_address', array('get_store_name_by_product_id' => true, 'product_id' => $c['product_id'])); ?></td>
			<td><?php echo $this->element('product_name', array('get_product_name' => true, 'id' => $c['product_id'])); ?></td>
			<td><?php echo $c['discount_percentage']; ?></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
</div>