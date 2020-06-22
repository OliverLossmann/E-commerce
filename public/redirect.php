<?php  
require ('../src/config.php');
require ('../src/dbconnect.php');


$timer = "<p>You will be redirected in <span id='counter'>5</span> second(s).
        </p><script type='text/javascript'>
        function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'index.php';
                }if (parseInt(i.innerHTML)!=0) {
                    i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    }
                    setInterval(function(){ countdown(); },1000);
                    </script>";
    echo "Please log in first to see this page.";


?>

<?php echo $timer;  ?>