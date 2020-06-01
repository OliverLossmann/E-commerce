<?php
include_once('../../src/config.php');
include_once('../../src/dbconnect.php');
include_once('functions/main.php'); 
$post = new Order;

	if(isset($_GET['post_id'])){
		$pid = $_GET['post_id'];
		$post = $post->fetch_data($pid);
		//if user update post
		if($_POST){
			$prodname = $_POST['title'];
			$udescription = $_POST['description'];
			$uprice = $_POST['price'];
			$img = $_POST['img_url'];
		 
		
							//update post with new data 					 	
							$query = $pdo->prepare('UPDATE `products` SET `title` = ?, `description` = ?, `price` = ?, `img_url` = ? , `id` = ?; ');
                            $query->bindValue(1, $prodname);	
							$query->bindValue(2, $udescription);	
							$query->bindValue(3, $uprice);	
							$query->bindValue(4, $img);
							$query->bindValue(5, $pid);
 							$query->execute();	
							header('Location: productlist.php');	


					 }
				 	}
				
						

		
	
		?>
	<html>
		<head>
			<title>Edit - Product</title>
			<link rel="stylesheet" href="../css/style.css">
				  	
		
		</head>


		<body>
			<div class="wp">
		<div class="menu">
		<form action="" method="post" enctype="multipart/form-data">
			
		</div>
		<div class="content">
			<div class="left-side">
			<!---- show error if isset -->
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
						
						
						
						<li><input class="submit" value="Edit products" type="submit"></input></li>
						
					</ul>
					</form>
				</div>
				
			</div>
		</div>
		<div class="footer">
			
		</div>
	</div>
		</body>
	</html>