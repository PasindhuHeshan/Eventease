<?php 
    $parameter='disableacc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/mngusrstyle.css">
    <link rel="stylesheet" href="./css/useraddstyles.css">
</head>
<body>

<div class="container">

    <?php include 'aside.php'; ?>

    
    <div class="content">
        <h2>Disable Account Complaints</h2>
        <p>This page allows the admin to review and manage Disable Account Complaints. Admins can approve or send reply based on the provided information.</p>
        <table>
            <tr>
                <th>User</th>
                <th>ID</th>
                <th>Complaint</th>
                <th>Send Mail</th>
                <th>Approve</th>
            </tr>
            <?php if (!empty($complaints)): ?>
                <?php foreach ($complaints as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["fname"]); ?></td>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["details"]); ?></td>
                        <td>
                            <?php if($row['email_status']==0){ ?>
                                <button onclick="openPopup(<?php echo htmlspecialchars($row['no']); ?>, '<?php echo htmlspecialchars($row['fname']); ?>', '<?php echo htmlspecialchars($row['email']); ?>')">Send</button>
                            <?php }else{ ?>
                                <p>Email Thread Started.</p>
                            <?php } ?> 
                        </td>
                        <td>
                            <form method="POST" action="activeacc">
                                <input type="hidden" name="no" value="<?php echo htmlspecialchars($row['no']); ?>">
                                <button type="submit" name="approve">Active</button>
                            </form>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No Disable Account complaints found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>


<div id="popupForm" class="popup-form">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">x</span>
        <div class="container">
            <form action="process_send_email" method="post">
                <h2>Disable Account Complaints</h2>
                <input type="hidden" id="rejectNo" name="no" value="<?php echo $row['no']; ?>">
                <div class="form-group">
                    <label for="fname">User</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($row['fname']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea id="reply" name="email_body" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="subject" value="About your EventEase Account Banned!">
                    <input type="email" name="recipient_email" value="<?php echo htmlspecialchars($row['email']); ?>" hidden>
                    
                    <button type="submit" name="send_email">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPopup(no, fname, email) {
        document.getElementById('rejectNo').value = no;
        document.querySelector('input[name="name"]').value = fname;
        document.querySelector('input[name="recipient_email"]').value = email;
        document.getElementById('popupForm').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popupForm').style.display = 'none';
    }
</script>
</body>
</html>
