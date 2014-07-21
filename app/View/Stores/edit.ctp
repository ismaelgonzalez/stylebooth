<?php
echo $this->Form->Create('Store',
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
	'default' => $store['Store']['id'],
));
echo $this->Form->input('name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-4">',
	'default' => $store['Store']['name'],
));
echo $this->Form->input('url', array(
	'label' => array('text' => 'URL', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
	'default' => $store['Store']['url'],
));
echo $this->Form->input('google_maps', array(
	'label' => array('text' => 'Google Maps', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
	'rows' => '5',
	'default' => $store['Store']['google_maps'],
));
if ($store['Store']['image']){
	echo "<div class='row'><div class='col-lg-2'></div><div class='col-lg-10'>";
	$this->Product->store_thumbnail($store, 250);
	echo "</div></div>";
}
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));
echo $this->Form->input('zone', array(
	'label' => array('text' => 'Zona', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'options' => array(
		'N' => 'Norte',
		'S' => 'Sur',
		'P' => 'Poniente',
		'O' => 'Oriente',
	),
	'empty' => array('' => '-- Elige una zona --'),
	'default' => $store['Store']['zone'],
));
echo $this->Form->input('redes_sociales', array(
	'label' => array('text' => 'Redes Sociales', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'between' => '<div class="col-lg-6">',
	'default' => $store['Store']['redes_sociales'],
));
?>
<div class="panel panel-info">
	<div class="panel-heading">Dirección de Tienda</div>
	<div class="panel-body">
		<?php
		echo $this->Form->input('StoreAddress.id', array(
			'default' => $store['StoreAddress'][0]['id'],
			'type' => 'hidden',
		));
		echo $this->Form->input('StoreAddress.store_id', array(
			'default' => $store['StoreAddress'][0]['store_id'],
			'type' => 'hidden',
		));
		echo $this->Form->input('StoreAddress.address1', array(
			'label' => array('text' => 'Dirección', 'class' => 'control-label my-label col-lg-2'),
			'class' => 'form-control',
			'between' => '<div class="col-lg-6">',
			'default' => $store['StoreAddress'][0]['address1'],
		));
		echo $this->Form->input('StoreAddress.address2', array(
			'label' => array('text' => 'Colonia', 'class' => 'control-label my-label col-lg-2'),
			'class' => 'form-control',
			'between' => '<div class="col-lg-6">',
			'default' => $store['StoreAddress'][0]['address2'],
		));
		echo $this->Form->input('StoreAddress.city', array(
			'label' => array('text' => 'Ciudad', 'class' => 'control-label my-label col-lg-2'),
			'class' => 'form-control',
			'between' => '<div class="col-lg-6">',
			'default' => $store['StoreAddress'][0]['city'],
		));
		echo $this->Form->input('StoreAddress.state', array(
			'label' => array('text' => 'Estado', 'class' => 'control-label my-label col-lg-2'),
			'class' => 'form-control',
			'between' => '<div class="col-lg-6">',
			'default' => $store['StoreAddress'][0]['state'],
		));
		echo $this->Form->input('StoreAddress.country', array(
			'label' => array('text' => 'País', 'class' => 'control-label my-label col-lg-2'),
			'class' => 'form-control',
			'between' => '<div class="col-lg-6">',
			'default' => $store['StoreAddress'][0]['country'],
		));
		echo $this->Form->input('StoreAddress.zip', array(
			'label' => array('text' => 'Código Postal', 'class' => 'control-label my-label col-lg-2'),
			'class' => 'form-control',
			'between' => '<div class="col-lg-6">',
			'default' => $store['StoreAddress'][0]['zip'],
		));
		?>
	</div>
</div>
<?php
echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success'));
echo "</div>";
echo $this->Form->end();
?>