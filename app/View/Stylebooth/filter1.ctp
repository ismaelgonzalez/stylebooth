<form id="frmFilter1" method="post" role="form">
	<h3>Selecciona tu Presupuesto</h3>
	<div class="btn-group " data-toggle="buttons" >
		<label class="btn btn-default">
			<input type="radio" name="budget" class='budget' value="500"> $500
		</label>
		<label class="btn btn-default">
			<input type="radio" name="budget" class='budget' value="800"> $800 MXN
		</label>
		<label class="btn btn-default">
			<input type="radio" name="budget" class='budget' value="1000"> $1000 MXN
		</label>
		<label class="btn btn-default">
			<input type="radio" name="budget" class='budget' value="1500"> $1500 MXN
		</label>
		<label class="btn btn-default">
			<input type="radio" name="budget" class='budget' value="2000"> $2000 MXN
		</label>
		<label class="btn btn-default">
			<input type="radio" name="budget" class='budget' value="2001"> Cualquier presupuesto
		</label>
	</div>
	<h3>Selecciona tu talla</h3>
	<div class="btn-group " data-toggle="buttons" >
		<label class="btn btn-default">
			<input type="radio" name="size" class='size' value="chica"> Chica
		</label>
		<label class="btn btn-default">
			<input type="radio" name="size" class='size' value="mediana"> Mediana
		</label>
		<label class="btn btn-default">
			<input type="radio" name="size" class='size' value="grande"> Grande
		</label>
		<label class="btn btn-default">
			<input type="radio" name="size" class='size' value="extra grande"> Extra Grande
		</label>
		<label class="btn btn-default">
			<input type="radio" name="size" class='size' value="cualquier talla"> Cualquier talla
		</label>
	</div>
	<br /><br />
	<h3>Selecciona tu talla en calzado</h3>
	<div class="btn-group " data-toggle="buttons" >
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="3"> 3
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="3.5"> 3.5
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="4"> 4
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="4.5"> 4.5
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="5"> 5
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="5.5"> 5.5
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="6"> 6
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="6.5"> 6.5
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="7"> 7
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="7.5"> 7.5
		</label>
		<label class="btn btn-default">
			<input type="radio" name="foot_size" class='foot_size' value="cualquier talla calzado"> Cualquiera
		</label>
	</div>
	<ul class="pager">
		<li><a href="/">Anterior</a></li>
		<li><a id="filter1Continue" href="#">Continuar</a></li>
	</ul>
</form>

<script type="text/javascript">
	$(function() {
		$("#filter1Continue").click(function() {
			$budget    = $(".budget:checked").val();
			$size      = $(".size:checked").val();
			$foot_size = $(".foot_size:checked").val();

			if ($budget == '') {
				$budget = '2001';
			}
			if ($size == '') {
				$size = 'cualquier talla';
			}
			if ($foot_size == '') {
				$foot_size = 'cualquier talla calzado';
			}
			var action = "/filter2";

			$("#frmFilter1").attr('action', action)
				.submit();
		});
	});
</script>