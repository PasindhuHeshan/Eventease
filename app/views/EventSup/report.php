<?php
// Assuming $userData contains the current user's information and $eventNo is the event being viewed
$eventNo = isset($_GET['eventNo']) ? (int)$_GET['eventNo'] : 0;

// Function to get event details
function getEventDetails($eventNo) {
    global $conn;
    
    $query = "SELECT e.*, u.fname, u.lname 
              FROM events e 
              LEFT JOIN users u ON e.supervisor = u.No 
              WHERE e.no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventNo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_object();
}

// Function to get management staff for an event
function getManagementStaff($eventNo) {
    global $conn;
    $staff = [];
    
    $query = "SELECT u.fname, u.lname, er.event_role 
              FROM event_members em 
              JOIN users u ON em.member_id = u.No 
              JOIN event_role er ON em.event_role_id = er.event_role_id 
              WHERE em.event_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventNo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $staff[] = (object)[
            'name' => trim($row['fname'] . ' ' . $row['lname']),
            'role' => $row['event_role']
        ];
    }
    
    return $staff;
}

// Function to get event statistics
function getEventStatistics($eventNo) {
    global $conn;
    $stats = [];
    
    // Get enrollment and participation
    $query = "SELECT 
                COUNT(*) as enrolled,
                SUM(CASE WHEN attendance_status = 1 THEN 1 ELSE 0 END) as participated
              FROM enroll 
              WHERE eventno = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stats['enrolled'] = $row['enrolled'];
    $stats['participated'] = $row['participated'];
    $stats['participation_percentage'] = $row['enrolled'] > 0 ? ($row['participated'] / $row['enrolled']) * 100 : 0;
    
    // Get average rating from event_review
    $query = "SELECT AVG(rating) as avg_rating, COUNT(*) as review_count 
              FROM event_review 
              WHERE event_no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stats['total_rating'] = $row['avg_rating'] ? round($row['avg_rating'], 1) : 0;
    $stats['reviews_count'] = $row['review_count'];
    
    // Get reach statistics
    $query = "SELECT people_limit FROM events WHERE no = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $eventNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stats['reached_audience'] = $stats['enrolled'];
    $stats['reach_percentage'] = $row['people_limit'] > 0 ? ($stats['enrolled'] / $row['people_limit']) * 100 : 0;
    
    return $stats;
}

$event = getEventDetails($eventNo);
$managementStaff = getManagementStaff($eventNo);
$statistics = getEventStatistics($eventNo);
$remarks = ''; // Would come from a database field if available
?>
<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <h2>Event Report: <?= htmlspecialchars($event->name) ?></h2>
    <div class="report">
        <h3>Event Details</h3>
        <div class="event-details">
            <p><strong>Date:</strong> <?= htmlspecialchars($event->date) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($event->time) ?></p>
            <p><strong>Venue:</strong> <?= htmlspecialchars($event->venue) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($event->type) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($event->description) ?></p>
            <p><strong>Supervisor:</strong> <?= htmlspecialchars($event->supervisor) ?></p>
            <p><strong>Participant Cap:</strong> <?= htmlspecialchars($event->participant_cap) ?></p>
            <p><strong>Target Audience:</strong> <?= htmlspecialchars($event->target_audience) ?></p>
        </div>
        
        <h3>Management Staff</h3>
        <ul>
            <?php foreach ($managementStaff as $staff): ?>
                <li><?= htmlspecialchars($staff->name) ?> - <?= htmlspecialchars($staff->role) ?></li>
            <?php endforeach; ?>
        </ul>
        
        <h3>Statistics</h3>
        <div class="statistics">
            <p><strong>Total Enrolled:</strong> <?= $statistics['enrolled'] ?></p>
            <p><strong>Total Participated:</strong> <?= $statistics['participated'] ?></p>
            <p><strong>Participation Percentage:</strong> <?= number_format($statistics['participation_percentage'], 2) ?>%</p>
            <p><strong>Total Rating:</strong> <?= number_format($statistics['total_rating'], 1) ?>/5 (from <?= $statistics['reviews_count'] ?> reviews)</p>
            <p><strong>Reached Audience:</strong> <?= $statistics['reached_audience'] ?></p>
            <p><strong>Total Reach Percentage:</strong> <?= number_format($statistics['reach_percentage'], 2) ?>%</p>
        </div>
        
        <h3>Additional Remarks</h3>
        <p><?= htmlspecialchars($remarks) ?></p>

        <div class="actions">
            <button type="button" class="btn primary">Edit</button>
            <break></break>
            <button type="button" class="btn primary">Export as pdf</button>
        </div>
    </div>
</div>