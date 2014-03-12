<ul>
	<li>mostrar products_categories</li>
	<li>on change escoger producto de esa categoria</li>
	<li>al guardar, guardar record en outfit_products</li>
</ul>
<?php
echo $this->Form->Create('Outfit',
	array(
		'type' => 'file',
		'class' => 'form-horizontal',
		'role' => 'form',
		'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'form-group'),
			'class' => array('form-control'),
			'label' => array('class' => 'col-lg-3 control-label'),
			'between' => '<div class="col-lg-3">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'alert alert-danger')),
		)
	)
);
echo $this->Form->input('name', array(
	'label' => array('text' => 'Nombre', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control'
));
echo $this->Form->input('image', array(
	'label' => array('text' => 'Imagen', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control',
	'type' => 'file',
	'between' => '<div class="col-lg-4">',
));

echo "<hr>";
echo "<h4>Productos para el Outfit</h4>";
echo $this->Form->input('product_category_id', array(
	'label' => array('text' => 'Categoría', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control col-lg-3',
	'options' => $products_categories,
	'empty' => array('' => '-- Elige una Categoría --'),
));
echo $this->Form->input('product_id', array(
	'label' => array('text' => 'Producto', 'class' => 'control-label my-label col-lg-2'),
	'class' => 'form-control col-lg-3',
	'empty' => array('' => '-- Elige un Producto --'),
));
echo $this->Form->button("Agregar Producto", array(
	'class' => 'btn btn-info',
	'type' => 'button'
));

echo "<div class='form-group col-lg-5'>";
echo $this->Form->submit('Enviar', array('formnovalidate' => true, 'class' => 'btn btn-success pull-right'));
echo "</div>";
echo $this->Form->end();
?>
<div class="form-group hidden">
	<label for="OutfitProduct" class="control-label my-label col-lg-2">Producto</label>
	<div class="col-lg-3">
		<select name="data[Outfit][product_id]" class="form-control col-lg-3" id="OutfitProduct">
			<option value="">-- Elige un Producto --</option>
		</select>
	</div>
</div>