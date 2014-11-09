<h1>Selecciona tu Estilo</h1>
<form id="frmStyle" method="post" role="form">
<div class="row">
	<div class="col-md-6">
		<div>
			<a class="thumbnail" onclick="setFilter1(<?php echo $styles[0]['Style']['id']; ?>)"> <img src="/files/styles/<?php echo $styles[0]['Style']['image']; ?>" alt="<?php echo $styles[0]['Style']['name']; ?>" height="290" width="290"></a>
		</div>
	</div>
	<div class="col-md-6">
		<div>
			<a class="thumbnail" onclick="setFilter1(<?php echo $styles[1]['Style']['id']; ?>)"> <img src="/files/styles/<?php echo $styles[1]['Style']['image']; ?>" alt="<?php echo $styles[1]['Style']['name']; ?>" height="290" width="290"></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div>
			<a class="thumbnail" onclick="setFilter1(<?php echo $styles[2]['Style']['id']; ?>)"> <img src="/files/styles/<?php echo $styles[2]['Style']['image']; ?>" alt="<?php echo $styles[2]['Style']['name']; ?>" height="290" width="290"></a>
		</div>
	</div>
	<div class="col-md-6">
		<div>
			<a class="thumbnail" onclick="setFilter1(<?php echo $styles[3]['Style']['id']; ?>)"> <img src="/files/styles/<?php echo $styles[3]['Style']['image']; ?>" alt="<?php echo $styles[3]['Style']['name']; ?>" height="290" width="290"></a>
		</div>
	</div>
</div>
	<input id="style_id" name="style_id" type="hidden" value="">
</form>
<h3><a href="/productosyaccesoriosdemoda">Ver todos los productos</a></h3>
	<script type="text/javascript">
		function setFilter1(style_id) {
			$('#style_id').val(style_id);
			console.log($('#style_id').val());

			$('#frmStyle').attr('action', '/filter1')
				.submit();
		}
	</script>