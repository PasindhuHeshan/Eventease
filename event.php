<!DOCTYPE html>
<html>
<?php
    $isLoggedIncheck = isset($_GET['isLoggedIncheck'])?$_GET['isLoggedIncheck']: 0;
    $isUserName = isset($_GET['username'])?$_GET['username']: "Customer";
?>
<head>
    <link rel="stylesheet" type="text/css" href="event.css">
</head>

<body>
    <header>
        <?php include 'header.php'; ?>
    </header>
    <main>
        <div class="main">
            <?php
            include("connection.php");

            
            if (isset($_GET['no'])) {
                $no = $_GET['no'];
            }
            $table = "SELECT * FROM events WHERE no = ?";
            $stmt = $con->prepare($table);
            $stmt->bind_param("i", $no); // Assuming 'no' is an integer
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            if($data){
                ?>
                    <div>
                        <h1><?php echo $data['name']; ?></h1>
                        <hr>
                        <p class="details"><?php echo $data['long_dis']; ?></p>
                        <p><b>
                            Time: <?php echo $data['time']; ?>
                            <br>
                            Location: <?php echo $data['location']; ?>
                        </b>
                        </p>
                <?php 
                }
            // Close connection
            $con->close();
            ?>
        </div>
    </main>
</body>
</html>