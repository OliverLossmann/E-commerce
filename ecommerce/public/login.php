<?php 
require_once('../src/dbconnect.php');
require_once('../src/config.php');


if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['email'])){ $errors[]="E-Mail field is Required"; }
    if(empty($_POST['password'])){ $errors[]="Password field is Required"; }

    if(empty($errors)){
        // Check the Login Credentials
        $sql = "SELECT * FROM users WHERE ";
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $sql .= "email=?";
        }
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if($count == 1){
            // Compare the password with password hash
            if(password_verify($_POST['password'], $res['password'])){
                // regenerate session id
                session_regenerate_id();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $res['id'];
                $_SESSION['email'] = $res['email'];
                $_SESSION['first_name'] = $res['first_name'];
                $_SESSION['last_name'] = $res['last_name'];
                $_SESSION['password'] = $res['password'];
                $_SESSION['postal_code'] = $res['postal_code'];
                $_SESSION['phone'] = $res['phone'];
                $_SESSION['country'] = $res['country'];
                $_SESSION['street'] = $res['street'];
                $_SESSION['city'] = $res['city'];
                $_SESSION['last_login'] = time();
                // redirect the user to members area/dashboard page
                header("Location:index.php");
            }else{
                $errors[] = "E-Mail & Password Combination not Working";
            }
        }else{
            $errors[] = "E-Mail not Valid";
        }
    }
} 



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<nav class="navbar navbar-expand-md">
    <a class="navbar-brand" href="index.php">Home</a>
 <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
     <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="main-navigation">
        <ul class="navbar-nav">
            <?php include('cart.php') ?>
            <li class="nav-item">
            <a class="nav-link" type="button" name="products" href='products.php'>Products</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" type="button" name="register" href='register.php'>Register</a>
            </li>
    
<?php if (empty($_SESSION['id'])) {
    echo "<li class='nav-item'>
            <a class='nav-link' type='button' name='login' href='login.php'>Login</a>
        </li>";
} elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    
}?>
            
            <li class="nav-item">
            <a class="nav-link" type="button" name="mypage" href='mypage.php'>Go to profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" type="button" name="logout" href='logout.php'>Logout</a>
        </li>
            <li class='nav-item'>   
            <a class='nav-link' type='button' name='admin'href='admin/index.php'>Admin</a>
        </li>
            
        </ul>
    </div>
</nav>
<header class="page-header header container-fluid">
<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-4 mx-auto">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 style='color:white' class="panel-title">Log In</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo $timer;  ?>
                        <?php
                            if(!empty($errors)){
                                echo "<div class='alert alert-danger'>";
                                foreach ($errors as $error) {
                                    echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;".$error."<br>";
                                }
                                echo "</div>";
                            }
                        ?>
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="text" autofocus value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->

                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
                                <input onclick="location.href='index.php'" type= "button" class="btn btn-lg btn-success btn-block" value="Back" />

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </header>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="javascript/main.js"></script>
</body>
</html>

    

                