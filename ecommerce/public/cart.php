<?php  
//unset($_SESSION['cartItems']);
if (!isset($_SESSION['cartItems'])) {
	$_SESSION['cartItems'] = [];
}


//echo "<pre>";
//print_r($_SESSION['cartItems']);
//echo "<pre>";


$cartItemCount = count($_SESSION['cartItems']);
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
	$cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}
?>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
  	
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  	

</head>


		<div class="row">
			<div class="col-lg-12 col-sm-12 col-12 main-section">
		<div class="dropdown">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-shopping-cart" aria-hidden="true" ></i> Cart <span class="badge badge-pill badge-danger"><?=$cartItemCount?></span>
			</button>
			<div class="dropdown-menu">
				<div class="row total-header-section">
					<div class="col-lg-6 col-sm-6 col-6">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge badge-pill badge-danger"><?=$cartItemCount?></span>
					</div>
					<div class="col-lg-6 col-sm-6 col-6 total-section text-right">
						<p>Total: <span class="text-info"><?=$cartTotalSum?> kr</span></p>
					</div>
				</div>

				<?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) { ?>
					<div class="row cart-detail">
						<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
							<img class="imgsize" src="<?=$cartItem['img_url']?>">
						</div>
						<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
							<p><?=$cartItem['title']?></p>
							<span class="price text-info"><?=$cartItem['price']?>kr</span> <span class="count">Quantity: <?=$cartItem['quantity']?></span>
						</div>
					</div>
				<?php } ?>

				<div class="row">
					<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
						<a href="checkout.php" class="btn btn-primary btn-block">Checkout</a>
					</div>
				</div>
			</div>
		</div>
</div>
</div>




