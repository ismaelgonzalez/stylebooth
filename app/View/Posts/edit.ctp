<?php
$this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas', 'theme_advanced_toolbar_location' => 'top', 'theme_advanced_buttons3' => ''));

echo $this->Form->Create('Post',
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
	'default' => $post['Post']['id'],
));
echo $this->Form->input('title', array(
	'label' => array('text' => 'Titulo', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => $post['Post']['title'],
));
echo $this->Form->input('blurb', array(
	'label' => array('text' => 'Descripción', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
	'default' => $post['Post']['blurb'],
));
echo $this->Form->input('post', array(
	'label' => array('text' => 'Texto', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
	'rows' => '20',
	'default' => $post['Post']['post'],
));
if ($post['Post']['image']){
	echo "<div class='row'><div class='col-lg-2'></div><div class='col-lg-10'>";
	$this->Product->post_thumbnail($post, 250);
	echo "</div></div>";
}
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));
echo $this->Form->input('post_date', array(
	'type' => 'text',
	'label' => array('text' => 'Fecha de Publicaci&oacute;n', 'class' => 'control-label my-label col-lg-2'),
	'default' => $post['Post']['post_date'],
));
echo $this->Form->input('type', array(
	'label' => array('text' => 'Tipo de Publicación', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array(
		'N' => 'Noticia',
		'B' => 'Blog'
	),
	'default' => $post['Post']['type'],
));

echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success'));
echo "</div>";
echo $this->Form->end();
?>
<script type="text/javascript">
	$(function () {
		$('#PostPostDate').datepicker({dateFormat:'dd-mm-yy'});
	});
</script>