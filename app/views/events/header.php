<!DOCTYPE html>
<html lang="en">
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
        <a style="margin-left:10px;" href="index.php" target="_parent"><img src="./images/logo.png" alt="logo" width="150px"></a>
        <div>
            <?php if ($username !== 'Guest') { ?>
                <ul class="nothingul">
                    <?php
                        date_default_timezone_set('Asia/Colombo');
                        $hour = date('H');
                        $greeting = ($hour < 12) ? 'Good Morning!' : (($hour < 18) ? 'Good Afternoon!' : 'Good Evening!');
                    ?>
                    <li><?php echo $greeting ." ". $fname; ?></li>
                    <li><a href="userprofile.php" target="_self" class="nothing"><img src="<?php echo $profilePicture; ?>" alt="Profile Picture" width="50px"></a></li>
                    <li><a href="logout.php" target="_self">Logout</a></li>
                    <li><a href="contactus.php" target="rside">Contact us</a></li>
                </ul>
            <?php } else { ?>
                <ul>
                    <?php
                        date_default_timezone_set('Asia/Colombo');
                        $hour = date('H');
                        $greeting = ($hour < 12) ? 'Good Morning!' : (($hour < 18) ? 'Good Afternoon!' : 'Good Evening!');
                    ?>
                    <li><?php echo $greeting; ?></li>
                    <li><a href="login.php" target="_self">Login</a></li>
                    <li><a href="contactus.php" target="rside">Contact us</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</body>
</html>
