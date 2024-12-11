<?php
include 'connections.php'; // Include your DB connection
session_start();

// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//     die("Access denied. Only admins can view this page.");
// }

// Fetch list of teachers for dropdown
$teacherQuery = "SELECT user_id, Name FROM teachers_list ORDER BY user_id";
$teacherStmt = $pdo->prepare($teacherQuery);
$teacherStmt->execute();
$teachers = $teacherStmt->fetchAll(PDO::FETCH_ASSOC);

$results = [];
$day = $teacher_id = $period = $date = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $day = $_POST['day'] ?? null;
    $date = $_POST['date'] ?? null;
    $teacher_id = $_POST['teacher_id'] ?? null;
    $period = $_POST['period'] ?? null;

    // Building the query based on selected options
    $query = "SELECT t.user_id, tl.Name, t.day_of_week, t.p1, t.p2, t.p3, t.p4, t.p5, t.p6, t.p7 
              FROM timetable t
              JOIN teachers_list tl ON t.user_id = tl.user_id
              WHERE 1=1"; // Dummy condition for appending other conditions easily

    $params = [];

    // Apply filters based on selected fields
    if ($day) {
        $query .= " AND t.day_of_week = :day";
        $params['day'] = $day;
    }
    if ($date) {
        $query .= " AND t.date = :date";
        $params['date'] = $date;
    }
    if ($teacher_id) {
        $query .= " AND t.user_id = :teacher_id";
        $params['teacher_id'] = $teacher_id;
    }

    // Check specific period if selected
    if ($period) {
        $query .= " AND t.$period IS NULL";
    } else {
        // If no specific period is selected, check if any period is null
        $query .= " AND (t.p1 IS NULL OR t.p2 IS NULL OR t.p3 IS NULL OR t.p4 IS NULL OR t.p5 IS NULL OR t.p6 IS NULL OR t.p7 IS NULL)";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Empty Periods</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Find Empty Periods</h1>

    <form method="post" action="">
        <label for="day">Select Day:</label>
        <select name="day" id="day">
            <option value="">-- Select Day --</option>
            <?php foreach (["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"] as $d): ?>
                <option value="<?= $d ?>" <?= $day == $d ? 'selected' : '' ?>><?= $d ?></option>
            <?php endforeach; ?>
        </select>

        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" value="<?= htmlspecialchars($date) ?>">

        <label for="teacher_id">Select Teacher:</label>
        <select name="teacher_id" id="teacher_id">
            <option value="">-- Select Teacher --</option>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['user_id'] ?>" <?= $teacher_id == $teacher['user_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($teacher['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="period">Select Period:</label>
        <select name="period" id="period">
            <option value="">-- Any Period --</option>
            <?php for ($i = 1; $i <= 7; $i++): ?>
                <option value="p<?= $i ?>" <?= $period == "p$i" ? 'selected' : '' ?>>Period <?= $i ?></option>
            <?php endfor; ?>
        </select>

        <input type="submit" value="Find Empty Periods">
    </form>

    <br>

    <!-- Display Results -->
    <?php if ($results): ?>
        <table border="1">
            <tr>
                <th>Teacher Name</th>
                <th>Day</th>
                <th>Period 1</th>
                <th>Period 2</th>
                <th>Period 3</th>
                <th>Period 4</th>
                <th>Period 5</th>
                <th>Period 6</th>
                <th>Period 7</th>
            </tr>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= htmlspecialchars($result['Name']) ?></td>
                    <td><?= htmlspecialchars($result['day_of_week']) ?></td>
                    <td><?= $result['p1'] ?? 'Empty' ?></td>
                    <td><?= $result['p2'] ?? 'Empty' ?></td>
                    <td><?= $result['p3'] ?? 'Empty' ?></td>
                    <td><?= $result['p4'] ?? 'Empty' ?></td>
                    <td><?= $result['p5'] ?? 'Empty' ?></td>
                    <td><?= $result['p6'] ?? 'Empty' ?></td>
                    <td><?= $result['p7'] ?? 'Empty' ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No matching results found.</p>
    <?php endif; ?>
</body>
</html>
