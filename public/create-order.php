<?php
require '../src/config.php';
require '../src/dbconnect.php';

if (isset ($_POST['createOrderBtn'])) {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $street = trim($_POST['street']);
    $city = trim($_POST['city']);
    $country = trim($_POST['country']);
    $postalCode = trim($_POST['postalCode']);
    $totalPrice = trim($_POST['totalPrice']);

 try {
     $query = "
     SELECT * FROM users
     WHERE email = :email
     ";

     $stmt = $dbconnect->prepare($query);
     $stmt->bindValue(':email', $email);
     $stmt->execute();
     $user = $stmt->fetch();

 } catch(\PDOexeption $e) {
     throw new \PDOexeption($e->getMessage(),(int) $e->getCode());
 }

 if ($user) {
    $userID = $user['id'];
 } else {
    try {
        $query = "
    INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country)
    VALUES (:firstName, :lastName, :email, :password, :phone, :street, :postalCode, :city, :country);
    ";

    $stmt = $dbconnect->prepare($query);
    $stmt->bindValue(':firstName', $firstName);
    $stmt->bindValue(':lastName', $lastName);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':street', $street);
    $stmt->bindValue(':postalCode', $postalCode);
    $stmt->bindValue(':city', $city);
    $stmt->bindValue(':country', $country);
    $stmt->execute();
    $userID = $dbconnect->lastInsertID();
    
 } catch(\PDOexeption $e) {
     throw new \PDOexeption($e->getMessage(),(int) $e->getCode());
 }
}
}

try {
    $query = "
    INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
    VALUES (:userID, :totalPrice, :fullName, :street, :postalCode, :city, :country);
    ";

$stmt = $dbconnect->prepare($query);
$stmt->bindValue(':userID', $userID);
$stmt->bindValue(':totalPrice', $totalPrice);
$stmt->bindValue(':fullName', "{$firstName} {$lastName}");
$stmt->bindValue(':street', $street);
$stmt->bindValue(':postalCode', $postalCode);
$stmt->bindValue(':city', $city);
$stmt->bindValue(':country', $country);
$stmt->execute();
$orderID = $dbconnect->lastInsertID();
} catch(\PDOexeption $e) {
 throw new \PDOexeption($e->getMessage(),(int) $e->getCode());
}


foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {

try {
    $query = "
    INSERT INTO order_items (order_id, product_id, quantity, unit_price, product_title)
    VALUES (:orderID, :productID, :quantity, :price, :title);
    ";

$stmt = $dbconnect->prepare($query);
$stmt->bindValue(':orderID', $orderID);
$stmt->bindValue(':productID', $cartItem['id']);
$stmt->bindValue(':quantity', $cartItem['quantity']);
$stmt->bindValue(':price', $cartItem['price']);
$stmt->bindValue(':title', $cartItem['title']);
$stmt->execute();
} catch(\PDOexeption $e) {
 throw new \PDOexeption($e->getMessage(),(int) $e->getCode());
}
}

header('Location: order-confirmation.php');
exit;

header('Location: checkout.php');
exit;