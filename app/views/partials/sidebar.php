<style>
.sidebar {
    width: 250px;
    background-color: #87cefa;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.sidebar-menu .nav {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
}
.sidebar-menu .nav:hover,
.sidebar-menu .nav.active {
    background-color: #0056b3;
}
</style>

<div class="sidebar">
    <div class="sidebar-menu">
        <a href="enrollment?no=<?= $no ?>" class="nav <?= basename($_SERVER['PHP_SELF']) == 'enrollment.php' ? 'active' : '' ?>">Enrollment</a>
        <a href="inquiry?no=<?= $no ?>" class="nav <?= basename($_SERVER['PHP_SELF']) == 'inquiry.php' ? 'active' : '' ?>">Inquiry</a>
        <a href="report?no=<?= $no ?>" class="nav <?= basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : '' ?>">Report</a>
        <a href="statistics?no=<?= $no ?>" class="nav <?= basename($_SERVER['PHP_SELF']) == 'statistics.php' ? 'active' : '' ?>">Statistics</a>
        <a href="review?no=<?= $no ?>" class="nav <?= basename($_SERVER['PHP_SELF']) == 'review.php' ? 'active' : '' ?>">Review</a>
    </div>
</div>