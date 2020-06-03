<?php 
	include ('../../src/dbconnect.php');
	include ('../../src/config.php');
	include ('functions/main.php');

	if ($_SESSION["id"] === '1' || $_SESSION["id"] === '2' || $_SESSION["id"] === '3') {
    
} else {
	header("Location:../redirect.php");
}
	 
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
        $timer = "<p>Registration Completed, You will be redirected in <span id='counter'>5</span> second(s).
        </p><script type='text/javascript'>
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'view_all_users.php';
                }if (parseInt(i.innerHTML)!=0) {
                    i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    }
                    setInterval(function(){ countdown(); },1000);
                    </script>";
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add New User</h3>
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
