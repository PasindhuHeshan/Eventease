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

    <!-- Content -->
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

            <?php
            if (!empty($complaints)) {
                foreach ($complaints as $row) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row["fname"]) . "</td>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["details"]) . "</td>
                        <td>
                            <button onclick='openPopup(" . htmlspecialchars($row["no"]) . ")'>Send</button>
                        </td>
                        <td>
                            <form method='POST' action='activeacc'>
                                <input type='hidden' name='no' value='" . htmlspecialchars($row["no"]) . "'>
                                <button type='submit' name='approve'>Active</button>
                            </form>
                        </td>
                        
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No Disable Account complaints found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<!-- Popup Form -->
<div id="popupForm" class="popup-form">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <div class="container">
            <form action="disableacc.php" method="post">
                <h2>Disable Account Complaints</h2>
                <input type="hidden" id="rejectNo" name="no">
                <div class="form-group">
                    <label for="fname">User</label>
                    <input type="text" value="<?php echo htmlspecialchars($row['fname']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea id="reply" name="reply" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPopup(no) {
        document.getElementById('rejectNo').value = no;
        document.getElementById('popupForm').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popupForm').style.display = 'none';
    }
</script>
</body>
</html>
