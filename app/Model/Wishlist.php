<?php
class Wishlist extends AppModel {
	public $name = 'Wishlist';
	public $useTable = 'wishlists';

	public $belongsTo = array('User', 'Product');
}