<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="loginformstyle.css">
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Forget Password</h2>
            <form name="fp" action="index.php?url=fpcheck" method="post">
                <table>
                <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <tr>
                        <td><label for="username">Username:</label></td>
                        <td><input type="text" id="username" name="username" placeholder="Enter your UserName"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email" placeholder="Enter your Email"></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Check Account Details</button></td>
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
