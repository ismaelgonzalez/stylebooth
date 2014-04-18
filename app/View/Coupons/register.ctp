<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-md-3"><img src="/files/products/<?php echo $coupon['Product']['image']; ?>" class="img-thumbnail" width="200" height="150" ></div>
			<div class="col-md-7">
				<h1><?php echo $coupon['Coupon']['title']; ?> <small><?php echo $coupon['Product']['name']; ?></small></h1>
				<h2><?php echo 'Descuento de ' . $coupon['Coupon']['discount_percentage']; ?>% <small>Vigente de <?php echo date('d/M/Y', strtotime($coupon['Coupon']['start_date'])) . ' a ' . date('d/M/Y', strtotime($coupon['Coupon']['end_date'])); ?></small></h2>
				<h4><?php echo $logged_user['first_name'] . ' ' . $logged_user['last_name']; ?></h4>
				<h5>Número de cupon: <small><?php echo $usedCoupon['CouponUser']['generated_key']; ?></small></h5>
			</div>
			<div class="col-md-2"><img src="/stylebooth.png"></div>
		</div>
	</div>
	<button class="btn btn-lg btn-info" onclick="window.print();">Imprimir</button>
	<button class="btn btn-lg btn-warning" onclick="window.history.back();">Regresar</button>
</div>