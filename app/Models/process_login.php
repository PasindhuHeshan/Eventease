<?php
session_start();
include('connection.php');

$username = $_POST['name'];
$password = $_POST['password'];


$stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$count = $result->num_rows;

if ($count == 1 && password_verify($password, $row['password'])) {
    if ($row['usertype'] != 'admin') {
        $isLoggedIncheck = 1;
        header("location: index.php?isLoggedIncheck=" . $isLoggedIncheck . "&username=" . $username . "&fname=" . $fname);
        exit();
    } else if ($row['usertype'] == 'admin') {
        $isLoggedIncheck = 1;
        header("location: dashboard.php?username=" . $username);
        exit();
    }
} else {
    ?>
    <style>
        a:hover {
            box-shadow: 2px 2px 5px gray;
        }
    </style>
    <div style="text-align: center;">
        <p style="font-size: larger;">Incorrect Username or Password!</p>
        <a href="javascript:history.back()" style="text-decoration: none;color:black;border: solid; padding: 10px; border-radius: 15px; border-width: 1px">Go back and Try Again</a>
    </div>
    <?php
}
mysqli_close($con);
?>
