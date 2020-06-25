<?php
include_once('../../src/dbconnect.php');
include ('../../src/config.php');
include_once('functions/post.php'); 


if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    
} else {
	header("Location:../redirect.php");
}
$post  = new Main;
$check = new Main;



if(isset($_GET['id'])){
	$pid = $_GET['id'];
	$post = $post->fetch_data($pid);
	?>
<html>
	<head>
		<title>Users</title>
		<link rel="stylesheet" href="css/style.css">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	</head>


	<body>
		<div class="wp">
		<div class="menu">
			<ul>
			<input type="button" name="register" onclick="location.href='index.php'" value="Home">
			</ul>
		</div>
		<div class="content">
			<div class="left-side">
				<div class="post">
				<div class="post-head">
					
					<div class="card">
  <h5 class="card-header">User Information</h5>
  <div class="card-body">

	<b>First Name:</b> <?php echo $post['first_name'];?><br>
    <b>Last Name:</b> <?php echo $post['last_name'];?><br>
	<b>Email:</b> <?php echo $post['email'];?><br>
	<b>Phone:</b> <?php echo $post['phone'];?><br>
	<b>Street:</b> <?php echo $post['street'];?><br>
	<b>Postal Code:</b> <?php echo $post['postal_code'];?><br>
	<b>City:</b> <?php echo $post['city'];?><br>
	<b>Country:</b> <?php echo $post['country'];?><br>
    <a href="edit.php" class="btn btn-primary">Edit</a><a href="view_all_users.php" class="btn btn-primary">Back</a>
  </div>
</div>
					
				</div>
				
				<div class="post-body">
				
				
				</div>
			</div>
				
			</div>
			<div class="right-side">
			
			</div>
			</div>
			</div>
		</div>
		<div class="footer">
		
		</div>
	</body>
</html>

	<?php
}else{
	header('Location:index.php');
}

?>