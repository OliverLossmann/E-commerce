<?php
include_once('../../src/dbconnect.php');
include_once('functions/post.php'); 
$post  = new Main;
$check = new Main;
$check_login = $check->logged_in();


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
					<h1><?php echo $post['first_name'];?></h1>
					<?php echo $post['last_name'];?>
					<?php echo $post['email'];?>
					<p><?php echo $post['country']?></p>
				</div>
				
				<div class="post-body">
				<?php echo $post['content'];?>
				
				</div>
			</div>
				
			</div>
			<div class="right-side">
			<input type="button" name="return" onclick="location.href='view_all_posts.php'" value="Back">
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