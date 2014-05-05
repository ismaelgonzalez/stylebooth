<?php
if ($get_product_name){
	$product_name = $this->requestAction('/products/getNameById/' . $id);
	echo $product_name['Product']['name'];
} elseif ($get_skin_body_types) {
	$result = $this->requestAction('/products/getSkinAndBodyType/' . $skin_hair_type_id . '/' . $body_type_id);

	echo '<div class="col-md-6">'
		. '<h4>Tez y Cabello</h4>'
		. '<span class="thumbnail">';
	if (empty($result[0]['SkinHairType']['image'])) {
		echo '<img src="/files/skin_hair_types/imagecara.jpg" alt="' . $result[0]['SkinHairType']['name'] . '"/>';
	} else {
		echo '<img src="/files/skin_hair_types/' . $result[0]['SkinHairType']['image'] . '" alt="' . $result[0]['SkinHairType']['name'] . '"/>';
	}

		echo '<h5>' . $result[0]['SkinHairType']['name'] . '</h5>'
		. '<a href="/users/editSkinHairType">Cambiar Selección</a>'
		. '</span>'
		. '</div>'
		. '<div class="col-md-6">'
		. '<h4>Cuerpo</h4>'
		. '<span class="thumbnail">';
	if (empty($result[1]['BodyType']['image'])) {
		echo '<img src="/files/body_types/imagecara.jpg" alt="' . $result[1]['BodyType']['name'] . '"/>';
	} else {
		echo '<img src="/files/body_types/' . $result[1]['BodyType']['image'] . '" alt="' . $result[1]['BodyType']['name'] . '"/>';
	}
		echo '<h5>' . $result[1]['BodyType']['name'] . '</h5>'
		. '<a href="/users/editBodyType">Cambiar Selección</a>'
		. '</span>'
		. '</div>';
}

