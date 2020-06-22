<?php
require ('../src/config.php');
require ('../src/dbconnect.php');
require('admin/functions/main.php');

//echo "<pre>";
//print_r($_POST);
//echo "<pre>";


if (!empty($_POST['quantity'])) {
	$productId = (int) $_POST['productId'];
	$quantity = (int) $_POST['quantity'];

	try {
		$query = "
			SELECT * FROM products
			WHERE id = :id
		";

		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':id', $productId);
		$stmt->execute();
		$product = $stmt->fetch();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}

	if ($product) {
		$product = array_merge($product, ['quantity' => $quantity]);
		//echo "<pre>";
		//print_r($product);
		//echo "<pre>";

		$cartItem = [$productId => $product];

		//echo "<pre>";
		//print_r($cartItem);
		//echo "<pre>";


		if (empty($_SESSION['cartItems'])) {
			$_SESSION['cartItems'] = $cartItem;
		} else {
			if (isset($_SESSION['cartItems'][$productId])){
				$_SESSION['cartItems'][$productId]['quantity'] += $quantity;
			} else {
				$_SESSION['cartItems'] += $cartItem;
			}
		}	
	}
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;