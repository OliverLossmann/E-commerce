<?php  
require('../src/config.php');
require ('../src/dbconnect.php');

if (!empty($_POST['cartId']) 						
	&& isset($_SESSION['cartItems'][$_POST['cartId']])
) {
	unset($_SESSION['cartItems'][$_POST['cartId']]);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
