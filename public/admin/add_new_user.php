<?php 
	include ('../../src/dbconnect.php');
	include ('../../src/config.php');
	include ('functions/main.php');

	if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    
} else {
	header("Location:../redirect.php");
}
	 
	//check if user Publish a post
 	if($_POST){
		$ufirstname = $_POST['first_name'];
		$ulastname = $_POST['last_name'];
		$uemail = $_POST['email'];
		$upassword = $_POST['password'];
		$uphone = $_POST['phone'];
		$ustreet = $_POST['street'];
		$upostalcode = $_POST['postal_code'];
		$ucity = $_POST['city'];
		$ucountry = $_POST['country'];

							$query = $pdo->prepare("INSERT INTO `ebutik`.`users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone` , `street`, `postal_code`, `city`, `country`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
							$query->bindValue(1, $ufirstname);	
							$query->bindValue(2, $ulastname);	
							$query->bindValue(3, $uemail);	
							$query->bindValue(4, $upassword);
							$query->bindValue(5, $uphone);
							$query->bindValue(6, $ustreet);
							$query->bindValue(7, $upostalcode);
							$query->bindValue(8, $ucity);
							$query->bindValue(9, $ucountry);
 							$query->execute();	
							header('Location: view_all_users.php');	

					 }
				 	
				
						

		



		
	
	
?>


<html>
	<head>
		<title>Add new user - Admin</title>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery.js"></script>
	   <script src="ckeditor/ckeditor.js"></script>		
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
					    <li><h3>First Name</h3><textarea rows="1" name="first_name"></textarea></li>
						<li><h3>Last Name</h3><textarea rows="1" name="last_name"></textarea></li>
						<li><h3>Email</h3><textarea rows="1" name="email"></textarea></li>
						<li><h3>Password</h3><textarea rows="1" name="password"></textarea></li>
						<li><h3>Phone</h3><textarea rows="1" name="phone"></textarea></li>
						<li><h3>Street</h3><textarea rows="1" name="street"></textarea></li>
						<li><h3>Postal Code</h3><textarea rows="1" name="postal_code"></textarea></li>
						<li><h3>City</h3><textarea rows="1" name="city"></textarea></li>
						<li><h3>Country</h3><textarea rows="1" name="country"></textarea></li>
						
						<input class="submit" value="Create User" type="submit"></input>
						<input type="button" name="return" onclick="location.href='view_all_users.php'" value="Back">
					</ul>
					</form>
				</div>
				
			</div>
		</div></div>
		<div class="footer">
			
		</div>
	
	</body>
</html>
