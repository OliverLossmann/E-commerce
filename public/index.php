<?php
require '../src/config.php';
require '../src/dbconnect.php';
require('admin/functions/main.php');

$post  = new Order;
$check = new Order;  
$posts = $post->get_all_products();
$check_login = $check->logged_in();

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
			<h1>Shop page</h1>
			<input type="button" name="register" onclick="location.href='register.php'" value="Register">
			<input type="button" name="login" onclick="location.href='login.php'" value="Login">
			<input type="button" name="mypage" onclick="location.href='mypage.php'" value="Go to profile">
			<input type="button" name="admin" onclick="location.href='admin/index.php'" value="Admin">
			<input type="button" name="logout" onclick="location.href='logout.php'" value="Logout">
        </ul>
    </div>
<div id="content">
	<div class="posts-holder">
		<?php foreach($posts as $post){?>
			<table>
				<tbody>
					<tr class="tr-st">
						<div class="post-link">
							<a href="../viewprod.php?id=<?php echo $post['id'];?>"><h1><?php echo $post['title'];?></h1></a>
						</div>
						<div class="post-img">
							<a href="../viewprod.php?id=<?php echo $post['id']?>"><img src="<?php echo $post['img_url']?>"></img></a>
						</div>
						<div class="post-hidden">
							<input type="button" name="return" onclick="location.href='viewproduser.php?id=<?php echo $post['id'];?>'" value="View">
							<input type="button" name="return" onclick="location.href=''" value="Add To Cart">
                        </div>
                    <?php }?>
                    </tr>
                </tbody>
            </table>
    </div>
</div>

</body>
</html>