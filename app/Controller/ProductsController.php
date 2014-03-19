<?php
class ProductsController extends AppController
{
	public $uses = array('Product', 'ProductsCategory', 'Store', 'Style', 'SkinHairType', 'BodyType');

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

		$products = $this->Product->find('all', array(
			'conditions' => array(
				'Product.status' => 1,
			),
		));

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
			$this->Product->create();
			if (empty($this->data['Product']['image']['name'])) {
				unset($this->request->data['Product']['image']);
			}
			if (!$this->Product->saveAll($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el Producto  :S', 'default', array('class'=>'alert alert-danger'));

				return false;
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