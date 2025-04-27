<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <?php
    // Assuming $eventNo is passed via GET
    $eventNo = isset($_GET['eventNo']) ? (int)$_GET['eventNo'] : 0;

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
        $query = "SELECT AVG(rating) as avg_rating 
                  FROM event_review 
                  WHERE event_no = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $eventNo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $stats['total_rating'] = $row['avg_rating'] ? round($row['avg_rating'], 1) : 0;
        
        // Get reach statistics
        $query = "SELECT people_limit FROM events WHERE no = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $eventNo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $stats['target_audience'] = $row['people_limit'];
        $stats['reached_audience'] = $stats['enrolled'];
        $stats['reach_percentage'] = $row['people_limit'] > 0 ? ($stats['enrolled'] / $row['people_limit']) * 100 : 0;
        
        return $stats;
    }

    $data = getEventStatistics($eventNo);
    ?>
    <h2>Event Statistics</h2>
    <div class="statistics">
        <form action="" method="post">
            <div class="statistics-container">
                <div class="stat-item">
                    <label>Total Enrolled:</label>
                    <span><?= $data['enrolled'] ?></span>
                </div>
                <div class="stat-item">
                    <label>Total Participated:</label>
                    <span><?= $data['participated'] ?></span>
                </div>
                <div class="stat-item">
                    <label>Participation Percentage:</label>
                    <span><?= number_format($data['participation_percentage'], 2) ?>%</span>
                </div>
                <div class="stat-item">
                    <label>Total Rating:</label>
                    <span><?= $data['total_rating'] ?></span>
                </div>
                <div class="stat-item">
                    <label>Target Audience:</label>
                   <span><?= $data['target_audience'] ?></span>
                </div>
                <div class="stat-item">
                    <label>Reached Audience:</label>
                    <span><?= $data['reached_audience'] ?></span>
                </div>
                <div class="stat-item">
                    <label>Total Reach Percentage:</label>
                    <span><?= number_format($data['reach_percentage'], 2) ?>%</span>
                </div>
                <button type="submit" class="btn primary">Forward</button>
            </div>
        </form>
    </div>
</div>