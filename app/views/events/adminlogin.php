<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="adminstyle.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form name="login" action="index.php?url=processadminlogin.php" method="POST">
      <h1>Admin Login</h1>

      <!-- Display error message from session -->
      <?php if (isset($_SESSION['error'])) { ?>
        <div>
          <p style="color: red; text-align: center"><?php echo $_SESSION['error']; ?></p>
        </div>
        <?php unset($_SESSION['error']); // Clear the error message after displaying it ?>
      <?php } ?>

      <div class="input-box">
        <input type="text" id="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" id="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>

      <div class="remember-forgot">
        <label><input type="checkbox" name="remember">Remember Me</label>
        <a href="forgot_password.php">Forgot Password</a>
      </div>

      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>
