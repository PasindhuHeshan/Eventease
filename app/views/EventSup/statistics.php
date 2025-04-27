<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    
    <h2>Event Statistics</h2>
    <div class="statistics">
        <form>
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
            </div>
        </form>
    </div>
</div>