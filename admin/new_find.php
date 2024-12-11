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
        $dayOfWeek = date('l', strtotime($date));
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
    <link rel="stylesheet" href="css/table_list.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .col{
            padding: 10px;
        }
    </style>
    <script>
        function updateDayFromDate() {
            const dateInput = document.getElementById('date');
            const daySelect = document.getElementById('day');

            if (dateInput.value) {
                const selectedDate = new Date(dateInput.value);
                const dayName = selectedDate.toLocaleDateString('en-US', { weekday: 'long' });

                // Set the day dropdown based on the selected date
                for (let option of daySelect.options) {
                    if (option.value === dayName) {
                        option.selected = true;
                        break;
                    }
                }

                // Hide the day dropdown when a date is selected
                daySelect.disabled = true;
            } else {
                daySelect.disabled = false; // Enable day select if no date is selected
            }
        }

        function toggleDateAndDayInput() {
            const daySelect = document.getElementById('day');
            const dateInput = document.getElementById('date');

            if (daySelect.value) {
                dateInput.value = ''; // Clear date input if day is selected
                dateInput.disabled = true; // Disable date input
            } else {
                dateInput.disabled = false; // Enable date input if no day is selected
            }
        }
    </script>
</head>
<body>
    <h1>Find Empty Periods</h1>
    <form method="post" action="">

        <div class="container">
        <div class="row">
        <div class="col">
        <p class="label-title"><label for="day">Select Day:</label></p class="label-title">
        <select name="day" id="day" onchange="toggleDateAndDayInput()">
            <option value="">-- Select Day --</option>
            <?php foreach (["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"] as $d): ?>
                <option value="<?= $d ?>" <?= $day == $d ? 'selected' : '' ?>><?= $d ?></option>
            <?php endforeach; ?>
        </select>
        </div>


        <div class="col">
        <p class="label-title"><label for="date">Select Date:</label></p class="label-title">
        <input type="date" name="date" id="date" value="<?= htmlspecialchars($date) ?>" onchange="updateDayFromDate()">
        </div>
        </div>
        
        <div class="row">
        <div class="col">
        <p class="label-title"><label for="teacher_id">Select Teacher:</label></p class="label-title">
        <select name="teacher_id" id="teacher_id">
            <option value="">-- Select Teacher --</option>
            <?php foreach ($teachers as $teacher): ?>
                <option value="<?= $teacher['user_id'] ?>" <?= $teacher_id == $teacher['user_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($teacher['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        </div>
        
        <div class="col">
        <p class="label-title"><label for="period">Select Period:</label></p class="label-title">
        <select name="period" id="period">
            <option value="">-- Any Period --</option>
            <?php for ($i = 1; $i <= 7; $i++): ?>
                <option value="p<?= $i ?>" <?= $period == "p$i" ? 'selected' : '' ?>>Period <?= $i ?></option>
            <?php endfor; ?>
        </select>
        </div>
        </div>
        <div class="row">
        <div class="col">   
        <input type="submit" value="Find Empty Periods" class="button-68">
        </div>
        </div>
        </div>
    </form>

    <br>

    <!-- Display Results -->
    <?php if ($results): ?>
        <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <th>Teacher Name</th>
                <th>Day</th>
                <?php if ($period): ?>
                    <th><?= ucfirst($period) ?></th>
                <?php else: ?>
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        <th>Period <?= $i ?></th>
                    <?php endfor; ?>
                <?php endif; ?>
            </thead>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
