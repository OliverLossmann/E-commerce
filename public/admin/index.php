<?php
	include_once('../../src/dbconnect.php');
	include_once('functions/post.php');
	
	
?>
<html>
	<head>
		<title>Blog</title>
		<link rel="stylesheet" href="css/style.css">		
	</head>


	<body>
		<div class="wp">
		
		<div class="menu">
			<ul>
				<?php 
			
			 echo	'<li><a href="index.php">Home</a></li>
					<li><a href="add_new_post.php">Create New User</a></li>
					<li><a href="view_all_posts.php">View All Users</a></li>
					<li><a href="Logout.php">Logout</a></li>
					<li><a href="productlist.php">Productlist</a></li>';
			?>
		 
			</ul>
		</div>
		
			
		<div class="footer">
		</div>
	</body>
</html>