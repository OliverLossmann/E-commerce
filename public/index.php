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
	<a href="register.php">Register here</a>
	<a href="login.php">Login here</a>
	<input type="button" name="return" onclick="location.href='mypage.php'" value="Go to profile">
	<input type="button" name="return" onclick="location.href='admin/index.php'" value="Admin">
                <li><a href="logout.php">Logout</a></li>
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
                                    <a href="../viewprod.php?id=<?php echo $post['id'];?>"><h1><?php echo $post['title'];?></h1></a>
                                </div>
                                <div class="post-img">
                                    <a href="../viewprod.php?id=<?php echo $post['id']?>"><img src="<?php echo $post['img_url']?>"></img></a>
                                </div>
                            </td>
                            
                                <div class="post-hidden">
                                    <a href="viewproduser.php?id=<?php echo $post['id'];?>">View</a>
                                    <a href="">Add To Cart</a>
                                </div>
                            </td><?php }?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<div class="footer">
            
        </div>
</body>
</html>