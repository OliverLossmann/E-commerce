<?php
	include_once('../../src/dbconnect.php');
	include_once('../../src/config.php');
	include_once('functions/post.php');
	$post  = new Main;
	$check = new Main;	
  $posts = $post->get_all_posts();

  $postproduct  = new Order;
  $checkproduct = new Order;  
  $postsproduct = $postproduct->get_all_products();
  

?>
<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">		
	</head>


	<body>
	<nav class="navbar navbar-expand-md">
  <a class="navbar-brand" href="#">Logga</a>
  <?php
	if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    echo "<a class='navbar-brand'><a style='color:white;'>Welcome to the admin's area, " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . "!";
} else {
	header("Location:../redirect.php");
}
?>

  <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="main-navigation">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_new_user.php">Create New User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_all_users.php">View All Users</a>
	  </li>
	  <li class="nav-item">
        <a class="nav-link" href="productlist.php">Product List</a>
	  </li>
	  <li class="nav-item">
        <a class="nav-link" href="../index.php">User Index</a>
	  </li>
	  <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>

			

		
		<header class="page-header header container-fluid">
		<div class="overlay"><div class="description">
  <h1>Welcome to the Admin Page!</h1>
  <p>Scroll down to see users on the left and products on the right! They also have their own individual pages on the top right navbar.</p>
  <button class="btn btn-outline-secondary btn-lg">Tell Me More!</button></div> </div>
</header>
			
<div class="row">
  <div class="column" style="background-color:#aaa;">
    <h2>Users</h2>
    <?php foreach($posts as $post){?>
				
									<h3><a href="post.php?id=<?php echo $post['id'];?>"><?php echo $post['first_name'];?></a></h3>
							
							
							
									<input type="button" name="admin" onclick="location.href='edit.php?post_id=<?php echo $post['id'];?>'" value="Edit">
									<input type="button" name="admin" onclick="location.href='post.php?id=<?php echo $post['id'];?>'" value="View">
									<input class="post_delete" type="button" name="<?php echo $post['id']; ?>" onClick="deletepost(<?php echo $post['id']; ?>)" value="Delete">
					
						<?php }?>
							<script type="text/javascript">
								function deletepost(x){
									var conf = confirm("Are you sure you want to delete this user?");
									if(conf == true){
									window.location = "delete.php?delete_id="+x;
									}
								}
							</script>
  </div>
  <div class="column" style="background-color:#bbb;">
    <h2>Products</h2>
      <?php foreach($postsproduct as $postproduct){?>
                <table>
                    <tbody>
                        <tr class="tr-st">
                            
                                <div class="check">
                                    
                                </div>
                            </td>
                            
                                <div class="post-link">
                                    <h1><a href="../viewprod.php?id=<?php echo $postproduct['id'];?>"><?php echo $postproduct['title'];?></a></h1>
                                </div>
                                <div class="post-img">
                                <a><img class="img-fluid" src="<?php echo $postproduct['img_url']?>"></a>
<div class="col-lg-4 col-md-4 col-sm-12">
                                    <a href="../viewprod.php?id=<?php echo $postproduct['id']?>"><img src="<?php echo $postproduct['img_url']?>"></img></a>
                                </div>
                            </td>
                            
                                <div class="post-hidden">
                                    <input type="button" name="admin" onclick="location.href='editprod.php?post_id=<?php echo $postproduct['id'];?>'" value="Edit">
                                    <input type="button" name="return" onclick="location.href='viewprod.php?id=<?php echo $postproduct['id'];?>'" value="View">
                                    <input class="post_delete" type="button" name="<?php echo $postproduct['id']; ?>" onClick="deletepost(<?php echo $postproduct['id']; ?>)" value="Delete">
                                </div>
                            </td><?php }?>
                            <script type="text/javascript">
                                function deletepost(x){
                                    var conf = confirm("Are you sure you want to delete this post?");
                                    if(conf == true){
                                    window.location = "deleteprod.php?delete_id="+x;
                                    }
                                }
                            </script>
  </div>
</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="main.js"></script>
	</body>
	
</html>
