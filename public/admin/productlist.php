<?php
    session_start();
    include_once('../../src/dbconnect.php');
    include_once('functions/main.php');
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
                <li><a href="index.php">Home</a></li>
                <li><a href="creatprod.php">Create New Product</a></li>
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
                                    <a href="../viewprod.php?id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a>
                                </div>
                                <div class="post-img">
                                    <a href="../viewprod.php?id=<?php echo $post['id']?>"><img src="<?php echo $post['img_url']?>"></img></a>
                                </div>
                            </td>
                            
                                <div class="post-hidden">
                                    <a href="editprod.php?post_id=<?php echo $post['id'];?>">Edit</a>|<a href="viewprod.php?id=<?php echo $post['id'];?>">View</a>|<a href="#" class="post_delete" name="<?php echo $post['id']; ?>" onClick="deletepost(<?php echo $post['id']; ?>)">Delete</a>|
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
<div class="footer">
            
        </div>
</body>
</html>