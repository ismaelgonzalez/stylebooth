<?php
if ($get_product_name){
	$product_name = $this->requestAction('/products/getNameById/' . $id);
	echo $product_name['Product']['name'];
} elseif ($get_skin_body_types) {
	$result = $this->requestAction('/products/getSkinAndBodyType/' . $skin_hair_type_id . '/' . $body_type_id);
?>
	<div class="col-md-6">
		<div class="col-md-6">
			Tex y cabello:<br/>
			<?php echo $result[0]['SkinHairType']['name']; ?><br/>
			<a href="/users/editSkinHairType">CAMBIAR SELECCIÓN</a>
		</div>
		<div class="col-md-5">
			<?php
				if (empty($result[0]['SkinHairType']['image'])) {
					echo '<img src="/files/skin_hair_types/imagecara.jpg" alt="' . $result[0]['SkinHairType']['name'] . '"/>';
				} else {
					echo '<img src="/files/skin_hair_types/' . $result[0]['SkinHairType']['image'] . '" alt="' . $result[0]['SkinHairType']['name'] . '"/>';
				}
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="col-md-6">
			Cuerpo:<br/>
			<?php echo $result[1]['BodyType']['name']; ?><br/>
			<a href="/users/editBodyType">CAMBIAR SELECCIÓN</a>
		</div>
		<div class="col-md-5">
			<?php
				if (empty($result[1]['BodyType']['image'])) {
					echo '<img src="/files/body_types/imagecara.jpg" alt="' . $result[1]['BodyType']['name'] . '"/>';
				} else {
					echo '<img src="/files/body_types/' . $result[1]['BodyType']['image'] . '" alt="' . $result[1]['BodyType']['name'] . '"/>';
				}
			?>
		</div>
	</div>
<?php
}

