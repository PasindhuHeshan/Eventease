<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/contactus.css">
    <script>
        function validatePasswords(event) {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var valid = true;

            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
            if (!passwordPattern.test(newPassword)) {
                document.getElementById('password_error').textContent = "Password must contain at least one uppercase letter, one lowercase letter, and one number.";
                valid = false;
            } else {
                document.getElementById('password_error').textContent = "";
            }

            if (newPassword !== confirmPassword) {
                document.getElementById('confirm_password_error').textContent = "Passwords do not match. Please try again.";
                valid = false;
            } else {
                document.getElementById('confirm_password_error').textContent = "";
            }

            if (!valid) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Change Password</h2>
            <form name="cp" action="index.php?url=changepassword" method="post" onsubmit="validatePasswords(event)">
                <table>
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <tr>
                        <td><label for="new_password">New Password</label></td>
                        <td>
                            <input type="password" id="new_password" name="new_password" placeholder="Enter your New Password">
                            <p id="password_error" style="color: red; font-size: 12px;"></p>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="confirm_password">Confirm Password</label></td>
                        <td>
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your New Password">
                            <p id="confirm_password_error" style="color: red; font-size: 12px;"></p>
                        </td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Change Password</button></td>
                    </tr>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <tr>
                            <td class="tderror" colspan="2"><p style="color: red; text-align: center"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p></td>
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
