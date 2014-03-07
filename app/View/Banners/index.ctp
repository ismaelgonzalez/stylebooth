<h3><a href="/banners/add">Agregar un Banner Nuevo</a></h3>
<?php
	if (sizeof($banners) < 1) {
		echo "<h4>Por el momento no tenemos banners en el sistema.</h4>";
	} else {
?>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Posicion</th>
			<th>Imagen</th>
			<th>Link</th>
			<th>Fecha de Banner</th>
			<th>Status</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<? foreach($banners as $b) { ?>
		<tr>
			<td><?php echo $this->Status->getPosition($b['Banner']['type']); ?></td>
			<td><?php echo $b['Banner']['image']; ?></td>
			<td><?php echo $b['Banner']['link']; ?></td>
			<td><?php echo $b['Banner']['banner_date']; ?></td>
			<td><?php echo $this->Status->getStatus($b['Banner']['status']); ?></td>
			<td>
				<a href="/banners/edit/<?php echo $b['Banner']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Banner"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $b['Banner']['id']; ?>)" data-toggle="tooltip" title="Desactivar Banner"></i>
			</td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});
	});

	function borrar(album_id) {
		var choice = confirm("¿Estas seguro que quieres desactivar este banner?");

		if (choice) {
			window.open('/banners/delete/'+album_id, '_parent');
		}
	}
</script>
