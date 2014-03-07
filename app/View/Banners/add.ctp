<?php
$type = array(
	'U' => 'Arriba',
	'D' => 'Abajo',
	'L' => 'Izquierda',
	'R' => 'Derecha',
	'W' => 'Wallpaper'
);

echo $this->Form->Create('Banner',
	array(
		'type' => 'file',
		'class' => 'form-horizontal',
		'role' => 'form',
		'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'form-group'),
			'class' => array('form-control'),
			'label' => array('class' => 'col-lg-2 control-label'),
			'between' => '<div class="col-lg-2">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
		)
	)
);
echo $this->Form->input('type', array(
		'label' => array('text' => 'Posición', 'class' => 'control-label my-label col-lg-2'),
		'options' => array($type),
		'empty' => array('' => '-- Elige una posición --'),
		'class' => 'form-control'
));
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));//application/x-shockwave-flash
echo $this->Form->input('link', array(
	'label' => array('text' => 'Link', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control'
));
echo $this->Form->input('banner_date', array(
	'type' => 'text',
	'label' => array('text' => 'Fecha de Publicaci&oacute;n', 'class' => 'control-label my-label col-lg-2'),
));

echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success pull-right'));
echo "</div>";
echo $this->Form->end();
?>
<script type="text/javascript">
	$(function () {
		$('#BannerBannerDate').datepicker({dateFormat:'dd-mm-yy'});
	});
</script>