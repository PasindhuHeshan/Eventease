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
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            z-index: 1;
            padding: 10px 5px 10px 5px;
            border-radius: 20px;
            background-color: lightskyblue;
        }
        .dropdown-content a {
            color: black;
            padding-bottom: 2px;
            text-decoration: none;
            display: block;
            background-color: lightskyblue;
            margin-bottom: 10px; /* Add space between dropdown items */
        }
        .dropdown:hover .dropdown-content {
            display: block;
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
                    <li class="dropdown">
                        <a class="nothing"><img src="./images/bell.png" alt="Notifications" width="50px"></a>
                        <div class="dropdown-content">
                            <p style="text-align: center;">Upcoming Events</p>
                            <hr>
                            <a href="#">Art Exhibition on 2024-01-05</a>
                            <a href="#">Music Festival on 2024-02-20</a>
                        </div>
                    </li>
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
