<h3><a href="/banners/add">Agregar un Banner Nuevo</a></h3>
<?php
	if (sizeof($banners) < 1) {
		echo "<h4>Por el momento no tenemos banners en el sistema.</h4>";
	} else {
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Posicion</th>
			<th>Imagen</th>
			<th>Link</th>
			<th>Fecha de Banner</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($banners as $b) { ?>
		<tr>
			<td><?php echo $this->Status->getPosition($b['Banner']['type']); ?></td>
			<td><?php if ($b['Banner']['image']) { echo $b['Banner']['image']; } else { echo "<span class='label label-info'>AdSense</span>"; } ?></td>
			<td><?php echo $b['Banner']['link']; ?></td>
			<td><?php echo date('d/M/Y', strtotime($b['Banner']['banner_date'])); ?></td>
			<td><?php echo $this->Status->getStatus($b['Banner']['status']); ?></td>
			<td>
				<a href="/banners/edit/<?php echo $b['Banner']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Banner"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $b['Banner']['id']; ?>)" data-toggle="tooltip" title="Desactivar Banner"></i>
			</td>
			<td align="center" class="checkboxes"><input class="chk_id" type="checkbox" name="batch_<?php echo $b['Banner']['id']; ?>" id="batch_<?php echo $b['Banner']['id']; ?>" value="<?php echo $b['Banner']['id']; ?>"></td>
		</tr>
		<?php } ?>
		</tbody>
		<tfoot>
			<td colspan="6"><?php echo $this->Paginator->numbers(); ?></td>
			<td align="center"><span class="btn btn-bg btn-danger borrar_grupo" data-toggle="tooltip" title="Borrar En Grupo"><i class="icon-bug"></i></span></td>
		</tfoot>
	</table>
</div>
<?php } ?>
<div id="deleteBanner" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar este banner?</p>
				<input id="deleteID" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Banner</button>
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
				<p>Estas Seguro que quieres borrar estos Banners?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmBatchDelete" type="button" class="btn btn-danger">Desactivar Banners</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});

		$("#confirmDelete").click(function() {
			var id = $("#deleteID").val();
			$("#deleteBanner").modal('hide');
			window.open('/banners/delete/'+id, '_parent');
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

			window.open('/banners/batch_delete/' + $selected, '_parent');
		});
	});

	function borrar(album_id) {
		$("#deleteID").val(album_id);
		$("#deleteBanner").modal('show');
	}
</script>
