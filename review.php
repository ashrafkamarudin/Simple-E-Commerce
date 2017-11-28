<?php

session_start();

require_once 'config.php';
require_once 'vendor/libs/database.php';
require_once 'vendor/libs/functions.php';

$db = new Database();

echo "<pre>";
var_dump($_POST);
echo "</pre>";

extract($_POST);

if (isset($_POST['submit'])) {
	$db->create(array(
		'id' => $user_id . $product_id,
		'user_id' => $user_id,
		'product_id' => $product_id,
		'review' => $review), 'product_reviews');
}

redirect(URL . '/product/index.php?id=' . $product_id); // redirect to authenticate page