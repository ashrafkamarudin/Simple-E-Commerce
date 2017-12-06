<?php

session_start();

require_once 'config.php';
require_once 'vendor/libs/database.php';
require_once 'vendor/libs/functions.php';

$db = new Database();

echo "<pre>";
var_dump($_POST);
var_dump($_GET);
echo "</pre>";

extract($_POST);
extract($_GET);
$ip_add = getenv("REMOTE_ADDR");

$arg = array(':ip_add' => $ip_add, ':user_id' => $_SESSION['user_id']);
$products = $db->run('
	SELECT * FROM cart 
	INNER JOIN products ON products.id = cart.product_id 
	WHERE cart.ip_add =:ip_add AND cart.user_id=:user_id', $arg);

foreach ($products as $key => $product) {

	$data = array(
		'user_id' => $_SESSION['user_id'],
		'name' => $name,
		'contact' => $phone,
		'address' => $address,
		'city' => $city,
		'state' => $state,
		'zip' => $zip,
		'product_id' => $product['id'],
		'quantity' => $product['quantity']
		);
	$table = 'checkout';

	$db->create($data, $table);

	$db->delete('user_id='.$_SESSION['user_id'], 'cart');
}

redirect(URL . 'home');