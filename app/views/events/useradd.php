<?php
// Initialize an error message variable
$errorMsg = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "eventease";

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $userType = 'staff'; // Set user type to 'staff'

    // Prepare an SQL query to insert the new user into the `users` table
    $sql = "INSERT INTO users (fname, lname, email, usertype) VALUES ('$fname', '$lname', '$email', '$userType')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to user table page after successful insertion
        header("Location: ../public/index.php?url=users.php");  // Change "user-table.php" to your page showing the users
        exit();  // Ensure no further code is executed after redirection
    } else {
        if ($conn->errno == 1062) {
            $errorMsg = "Email already exists!";
        } else {
            $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Form</title>
    <link rel="stylesheet" href="./css/useraddstyles.css">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h2>New Staff Member</h2>
            <?php if (!empty($errorMsg)): ?>
                <p style="color: red;"><?php echo $errorMsg; ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="usertype">User Type</label>
                <input type="text" id="usertype" name="usertype" value="staff" readonly>
            </div>
            <div class="form-group">
                <button type="submit">Create</button>
            </div>
        </form>
    </div>
</body>
</html>
