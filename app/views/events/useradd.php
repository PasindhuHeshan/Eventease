

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
