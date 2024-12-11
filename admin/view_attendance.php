<?php
include 'connections.php'; // Include your DB connection
session_start();

// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//     die("Access denied. Only admins can view this page.");
// }

if (!isset($_GET['user_id'])) {
    die("No user ID specified.");
}

$user_id = $_GET['user_id'];

// Fetch the teacher's name from the `teachers_list` table
$query = "SELECT Name FROM teachers_list WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$teacher) {
    die("Teacher not found.");
}

// Fetch attendance records for the teacher
$attendanceQuery = "SELECT date, p1, p2, p3, p4, p5, p6, p7 FROM attendance WHERE user_id = :user_id ORDER BY date DESC";
$attendanceStmt = $pdo->prepare($attendanceQuery);
$attendanceStmt->execute(['user_id' => $user_id]);
$attendanceRecords = $attendanceStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance - <?= htmlspecialchars($teacher['name']) ?></title>
    <link rel="stylesheet" href="css/table_list.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Attendance Records for <?= htmlspecialchars($teacher['Name']) ?></h1>

    <!-- Display attendance records in a table -->
    <div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <th>Date</th>
            <th>Period 1</th>
            <th>Period 2</th>
            <th>Period 3</th>
            <th>Period 4</th>
            <th>Period 5</th>
            <th>Period 6</th>
            <th>Period 7</th>
        </thead>

        <?php if ($attendanceRecords): ?>
            <?php foreach ($attendanceRecords as $record): ?>
                <tr>
                    <td><?= htmlspecialchars($record['date']) ?></td>
                    <td><?= htmlspecialchars($record['p1']) ?></td>
                    <td><?= htmlspecialchars($record['p2']) ?></td>
                    <td><?= htmlspecialchars($record['p3']) ?></td>
                    <td><?= htmlspecialchars($record['p4']) ?></td>
                    <td><?= htmlspecialchars($record['p5']) ?></td>
                    <td><?= htmlspecialchars($record['p6']) ?></td>
                    <td><?= htmlspecialchars($record['p7']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No attendance records found for this teacher.</td>
            </tr>
        <?php endif; ?>
    </table>
    </div>
</body>
</html>
