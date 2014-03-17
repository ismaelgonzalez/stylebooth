<?php
class PostsController extends AppController
{
	public $uses = array('Post');

	public $components = array('Session');

	public $helpers = array('Paginator', 'Js', 'Status');

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

		$posts = $this->Post->findAllByType($type);

		$this->set('posts', $posts);
		$this->set('type', $type);

	}
}