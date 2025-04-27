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
    <div class="contact_main">
        
        <div class="main_box">
            <h2><?php echo htmlspecialchars($eventData['name'] ?? ''); ?></h2>
            <?php if (isset($success) && $success): ?>
                <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <form name="contactsupport" action="submitask" method="post" onsubmit="return confirmSubmission();">
                <table>
                    <tr>
                        <td><label for="type">Type</label></td>
                        <td>
                            <select name="type">
                                <option value="1">Feedback</option>
                                <option value="4">Inquery</option>
                            </select>
                        </td>
                    </tr>
                        <input type="text" id="event_no" name="event_no" value="<?php echo htmlspecialchars($eventData['no'] ?? ''); ?>" hidden>
                        <input type="text" id="user_no" name="user_no" value="<?php echo htmlspecialchars($userData['No'] ?? ''); ?>" hidden>
                    <tr>
                        <td><label for="feedback">Message</label></td>
                        <td><textarea class="myTextarea" name="message" rows="4" placeholder="Enter your feedback" required></textarea></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Send</button></td>
                    </tr>
                </table>
            </form>
        </div>
        
    </div>
</body>
</html>