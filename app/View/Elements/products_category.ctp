<?php
/*
$pc = $this->requestAction('/stylebooth/getProductsCategoryList/');
$options = '<li><a href="#">Todos los Productos</a></li>';
foreach ($pc as $key => $value) {
	$options .= '<li><a href="#">Solo '.$value.'</a></li>';
}
*/
$pc = $this->requestAction('/stylebooth/getProductsCategoryList/');
$options = '<select id="productsFilter"><option value="Todos los Productos">Todos los Productos</option>';
foreach ($pc as $key => $value) {
	$options .= '<option value="Solo '.$value.'">Solo '.$value.'</option>';
}
$options .= '</select>';

echo $options;