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
			<td><?php echo $b['Banner']['type']; ?></td>
			<td><?php echo $b['Banner']['image']; ?></td>
			<td><?php echo $b['Banner']['link']; ?></td>
			<td><?php echo $b['Banner']['banner_date']; ?></td>
			<td><?php echo $b['Banner']['status']; ?></td>
			<td></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<?php } ?>