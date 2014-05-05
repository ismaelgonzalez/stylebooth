<h3><a href="/products/add/">Agregar Productos</a></h3>
<?php
if (sizeof($products) < 1) {
	echo "<h4>Por el momento no tenemos productos en el sistema.</h4>";
} else {
	?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th>Tienda</th>
			<th>Categorías de Productos</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Status</th>
		</tr>
		</thead>
		<tbody>
			<?php foreach($products as $p) { ?>
		<tr>
			<td><?php echo $p['Store']['name']; ?></td>
			<td><?php echo $p['ProductsCategory']['name']; ?></td>
			<td><?php echo $p['Product']['name']; ?></td>
			<td><?php echo $p['Product']['price']; ?></td>
			<td><?php echo $this->Status->getStatus($p['Product']['status']); ?></td>
			<td>
				<a href="/products/edit/<?php echo $p['Product']['id']; ?>"><i class="icon-edit" data-toggle="tooltip" title="Editar Producto"></i></a> |
				<i class="icon-remove-sign delete" onclick="borrar(<?php echo $p['Product']['id']; ?>)" data-toggle="tooltip" title="Desactivar Producto"></i>
			</td>
		</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4">
					<?php echo $this->Paginator->numbers(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php } ?>
<div id="deleteProduct" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Stylebooth Admin</h4>
			</div>
			<div class="modal-body">
				<p>Estas Seguro que quieres borrar este Producto?</p>
				<input id="deleteID" value="" type="hidden">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button id="confirmDelete" type="button" class="btn btn-danger">Desactivar Producto</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});

		$("#confirmDelete").click(function() {
			var id = $("#deleteID").val();
			$("#deleteProduct").modal('hide');
			window.open('/products/delete/'+id, '_parent');
		});
	});

	function borrar(post_id) {
		$("#deleteID").val(post_id);
		$("#deleteProduct").modal('show');
	}
</script>
