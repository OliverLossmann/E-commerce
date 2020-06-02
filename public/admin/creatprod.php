<?php 
	include ('../../src/dbconnect.php');
	include ('functions/main.php');
	if($check_login === false){
		header('Location: index.php');
	}
	else{
	 
	//check if products Publish a post
 	if($_POST){
		$prodname = $_POST['title'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$img = $_POST['img_url'];

							$query = $pdo->prepare("INSERT INTO `products` (`id`, `title`, `description`, `price`, `img_url`) VALUES (NULL, ?, ?, ?, ?)");
							$query->bindValue(1, $prodname);	
							$query->bindValue(2, $description);	
							$query->bindValue(3, $price);	
							$query->bindValue(4, $img);
 							$query->execute();	
							header('Location: productlist.php');	

					 }
				 	}
				
	
?>


<html>
	<head>
		<title>Add new Product - Admin</title>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery.js"></script>		
	</head>
<body>
		<div class="wp">
		
		<div class="menu">
			<ul>
			<input type="button" name="register" onclick="location.href='index.php'" value="Home">
		 
			</ul>
		</div>
		<form action="" method="post" enctype="multipart/form-data">
			<ul>
				
				
			</ul>
		</div>
		<div class="content">
				<!--show error if isset-->
				<?php if(isset($errors)){
						echo $errors;
					}?>
				
			</div>
			<div class="right-side">
				<div class="right-menu">
					<ul>
					    <li><h3>Product name</h3><textarea rows="1" name="title"></textarea></li>
						<li><h3>Description</h3><textarea rows="1" name="description"></textarea></li>
						<li><h3>Price</h3><textarea rows="1" name="price"></textarea></li>
						<li><h3>Images</h3><textarea rows="1" name="img_url"></textarea></li>
						
						
						<input class="submit" value="Create Products" type="submit">
						<input type="button" name="return" onclick="location.href='productlist.php'" value="Back">
					</ul>
					</form>
				</div>
				
			</div>
		</div></div>
		<div class="footer">
			
		</div>
	
	</body>
</html>