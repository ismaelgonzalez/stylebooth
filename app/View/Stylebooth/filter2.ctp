<form id="frmFilter2" method="post" role="form">
<br />
<h4>Selecciona la persona que mayor corresponda a tu piel y cabello</h4>
<br />
	<?php foreach ($skin_hair_types as $sk) { ?>
	<div class="col-md-3">
		<div>
			<a class="thumbnail" href="#" onclick="setSkinHairType(<?php echo $sk['SkinHairType']['id']; ?>)"><img src="/files/skin_hair_types/<?php if ($sk['SkinHairType']['image']) { echo $sk['SkinHairType']['image']; } else { echo 'imagecara.jpg'; } ?>" alt="<?php echo $sk['SkinHairType']['name']; ?>"></a>
		</div>
	</div>
	<?php } ?>
	<ul class="pager">
		<li><a href="/filter1">Anterior</a></li>
	</ul>
	<input type="hidden" id="skin_hair_type" name="skin_hair_type" value="">
</form>
<script type="text/javascript">
	function setSkinHairType(id) {
		$('#skin_hair_type').val(id);
		$("#frmFilter2").attr('action', '/filter3')
			.submit();
	}
</script>