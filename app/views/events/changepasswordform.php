<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/loginformstyle.css">
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Forget Password</h2>
            <h5>Change Password for <?php echo htmlspecialchars($username); ?></h5>
            <form name="fp" action="index.php?url=fpchange" method="post">
                <table>
                    <tr>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" style="display: none;">
                        <td><label for="password">New Password:</label></td>
                        <td><input type="password" id="password" name="password" placeholder="New Password"></td>
                    </tr>
                    <tr>
                        <td><label for="password2">Reenter New Password:</label></td>
                        <td><input type="password" id="password2" name="password2" placeholder="Reenter New Password"></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Change Password</button></td>
                    </tr>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <tr>
                            <td colspan="2"><p style="color: red; text-align: center"><?php echo $_SESSION['error']; ?></p></td>
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
