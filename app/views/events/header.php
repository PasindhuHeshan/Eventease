<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/headerstyle.css">
    <title>EMS System</title>
</head>
<body>
    <?php if(isset($userData) && $userData!=null && isset($userData['role_name']) && $userData['role_name']=='Admin'): ?>
        <style>
            .container{
                width: max-content;
            }
        </style>
    <?php endif; ?>
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
                        <?php if(($newchat==true && $userData['usertype']=='1')||($newchatadmin==true && $userData['usertype']=='0')){?>
                            <a class="nothing"><img src="./images/bell-red.png" alt="Chat" width="50px"></a>
                        <?php }else{?>
                            <a class="nothing"><img src="./images/bell.png" alt="Notifications" width="50px"></a>
                        <?php }?>
                        <div class="dropdown-content">
                            <p style="text-align: center;">Upcoming Events</p>
                            <hr>
                            <?php if (!empty($events)): ?>
                                <?php foreach (array_slice($events, 0, 2) as $data): ?>
                                    <a href="event.php?no=<?php echo isset($data['no']) ? $data['no'] : ''; ?>">
                                        <?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ' '; ?> 
                                        on <?php echo isset($data['date']) ? $data['date'] : 'Unknown Date'; ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No upcoming events for next 2 weeks</p>
                            <?php endif; ?>

                            <?php if ($newchat==true && $userData['usertype']=='1'): ?>
                                <p style="text-align: center;">Chat</p>
                                <hr>
                                    <a href="chat.php" target="_self">New Chat Available!</a>
                            <?php elseif($newchatadmin==true  && $userData['usertype']=='0'): ?>
                                <p style="text-align: center;">Chat</p>
                                <hr>
                                    <a href="feedback.php" target="_self">New Chat(s) Available!</a>
                            <?php endif; ?>
                        </div>
                    </li>
                    <?php if($userData['role_name']==='Academic'){?>
                        <li><a href="getNotApprovedEvents" target="_self">Approve Events</a></li>
                    <?php } ?>
                    <?php if($userData['role_name']==='Organizer'){?>
                        <li><a href="myevents" target="_self">My events</a></li>
                    <?php } ?>
                    <?php if($userData['role_name']==='Support Staff'){?>
                        <li>
                            <a href="myevents" target="_self">Assigned Events</a>
                        </li>
                    <?php } ?>
                    <?php if($userData['usertype']==='0'){?>
                        <li><a href="dashboard.php" target="_self">Switch to Admin</a></li>
                    <?php } ?>
                    <li><a href="logout.php" target="_self">Logout</a></li>
                    <?php if($userData['usertype']!='0'){?>
                        <li><a href="contactus.php" target="rside">Contact us</a></li>
                    <?php } ?>
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
