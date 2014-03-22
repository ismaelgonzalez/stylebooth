<?php
class ProductsController extends AppController
{
	public $uses = array('Product', 'ProductsCategory', 'Store', 'Style', 'SkinHairType', 'BodyType',
		'ProductStyle', 'ProductsSkinHairType', 'ProductsBodyType', 'ProductSize'
	);

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Product.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Product.id' => 'DESC'
		)
	);

	public function getbyid($product_id){
		$this->autoRender = false;
		$product = $this->Product->findById($product_id);

		$div = "<div class='thumbnail col-md-1' style='margin-left:10px' id='prod_".$product['Product']['id']."'>
			<img src='/files/products/".$product['Product']['image']."' alt='".$product['Product']['name']."' width='75' class='img-thumbnail'>
			<p>".$product['Product']['name']."<a class='close' onclick='delProd(".$product['Product']['id'].")'>x</a></p>
		</div>";

		echo $div;
	}

	public function index(){
		$this->set('title_for_layout', 'Administrar Productos');
		$this->set('pageHeader', 'Productos');
		$this->set('sectionTitle', 'Lista de Productos');

		$products = $this->paginate('Product');

		$this->set('products', $products);
	}

	public function add(){
		$this->set('title_for_layout', 'Agregar Producto');
		$this->set('pageHeader', 'Productos');
		$this->set('sectionTitle', 'Agregar Productos');

		$stores             = $this->Store->find('list');
		$product_categories = $this->ProductsCategory->find('list');
		$styles             = $this->Style->find('list');
		$skin_hair_types    = $this->SkinHairType->find('list');
		$body_types         = $this->BodyType->find('list');

		$this->set('stores', $stores);
		$this->set('product_categories', $product_categories);
		$this->set('styles', $styles);
		$this->set('skin_hair_types', $skin_hair_types);
		$this->set('body_types', $body_types);

		if (!empty($this->data)) {
			echo '<pre>';
			print_r($this->data);
			//exit();
			$this->Product->create();
			if (empty($this->data['Product']['image']['name'])) {
				unset($this->request->data['Product']['image']);
			}

			if (!$this->Product->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Producto  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			if (!empty($this->request->data['ProductStyle']['style_id'])) {
				for($i=0; $i<sizeof($this->request->data['ProductStyle']['style_id']); $i++) {
					$this->ProductStyle->create();
					$this->ProductStyle->save(
						$this->ProductStyle->set(
							array(
								'style_id' => $this->data['ProductStyle']['style_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductsSkinHairType']['skin_hair_type_id'])) {
				for($i=0; $i<sizeof($this->request->data['ProductsSkinHairType']['skin_hair_type_id']); $i++) {
					$this->ProductsSkinHairType->create();
					$this->ProductsSkinHairType->save(
						$this->ProductsSkinHairType->set(
							array(
								'skin_hair_type_id' => $this->data['ProductsSkinHairType']['skin_hair_type_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductsBodyType']['body_type_id'])) {
				for($i=0; $i<sizeof($this->request->data['ProductsBodyType']['body_type_id']); $i++) {
					$this->ProductsBodyType->create();
					$this->ProductsBodyType->save(
						$this->ProductsBodyType->set(
							array(
								'body_type_id' => $this->data['ProductsBodyType']['body_type_id'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			if (!empty($this->request->data['ProductSize']['size'])) {
				for($i=0; $i<sizeof($this->request->data['ProductSize']['size']); $i++) {
					$this->ProductSize->create();
					$this->ProductSize->save(
						$this->ProductSize->set(
							array(
								'size' => $this->data['ProductSize']['size'][$i],
								'product_id' => $this->Product->id
							)
						)
					);
				}
			}

			$this->Session->setFlash('Se agreg&oacute; el Producto!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/products/index');
		}
	}

	public function edit($id){
		$this->set('title_for_layout', 'Editar Productos');
		$this->set('pageHeader', 'Productos');
		$this->set('sectionTitle', 'Editar Productos');


	}
}