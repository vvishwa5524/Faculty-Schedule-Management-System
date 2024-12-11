<?php
include 'connections.php'; // Include your DB connection
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['Name'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];
$name = $_SESSION['Name'];

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Fetch existing record
    $fetchQuery = "SELECT p1, p2, p3, p4, p5, p6, p7 FROM attendance WHERE date = :date AND user_id = :user_id";
    $stmt = $pdo->prepare($fetchQuery);
    $stmt->execute(['date' => $date, 'user_id' => $user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die("No record found for the specified date.");
    }
} else {
    die("No date specified.");
}
?>

<!-- Display the form with fetched data -->
<form method="post">
    Date: <input type="date" name="date" value="<?php echo htmlspecialchars($date); ?>" readonly><br>

    Period 1: <input type="text" name="period1" value="<?php echo htmlspecialchars($row['p1']); ?>"><br>
    Period 2: <input type="text" name="period2" value="<?php echo htmlspecialchars($row['p2']); ?>"><br>
    Period 3: <input type="text" name="period3" value="<?php echo htmlspecialchars($row['p3']); ?>"><br>
    Period 4: <input type="text" name="period4" value="<?php echo htmlspecialchars($row['p4']); ?>"><br>
    Period 5: <input type="text" name="period5" value="<?php echo htmlspecialchars($row['p5']); ?>"><br>
    Period 6: <input type="text" name="period6" value="<?php echo htmlspecialchars($row['p6']); ?>"><br>
    Period 7: <input type="text" name="period7" value="<?php echo htmlspecialchars($row['p7']); ?>"><br>

    <input type="submit" value="Update">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $period1 = $_POST['period1'];
    $period2 = $_POST['period2'];
    $period3 = $_POST['period3'];
    $period4 = $_POST['period4'];
    $period5 = $_POST['period5'];
    $period6 = $_POST['period6'];
    $period7 = $_POST['period7'];

    // Prepare update query
    $updateQuery = "
        UPDATE attendance
        SET p1 = :period1,
            p2 = :period2,
            p3 = :period3,
            p4 = :period4,
            p5 = :period5,
            p6 = :period6,
            p7 = :period7
        WHERE date = :date AND user_id = :user_id";
    $stmt = $pdo->prepare($updateQuery);

    $params = [
        'period1' => $period1,
        'period2' => $period2,
        'period3' => $period3,
        'period4' => $period4,
        'period5' => $period5,
        'period6' => $period6,
        'period7' => $period7,
        'date' => $date,
        'user_id' => $user_id
    ];

    if ($stmt->execute($params)) {
        echo "Record updated successfully.";
    } else {
        echo "Error: Unable to update record.";
    }
}
?>
