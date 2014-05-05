<h3><a href="/outfits/add">Agregar un Outfit Nuevo</a></h3>
<?php
if (sizeof($outfits) < 1) {
	echo "<h4>Por el momento no tenemos outfits en el sistema.</h4>";
} else {
	?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Imagen</th>
			<th>Status</th>
			<th>Presupuesto</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($outfits as $o) { ?>
		<tr>
			<td><?php echo $o['Outfit']['name']; ?></td>
			<td><?php echo $o['Outfit']['image']; ?></td>
			<td><?php echo $this->Status->getStatus($o['Outfit']['status']); ?></td>
			<td><?php echo $this->Number->Currency($o['Outfit']['budget']); ?></td>
			<td>
				<a href="/outfits/edit/<?php echo $o['Outfit']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Outfit"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $o['Outfit']['id']; ?>)" data-toggle="tooltip" title="Desactivar Outfit"></i>
			</td>
		</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<td colspan="5"><?php echo $this->Paginator->numbers(); ?></td>
		</tfoot>
	</table>
</div>
<?php } ?>
<div id="deleteOutfit" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar este outfit?</p>
				<input id="deleteID" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Outfit</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});

		$("#confirmDelete").click(function() {
			var id = $("#deleteID").val();
			$("#deleteOutfit").modal('hide');
			window.open('/outfits/delete/'+id, '_parent');
		});
	});

	function borrar(album_id) {
		$("#deleteID").val(album_id);
		$("#deleteOutfit").modal('show');
	}
</script>
