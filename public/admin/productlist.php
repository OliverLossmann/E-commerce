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

                <input type="button" name="register" onclick="location.href='index.php'" value="Home">
                <input type="button" name="login" onclick="location.href='creatprod.php'" value="Create New Product">
                <input type="button" name="admin" onclick="location.href='logout.php'" value="Logout">

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
                                    <h1><a href="../viewprod.php?id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a></h1>
                                </div>
                                <div class="post-img">
                                    <a href="../viewprod.php?id=<?php echo $post['id']?>"><img src="<?php echo $post['img_url']?>"></img></a>
                                </div>
                            </td>
                            
                                <div class="post-hidden">
                                    <input type="button" name="admin" onclick="location.href='editprod.php?post_id=<?php echo $post['id'];?>'" value="Edit">
                                    <input type="button" name="return" onclick="location.href='viewprod.php?id=<?php echo $post['id'];?>'" value="View">
                                    <input class="post_delete" type="button" name="<?php echo $post['id']; ?>" onClick="deletepost(<?php echo $post['id']; ?>)" value="Delete">
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