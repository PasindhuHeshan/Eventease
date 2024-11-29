<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$upevent = isset($_SESSION['upevent']) ? $_SESSION['upevent'] : 'NO';

if ($upevents === null) {
    $_SESSION['upevent'] = 'NO'; 
} else { 
    $_SESSION['upevent'] = 'YES'; 
}
?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="indexstyle.css">
    <title>EMS System</title>
</head>
<body>
    <main>
        <?php include 'main.php'; ?>
    </main>
    <?php if($username!="Guest" && $upevent!="NO"){?>
    <aside class="rside" id="rside">
        <?php include 'upcoming.php'; ?>
    </aside>
    <?php } else { ?>
        <style>
            main {
                width: 100%;
            }
        </style>
    <?php }?>
</body>
</html>
