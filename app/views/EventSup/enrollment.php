<?php

$eventNo = isset($_GET['eventNo']) ? (int)$_GET['eventNo'] : 0;

// Handle attendance form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_attendance'])) {
    processAttendance();
}

// Function to get enrolled people for an event (with attendance status)
function getEnrolledPeople($eventNo) {
    global $conn;
    $enrolled = [];
    
    $query = "SELECT u.No, u.username, u.fname, u.lname, e.attendance_status
              FROM enroll e 
              JOIN users u ON e.username = u.username 
              WHERE e.eventno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventNo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $name = trim($row['fname'] . ' ' . $row['lname']);
        if (empty($name)) $name = $row['username'];
        $enrolled[] = [
            'id' => $row['No'],
            'name' => $name,
            'username' => $row['username'],
            'attendance_status' => $row['attendance_status']
        ];
    }
    
    return $enrolled;
}

// Function to process attendance submission
function processAttendance() {
    global $conn;

    $eventNo = isset($_POST['eventNo']) ? (int)$_POST['eventNo'] : 0;
    $attendance = isset($_POST['attendance']) ? $_POST['attendance'] : [];

    if ($eventNo > 0) {
        // Reset all to 0 first
        $updateAll = "UPDATE enroll SET attendance_status = 0 WHERE eventno = ?";
        $stmt = $conn->prepare($updateAll);
        $stmt->bind_param("i", $eventNo);
        $stmt->execute();

        // Set 1 for selected attendees
        if (!empty($attendance)) {
            $placeholders = implode(',', array_fill(0, count($attendance), '?'));
            $types = str_repeat('i', count($attendance) + 1);
            $values = array_merge([$eventNo], $attendance);

            $query = "UPDATE enroll SET attendance_status = 1 
                      WHERE eventno = ? AND username IN (
                          SELECT username FROM users WHERE No IN ($placeholders)
                      )";
            $stmt = $conn->prepare($query);
            $stmt->bind_param($types, ...$values);
            $stmt->execute();
        }

        $_SESSION['success_message'] = "Attendance updated successfully!";
        header("Location: enrollment.php?eventNo=" . $eventNo);
        exit;
    } else {
        echo "Invalid event number.";
    }
}

$enrolled_people = getEnrolledPeople($eventNo);
?>

<link rel="stylesheet" type="text/css" href="./css/global.css">

<div class="page">
    <h2>Event Enrollment and Attendance</h2>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert success">
            <?= htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

    <div class="search-bar">
        <input type="text" id="search" placeholder="Search for names..." onkeyup="filterNames()">
    </div>

    <script>
        function filterNames() {
            var input, filter, ol, li, label, i, txtValue;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            ol = document.querySelector('.form-group ol');
            li = ol.getElementsByTagName('li');
            for (i = 0; i < li.length; i++) {
                label = li[i].getElementsByTagName("label")[0];
                txtValue = label.textContent || label.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>

    <div class="enrollment">
        <form action="enrollment.php?eventNo=<?= $eventNo ?>" method="post">
            <input type="hidden" name="eventNo" value="<?= $eventNo ?>">
            <div class="form-group">
                <ol>
                    <?php foreach ($enrolled_people as $person): ?>
                        <li>
                            <label for="attendee_<?= $person['id'] ?>"><?= htmlspecialchars($person['name']) ?></label>
                            <input 
                                type="checkbox" 
                                id="attendee_<?= $person['id'] ?>" 
                                name="attendance[]" 
                                value="<?= $person['id'] ?>"
                                <?= $person['attendance_status'] == 1 ? 'checked' : '' ?>
                            >
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
            <button type="submit" name="submit_attendance" class="btn primary">Submit Attendance</button>
        </form>
    </div>
</div>
