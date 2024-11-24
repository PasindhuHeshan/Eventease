<?php
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
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
    <?php if($username!="Guest"){?>
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
