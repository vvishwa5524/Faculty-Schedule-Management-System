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

    // Base query for finding empty periods
    $query = "SELECT t.user_id, tl.Name, t.day_of_week";
    $periodConditions = []; // To build dynamic period conditions
    $params = []; // To bind parameters

    // Check specific period if selected, otherwise check all periods
    if ($period) {
        $query .= ", t.$period AS empty_period";
        $periodConditions[] = "t.$period IS NULL";
    } else {
        for ($i = 1; $i <= 7; $i++) {
            $query .= ", t.p$i";
            $periodConditions[] = "t.p$i IS NULL";
        }
    }

    // Complete query with join and base conditions
    $query .= " FROM timetable t
                JOIN teachers_list tl ON t.user_id = tl.user_id
                WHERE 1=1";

    // Add filters
    if ($day) {
        $query .= " AND t.day_of_week = :day";
        $params['day'] = $day;
    }
    if ($date) {
        $dayOfWeek = date('l',strtotime($date));
        $query .= " AND t.day_of_week = :day";
        $params['day'] = $dayOfWeek;
    }
    if ($teacher_id) {
        $query .= " AND t.user_id = :teacher_id";
        $params['teacher_id'] = $teacher_id;
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
                <?php if ($period): ?>
                    <th><?= ucfirst($period) ?></th>
                <?php else: ?>
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        <th>Period <?= $i ?></th>
                    <?php endfor; ?>
                <?php endif; ?>
            </tr>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td><?= htmlspecialchars($result['Name']) ?></td>
                    <td><?= htmlspecialchars($result['day_of_week']) ?></td>
                    <?php if ($period): ?>
                        <td>Empty</td>
                    <?php else: ?>
                        <?php for ($i = 1; $i <= 7; $i++): ?>
                            <td><?= $result["p$i"] === null ? 'Empty' : '' ?></td>
                        <?php endfor; ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No matching results found.</p>
    <?php endif; ?>
</body>
</html>
