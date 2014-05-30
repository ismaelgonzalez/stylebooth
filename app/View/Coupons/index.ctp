<h3><a href="/coupons/add">Agregar un Cupon Nuevo</a></h3>
<?php
if (sizeof($coupons) < 1) {
	echo "<h4>Por el momento no tenemos cupones en el sistema.</h4>";
} else {
?>
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Titulo</th>
			<th>Producto</th>
			<th>Descuento</th>
			<th>Comienzo de Promoción</th>
			<th>Fin de Promoción</th>
			<th>Numero de Cupones Restantes</th>
			<th>Status</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($coupons as $c) { ?>
		<tr>
			<td><?php echo $c['Coupon']['title']; ?></td>
			<td><?php echo $c['Product']['name']; ?></td>
			<td><?php echo $c['Coupon']['discount_percentage']; ?></td>
			<td><?php echo date('d/M/Y', strtotime($c['Coupon']['start_date'])); ?></td>
			<td><?php echo date('d/M/Y', strtotime($c['Coupon']['end_date'])); ?></td>
			<td><?php echo $c['Coupon']['number_coupons']; ?></td>
			<td><?php echo $this->Status->getStatus($c['Coupon']['status']); ?></td>
			<td>
				<a href="/coupons/edit/<?php echo $c['Coupon']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Cupon"></i></a> |
				<a href="/coupons/generated/<?php echo $c['Coupon']['id']; ?>"><i class="icon-tags text-warning" data-toggle="tooltip" title="Ver Cupones Generados"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $c['Coupon']['id']; ?>)" data-toggle="tooltip" title="Desactivar Cupon"></i>
			</td>
			<td align="center" class="checkboxes"><input class="chk_id" type="checkbox" name="batch_<?php echo $c['Coupon']['id']; ?>" id="batch_<?php echo $c['Coupon']['id']; ?>" value="<?php echo $c['Coupon']['id']; ?>"></td>
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
<div id="deleteBanner" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar este cupon?</p>
				<input id="deleteID" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Cupon</button>
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
				<p>Estas Seguro que quieres borrar estos Cupones?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmBatchDelete" type="button" class="btn btn-danger">Desactivar Cupones</button>
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
			window.open('/coupons/delete/'+id, '_parent');
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

			window.open('/coupons/batch_delete/' + $selected, '_parent');
		});
	});

	function borrar(album_id) {
		$("#deleteID").val(album_id);
		$("#deleteBanner").modal('show');
	}
</script>