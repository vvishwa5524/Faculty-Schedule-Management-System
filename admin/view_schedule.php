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

// Fetch the timetable for the teacher
$scheduleQuery = "SELECT * FROM timetable WHERE user_id = :user_id";
$scheduleStmt = $pdo->prepare($scheduleQuery);
$scheduleStmt->execute(['user_id' => $user_id]);
$schedule = $scheduleStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule - <?= htmlspecialchars($teacher['name']) ?></title>
    <link rel="stylesheet" href="css/table_list.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Schedule for <?= htmlspecialchars($teacher['Name']) ?></h1>

    <!-- Display schedule in a table -->
    <div class="table-wrapper">
    <table class="fl-table">
        <thead>
            <th>Day</th>
            <th>Period 1</th>
            <th>Period 2</th>
            <th>Period 3</th>
            <th>Period 4</th>
            <th>Period 5</th>
            <th>Period 6</th>
            <th>Period 7</th>
        </thead>

        <?php if ($schedule): ?>
            <?php foreach ($schedule as $daySchedule): ?>
                <tr>
                    <td><?= htmlspecialchars($daySchedule['day_of_week']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p1']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p2']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p3']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p4']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p5']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p6']) ?></td>
                    <td><?= htmlspecialchars($daySchedule['p7']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No schedule found for this teacher.</td>
            </tr>
        <?php endif; ?>
    </table>
    </div>
</body>
</html>
