<?php
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/contactus.css">
    <script type="text/javascript">
        function confirmSubmission() {
            return confirm("Are you sure you want to enter the details?");
        }
    </script>
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Contact Support</h2>
            <form name="contactsupport" action="contactus" method="post" onsubmit="return confirmSubmission();">
                <table>
                    <tr>
                        <td><label for="type">Type</label></td>
                        <td>
                            <select name="type">
                                <option value="1">Feedback</option>
                                <?php if($username == ''): ?>
                                    <option value="2">Account Disable</option>
                                <?php endif; ?>
                                <option value="3">Complain</option>
                            </select>
                        </td>
                    </tr>

                    <?php if ($username === ''): ?>
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td>
                                <input type="text" id="name" name="name" placeholder="Enter your Name">
                                <?php if (isset($_SESSION['errors']['name'])): ?>
                                    <div class="error"><?php echo $_SESSION['errors']['name']; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td>
                                <input type="email" id="email" name="email" placeholder="Enter your Email">
                                <?php if (isset($_SESSION['errors']['email'])): ?>
                                    <div class="error"><?php echo $_SESSION['errors']['email']; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="contact">Contact number</label></td>
                            <td>
                                <input type="text" id="contact" name="contact_no" placeholder="Enter your Contact Number">
                                <?php if (isset($_SESSION['errors']['contact_no'])): ?>
                                    <div class="error"><?php echo $_SESSION['errors']['contact_no']; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td>
                                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userData['fname'] ?? ''); ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="contact">Contact number</label></td>
                            <td>
                                <input type="text" id="contact" name="contact_no" value="<?php echo htmlspecialchars($userData['contact_numbers'][0] ?? ''); ?>" readonly>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <tr>
                        <td><label for="feedback">Feedback</label></td>
                        <td><textarea class="myTextarea" name="feedback" rows="4" placeholder="Enter your feedback"></textarea></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Send</button></td>
                    </tr>
                </table>
                <p>For the Questions,<br>our contact support will get in touch with you as soon as possible</p>
            </form>
        </div>
    </div>
</body>
</html>