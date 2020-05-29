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
                $timer = "<p>Logging in, you will be redirected in <span id='counter'>5</span> second(s).
        </p><script type='text/javascript'>
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'mypage.php';
                }if (parseInt(i.innerHTML)!=0) {
                    i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    }
                    setInterval(function(){ countdown(); },1000);
                    </script>";
            }else{
                $errors[] = "E-Mail & Password Combination not Working";
            }
        }else{
            $errors[] = "E-Mail not Valid";
        }
    }
} 



?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <input type="button" name="return" onclick="location.href='mypage.php'" value="Go to profile">
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

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>