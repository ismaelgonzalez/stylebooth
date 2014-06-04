<h2>Contáctanos</h2>
<p style="text-align: justify">
	Mandanos tus sugerencias, dudas, comentarios o quejas.
</p>
<?php
echo $this->Form->Create('Stylebooth',
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
echo $this->Form->input('nombre', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
));
echo $this->Form->input('email', array(
	'label' => array('text' => 'Email', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
));
echo $this->Form->input('comentarios', array(
	'label' => array('text' => 'Comentarios', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'textarea',
	'between' => '<div class="col-lg-8">',
));
echo $this->Form->submit('Enviar', array(
	'formnovalidate' => true,
	'class' => 'btn btn-warning pull-left',
));
echo $this->Form->end();
?>