<?php 
require_once('../src/dbconnect.php');
require_once('../src/config.php');

if (empty($_SESSION['id'])) {
    header("Location:redirect.php");
}elseif (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . "!";
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

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Register</h3>
                </div>
            <div class="panel-body">
                <input type="button" name="return" onclick="location.href='mypage.php'" value="Go to profile">
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
                            <input type="submit" name="delbtn"class="btn btn-lg btn-success btn-block" value="Delete" />
                            <input onclick="location.href='index.php'" type= "button" class="btn btn-lg btn-success btn-block" value="Back" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



