<?php
// Include header for the common navigation bar
include('common/header.php');
?>

<!-- Notifications Section -->
<section id="notifications" class="notifications-section">
    <div class="container">
        <h2 class="section-title text-center">Notifications</h2>

        <?php
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "<p>You need to be logged in to view notifications.</p>";
        } else {
            // Fetch notifications for the logged-in user
            $notificationController = new NotificationController();
            $notifications = $notificationController->getUserNotifications($_SESSION['user_id']);
            
            if (count($notifications) > 0) {
                echo '<ul class="notification-list">';
                foreach ($notifications as $notification) {
                    $readClass = $notification['is_read'] ? 'read' : 'unread';
                    echo "<li class='notification-item $readClass'>";
                    echo "<p>{$notification['message']}</p>";
                    echo "<small>Received: {$notification['created_at']}</small>";
                    if (!$notification['is_read']) {
                        echo "<a href='/controller/NotificationController.php?action=markAsRead&id={$notification['id']}' class='mark-read'>Mark as Read</a>";
                    }
                    echo "</li>";
                }
                echo '</ul>';
            } else {
                echo "<p>No notifications at the moment.</p>";
            }
        }
        ?>

    </div>
</section>

<?php
// Include footer for common footer content
include('common/footer.php');
?>
