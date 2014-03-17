<?php
class ProductHelper extends AppHelper
{
	/*
	 *This gets product image thumbnail
	 */
	public function outfit_product_thumbnail($product, $thumb_size){

		$div = "<div class='thumbnail col-md-1' style='margin-left:10px' id='prod_".$product['Product']['id']."'>
			<img src='/files/products/".$product['Product']['image']."' alt='".$product['Product']['name']."' width='".$thumb_size."' class='img-thumbnail'>
			<p>".$product['Product']['name']."<a class='close' onclick='delProd(".$product['Product']['id'].")'>x</a></p>
		</div>";

		echo $div;
	}

	public function outfit_thumbnail($outfit, $thumb_size){
		$div = "<div class='thumbnail col-md-2' style='margin-left:10px'>
			<img src='/files/outfits/".$outfit['Outfit']['image']."' alt='".$outfit['Outfit']['name']."' width='".$thumb_size."' class='img-thumbnail'>
			<p class='text-center'><small>Imagen de outfit actual</small></p>
		</div>";

		echo $div;
	}
}