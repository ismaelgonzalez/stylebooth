<?php
class StatsController extends AppController {
	public $uses = array('User', 'UserStat', 'Coupon', 'Style', 'SkinHairType', 'BodyType', 'Product');

	public $components = array('Session', 'Paginator');

	public $helpers = array('Paginator', 'Js', 'Status', 'Product');

	public $layout = "admin";

	public $paginate = array(
		'limit' => 5,
		'order' => array(
			'UserStat.stat_date' => 'desc',
		),
	);

	public function index(){
		$this->set('title_for_layout', 'Estadísticas Generales');
		$this->set('pageHeader', 'Estadísticas Generales de Stylebooth');
		$this->set('sectionTitle', 'Estadísticas');


		$this->Paginator->settings = array(
			'order' => array(
				'UserStat.stat_date' => 'desc',
			),
			'limit' => 25,
		);

		$stats = $this->Paginator->paginate('UserStat');
		$this->set(compact('stats'));
	}
}