<?php

session_start();

require_once '../config.php';
require_once '../vendor/libs/auth/authlogin.php';
require_once '../vendor/libs/database.php';
require_once '../vendor/libs/functions.php';

var_dump($_POST);

extract($_POST);
extract($_GET); // extract $_GET into var

$db = new database(); // initialize database object

if (isset($_POST['add'])) {

	switch ($data) {
		case 'product': // in case of product
			$redirect = 'products/add.php';

			if(!(strtoupper(substr($_FILES['product_img']['name'],-4))==".JPG" || strtoupper(substr($_FILES['product_img']['name'],-5))==".JPEG"|| strtoupper(substr($_FILES['product_img']['name'],-4))==".PNG")) {
				setFlash(array('Please upload image only'), 'fail');
				break;
			}
						
			if(file_exists("../assets/product_images/".$_FILES['product_img']['name'])) {
				setFlash(array('Image with the same name already uploaded'), 'fail');
				break;
			}

			if ($db->create(array(
				'name' => $product_name,
				'category' => $product_category,
				'price' => $product_price,
				'description' => $product_desc,
				'image' => $_FILES['product_img']['name']
				), 'products')) {
				# code...
				$redirect = 'products';

				// move uploaded image into folder(upload_images)
				if (move_uploaded_file($_FILES['product_img']['tmp_name'],"../assets/product_images/".$_FILES['product_img']['name'])) {

					setFlash(array('Product has been added'), 'success');
					break;
				}

				setFlash(array('Product has been added but image failed to be upload.'), 'success');
				break;
			}
			break;

		case 'category':
			$redirect = 'categories/add.php';

			if ($db->create(array(
				'name' => $category_name), 'categories')) {
				# code...
				setFlash(array('Category has been added'), 'success');
				$redirect = 'categories';
			}
			break;

		default:
			# code...
			break;
	}
}

if (isset($_POST['update'])) {

	switch ($data) {
		case 'product': // in case of product
			$redirect = 'products';
		    if ($db->update(array(
		    	'name' => $product_name,
		    	'category' => $product_category,
				'price' => $product_price,
				'description' => $product_desc,
				'image' => $_FILES['product_img']['name']
		    	), $id, 'products')) {

		    	// move uploaded image into folder(upload_images)
				if (move_uploaded_file($_FILES['product_img']['tmp_name'],"../assets/product_images/".$_FILES['product_img']['name'])) {

					$filepath = '../assets/product_images/' . $oldFilename;
					if (file_exists($filepath)) {
				    	unlink($filepath);
				    }

					setFlash(array('Product has been updated'), 'success');
					break;
				}
				setFlash(array('Product has been updated but image failed to be upload.'), 'success');
				break;
		    }
			break;

		case 'category':
			$redirect = 'categories/add.php';

			if ($db->update(array(
				'name' => $category_name), 'categories')) {
				# code...
				setFlash(array('Category has been updated'), 'success');
				$redirect = 'categories';
			}
			break;

		case 'user':
			$redirect = 'users';

			if ($db->update(array(
				'name' => $name,
				'email' => $email,
				'role' => $role
				), $id, 'users')) {
				
				setFlash(array('User has been updated'), 'success');
			}
			break;
		
		default:
			# code...
			break;
	}
}

if (isset($_GET['delete'])) {

	switch ($data) {
		case 'products':
			$redirect = 'products';

			if ($db->delete($delete, 'products')) {

				$filepath = '../assets/product_images/' . $oldFilename;
				echo $filepath;
				echo $oldFilename;
				if (file_exists($filepath)) {
					echo $oldFilename;
				    unlink($filepath);
				}

				setFlash(array('a product has been deleted'), 'success');
			}
			break;

		case 'category':
			$redirect = 'categories';

			if ($db->delete($delete, 'categories')) {

				setFlash(array('Category has been deleted'), 'success');
			}
			break;

		case 'user':
			$redirect = 'users';

			if ($db->delete($delete, 'users')) {

				setFlash(array('User has been deleted'), 'success');
			}
			break;
		
		default:
			# code...
			break;
	}
}

redirect(URL . 'admin/' . $redirect);