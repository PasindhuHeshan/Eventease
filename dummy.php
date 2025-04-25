<?php if (!empty($message['user_msg'])): ?>
    <div class="<?php echo $userData['usertype'] == 0 ? 'user-message' : 'admin-reply'; ?>">
        <?php echo htmlspecialchars($message['user_msg']); ?>
    </div>
<?php endif; ?>
<?php if (!empty($message['admin_msg'])): ?>
    <div class="<?php echo $userData['usertype'] == 0 ? 'admin-reply' : 'user-message'; ?>">
        <?php echo htmlspecialchars($message['admin_msg']); ?>
    </div>
<?php endif; ?>