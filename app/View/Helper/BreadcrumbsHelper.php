<?php
class BreadcrumbsHelper extends AppHelper {
	/*
	 *This function will return the breadcrumbs as shown in filter 4, outfits/detail and products/detail
	 */
	public function getBreadcrumbs($style, $budget, $size, $foot_size, $skin_hair_type, $body_type){

		if (!strstr($budget, 'cualquier')) {
			if (strstr($budget, 'menos')) {
				$budget = "Menos de $500";
			} elseif (strstr($budget, 'mas')) {
				$budget = "Mas de $2000";
			} else {
				$values = split("_", $budget);
				$budget = "$" . $values[0] . " - $". $values[1];
			}
		} else {
			$budget = 'cualquier presupuesto';
		}
		echo '<a href="/" > ' . $style . ' </a> -> <a href="/filter1" > ' . $budget . ', talla ' . $size . ', calzado ' . $foot_size . ' </a>-> <a href="/filter2" > ' . $skin_hair_type . ' </a> -><a href="/filter3" > ' . $body_type . ' </a> ->  Outfits ->';
	}
}