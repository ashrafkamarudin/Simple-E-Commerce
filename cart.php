<?php

session_start();

require_once 'config.php';
require_once 'vendor/libs/database.php';
require_once 'vendor/libs/auth/authlogin.php';
require_once 'vendor/libs/functions.php';

$db = new Database();
$auth = new Login();

extract($_GET);
echo $user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '-1';
$ip_add = getenv("REMOTE_ADDR");

switch ($action) {
	case 'add':
		if (isset($_GET['id'])) {
			$redirect = "home";
			setFlash(array('Unknown error occured. Please try again.'), 'fail');

			$cartItems = array(
					'id' => $id . $user,
					'product_id' => $_GET['id'],
					'ip_add' => $ip_add,
					'user_id' => $user);

			$query = "SELECT count(*) AS count, quantity FROM cart WHERE product_id=:product_id AND user_id=:user_id AND ip_add=:ip_add";
			$args = array(':product_id' => $id, ':user_id' => $user, ':ip_add' => $ip_add);

			if ($auth->isUserLoggedIn()) {
				$query = "SELECT count(*) AS count, quantity FROM cart WHERE product_id=:product_id AND user_id=:user_id";
				$args = array(':product_id' => $id, ':user_id' => $user);
			}

			echo "<pre>";
			var_dump($cartItems);
			echo "</pre>";

			$q = $db->run($query, $args)->fetch();

			if ($q['count'] > 0) {
				if ($db->update(array('quantity' => ++$q['quantity']), $id.$user,'cart')) {
					setFlash(array('Product has been added to carts'), 'success');
				}
			} else {
				if ($db->create($cartItems, 'cart')) {
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

//redirect(URL . $redirect);