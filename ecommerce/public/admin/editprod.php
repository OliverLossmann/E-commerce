<?php
include_once('../../src/dbconnect.php');
include ('../../src/config.php');
include_once('functions/main.php'); 

if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    
} else {
	header("Location:../redirect.php");
}
$post = new Order;

	if(isset($_GET['post_id'])){
		$pid = $_GET['post_id'];
		$post = $post->fetch_product($pid);
		//if user update post
		if($_POST){
			$utitle = $_POST['title'];
			$udescription = $_POST['description'];
			$uprice = $_POST['price'];
			$img = $_POST['img_url'];


        if(empty($utitle) && empty($udescription) && empty($uprice) && empty($img)){
            $errors = '<div class="error2"><p> All fields are required to post. Please try again</p></div>';
        }
          else if (empty($utitle)) {
        $errors = '<div class="error2"><p> A Title is required. Please try again</p></div>';
        } else if (empty($udescription)) {
        $errors = '<div class="error2"><p> A Description is required. Please try again</p></div>';
        } else if (empty($uprice)) {
            $errors = '<div class="error2"><p> An Author is required. Please try again</p></div>';
        } else if (empty($img)) {
        $errors = '<div class="error2"><p> Content is required. Please try again</p></div>';
        }
        else{
							//update post with new data 					 	
							$query = $pdo->prepare('UPDATE `products` SET `title` = ?, `description` = ?, `price` = ?, `img_url` = ? WHERE `id` = ?; ');
                            $query->bindValue(1, $utitle);	
							$query->bindValue(2, $udescription);	
							$query->bindValue(3, $uprice);	
							$query->bindValue(4, $img);
	                        $query->bindValue(5, $pid);
                            $query->execute(); 
                            header('Location: productlist.php'); 


					 }
				 	}
				 }
						

		



		
	
		?>
	<html>
		<head>
			<title>Edit - User</title>
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
					<li><h3>Title</h3><textarea rows="1" name="title"></textarea></li>
						<li><h3>Description</h3><textarea rows="1" name="description"></textarea></li>
						<li><h3>Price</h3><textarea rows="1" name="price"></textarea></li>
						<li><h3>Img</h3><textarea rows="1" name="img_url"></textarea></li>

						
						<li><input class="submit" value="Edit Product" type="submit"></input></li>
						
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