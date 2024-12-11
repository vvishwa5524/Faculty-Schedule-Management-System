<?php
session_start();
include 'connections.php'; // Include your DB connection

if (isset($_GET['day']) && isset($_SESSION['user_id'])) {
    $day1 = $_GET['day'];
    $user = $_SESSION['user_id'];
    // Prepare SQL statement to fetch schedule for a specific day and user_id
    $stmt = $pdo->prepare("SELECT p1,p2,p3,p4,p5,p6,p7 FROM timetable WHERE day_of_week = :day AND user_id = :us");
    $stmt->execute(['day' => $day1, 'us' => $user]);
    // Fetch the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Set the content type to JSON and output the results
    header('Content-Type: application/json');
    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode([]);
    }
} else {
    echo "Day or user ID not set";
}
?>
