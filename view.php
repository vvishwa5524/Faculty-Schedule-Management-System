<?php
include 'connections.php'; // Include your DB connection
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$timeframe = $_POST['timeframe'] ?? 'week';
$startDate = null;
$endDate = null;

// Handle timeframe-based date filtering
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($timeframe) {
        case 'week':
            // Get the start and end date for the week
            $startDate = $_POST['start_date'] ?? date('Y-m-d', strtotime('-1 week'));
            $endDate = $_POST['end_date'] ?? date('Y-m-d');
            break;
        case 'month':
            // Get the selected month and year
            $month = $_POST['month'] ?? date('m');
            $year = $_POST['year'] ?? date('Y');
            $startDate = "$year-$month-01";
            $endDate = date('Y-m-t', strtotime($startDate)); // Last day of the selected month
            break;
        case 'year':
            // Get the selected year
            $year = $_POST['year'] ?? date('Y');
            $startDate = "$year-01-01";
            $endDate = "$year-12-31";
            break;
    }
}

// Fetch attendance records within the specified range
$query = "SELECT date, p1, p2, p3, p4, p5, p6, p7 
          FROM attendance 
          WHERE user_id = :user_id AND date BETWEEN :start_date AND :end_date
          ORDER BY date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id, 'start_date' => $startDate, 'end_date' => $endDate]);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>View Your Attendance</h1>

    <!-- Form to select timeframe -->
    <form method="post" action="">
        <label for="timeframe">Select Timeframe:</label>
        <select name="timeframe" id="timeframe" onchange="this.form.submit()">
            <option value="week" <?= $timeframe == 'week' ? 'selected' : '' ?>>Week</option>
            <option value="month" <?= $timeframe == 'month' ? 'selected' : '' ?>>Month</option>
            <option value="year" <?= $timeframe == 'year' ? 'selected' : '' ?>>Year</option>
        </select>

        <!-- Week timeframe -->
        <?php if ($timeframe == 'week'): ?>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($startDate) ?>">

            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($endDate) ?>">
        <?php endif; ?>

        <!-- Month timeframe -->
        <?php if ($timeframe == 'month'): ?>
            <label for="month">Select Month:</label>
            <select name="month" id="month">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>" <?= $month == $m ? 'selected' : '' ?>>
                        <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                    </option>
                <?php endfor; ?>
            </select>

            <label for="year">Select Year:</label>
            <input type="number" name="year" id="year" value="<?= htmlspecialchars($year) ?>" min="2000" max="<?= date('Y') ?>">
        <?php endif; ?>

        <!-- Year timeframe -->
        <?php if ($timeframe == 'year'): ?>
            <label for="year">Select Year:</label>
            <input type="number" name="year" id="year" value="<?= htmlspecialchars($year) ?>" min="2000" max="<?= date('Y') ?>">
        <?php endif; ?>

        <input type="submit" value="Filter">
    </form>

    <br>

    <!-- Display attendance records in a table -->
    <table border="1">
        <tr>
            <th>Date</th>
            <th>Period 1</th>
            <th>Period 2</th>
            <th>Period 3</th>
            <th>Period 4</th>
            <th>Period 5</th>
            <th>Period 6</th>
            <th>Period 7</th>
        </tr>

        <?php if ($records): ?>
            <?php foreach ($records as $record): ?>
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
                <td colspan="8">No attendance records found for the selected timeframe.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
