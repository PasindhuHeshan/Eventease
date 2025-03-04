<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/loginformstyle.css">
    <script>
        function validatePasswords(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('password2').value;
            var valid = true;

            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
            if (!passwordPattern.test(password)) {
                document.getElementById('password_error').innerHTML = "Password must contain at least one uppercase letter,<br> one lowercase letter, and one number.";
                valid = false;
            } else {
                document.getElementById('password_error').innerHTML = "";
            }

            if (password !== confirmPassword) {
                document.getElementById('confirm_password_error').innerHTML = "Passwords do not match. Please try again.";
                valid = false;
            } else {
                document.getElementById('confirm_password_error').innerHTML = "";
            }

            if (!valid) {
                event.preventDefault();
            }
        }
    </script>
    <style>
        label {
            text-align: left;
            display: block;
            margin-right: 10px;
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Forget Password</h2>
            <h5>Change Password for <?php echo htmlspecialchars($username); ?></h5>
            <form name="fp" action="index.php?url=fpchange" method="post" onsubmit="validatePasswords(event)">
                <table>
                    <tr>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" style="display: none;">
                        <td><label for="password">New Password:</label></td>
                        <td><input type="password" id="password" name="password" placeholder="New Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id="password_error" class="error"></div></td>
                    </tr>
                    <tr>
                        <td><label for="password2">Reenter New Password:</label></td>
                        <td><input type="password" id="password2" name="password2" placeholder="Reenter New Password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div id="confirm_password_error" class="error"></div></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Change Password</button></td>
                    </tr>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <tr>
                            <td colspan="2"><p style="color: red; text-align: center"><?php echo $_SESSION['error']; ?></p></td>
                        </tr>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
