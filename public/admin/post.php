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
					<h1>User Info</h1>
					<?php echo $post['first_name'];?> <br>
					<?php echo $post['last_name'];?><br>
					<?php echo $post['email'];?><br>
					<?php echo $post['phone'];?><br>
					<?php echo $post['street'];?><br>
					<?php echo $post['postal_code'];?><br>
					<?php echo $post['city'];?><br>
					<?php echo $post['country'];?><br>
				</div>
				
				<div class="post-body">
				
				
				</div>
			</div>
				
			</div>
			<div class="right-side">
			<input type="button" name="return" onclick="location.href='view_all_users.php'" value="Back">
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