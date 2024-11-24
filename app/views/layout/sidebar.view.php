<?php
    if (!isset($navigation)) {
        $navigation = 'Home';
    }
?>

<div class="sidebar">
    <div class="sidebar-menu">
        <a class="nav <?= $navigation == "My Events" ? "active" : "" ?>" href="<?=BASE_URL ?>/events/myevents">
            My Events
        </a>
        <a class="nav <?= $navigation == "Event Staff" ? "active" : "" ?>" href="<?=BASE_URL ?>/events/myevents">
            Event Staff
        </a>
        <a class="nav <?= $navigation == "Settings" ? "active" : "" ?>" href="<?=BASE_URL ?>/events/myevents">
            Settings
        </a>
    </div>
</div>