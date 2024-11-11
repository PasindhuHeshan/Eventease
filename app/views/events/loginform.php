<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="loginformstyle.css">
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Login</h2>
            <form name="login" action="index.php?url=processlogin" method="post">
                <table>
                    <tr>
                        <td><label for="name">Username:</label></td>
                        <td><input type="text" id="name" name="name" placeholder="Enter your UserName"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" placeholder="Enter your password"></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Login</button></td>
                    </tr>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <tr>
                            <td colspan="2"><p style="color: red; text-align: center"><?php echo $_SESSION['error']; ?></p></td>
                        </tr>
                    <?php } ?>
                </table>
                <p>If you haven't signed yet? <a href="registration.php">sign in</a></p>
            </form>
        </div>
    </div>
</body>
</html>
