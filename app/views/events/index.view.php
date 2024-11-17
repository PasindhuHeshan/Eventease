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
    <aside class="rside" id="rside">
        <?php include 'upcoming.php'; ?>
    </aside>
</body>
</html>
