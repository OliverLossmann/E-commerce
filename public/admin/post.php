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
			<?php if($check_login === false){
			echo	'<li><a href="index.php">Home</a></li>
					 <li><a href="admin/adminpanel.php">Log in</a></li>';
			}else{
			 echo	'<li><a href="index.php">Home</a></li>
					<li><a href="add_new_post.php">Create New User</a></li>
					<li><a href="admin/view_all_posts.php">View All Users</a></li>
					<li><a href="admin/Logout.php">Logout</a></li>';
			}
			?>
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