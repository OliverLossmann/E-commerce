<?php 
require_once('../src/dbconnect.php');
require_once('../src/config.php');



if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['first_name'])){ $errors[]="Name field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE first_name=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['first_name']));
        $count = $result->rowCount();
    }
    if(empty($_POST['last_name'])){ $errors[]="Last Name field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE last_name=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['last_name']));
        $count = $result->rowCount();
    }
    if(empty($_POST['city'])){ $errors[]="City field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE city=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['city']));
        $count = $result->rowCount();
    }
    if(empty($_POST['street'])){ $errors[]="Street field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE street=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['street']));
        $count = $result->rowCount();
    }
    if(empty($_POST['country'])){ $errors[]="Country field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE city=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['country']));
        $count = $result->rowCount();
    }
    if(empty($_POST['postal_code'])){ $errors[]="Postal Code field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE postal_code=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['postal_code']));
        $count = $result->rowCount();
    }
    if(empty($_POST['email'])){ $errors[]="E-mail field is Required"; }else{
        // Check Email is Unique with DB Query
        $sql = "SELECT * FROM users WHERE email=?";
        $result = $dbconnect->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "E-Mail already exists in database";
        }
    }
    if(empty($_POST['phone'])){ $errors[]="Phone field is Required"; }
    if(empty($_POST['password'])){ $errors[]="Password field is Required"; }else{
        // check the repeat password
        if(empty($_POST['passwordr'])){ $errors[]="Repeat Password field is Required"; }else{
            // compare both passwords, if they match. Generate the Password Hash
            if($_POST['password'] == $_POST['passwordr']){
                // create password hash
                $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                // Display Error Message
                $errors[] = "Both Passwords Should Match";
            }
        }
    }

  

    // If no Errors, Insert the Values into users table
    if(empty($errors)){
        $sql = "INSERT INTO users (first_name, last_name, email, password, phone, street, postal_code, city, country) VALUES (:first_name, :last_name, :email, :password, :phone, :street, :postal_code, :city, :country)";
        $result = $dbconnect->prepare($sql);
        $values = array(':first_name'     => $_POST['first_name'],
                        ':email'        => $_POST['email'],
                        ':last_name'     => $_POST['last_name'],
                        ':phone'     => $_POST['phone'],
                        ':street'     => $_POST['street'],
                        ':postal_code'     => $_POST['postal_code'],
                        ':city'     => $_POST['city'],
                        ':country'     => $_POST['country'],
                        ':password'     => $pass_hash
                        );
        $res = $result->execute($values);
        $timer = "<p><a style='color:white;'>Registration Completed, You will be redirected in <span id='counter'>5</span> second(s).</a>
        </p><script type='text/javascript'>
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'login.php';
                }if (parseInt(i.innerHTML)!=0) {
                    i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    }
                    setInterval(function(){ countdown(); },1000);
                    </script>";
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
                    <h3 style='color:white' class="panel-title">Register</h3>
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
                    <?php
                        if(!empty($messages)){
                            echo "<div class='alert alert-success'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;".$message."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="first_name" type="text" autofocus value="<?php if(isset($_POST['first_name'])){ echo $_POST['first_name']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Last Name" name="last_name" type="text" autofocus value="<?php if(isset($_POST['last_name'])){ echo $_POST['last_name']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Phone" name="phone" type="text" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Street" name="street" type="text" autofocus value="<?php if(isset($_POST['street'])){ echo $_POST['street']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="City" name="city" type="text" autofocus value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Postal Code" name="postal_code" type="text" autofocus value="<?php if(isset($_POST['postal_code'])){ echo $_POST['postal_code']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Country" name="country" type="text" autofocus value="<?php if(isset($_POST['country'])){ echo $_POST['country']; } ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Repeat Password" name="passwordr" type="password" value="">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Register" />
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




