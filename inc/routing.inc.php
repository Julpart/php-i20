<?php
switch ($page) {
	case 'catalog':
		include 'inc/catalog.inc.php';
		break;
	case 'category':
		include 'inc/category.inc.php';
		break;
	case 'product':
		include 'inc/product.inc.php';
		break;
	default:
		include 'notfound.php';
}
