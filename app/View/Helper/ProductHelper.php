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
			<p class='text-center'><small>Imagen actual del outfit</small></p>
		</div>";

		echo $div;
	}

	public function post_thumbnail($post, $thumb_size){
		$div = "<div class='thumbnail col-md-2' style='margin-left:10px'>
			<img src='/files/posts/".$post['Post']['image']."' alt='".$post['Post']['title']."' width='".$thumb_size."' class='img-thumbnail'>
			<p class='text-center'><small>Imagen actual del post</small></p>
		</div>";

		echo $div;
	}

	public function store_thumbnail($store, $thumb_size){
		$div = "<div class='thumbnail col-md-2' style='margin-left:10px'>
			<img src='/files/stores/".$store['Store']['image']."' alt='".$store['Store']['name']."' width='".$thumb_size."' class='img-thumbnail'>
			<p class='text-center'><small>Logo de la Tienda</small></p>
		</div>";

		echo $div;
	}
}