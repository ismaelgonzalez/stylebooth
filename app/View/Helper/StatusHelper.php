<?php
class StatusHelper extends AppHelper {
	/*
	 * This function returns a status badge
	 */
	public function getStatus($status) {
		$badge = '';
		switch($status) {
			case 1:
				$badge = "<span class='label label-success'>Activo</span>";
				break;
			case 0:
				$badge = "<span class='label label-danger'>Desactivado</span>";
				break;
		}

		return $badge;
	}

	/*
	 * This function returns the text position in a badge
	 */
	public function getPosition($position) {
		$badge = '';
		switch($position) {
			case 'U':
				$badge = "<span class='label label-info'>Arriba</span>";
				break;
			case 'D':
				$badge = "<span class='label label-info'>Abajo</span>";
				break;
			case 'L':
				$badge = "<span class='label label-info'>Izquierda</span>";
				break;
			case 'R':
				$badge = "<span class='label label-info'>Derecha</span>";
				break;
			case 'W':
				$badge = "<span class='label label-info'>Wallpaper</span>";
				break;
		}

		return $badge;
	}
}