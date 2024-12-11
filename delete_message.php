<?php
include 'connections.php'; // Include your DB connection
session_start();

// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'teacher') {
//     die("Access denied. Only teachers can delete messages.");
// }

$user_id = $_SESSION['user_id'];

if (!isset($_GET['message_id'])) {
    die("No message ID specified.");
}

$message_id = $_GET['message_id'];

// Verify that the message belongs to the logged-in teacher
$verifyQuery = "SELECT message_id FROM messages WHERE message_id = :message_id AND receiver_id = :user_id";
$verifyStmt = $pdo->prepare($verifyQuery);
$verifyStmt->execute(['message_id' => $message_id, 'user_id' => $user_id]);
$message = $verifyStmt->fetch(PDO::FETCH_ASSOC);

if (!$message) {
    die("Message not found or you do not have permission to delete this message.");
}

// Delete the message
$deleteQuery = "DELETE FROM messages WHERE message_id = :message_id";
$deleteStmt = $pdo->prepare($deleteQuery);
$deleteStmt->execute(['message_id' => $message_id]);

echo "Message deleted successfully.";
header("Location: view_messages.php");
exit();
