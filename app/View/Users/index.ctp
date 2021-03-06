<h3><a href="/users/add/">Agregar Usuarios</a></h3>
<?php
if (sizeof($users) < 1) {
	echo "<h4>Por el momento no tenemos usuarios en el sistema.</h4>";
} else {
	?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Email</th>
			<th>Ocupación</th>
			<th>Edad</th>
			<th>Código Postal</th>
			<th>Rol</th>
			<th>Status</th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($users as $u) { ?>
		<tr>
			<td><?php echo $u['User']['first_name'] . ' ' . $u['User']['last_name']; ?></td>
			<td><?php echo $u['User']['email']; ?></td>
			<td><?php echo $u['User']['job']; ?></td>
			<td><?php echo $u['User']['age']; ?></td>
			<td><?php echo $u['User']['zip']; ?></td>
			<td><?php echo $this->Status->getRole($u['User']['role']); ?></td>
			<td><?php echo $this->Status->getStatus($u['User']['status']); ?></td>
			<td>
				<a href="/users/edit/<?php echo $u['User']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Usuario"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $u['User']['id']; ?>)" data-toggle="tooltip" title="Desactivar Usuario"></i> |
				<a href="/users/cupones/<?php echo $u['User']['id']; ?>"><i class="icon-tags" data-toggle="tooltip" title="Ver Cupones del Usuario"></i></a> |
				<a href="/users/stats/<?php echo $u['User']['id']; ?>"><i class="icon-bar-chart" data-toggle="tooltip" title="Ver Stats del Usuario"></i></a>
			</td>
			<td align="center" class="checkboxes"><input class="chk_id" type="checkbox" name="batch_<?php echo $u['User']['id']; ?>" id="batch_<?php echo $u['User']['id']; ?>" value="<?php echo $u['User']['id']; ?>"></td>
		</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<td colspan="8"><?php echo $this->Paginator->numbers(); ?></td>
			<td align="center"><span class="btn btn-bg btn-danger borrar_grupo" data-toggle="tooltip" title="Borrar En Grupo"><i class="icon-bug"></i></span></td>
		</tfoot>
	</table>
</div>
<?php } ?>
<div id="deleteUser" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar este Usuario?</p>
				<input id="deleteID" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Usuario</button>
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
				<p>Estas Seguro que quieres borrar estos Usuarios?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmBatchDelete" type="button" class="btn btn-danger">Desactivar Usuarios</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});

		$("#confirmDelete").click(function() {
			var id = $("#deleteID").val();
			$("#deleteUser").modal('hide');
			window.open('/users/delete/'+id, '_parent');
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

			window.open('/users/batch_delete/' + $selected, '_parent');
		});
	});

	function borrar(post_id) {
		$("#deleteID").val(post_id);
		$("#deleteUser").modal('show');
	}
</script>
