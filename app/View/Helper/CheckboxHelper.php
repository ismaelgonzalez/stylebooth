<?php
class CheckboxHelper extends AppHelper {
	/*
	 * This helper will get an array and then return the set values of the checked checkboxes
	 */
	public function getChecked($values_array, $field){
		$checked = array();
		foreach ($values_array as $v) {
			$checked[] = $v[$field];
		}

		return $checked;
	}

	/*
	 * This function returns the chekced values for size
	 */
	public function getSizeChecked($values_array, $field){
		$checked = array();
		foreach ($values_array as $v) {
			$checked[] = $v[$field];
		}

		return $checked;
	}
}