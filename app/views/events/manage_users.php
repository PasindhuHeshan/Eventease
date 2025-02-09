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
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-section">
                <div class="profile-icon">
                <img src="./images/adminlogo.png" alt="Profile">
                </div>
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li class="active">Manage Users</li>
                <li><a href="manageevent.php">Approve Events</a></li>
                <li><a href="inventory.php">Manage Inventory</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
          
            <h2>Users</h2>

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Users</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 0;
                            padding: 0;
                            background-color: #f4f4f4;
                        }

                        table {
                            border-collapse: separate;
                            border-spacing: 0;
                            width: 100%;
                            border: 1px solid #ddd;
                            border-radius: 10px;
                            overflow: hidden;
                        }

                        table, th, td {
                            border: 1px solid #ddd;
                        }

                        th, td {
                            padding: 10px;
                            text-align: left;
                        }

                        button {
                            padding: 5px 10px;
                            width: 80px;
                            border-radius: 10px;
                            background-color: white;
                            cursor: pointer;
                        }

                        button:hover {
                            background-color: skyblue;
                            color: white;
                        }

                        button:disabled {
                            background-color: gray;
                            cursor: not-allowed;
                        }

                        #addNewButton {
                            margin: 10px 0;
                        }
                    </style>
                </head>
                <body>
                    <div>
                        <label for="userTypeFilter">Filter by User Type:</label>
                        <select id="userTypeFilter" onchange="filterUsers()">
                            <option value="all">All</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                            <option value="organizer">Organizer</option>
                            <option value="support">Support</option>
                            <option value="guest">Guest</option>
                            <option value="student">Student</option>
                        </select>
                        <label for="nameSearch">Search by Name:</label>
                        <input type="text" id="nameSearch" onkeyup="filterUsers()" placeholder="Search for names..">
                    </div>
                    <table id="usersTable">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action(Enable/Disable)</th>
                        </tr>
                        <?php
                        $result = $dashboard->getUsers();
                        if (is_array($result) && count($result) > 0) {
                            // Output data of each row
                            foreach ($result as $row) {
                                // Determine the button text based on user status
                                $buttonText = $row['status'] == 1 ? 'Disable' : 'Enable';
                                $status = $row['status']; // Save current status for the toggle action
                                echo "<tr data-user-type='" . htmlspecialchars($row['usertype']) . "' data-name='" . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . "'>";
                                echo "<td>" . htmlspecialchars($row['fname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>
                                    <form method='post' action='index.php?url=changestatus' onsubmit='saveFilterState()'>
                                        <input type='hidden' name='No' value='" . htmlspecialchars($row['No']) . "'>
                                        <input type='hidden' name='status' value='" . htmlspecialchars($status == 1 ? 0 : 1) . "'>
                                        <button type='submit'>" . htmlspecialchars($buttonText) . "</button>
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
                            var filter = document.getElementById('userTypeFilter').value;
                            var search = document.getElementById('nameSearch').value.toLowerCase();
                            var rows = document.querySelectorAll('#usersTable tr[data-user-type]');
                            rows.forEach(function(row) {
                                var userType = row.getAttribute('data-user-type');
                                var name = row.getAttribute('data-name').toLowerCase();
                                if ((filter === 'all' || userType === filter) && (name.includes(search))) {
                                    row.style.display = '';
                                } else {
                                    row.style.display = 'none';
                                }
                            });
                            // Show or hide the Add New button based on the filter
                            var addNewButton = document.getElementById('addNewButton');
                            if (filter === 'staff') {
                                addNewButton.style.display = 'block';
                            } else {
                                addNewButton.style.display = 'none';
                            }
                        }

                        function saveFilterState() {
                            var filter = document.getElementById('userTypeFilter').value;
                            var search = document.getElementById('nameSearch').value;
                            localStorage.setItem('userTypeFilter', filter);
                            localStorage.setItem('nameSearch', search);
                        }

                        function loadFilterState() {
                            var filter = localStorage.getItem('userTypeFilter');
                            var search = localStorage.getItem('nameSearch');
                            if (filter) {
                                document.getElementById('userTypeFilter').value = filter;
                            }
                            if (search) {
                                document.getElementById('nameSearch').value = search;
                            }
                            filterUsers();
                        }

                        window.onload = loadFilterState;
                    </script>

                    <!-- Popup form -->
                    <div id="popupForm" class="popup-form" style="display: <?php echo !empty($_SESSION['error']) ? 'block' : 'none'; ?>;">
                        <div class="popup-content">
                            <span class="close" onclick="closePopup()">&times;</span>
                            <div class="container">
                                <form action="index.php?url=useradd.php" method="post">
                                    <h2>New Staff Member</h2>
                                    <?php if (!empty($_SESSION['error'])): ?>
                                        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
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

           
            <!-- <h2>User role requests</h2>
            <iframe src="role_requests.php" class="iframe-section"></iframe> -->
        </div>
    </div>
</body>
</html>
