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
echo $this->Form->input('id', array(
	'default' => $banner['Banner']['id']
));
echo $this->Form->input('type', array(
	'label' => array('text' => 'Posición', 'class' => 'control-label my-label col-lg-2'),
	'options' => array($type),
	'empty' => array('' => '-- Elige una posición --'),
	'class' => 'form-control',
	'default' => $banner['Banner']['type']
));
?>
<div class="form-group">
	<label class="control-label my-label col-lg-2" style="padding-top: 0">Es Banner de Adsense?</label>
	<div class="col-lg-4">
		<label for="BannerIsAdsense1">Si</label>
		<input type="radio" name="data[Banner][is_adsense]" id="BannerIsAdsense1" value="1" <?php if ($banner['Banner']['is_adsense'] == 1) { echo 'checked="checked"'; } ?>>
		<label for="BannerIsAdsense0">No</label>
		<input type="radio" name="data[Banner][is_adsense]" id="BannerIsAdsense0" value="0" <?php if ($banner['Banner']['is_adsense'] == 0) { echo 'checked="checked"'; } ?>>
	</div>
</div>
<?php
if ($banner['Banner']['is_adsense'] == 1) {
	echo $this->Form->input('adsense', array(
		'label' => array('text' => 'Código Adsense', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'type' => 'textarea',
		'between' => '<div class="col-lg-4">',
		'before' => '<div class="form-group banner-adsense">',
		'default' => $banner['Banner']['adsense']
	));
	echo $this->Form->input('image', array(
		'label' => array('text' => 'Banner Nuevo', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'type' => 'file',
		'between' => '<div class="col-lg-4">',
		'before' => '<div class="form-group banner-image" style="display: none;">',
	));//application/x-shockwave-flash
	echo $this->Form->input('old_image', array(
		'type' => 'hidden',
		'default' => $banner['Banner']['image'],
		'before' => '<div class="form-group banner-image" style="display: none;">',
	));//application/x-shockwave-flash
}
if ($banner['Banner']['is_adsense'] == 0) {
	echo $this->Form->input('adsense', array(
		'label' => array('text' => 'Código Adsense', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'type' => 'textarea',
		'between' => '<div class="col-lg-4">',
		'before' => '<div class="form-group banner-adsense" style="display: none;">',
		'default' => $banner['Banner']['adsense']
	));
	echo $this->Form->input('image', array(
		'label' => array('text' => 'Banner Nuevo', 'class' => 'control-label my-label col-lg-2'),
		'class' => 'form-control',
		'type' => 'file',
		'between' => '<div class="col-lg-4">',
		'before' => '<div class="form-group banner-image">',
	));//application/x-shockwave-flash
	echo $this->Form->input('old_image', array(
		'type' => 'hidden',
		'default' => $banner['Banner']['image'],
		'before' => '<div class="form-group banner-image">',
	));//application/x-shockwave-flash
	?>
<div class="form-group">
	<div class="col-lg-6" style="text-align: right">
		Imagen actual: <?php echo $banner['Banner']['image']; ?>
	</div>
</div>
<?php
}
echo $this->Form->input('link', array(
	'label' => array('text' => 'Link', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'default' => $banner['Banner']['link']
));
echo $this->Form->input('banner_date', array(
	'type' => 'text',
	'label' => array('text' => 'Fecha de Publicaci&oacute;n', 'class' => 'control-label my-label col-lg-2'),
	'default' => date('d-m-Y', strtotime($banner['Banner']['banner_date']))
));

echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success pull-right'));
echo "</div>";
echo $this->Form->end();
?>
<script type="text/javascript">
	$(function () {
		$('#BannerBannerDate').datepicker({dateFormat:'dd-mm-yy'});

		$('#BannerIsAdsense1').click(function() {
			$('.banner-image').fadeOut('slow');
			$('.banner-adsense').fadeIn('slow');
		});

		$('#BannerIsAdsense0').click(function() {
			$('.banner-image').fadeIn('slow');
			$('.banner-adsense').fadeOut('slow');
		});
	});
</script>