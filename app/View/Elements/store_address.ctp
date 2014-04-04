<?php
$store_address = $this->requestAction('/stores/getStoreAddress/' . $store_id);

echo "<h5>" . $store_address['StoreAddress']['address1'];

if (!empty($store_address['StoreAddress']['address2'])) {
	echo " <br/>" . $store_address['StoreAddress']['address2'];
}
if (!empty($store_address['StoreAddress']['zip'])) {
	echo "<br/>C.P. " . $store_address['StoreAddress']['zip'];
}

	echo "<br/>" . $store_address['StoreAddress']['city'] . ", "
	. $store_address['StoreAddress']['state']
	. ". " . $store_address['StoreAddress']['country'] . "</h5>";
