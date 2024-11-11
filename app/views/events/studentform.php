<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="loginformstyle.css">
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Registration Form</h2>
            <h4>For University Student</h4>
            <form name="register" action="index.php?url=processsignin" method="post">
                <table>
                    <tr>
                        <td><label for="fname">First Name</label></td>
                        <td colspan="2"><input type="text" id="fname" name="fname"></td>
                    </tr>
                    <tr>
                        <td><label for="lname">Last Name</label></td>
                        <td colspan="2"><input type="text" id="lname" name="lname"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email Address</label></td>
                        <td colspan="2"><input type="email" id="email" name="email"></td>
                    </tr>
                    <tr>
                        <td><label for="contactno">Contact Number</label></td>
                        <td><input type="number" id="contactno1" name="contactno1"></td>
                        <td><input type="number" id="contactno2" name="contactno2"></td>
                    </tr>
                    <tr class="button">
                        <td colspan="3"><button type="submit">Login</button></td>
                    </tr>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <tr>
                            <td colspan="3"><p style="color: red; text-align: center"><?php echo $_SESSION['error']; ?></p></td>
                        </tr>
                    <?php } ?>
                </table>
                <p>If you haven't signed yet? <a href="signin.php">sign in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
