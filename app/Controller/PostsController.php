<?php
class PostsController extends AppController
{
	public $uses = array('Post');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status', 'TinyMCE.TinyMCE', 'Product');

	public $layout = "admin";

	public $paginate = array(
		'conditions' => array(
			'Post.status' => 1
		),
		'limit' => 10,
		'order' => array(
			'Post.date' => 'DESC',
			'Post.id'   => 'DESC'
		)
	);

	public function index($type){
		if ($type == 'b') {
			$this->set('title_for_layout', 'Administrar Posts de Blog');
			$this->set('pageHeader', 'Blogs');
			$this->set('sectionTitle', 'Lista de Blogs');
		} elseif ($type == 'n') {
			$this->set('title_for_layout', 'Administrar Posts de Noticias');
			$this->set('pageHeader', 'Noticias');
			$this->set('sectionTitle', 'Lista de Noticias');
		}

		$posts = $this->Post->find('all', array(
			'conditions' => array(
				'Post.status' => 1,
				'Post.type' => $type,
			),
		));

		$this->set('posts', $posts);
		$this->set('type', $type);
	}

	public function add($type){
		$this->set('title_for_layout', 'Agregar Posts');
		$this->set('type', $type);

		if (!empty($this->data)) {
			$this->Post->create();
			if (empty($this->data['Post']['image']['name'])) {
				unset($this->request->data['Post']['image']);
			}
			if (!$this->Post->save($this->data)) {
				$this->Session->setFlash('No se pudo guardar el post :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se agreg&oacute; el nuevo post!', 'default', array('class'=>'alert alert-success'));

			if ($type == 'b') {
				return $this->redirect('/blogs/index/b');
			} else {
				return $this->redirect('/noticias/index/n');
			}
		}
	}

	public function edit($id, $type){
		$this->set('title_for_layout', 'Editar Posts');
		$this->set('type', $type);

		$post = $this->Post->findById($id);

		if ($post) {
			$this->set('post', $post);
		} else {
			$this->Session->setFlash('No existe post con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/posts/index/'.$type);
		}

		if (!empty($this->data)) {
			if (empty($this->data['Post']['image']['name'])) {
				unset($this->request->data['Post']['image']);
			}
			if (!$this->Post->save($this->request->data)) {
				$this->Session->setFlash('No se pudo guardar el post :S', 'default', array('class'=>'alert alert-danger'));

				return false;
			}

			$this->Session->setFlash('Se edito el post!', 'default', array('class'=>'alert alert-success'));

			if (lcfirst($this->data['Post']['type']) == 'b') {
				return $this->redirect('/blogs/index/b');
			} else {
				return $this->redirect('/noticias/index/n');
			}
		}
	}

	public function delete($id, $type){
		$this->autoRender = false;
		$post = $this->Post->find('first', array(
			'conditions' => array(
				'Post.id' => $id
			),
			'fields' => array(
				'Post.id',
				'Post.status'
			)
		));

		if ($post) {
			$post['Post']['status'] = 0;
			$this->Post->save($post);
			$this->Session->setFlash('Se desactiv&oacute; el Post con exito!', 'default', array('class'=>'alert alert-success'));

			return $this->redirect('/posts/index/'.$type);
		} else {
			$this->Session->setFlash('No existe Post con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/banners/index/'.$type);
		}
	}
}