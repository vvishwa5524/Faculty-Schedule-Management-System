<?php
include 'connections.php'; // Include your DB connection
session_start();

// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//     die("Access denied. Only admins can view this page.");
// }

// Fetch list of teachers for the dropdown
$teacherQuery = "SELECT user_id, name FROM teachers_list ORDER BY name";
$teacherStmt = $pdo->prepare($teacherQuery);
$teacherStmt->execute();
$teachers = $teacherStmt->fetchAll(PDO::FETCH_ASSOC);

$user_id = null;
$teacher = null;
$schedule = [];

// Check if a user has been selected
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // Fetch the teacher's name based on the selected user_id
    $nameQuery = "SELECT name FROM teachers_list WHERE user_id = :user_id";
    $nameStmt = $pdo->prepare($nameQuery);
    $nameStmt->execute(['user_id' => $user_id]);
    $teacher = $nameStmt->fetch(PDO::FETCH_ASSOC);

    if ($teacher) {
        // Fetch the timetable for the selected teacher
        $scheduleQuery = "SELECT * FROM timetable WHERE user_id = :user_id ";
        $scheduleStmt = $pdo->prepare($scheduleQuery);
        $scheduleStmt->execute(['user_id' => $user_id]);
        $schedule = $scheduleStmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "No teacher found with the specified user ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule - Admin</title>
    <link rel="stylesheet" href="css/table_list.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>View Teacher's Schedule</h1>

    <!-- Form to select a teacher -->
     <div class="width-full">
    <form method="post" action="" class="form-center">
        <h2><label for="user_id">Select Teacher:</label></h2>
        <select name="user_id" id="user_id" required>
            <option value="">-- Select a Teacher --</option>
            <?php foreach ($teachers as $teacherOption): ?>
                <option value="<?= htmlspecialchars($teacherOption['user_id']) ?>" <?= $user_id == $teacherOption['user_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($teacherOption['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="View Schedule" class="button-68">
    </form>
    </div>

    <?php if ($teacher && $schedule): ?>
        <h1>Schedule for <?= htmlspecialchars($teacher['name']) ?></h1>

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
        </table>
        </div>
    <?php elseif ($teacher): ?>
        <p>No schedule found for <?= htmlspecialchars($teacher['name']) ?>.</p>
    <?php endif; ?>
</body>
</html>
