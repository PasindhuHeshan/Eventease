<?php 
    $parameter='role_requests';
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
        <h2>User Role Requests for Event Organizer</h2>
        <p>This page allows the admin to review and manage user role requests. Admins can approve or reject requests based on the provided information.</p>
        <table>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Organization</th>
                <th>Reason</th>
                <th>Approve</th>
                <th>Reject</th>
            </tr>

            <?php
            if (!empty($roleRequests)) {
                $rowNumber = 1;
                foreach ($roleRequests as $row) {
                    echo "<tr>
                        <td>" . $rowNumber++ . "</td>
                        <td>" . htmlspecialchars($row["id"]) . "</td>
                        <td>" . htmlspecialchars($row["orgname"]) . "</td>
                        <td>" . htmlspecialchars($row["reason"]) . "</td>
                        <td>
                            <form method='POST' action='role_requests.php'>
                                <input type='hidden' name='no' value='" . htmlspecialchars($row["no"]) . "'>
                                <input type='hidden' name='orgno' value='" . htmlspecialchars($row["orgno"]) . "'>
                                <button type='submit' name='approve' " . ($row["status"] == 0 ? "disabled" : "") . ">Approve</button>
                            </form>
                        </td>
                        <td>
                            <button onclick='openPopup(" . htmlspecialchars($row["no"]) . ")' " . ($row["status"] == -1 ? "disabled" : "") . ">Reject</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No role requests found.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<!-- Popup Form -->
<div id="popupForm" class="popup-form">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">x;</span>
        <div class="container">
            <form action="role_requests.php" method="post">
                <h2>Reject Role Request</h2>
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
                    <button type="submit" name="reject">Reject</button>
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
