<link rel="stylesheet" type="text/css" href="./css/global.css">

<style>
.event-sup-container {
    display: flex; /* Use flexbox for side-by-side layout */
    gap: 20px; /* Add spacing between the sidebar and content */
}

.sidebar {
    width: 250px; /* Fixed width for the sidebar */
    background-color: #87cefa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    flex-shrink: 0; /* Prevent the sidebar from shrinking */
}

.event-sup-content {
    flex: 1; /* Allow the content to take up the remaining space */
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
</style>

<div class="page">
    <div class="event-sup-container">
        <!-- Include Sidebar -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Eventease/app/views/partials/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="event-sup-content">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>