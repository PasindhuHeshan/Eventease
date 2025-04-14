<?php 
    $parameter='feedback';
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
        <h2>General Feedbacks</h2>
        <p>This page allows the admin to review and manage general Complaints. Admins can approve or reject  Complaints based on the provided information.</p>
        <table>
            <tr>
                <th>User</th>
                <th>Contact No</th>
                <th>Feedbacks</th>
                <th>Send Mail</th>
                <th>Status</th>
            </tr>

            <?php
                if (!empty($complaints)) {
                    foreach ($complaints as $row) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row["name"]) . "</td>
                            <td>" . htmlspecialchars($row["contact_no"]) . "</td>
                            <td>" . htmlspecialchars($row["details"]) . "</td>
                            <td>
                                <button onclick='openPopup(" . htmlspecialchars($row["no"]) . ")'>Send</button>
                            </td>
                            <td>
                                <form method='POST' action='feedbackdone'>
                                    <input type='hidden' name='row_id' value='" . htmlspecialchars($row["no"]) . "'>
                                    <button type='submit' name='approve'>Done</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No feedbacks found.</td></tr>";
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
            <form action="role_requests.php" method="post">
                <h2>General Complaints</h2>
                <input type="hidden" id="rejectNo" name="no">
                <div class="form-group">
                    <label for="fname">Email</label>
                    <input type="text" value="<?php echo htmlspecialchars($row['email']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea id="reply" name="reply" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit">Submit</button>
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
