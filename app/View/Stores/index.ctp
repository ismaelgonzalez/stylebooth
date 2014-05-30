<h3><a href="/stores/add/">Agregar Tiendas</a></h3>
<?php
if (sizeof($stores) < 1) {
	echo "<h4>Por el momento no tenemos tiendas en el sistema.</h4>";
} else {
	?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>NombreTitulo</th>
			<th>URL</th>
			<th>Zona</th>
			<th>Status</th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($stores as $s) { ?>
		<tr>
			<td><?php echo $s['Store']['name']; ?></td>
			<td><a href="<?php echo $s['Store']['url']; ?>"><?php echo $s['Store']['url']; ?></a></td>
			<td><?php echo $this->Status->getZone($s['Store']['zone']); ?></td>
			<td><?php echo $this->Status->getStatus($s['Store']['status']); ?></td>
			<td>
				<a href="/stores/edit/<?php echo $s['Store']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Tienda"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $s['Store']['id']; ?>)" data-toggle="tooltip" title="Desactivar Tienda"></i>
			</td>
			<td align="center" class="checkboxes"><input class="chk_id" type="checkbox" name="batch_<?php echo $s['Store']['id']; ?>" id="batch_<?php echo $s['Store']['id']; ?>" value="<?php echo $s['Store']['id']; ?>"></td>
		</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<td colspan="5"><?php echo $this->Paginator->numbers(); ?></td>
			<td align="center"><span class="btn btn-bg btn-danger borrar_grupo" data-toggle="tooltip" title="Borrar En Grupo"><i class="icon-bug"></i></span></td>
		</tfoot>
	</table>
</div>
<?php } ?>
<div id="deleteStore" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar esta Tienda?</p>
				<input id="deleteID" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Tienda</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="deleteBatch" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar estas Tiendas?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmBatchDelete" type="button" class="btn btn-danger">Desactivar Tiendas</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});

		$("#confirmDelete").click(function() {
			var id = $("#deleteID").val();
			$("#deleteStore").modal('hide');
			window.open('/stores/delete/'+id, '_parent');
		});

		$('.borrar_grupo').click(function(){
			$("#deleteBatch").modal('show');
		});

		$('#confirmBatchDelete').click(function() {
			$("#deleteBatch").modal('hide');

			var $selected = "";
			var $checked = $('.checkboxes').children("input:checked");

			$checked.each(function(){
				$selected += $(this).val() + "_";
			});

			window.open('/stores/batch_delete/' + $selected, '_parent');
		});
	});

	function borrar(post_id) {
		$("#deleteID").val(post_id);
		$("#deleteStore").modal('show');
	}
</script>
