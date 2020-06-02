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


			<input type="button" name="register" onclick="location.href='index.php'" value="Home">
			<input type="button" name="login" onclick="location.href='add_new_post.php'" value="Create New User">
			<input type="button" name="mypage" onclick="location.href='view_all_posts.php'" value="View All Users">
			<input type="button" name="admin" onclick="location.href='Logout.php'" value="Logout">
			<input type="button" name="logout" onclick="location.href='productlist.php'" value="Product List">
			<input type="button" name="logout" onclick="location.href='../index.php'" value="User Index">
        </ul>

		</div>
		
			
		<div class="footer">
		</div>
	</body>
</html>