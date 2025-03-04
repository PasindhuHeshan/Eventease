<?php 
    $parameter='manage_users';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/mngusrstyle.css">
    <link rel="stylesheet" href="./css/useraddstyles.css">
    <style>
        .enable-button {
            background-color: mediumseagreen;
            color: white;
        }
        .disable-button {
            background-color: lightslategray;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <p>Hello</p>
        <div class="header-right">
            <span>, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <form method="POST" action="adminlogout.php" class="form">
                <button type="submit" class="logout-button">Log out</button>
            </form>
        </div>
    </header>
    <div class="container">
    
        <?php include 'aside.php'; ?>

        <!-- Content -->
        <div class="content">
            <h2>Users</h2>
            <p>This section allows you to manage the users of the application. You can disable any user accounts or add new staff accounts.</p>
            <div>
                <label for="nameSearch">Search by Name</label>
                <input type="text" id="nameSearch" class="user_type" onkeyup="filterUsers()" placeholder="Search for names..">
                <label for="userTypeFilter">Filter by User Type</label>
                <select id="userTypeFilter" class="user_type" onchange="filterUsers()">
                    <option value="all" default>All</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                    <option value="organizer">Organizer</option>
                    <option value="support">Support</option>
                    <option value="guest">Guest</option>
                    <option value="student">Student</option>
                </select>
                <label for="statusFilter">Status</label>
                <select id="statusFilter" class="user_type" onchange="filterUsers()">
                    <option value="all" default>All</option>
                    <option value="enabled">Enabled</option>
                    <option value="disabled">Disabled</option>
                </select>
            </div>
            <table id="usersTable">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Account Status</th>
                </tr>
                <?php
                $result = $dashboard->getUsers();
                if (is_array($result) && count($result) > 0) {
                    foreach ($result as $row) {
                        $buttonText = $row['status'] == 1 ? 'Enabled' : 'Disabled';
                        $buttonClass = $row['status'] == 1 ? 'enable-button' : 'disable-button';
                        $status = $row['status'];
                        echo "<tr data-user-type='" . htmlspecialchars($row['usertype']) . "' data-name='" . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . "' data-status='" . htmlspecialchars($status == 1 ? 'enabled' : 'disabled') . "'>";
                        echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['lname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>
                            <form method='post' action='index.php?url=changestatus' onsubmit='saveFilterState()'>
                                <input type='hidden' name='No' value='" . htmlspecialchars($row['No']) . "'>
                                <input type='hidden' name='status' value='" . htmlspecialchars($status == 1 ? 0 : 1) . "'>
                                <button type='submit' class='" . htmlspecialchars($buttonClass) . "'>" . htmlspecialchars($buttonText) . "</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
            </table>
            
            <div id="addNewButton" style="display: none;">
                <button type="button" onclick="openPopup()">Add New</button>
            </div>
            <script>
                function filterUsers() {
                    var userTypeFilter = document.getElementById('userTypeFilter').value;
                    var statusFilter = document.getElementById('statusFilter').value;
                    var search = document.getElementById('nameSearch').value.toLowerCase();
                    var rows = document.querySelectorAll('#usersTable tr[data-user-type]');
                    rows.forEach(function(row) {
                        var userType = row.getAttribute('data-user-type');
                        var status = row.getAttribute('data-status');
                        var name = row.getAttribute('data-name').toLowerCase();
                        if ((userTypeFilter === 'all' || userType === userTypeFilter) &&
                            (statusFilter === 'all' || status === statusFilter) &&
                            (name.includes(search))) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    var addNewButton = document.getElementById('addNewButton');
                    if (userTypeFilter === 'staff') {
                        addNewButton.style.display = 'block';
                    } else {
                        addNewButton.style.display = 'none';
                    }
                }

                function saveFilterState() {
                    var userTypeFilter = document.getElementById('userTypeFilter').value;
                    var statusFilter = document.getElementById('statusFilter').value;
                    var search = document.getElementById('nameSearch').value;
                    localStorage.setItem('userTypeFilter', userTypeFilter);
                    localStorage.setItem('statusFilter', statusFilter);
                    localStorage.setItem('nameSearch', search);
                }

                function loadFilterState() {
                    var userTypeFilter = localStorage.getItem('userTypeFilter');
                    var statusFilter = localStorage.getItem('statusFilter');
                    var search = localStorage.getItem('nameSearch');
                    if (userTypeFilter) {
                        document.getElementById('userTypeFilter').value = userTypeFilter;
                    }
                    if (statusFilter) {
                        document.getElementById('statusFilter').value = statusFilter;
                    }
                    if (search) {
                        document.getElementById('nameSearch').value = search;
                    }
                    filterUsers();
                }

                window.onload = loadFilterState;
            </script>

            <!-- Popup form -->
            <div id="popupForm" class="popup-form" style="display: <?php echo !empty($_SESSION['ac_createerror']) ? 'block' : 'none'; ?>;">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <div class="container">
                        <form action="index.php?url=useradd.php" method="post">
                            <h2>New Staff Member</h2>
                            <?php if (!empty($_SESSION['error'])): ?>
                                <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['ac_createerror']); ?></p>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name="fname" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name="lname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="usertype">User Type</label>
                                <input type="text" id="usertype" name="usertype" value="staff" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                function openPopup() {
                    document.getElementById('popupForm').style.display = 'block';
                }

                function closePopup() {
                    document.getElementById('popupForm').style.display = 'none';
                    window.location.href = 'index.php?url=manage_users.php';
                }
            </script>
        </div>
    </div>
</body>
</html>
