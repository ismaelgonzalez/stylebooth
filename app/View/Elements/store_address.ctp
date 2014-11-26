<?php
if ($get_store_address) {
	$store_address = $this->requestAction('/stores/getStoreAddress/' . $store_id);

	echo $store_address['StoreAddress']['address1'];

	if (!empty($store_address['StoreAddress']['address2'])) {
		echo " <br/>" . $store_address['StoreAddress']['address2'];
	}
	if (!empty($store_address['StoreAddress']['zip'])) {
		echo "<br/>C.P. " . $store_address['StoreAddress']['zip'];
	}

	echo "<br/>" . $store_address['StoreAddress']['city'] . ", "
		. $store_address['StoreAddress']['state']
		. ". " . $store_address['StoreAddress']['country'];

} elseif ($get_store_name) {
	$store_name = $this->requestAction('/stores/getStoreName/' . $store_id);
	echo $store_name['Store']['name'];
} elseif ($get_store_name_by_product_id) {
	$store_name = $this->requestAction('/stores/getStoreNameByProductId/' . $product_id);
	echo $store_name['Store']['name'];
} else {
	if (!empty($store_address['address1'])) {
		echo $store_address['address1'];

		if (!empty($store_address['address2'])) {
			echo " <br/>" . $store_address['address2'];
		}
		if (!empty($store_address['zip'])) {
			echo "<br/>C.P. " . $store_address['zip'];
		}

		echo "<br/>" . $store_address['city'] . ", "
			. $store_address['state']
			. ". " . $store_address['country'];
	}
}
