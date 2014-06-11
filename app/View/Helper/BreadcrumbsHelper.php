<?php
class BreadcrumbsHelper extends AppHelper {
	/*
	 *This function will return the breadcrumbs as shown in filter 4, outfits/detail and products/detail
	 */
	public function getBreadcrumbs($style, $budget, $size, $foot_size, $skin_hair_type, $body_type){

		if ($budget > 2000) {
			$budget = 'cualquier presupuesto';
		} else {
			$budget = 'menos de $' . $budget;
		}
		echo '<a href="/" > ' . $style . ' </a> -> <a href="/filter1" > ' . $budget . ', talla ' . $size . ', calzado ' . $foot_size . ' </a>-> <a href="/filter2" > ' . $skin_hair_type . ' </a> -><a href="/filter3" > ' . $body_type . ' </a> ->  Outfits ->';
	}
}