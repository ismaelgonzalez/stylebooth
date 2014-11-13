<style type="text/css">
/*	*, *:before, *:after {box-sizing:  border-box !important;}


	.row {
		-moz-column-width: 25em;
		-webkit-column-width: 25em;
		-moz-column-gap: .5em;
		-webkit-column-gap: .5em;

	}

	.panel {
		display: inline-block;
		margin:  .5em;
		padding:  0;
		width:98%;
	}*/
</style>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="icon-female icon-3"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $total_products; ?></div>
						<div>Numero de Productos</div>
					</div>
				</div>
			</div>
			<a href="/products">
				<div class="panel-footer text-success">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="icon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="icon-gift icon-3"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $total_coupons; ?></div>
						<div>Numero de Cupones</div>
					</div>
				</div>
			</div>
			<a href="/coupons">
				<div class="panel-footer text-warning">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="icon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="icon-user icon-3"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo $total_users; ?></div>
						<div>Numero de Usuarios</div>
					</div>
				</div>
			</div>
			<a href="/users">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="icon-circle-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="icon-female"></i> Productos Mas Vistos</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($most_viewed_prods as $p) { ?>
						<a href="/products/edit/<?php echo $p['Product']['id']; ?>" class="list-group-item">
							<span class="badge"><?php echo $p['Product']['num_views']; ?> Vistas</span>
							<i class="icon-female"></i> <?php echo $p['Product']['name']; ?>
						</a>
					<?php } ?>
				</div>
				<div class="text-right">
					<a href="/products">Ver Todos <i class="icon-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="icon-gift"></i> Ultimos Cupones Generados</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($latest_coupons as $c) { ?>
					<a href="/coupons/edit/<?php echo $c['Coupon']['id']; ?>" class="list-group-item">
						<span class="badge">Vigencia <?php echo date('d/m/y', strtotime($c['Coupon']['start_date']))
								. ' y ' . date('d/m/y', strtotime($c['Coupon']['end_date'])); ?></span>
						<i class="icon-gift"></i> <?php echo $c['Coupon']['title']; ?>
					</a>
					<?php } ?>
				</div>
				<div class="text-right">
					<a href="/coupons">Ver Todos <i class="icon-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="icon-group"></i> Ultimos Usuarios Registrados</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($latest_users as $u) { ?>
					<a href="/users/edit<?php echo $u['User']['id']; ?>" class="list-group-item">
						<span class="badge"><?php echo $u['User']['email']; ?></span>
						<i class="icon-user"></i> <?php echo $u['User']['first_name'] . ' ' . $u['User']['last_name']; ?>
					</a>
					<?php } ?>
				</div>
				<div class="text-right">
					<a href="/users">Ver Todos <i class="icon-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="icon-globe"></i> Tiendas Y Productos</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($stores_and_products as $s) { ?>
					<a href="/stores/edit/<?php echo $s['id']; ?>" class="list-group-item">
						<span class="badge">Productos Totales: <?php echo $s['num_prods']; ?></span>
						<i class="icon-building"></i> <?php echo $s['name']; ?>
					</a>
					<?php } ?>

				</div>
				<div class="text-right">
					<a href="/stores">Ver Todos <i class="icon-circle-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Ultimas Adiciones al Wishlist</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
						<tr>
							<th>Usuario</th>
							<th>Producto</th>
							<th>Tienda</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($wishlists as $w) { ?>
						<tr>
							<td><a href="/users/edit/<?php echo $w['User']['id']; ?>"><?php echo $w['User']['first_name'] . ' ' . $w['User']['last_name']; ?></a></td>
							<td><a href="/products/edit/<?php echo $w['Product']['id']; ?>"><?php echo $w['Product']['name']; ?></a></td>
							<td><a href="/stores/edit/<?php echo $w['Product']['store_id']; ?>"><?php echo $this->element('store_address', array('get_store_name' => true, 'store_id' => $w['Product']['store_id'])); ?></a></td>
						</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>