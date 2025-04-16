<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat View</title>
    <link rel="stylesheet" type="text/css" href="./css/chat.css">
</head>
<body>
    <div class="chatbody">
        <div class="container">
            <div class="header">
                <h1>Chat with Admin</h1>
            </div>
            <div class="chat-container">
                <div class="messages-container">
                    <?php if (!empty($chats)): ?>
                        <?php foreach ($chats as $message): ?>
                            <?php if (!empty($message['user_msg'])): ?>
                                <div class="user-message">
                                    <?php echo htmlspecialchars($message['user_msg']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($message['admin_msg'])): ?>
                                <div class="admin-reply">
                                    <?php echo htmlspecialchars($message['admin_msg']); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No chats available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="typing-area">
                <form method="POST" action="">
                    <table class="typing-table">
                        <tr>
                            <td>
                                <input type="hidden" name="no" value="<?php echo htmlspecialchars($message['no'] ?? ''); ?>">
                                <input type="text" name="message" placeholder="Type your complaint here..." class="message-input">
                            </td>
                            <td>
                                <button type="submit" class="send-button">Send</button>
                            </td>
                            <td>
                                <input type='hidden' name='email' value='<?php echo htmlspecialchars($email); ?>'>
                                <button type='submit' name='refresh' value='1'>Refresh</button>
                            </td>
                            <td>
                                <?php if($userData['usertype']=='0'):?>
                                    <a href="feedback.php" class="button-link">Close</a>
                                <?php else:?>
                                    <a href="userprofile.php" class="button-link">Close</a>
                                <?php endif;?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>