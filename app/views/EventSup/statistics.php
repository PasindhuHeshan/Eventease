<link rel="stylesheet" type="text/css" href="global.css">
<div class="page">
    <?php 
    $data['enrolled'] = 100;
    $data['participated'] = 80;
    $data['participation_percentage'] = ($data['participated'] / $data['enrolled']) * 100;
    $data['total_rating'] = 4.5;
    $data['target_audience'] = 200;
    $data['reached_audience'] = 150;
    $data['reach_percentage'] = ($data['reached_audience'] / $data['target_audience']) * 100;
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