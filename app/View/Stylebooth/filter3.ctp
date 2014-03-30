<form id="frmFilter3" method="post" role="form">
<br />
<h4>Selecciona la persona que mayor corresponda a tu tipo de cuerpo</h4>
<br />
<div class="row">
<?php foreach ($body_types as $b) { ?>
<div class="col-md-3">
	<div>
		<a class="thumbnail" href="#" onclick="setBodyType(<?php echo $b['BodyType']['id']; ?>)"><img src="/files/body_types/<?php if ($b['BodyType']['image']) { echo $b['BodyType']['image']; } else { echo 'imagecara.jpg'; } ?>" alt="<?php echo $b['BodyType']['name']; ?>"></a>
	</div>
</div>
<?php } ?>
</div>
<div class="row">
	<ul class="pager">
		<li><a href="/filter2">Anterior</a></li>
	</ul>
</div>
</form>
<script type="text/javascript">
	function setBodyType(id) {
		var action = "/filter4/" + id;
		$("#frmFilter3").attr('action', action)
			.submit();
	}
</script>