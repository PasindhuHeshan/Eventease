<?php 
    $parameter='dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/dashboardstyle.css">
   
</head>
<body>
    
    <div class="container">
        <?php include 'aside.php'; ?>

        <main class="main-content">
            <div class="upper-section">
                <div class="left-part">
                <table border="1" style="width:100%; border-collapse: collapse;">
                    <tr>
                        <th>User Type</th>
                        <th>New Users (<?php echo date('F'); ?>)</th>
                        <th>Total</th>
                    </tr>
                    <?php foreach ($user_types as $type): ?>
                    <tr>
                        <td><?php echo $type['role_name']; ?></td>
                        <td style="color:green;">
                            <?php 
                                $roleId = $type['role_id'];
                                echo isset($new_users[$roleId]) ? '+' . $new_users[$roleId] : '-';
                            ?>
                        </td>
                        <td><?php echo $type['count']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                </div>

                <div class="lower-card">
                    <a href="role_requests.php">
                    <div class="data-row">
                        <div class="data-info">
                            <div class="data-title">Pending Organizational Privilege Requests</div>
                            <div class="data-content"><?php echo htmlspecialchars($roleRequestscount ?? '-'); ?></div>
                        </div>
                        <div class="data-image">
                            <img src="./images/privilage.png" alt="privilage Icon">
                        </div>
                    </div>
                    </a>
                </div>

            </div>

            <div class="lower-section">
            <div class="lower-card">
                <a href="manageevent.php">
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Pending Event Approvals</div>
                        <div class="data-content"><?php echo htmlspecialchars($eventcount ?? '-'); ?></div>
                    </div>
                    <div class="data-image">
                        <img src="./images/pendingapproval.png" alt="pendingapproval Icon">
                    </div>
                </div>
                </a>
            </div>
    
            <div class="lower-card">
            <a href="disableacc.php">
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Disable Account Complaints</div>
                        <div class="data-content"><?php echo htmlspecialchars($disableacccount ?? '-'); ?></div>
                    </div>
                    <div class="data-image">
                        <img src="./images/DisAccComplaints.png" alt="DisAccComplaints Icon">
                    </div>
                </div>
                </a>
            </div>

            <div class="lower-card">
            <a href="feedback.php">
                <div class="data-row">
                    <div class="data-info">
                        <div class="data-title">Feedbacks</div>
                        <div class="data-content"><?php echo htmlspecialchars($feedbackcount ?? '-'); ?></div>
                    </div>
                    <div class="data-image">
                        <img src="./images/complaint.png" alt="complaint Icon">
                    </div>
                </div>
            </div>
            </a>
    </div>


            </main>
        </div>
    </body>
    </html>
