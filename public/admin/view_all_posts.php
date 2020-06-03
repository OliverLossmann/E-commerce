<?php
	include_once('../../src/dbconnect.php');
	include_once('../../src/config.php');
	include_once('functions/main.php');

if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    
} else {
    header("Location:../redirect.php");
}
	$post  = new Main;
	$check = new Main;	
	$posts = $post->get_all_posts();

	
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="../css/style.css"/>
</head>

<body>
<div class="wp">
		
		<div class="menu">
			<ul>
				<input type="button" name="register" onclick="location.href='index.php'" value="Home">
				<input type="button" name="login" onclick="location.href='add_new_post.php'" value="Create New User">
 				<input type="button" name="admin" onclick="location.href='Logout.php'" value="Logout">
			</ul>
		</div>
        <div id="content">
			<div class="posts-holder">
			<?php foreach($posts as $post){?>
				<table>
					<tbody>
						<tr class="tr-st">
							
								<div class="check">
									
								</div>
							</td>
							
								<div class="post-link">
									<h3><a href="post.php?id=<?php echo $post['id'];?>"><?php echo $post['first_name'];?></a></h3>
								</div>
							</td>
							
								<div class="post-hidden">
									<input type="button" name="admin" onclick="location.href='edit.php?post_id=<?php echo $post['id'];?>'" value="Edit">
									<input type="button" name="admin" onclick="location.href='post.php?id=<?php echo $post['id'];?>'" value="View">
									<input class="post_delete" type="button" name="<?php echo $post['id']; ?>" onClick="deletepost(<?php echo $post['id']; ?>)" value="Delete">
								</div>
							</td><?php }?>
							<script type="text/javascript">
								function deletepost(x){
									var conf = confirm("Are you sure you want to delete this post?");
									if(conf == true){
									window.location = "delete.php?delete_id="+x;
									}
								}
							</script>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
<div class="footer">
			
		</div>
</body>
</html>


