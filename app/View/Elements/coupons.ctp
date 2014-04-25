<?php
$coupon = $this->requestAction('/coupons/getByProductId/' . $product_id);
if (!empty($coupon)) {
	echo '<h5><a href="/products/detail/' . $product_id . '"><strong>Ve por tu cupon!</strong></a></h5>';
}