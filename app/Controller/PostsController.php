<?php
class PostsController extends AppController
{
	public $uses = array('Post', 'PostComment');

	public $components = array('Session', 'Paginator');

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

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('lista', 'noticia_detail', 'blog_lista', 'blog_detail', 'addComment', 'delComment');
	}

	public function lista() {
		$this->layout = 'default';

		$this->Paginator->settings = array(
			'conditions' => array(
				'Post.status' => 1,
				'Post.type' => 'N',
				'Post.post_date <= ' => date('Y-m-d'),
			),
			'order' => array(
				'Post.post_date' => 'desc',
				'Post.id' => 'desc',
			),
			'limit' => 20,
		);

		$posts = $this->Paginator->paginate('Post');

		$top3 = $this->Post->find('all', array(
			'conditions' => array(
				'Post.status' => 1,
				'Post.type' => 'N',
			),
			'order' => array(
				'Post.num_views' => 'desc',
			),
			'limit' => 3,
		));

		$this->set('title_for_layout', 'Noticias');
		$this->set('posts', $posts);
		$this->set('top3', $top3);
	}

	public function noticia_detail($id){
		$this->layout = 'default';

		$noticia = $this->Post->findByIdAndTypeAndStatus($id, 'N', 1);

		if (empty($noticia)) {
			$this->Session->setFlash('No existe post con este ID :(', 'default', array('class'=>'alert alert-danger'));

			return $this->redirect('/');
		}

		//save num_vista + 1
		$post['Post'] = array(
			'id'        => $noticia['Post']['id'],
			'num_views' => $noticia['Post']['num_views'] + 1,
		);

		$this->Post->save($post);

		$this->set('title_for_layout', $noticia['Post']['title']);
		$this->set('noticia', $noticia);
	}

	public function blog_lista($id = null) {
		$this->layout = 'default';

		if (!empty($id)) {
			$post_id = array("Post.id" => $id);
		}

		$main = $this->Post->find('first', array(
			'conditions' => array(
				'Post.status' => 1,
				'Post.type' => 'B',
				'Post.post_date <= ' => date('Y-m-d'),
				$post_id,
			),
			'order' => array(
				'Post.post_date' => 'desc',
				'Post.id' => 'desc',
			),
		));

		$this->Paginator->settings = array(
			'conditions' => array(
				'Post.status' => 1,
				'Post.type' => 'B',
				'Post.post_date <= ' => date('Y-m-d'),
			),
			'order' => array(
				'Post.post_date' => 'desc',
			),
			'limit' => 10,
		);

		$posts = $this->Paginator->paginate('Post');

		$this->set('title_for_layout', 'Blogs');

		$this->set('posts', $posts);
		$this->set('main', $main);
	}

	public function addComment() {
		$this->autoRender = false;
		if (!empty($this->request->data)) {
			$this->PostComment->create();
			$postComment['PostComment'] = array(
				'user_id' => $this->request->data['user_id'],
				'post_id' => $this->request->data['post_id'],
				'comment' => $this->request->data['comment'],
			);

			$this->PostComment->save($postComment);

			$this->PostComment->recursive = -1;
			$comments = $this->PostComment->find('all', array(
				'conditions' => array(
					'PostComment.status' => 1,
					'PostComment.post_id' => $this->request->data['post_id']
				),
				'contain' => array(
					'User',
				),
				'order' => array(
					'PostComment.id' => 'desc',
				),
			));

			echo json_encode($comments);
		}
	}

	public function delComment($comment_id, $post_id) {
		$this->autoRender = false;

		$user = $this->Session->read('Auth.User');

		if (empty($user) || $user['role'] != 'admin') {
			return $this->redirect('/');
		}

		$this->PostComment->recursive = -1;
		$pc = $this->PostComment->findById($comment_id);

		$pc['PostComment']['status'] = 0;
		$this->PostComment->save($pc);

		$this->PostComment->recursive = -1;
		$comments = $this->PostComment->find('all', array(
			'conditions' => array(
				'PostComment.status' => 1,
				'PostComment.post_id' => $post_id,
			),
			'contain' => array(
				'User',
			),
			'order' => array(
				'PostComment.id' => 'desc',
			),
		));

		echo json_encode($comments);
	}
}