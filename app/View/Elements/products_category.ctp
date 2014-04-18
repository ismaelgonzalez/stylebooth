<?php
$pc = $this->requestAction('/stylebooth/getProductsCategoryList/');
$options = '<li><a href="#">Todos los Productos</a></li>';
foreach ($pc as $key => $value) {
	$options .= '<li><a href="#">Solo '.$value.'</a></li>';
}
echo $options;