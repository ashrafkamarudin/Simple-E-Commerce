<?php

session_start();

require_once 'config.php';
require_once 'vendor/libs/database.php';
require_once 'vendor/libs/functions.php';

$db = new Database();

extract($_GET);
$user = $_SESSION['user_id'];

switch ($action) {
	case 'add':
		if (isset($_GET['id'])) {
			$redirect = "home";
			setFlash(array('Unknown error occured. Please try again.'), 'fail');

			$query = "SELECT count(*) AS count, quantity FROM cart WHERE product_id=:product_id AND user_id=:user_id";
			$args = array(':product_id' => $id, ':user_id' => $user);
			$q = $db->run($query, $args)->fetch();

			if ($q['count'] > 0) {
				if ($db->update(array('quantity' => ++$q['quantity']), $id.$user,'cart')) {
					setFlash(array('Product has been added to carts'), 'success');
				}
			} else {
				if ($db->create(array(
					'id' => $id . $user,
					'product_id' => $_GET['id'],
					'user_id' => $_SESSION['user_id']), 'cart')) {
					setFlash(array('Product has been added to cart'), 'success');
				}
			}
		}
		break;

	case 'update':
		$redirect = "cart";
		if ($db->update(array('quantity' => $_POST['quantity']), $id.$user,'cart')) {
			setFlash(array('Product has been updated'), 'success');
		}
		break;

	case 'delete':
		if (isset($_GET['id'])) {
			$redirect = "cart";
			setFlash(array('Unknown error occured. Please try again.'), 'fail');

			if ($db->delete($id . $user, 'cart')) {
				setFlash(array('1 item has been removed from cart'), 'success');
			}
		}
		break;
	
	default:
		# code...
		break;
}

/*
echo "<pre>";
var_dump($_GET);
var_dump($_POST);
echo "</pre>";
*/

//echo URL . $redirect;

redirect(URL . $redirect);