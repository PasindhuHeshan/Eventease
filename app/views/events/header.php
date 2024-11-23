<?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="headerstyle.css">
        <title>EMS System</title>
    </head>
    <body>
        <style>
            .headerbody {
                position: sticky;
                top: 0;
                width: 100%;
                z-index: 1; 
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
        </style>
        <div class="headerbody">
            <a href="index.php" target="_parent"><img src="./images/logo.png" alt="logo" width="150px"></a>
            <div>
                <ul>
                    <?php
                    if($username!=='Guest'){
                    ?>
                        <li>Hi <?php echo $username ?></li>
                        <li><a href="userprofile.php" target="rside">Profile</a></li>
                        <li><a href="logout.php" target="_self">Logout</a></li>
                    <?php
                    }else{
                    ?>
                        <li>Hi <?php echo $username ?></li>
                        <li><a href="login.php" target="_self">Login</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="contactus.html" target="rside">Contact us</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>