<head>
    <link rel="stylesheet" type="text/css" href="./css/contactus.css">
</head>
<div class="main">
    <div class="main_box">
        <h2>Login</h2>
        <?php if (isset($_GET['message']) && $_GET['message'] === '2'): ?>
            <div class="success">Payment Successful and Account Created! <div>You need to log in to the system.</div><br/></div>
        <?php elseif(isset($_GET['message']) && $_GET['message'] === '1'): ?>
            <div class="success">Account Created! <div> You need to log in to the system.</div><br/></div>
        <?php endif; ?>
        <form name="login" action="index.php?url=processlogin" method="post">
            <table>
                <tr>
                    <td><label for="name">Username</label></td>
                    <td><input type="text" id="name" name="name" placeholder="Enter your UserName"></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" id="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr class="button">
                    <td colspan="2"><button type="submit">Login</button></td>
                </tr>
                <?php if (isset($_SESSION['error'])) { ?>
                    <tr>
                        <td class="tderror" colspan="2"><p class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p></td>
                    </tr>
                <?php } ?>
            </table>
            <p>If you haven't signed up yet? <a href="signin.php">sign up</a></p>
            <p><a href="forgetpassword.php">Forget Password</a></p>
        </form>
    </div>
</div>

