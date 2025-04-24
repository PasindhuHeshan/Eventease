<?php 
    $parameter = 'feedback';
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
        <h2>General Feedbacks</h2>
        <p>This page allows the admin to review and manage general Feedbacks. Admins can check feedbacks and send reply based on the provided information.</p>
        <div class="table-selector">
            <label for="tableSelect">Select Feedback Type:</label>
            <select id="tableSelect" onchange="toggleTable()">
                <option value="normal">Normal Users</option>
                <option value="registered">Registered Users</option>
            </select>
        </div>

        <div id="normalTable" class="feedback-table">
            <h3>Normal Users</h3>
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
                            $rowJson = htmlspecialchars(json_encode($row));
                            echo "<tr>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["contact_no"]) . "</td>
                                <td>" . htmlspecialchars($row["user_msg"]) . "</td>
                                <td>
                                    <button onclick='openPopup($rowJson)'>Send</button>
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

        <div id="registeredTable" class="feedback-table" style="display: none;">
            <h3>Registered Users</h3>
            <table>
                <tr>
                    <th>User</th>
                    <th>Contact No</th>
                    <th>Open Chat</th>
                </tr>
                <?php
                    if (!empty($regcomplaints)) {
                        foreach ($regcomplaints as $row) {
                            $rowJson = htmlspecialchars(json_encode($row));
                            echo "<tr>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["contact_no"]) . "</td>
                                <td>
                                    <form method='POST' action='chat.php'>
                                        <input type='hidden' name='email' value='" . htmlspecialchars($row["email"]) . "'>
                                        <button type='submit'>Open</button>
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
</div>

<div id="popupForm" class="popup-form">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <div class="container">
            <form action="process_send_email" method="post">
                <h2>General Complaints</h2>
                <input type="hidden" id="row_no" name="row_no">
                <div class="form-group">
                    <label for="fname">Name</label>
                    <input type="text" id="name" name="name" readonly>
                </div>
                <input type="hidden" id="email" name="recipient_email" value="<?php echo htmlspecialchars($row['email']); ?>">
                <div class="form-group">
                    <label for="reply">Reply</label>
                    <textarea id="reply" name="email_body" rows="4" required></textarea>
                </div>
                <div class="form-group">
                <input type="hidden" name="subject" value="Thank you for your valuable feedback!">
                    <button type="submit" name="send_email">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleTable() {
        const selectedValue = document.getElementById('tableSelect').value;
        document.getElementById('normalTable').style.display = selectedValue === 'normal' ? 'block' : 'none';
        document.getElementById('registeredTable').style.display = selectedValue === 'registered' ? 'block' : 'none';
    }

    function openchat(){
        window.location.href = "chat.php";
    }

    function openPopup(row) {
        document.getElementById('row_no').value = row.row_no;
        document.getElementById('name').value = row.name;
        document.getElementById('email').value = row.email;
        document.getElementById('popupForm').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('popupForm').style.display = 'none';
    }
</script>
</body>
</html>
