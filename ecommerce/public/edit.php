<?php 
require_once('../src/dbconnect.php');
require_once('../src/config.php');

if (empty($_SESSION['id'])) {
    header("Location:redirect.php");
}elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
}

$id = $_SESSION['id'];  
$sql = "SELECT * FROM users WHERE id = :id";
$result = $dbconnect->prepare($sql);
$result->execute([':id' => $id]); 
$count = $result->rowCount();
$res = $result->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['editbtn'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    $pdo = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email WHERE id = :id";
    $stmt = $dbconnect->prepare($pdo);

    try{ $result = $stmt->execute([':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':id' => $id]);
        header("Location: index.php");
    }catch(PDOException $e) {
        $result = false;
    }
}

if(isset($_POST['delbtn'])) {  
    $pdo = "DELETE FROM users WHERE id = :id";
    $stmt = $dbconnect->prepare($pdo);
    $makeToDelete = $_SESSION['id'];
    $stmt->bindValue(':id', $makeToDelete);

    try{$delete = $stmt->execute();
        unset($_SESSION["id"]);
        unset($_SESSION["email"]);
        header("Location: index.php");
    }catch(PDOException $e) {
        $result = false;
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
                    <h3 style='color:white' class="panel-title">Update Profile</h3>
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
                                <input class="form-control" placeholder="Name" name="first_name" type="text" autofocus value="<?php echo $_SESSION['first_name']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Last Name" name="last_name" type="text" autofocus value="<?php echo $_SESSION['last_name']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php echo $_SESSION['email']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Phone" name="phone" type="text" value="<?php echo $_SESSION['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Street" name="street" type="text" autofocus value="<?php echo $_SESSION['street']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="City" name="city" type="text" autofocus value="<?php echo $_SESSION['city']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Postal Code" name="postal_code" type="text" autofocus value="<?php echo $_SESSION['postal_code']; ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Country" name="country" type="text" autofocus value="<?php echo $_SESSION['country']; ?>">
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <input type="submit" name="editbtn"class="btn btn-lg btn-success btn-block" value="Update" />
                            <input type="submit" name="delbtn"class="btn btn-lg btn-success btn-block" value="Delete Profile" />
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