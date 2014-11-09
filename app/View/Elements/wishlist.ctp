<?php
$user_id = !empty($user) ? $user['id'] : 0;
$in_wishlist = $this->requestAction('/products/check_if_in_wishlist/' . $product_id . '/' . $user_id);

if ($in_wishlist) {
	//show green heart disabled button
	echo '<button type="button" class="btn btn-default btn-xs" disabled="disabled">
	<span class="icon-heart" style="color: limegreen;"></span> Agregado a mi Booth Personal
	</button>';
} else {
	echo '<button type="button" class="btn btn-default btn-xs" onclick="javascript:addToWishList(' . $product_id . ')">
			<span class="icon-heart" style="color: #F92672;"></span> Agregar a mi Booth Personal
	</button>';
}