<?php
require ('../src/config.php');
require ('../src/dbconnect.php');
require('admin/functions/main.php');

$post  = new Order;
$check = new Order;  
$posts = $post->get_all_products();
$cartTotalSum = 0;
foreach ($_SESSION['cartItems'] as $cartId => $cartItem) {
  $cartTotalSum += $cartItem['price'] * $cartItem['quantity'];
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<nav class="navbar navbar-expand-md">
  <a class="navbar-brand" href="index.php">Home</a>
 <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
   <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="main-navigation">
    <ul class="navbar-nav">
      <?php include('cart.php') ?>
      <li class="nav-item">
      <a class="nav-link" type="button" name="products" href='products.php'>Products</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" type="button" name="register" href='register.php'>Register</a>
      </li>
  
<?php if (empty($_SESSION['id'])) {
  echo "<li class='nav-item'>
      <a class='nav-link' type='button' name='login' href='login.php'>Login</a>
    </li>";
} elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    
}?>
      
      <li class="nav-item">
      <a class="nav-link" type="button" name="mypage" href='mypage.php'>Go to profile</a>
    </li>
    <li class="nav-item">
            <a class="nav-link" type="button" name="logout" href='logout.php'>Logout</a>
        </li>
    <li class='nav-item'> 
      <a class='nav-link' type='button' name='admin'href='admin/index.php'>Admin</a>
    </li>
        </ul>
    </div>
</nav>

<header>
  <div class="jumbotron">
  <h1>Checkout</h1>
  </div>
</header>
<table class="table table-borderless">
  <thead>
    <tr>
      <th style="width: 10%">Product</th>
      <th style="width: 50%">Info</th>
      <th style="width: 10%">Quantity</th>
      <th style="width: 10%">Price per product</th>
      <th style="width: 10%"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($_SESSION['cartItems'] as $cartId => $cartItem) { ?>
      <tr>
        <td><img class="img-fluid" src="<?php echo $cartItem['img_url']?>" width="100"></td>
        <td><?=$cartItem['description']?></td>
        <td>
          <form class="update-cart-form" action="update-cart-item.php" method="POST">
            <input type="hidden" name="cartId" value="<?=$cartId?>">
          <input data-id="<?=$cartId?>" type="number" name="quantity" value="<?=$cartItem['quantity']?>" min="0">
        </form>
          </td>
        <td><?=$cartItem['price']?></td>
        <td>
          <form action="delete-cart-item.php" method="POST">
            <input type="hidden" name="cartId" value="<?=$cartId?>">
          <button type="submit" class="btn" style="background-color: transparent;"><svg class="bi bi-trash" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
          </svg>
          </button>
          </form>
        </td>
      </tr>
    <?php } ?>
    <tr class="border-top">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <p>Total: <span class="text-info"><?=$cartTotalSum?> kr</span></p>
        </td>
      </tr>
  </tbody>
</table>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>


<script type="text/javascript">
  $('.update-cart-form input[name="quantity"]').on('change', function() {
    $(this).parent().submit();
  });
</script>
</body>
</html>