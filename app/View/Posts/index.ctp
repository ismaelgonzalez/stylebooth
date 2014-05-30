<h3><a href="/posts/add/<?php echo $type; ?>">Agregar <?php if ($type == 'b') { echo 'un Post de Blog Nuevo'; } else { echo 'un Post de Noticias Nuevo'; } ?></a></h3>
<?php
if (sizeof($posts) < 1) {
	echo "<h4>Por el momento no tenemos posts en el sistema.</h4>";
} else {
	?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Titulo</th>
			<th>Fecha de Publicación</th>
			<th>Status</th>
			<th></th>
			<th></th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($posts as $p) { ?>
		<tr>
			<td><?php echo $p['Post']['title']; ?></td>
			<td><?php echo date('d/M/Y', strtotime($p['Post']['post_date'])); ?></td>
			<td><?php echo $this->Status->getStatus($p['Post']['status']); ?></td>
			<td>
				<a href="/posts/edit/<?php echo $p['Post']['id']."/".$p['Post']['type']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Post"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $p['Post']['id']; ?>, '<?php echo $p['Post']['type']; ?>')" data-toggle="tooltip" title="Desactivar Post"></i>
			</td>
			<td align="center" class="checkboxes"><input class="chk_id" type="checkbox" name="batch_<?php echo $p['Post']['id']; ?>" id="batch_<?php echo $p['Post']['id']; ?>" value="<?php echo $p['Post']['id']; ?>"></td>
		</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<td colspan="4"><?php echo $this->Paginator->numbers(); ?></td>
			<td align="center"><span class="btn btn-bg btn-danger borrar_grupo" data-toggle="tooltip" title="Borrar En Grupo"><i class="icon-bug"></i></span></td>
		</tfoot>
	</table>
</div>
<?php } ?>
<div id="deletePost" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar este Post?</p>
				<input id="deleteID" value="" type="hidden">
				<input id="deleteType" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Post</button>
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
				<p>Estas Seguro que quieres borrar <?php if ($type == 'n') { echo "estas noticias"; } else { echo "estos blogs"; } ?>?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmBatchDelete" type="button" class="btn btn-danger">Desactivar <?php if ($type == 'n') { echo "Noticias"; } else { echo "Blogs"; } ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});

		$("#confirmDelete").click(function() {
			var id = $("#deleteID").val();
			var type = $("#deleteType").val();
			$("#deletePost").modal('hide');
			window.open('/posts/delete/'+id+'/'+type, '_parent');
		});

		$('.borrar_grupo').click(function(){
			$("#deleteBatch").modal('show');
		});

		$('#confirmBatchDelete').click(function() {
			$("#deleteBatch").modal('hide');
			var type = "<?php echo $type; ?>";

			var $selected = "";
			var $checked = $('.checkboxes').children("input:checked");

			$checked.each(function(){
				$selected += $(this).val() + "_";
			});

			window.open('/posts/batch_delete/' + $selected + '/' + type, '_parent');
		});
	});

	function borrar(post_id, type) {
		$("#deleteID").val(post_id);
		$("#deleteType").val(type);
		$("#deletePost").modal('show');
	}
</script>
