<?php
include 'connections.php'; // Include your DB connection
session_start();

// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'teacher') {
//     die("Access denied. Only teachers can view messages.");
// }

$user_id = $_SESSION['user_id'];

// Fetch messages sent to the logged-in teacher
$query = "SELECT * from messages where receiver_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages</title>
</head>
<body>
    <h1>Your Messages</h1>

    <?php if ($messages): ?>
        <table border="1">
            <tr>
                <th>Sender</th>
                <th>Sender Name</th>
                <th>Message</th>
                <th>Sent At</th>
                <th>Action</th>
            </tr>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= htmlspecialchars($message['sender_id']) ?></td>
                    <td><?= htmlspecialchars($message['sender_name']) ?></td>
                    <td><?= htmlspecialchars($message['message']) ?></td>
                    <td><?= htmlspecialchars($message['sent_at']) ?></td>
                    <td>
                        <a href="delete_message.php?message_id=<?= urlencode($message['message_id']) ?>" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</body>
</html>
