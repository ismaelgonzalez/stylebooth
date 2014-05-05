<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'stylebooth', 'action' => 'index'));

/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

//Blogs
	Router::connect('/blogs/index/*', array('controller' => 'posts', 'action' => 'index'));
	Router::connect('/blogs/lista/*', array('controller' => 'posts', 'action' => 'blog_lista'));
//Noticias
	Router::connect('/noticias/index/*', array('controller' => 'posts', 'action' => 'index'));
	Router::connect('/noticias/lista/*', array('controller' => 'posts', 'action' => 'lista'));
	Router::connect('/noticias/post/*', array('controller' => 'posts', 'action' => 'noticia_detail'));
//admin
	Router::connect('/admin/*', array('controller' => 'stylebooth', 'action' => 'dashboard'));
	Router::connect(
		'/mi_booth/:user_id',
		array('controller' => 'stylebooth', 'action' => 'my_booth'),
		array(
			'pass' => array('user_id'),
			'user_id' => '[0-9]+'
		)
	);

	Router::connect(
		'/profile/:user_id',
		array('controller' => 'users', 'action' => 'profile'),
		array(
			'pass' => array('user_id'),
			'user_id' => '[0-9]+'
		)
	);

//FILTER URL's
	Router::connect('/filter1/*', array('controller' => 'stylebooth', 'action' => 'filter1'));
	Router::connect('/filter2/*', array('controller' => 'stylebooth', 'action' => 'filter2'));
	Router::connect('/filter3/*', array('controller' => 'stylebooth', 'action' => 'filter3'));
	Router::connect('/filter4/*', array('controller' => 'stylebooth', 'action' => 'filter4'));

//edit skin, hair & body types
	Router::connect('/editSkinHairType/*', array('controller' => 'user', 'action' => 'editSkinHairType'));
	Router::connect('/editBodyType/*', array('controller' => 'user', 'action' => 'editBodyType'));

//getcoupon
	Router::connect('/getcoupon/*', array('controller' => 'coupons', 'action' => 'register'));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
