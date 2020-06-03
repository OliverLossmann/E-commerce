<?php  
	include ('../../src/dbconnect.php');
	include ('../../src/config.php');
	include ('functions/main.php');

		if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    
} else {
	header("Location:../redirect.php");
}
	$check = new Main;
	
	
?>
<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="../css/style.css"/>
	
</head>

<body>
	
		
		<?php if($check_login === false){?>
		<div class="content">
			
				
			<div class="intro">
				
			
			</div>
			<?php 
				include('login.php');
			}else{
				header('Location: view_all_posts.php');
			}
			?>
		<div class="footer">
		
		</div>
	</div>
</body>
</html>