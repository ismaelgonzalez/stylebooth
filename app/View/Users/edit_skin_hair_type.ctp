<form id="frmFilter2" method="post" role="form">
	<br />
	<h4>Selecciona la persona que mayor corresponda a tu piel y cabello</h4>
	<br />
	<?php foreach ($skin_hair_types as $sk) { ?>
	<div class="col-md-3">
		<div>
			<a class="thumbnail" href="#" onclick="setSkinHairType(<?php echo $sk['SkinHairType']['id']; ?>)"><img src="/files/skin_hair_types/<?php if ($sk['SkinHairType']['image']) { echo $sk['SkinHairType']['image']; } else { echo 'imagecara.jpg'; } ?>" alt="<?php echo $sk['SkinHairType']['name']; ?>" data-html="true" data-toggle="tooltip" title="<?php echo $sk['SkinHairType']['tooltip']; ?>"></a>
		</div>
	</div>
	<?php } ?>
	<ul class="pager">
		<li><a href="/filter1">Anterior</a></li>
	</ul>
	<input type="hidden" id="skin_hair_type" name="skin_hair_type" value="">
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle=tooltip]").tooltip({placement: 'right'});
	});
	function setSkinHairType(id) {
		$('#skin_hair_type').val(id);
		$("#frmFilter2").attr('action', '/users/editSkinHairType')
			.submit();
	}
</script>
<style type='text/css'>
	div.tooltip-inner {
	    text-align: left;
	    -webkit-border-radius: 0px;
	    -moz-border-radius: 0px;
	    border-radius: 0px;
	    margin-bottom: 6px;
	    background-color: #505050;
	    font-size: 12px;
	    width: 500px;
	}
</style>