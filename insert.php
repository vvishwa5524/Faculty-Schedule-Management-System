
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Schedule</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <script>
       function updateForm() {
    const dateInput = document.querySelector('input[name="date"]');
    const daySelect = document.querySelector('select[name="day"]');
    const selectedDate = new Date(dateInput.value);
    const options = { weekday: 'long' };
    const dayName = selectedDate.toLocaleDateString('en-US', options);
    daySelect.value = dayName;

    // Fetch data from weekly_schedules based on selected day
    fetch(`get_schedule.php?day=${dayName}`)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                const schedule = data[0]; // Access the first object in the array
                document.querySelector('input[name="period1"]').value = schedule.p1 || '';
                document.querySelector('input[name="period2"]').value = schedule.p2 || '';
                document.querySelector('input[name="period3"]').value = schedule.p3 || '';
                document.querySelector('input[name="period4"]').value = schedule.p4 || '';
                document.querySelector('input[name="period5"]').value = schedule.p5 || '';
                document.querySelector('input[name="period6"]').value = schedule.p6 || '';
                document.querySelector('input[name="period7"]').value = schedule.p7 || '';
            } else {
                alert("No data found for the selected day.");
            }
        })
        .catch(error => console.error('Error fetching schedule:', error));
}


        function setSchedule(value) {
            const periods = ['period1', 'period2', 'period3', 'period4', 'period5', 'period6', 'period7'];
            periods.forEach(period => {
                document.querySelector(`input[name="${period}"]`).value = value;
            });
        }
    </script>
</head>
<body>

<div class="container">
    <div class="sidebar">
        <h2>Dashboard Menu</h2>
        <ul>
            <li><a href="insert.php">Insert Schedule</a></li>
            <li><a href="update.php">Update Schedule</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Insert Schedule</h1>

        <?php
include 'connections.php'; // Include your DB connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // Retrieve user_id from session
    $name = $_SESSION['Name']; // Retrieve Name from session
    $date = $_POST['date'];
    $day = $_POST['day'];
    $period1 = $_POST['period1'];
    $period2 = $_POST['period2'];
    $period3 = $_POST['period3'];
    $period4 = $_POST['period4'];
    $period5 = $_POST['period5'];
    $period6 = $_POST['period6'];
    $period7 = $_POST['period7'];

    // Check if the record already exists
    $checkQuery = "SELECT COUNT(*) FROM attendance WHERE date = :date AND user_id = :user_id";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->execute(['date' => $date, 'user_id' => $user_id]);
    $recordExists = $stmt->fetchColumn() > 0;

    if ($recordExists) {
        echo "<script>alert('Record already exists. Redirecting to update page.'); window.location.href='update.php?date=$date';</script>";
        exit();
    } else {
        // Insert new record with placeholders
        $insertQuery = "INSERT INTO attendance (log_id,user_id, Name, date, p1, p2, p3, p4, p5, p6, p7) 
                        VALUES (:user_id, :user_id,:name, :date, :period1, :period2, :period3, :period4, :period5, :period6, :period7)";
        $stmt = $pdo->prepare($insertQuery);

        // Bind parameters for the insert statement
        $params = [
            'user_id' => $user_id,
            'name' => $name,
            'date' => $date,
            'day' => $day,
            'period1' => $period1,
            'period2' => $period2,
            'period3' => $period3,
            'period4' => $period4,
            'period5' => $period5,
            'period6' => $period6,
            'period7' => $period7
        ];

        if ($stmt->execute($params)) {
            echo "New record created successfully";
        } else {
            echo "Error: Unable to create record.";
        }
    }
}
?>

        <form method="post">
            Date: <input type="date" name="date" required onchange="updateForm()"><br>
            Day:
            <select name="day" required>
                <option value="">Select Day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select><br>

            Period 1: <input type="text" name="period1"><br>
            Period 2: <input type="text" name="period2"><br>
            Period 3: <input type="text" name="period3"><br>
            Period 4: <input type="text" name="period4"><br>
            Period 5: <input type="text" name="period5"><br>
            Period 6: <input type="text" name="period6"><br>
            Period 7: <input type="text" name="period7"><br>

            <!-- Dropdown for schedule types -->
            <label for='scheduleType'>Select Schedule Type:</label>
            <select id='scheduleType' onchange='setSchedule(this.value)'>
                <option value=''>-- Select --</option>
                <option value='Holiday'>Holiday</option>
                <option value='Leave'>Leave</option>
                <option value='Internal Exams'>Internal Exams</option>
                <option value='External Exams'>External Exams</option>
                <option value='Internal Lab Exams'>Internal Lab Exams</option>
                <option value='External Lab Exams'>External Lab Exams</option> <!-- This was repeated, corrected it -->
            </select>

            <br><br> <!-- Add some space before submit -->
            
            <input type='submit' value='Submit'>
        </form>

    </div> <!-- End of main-content -->
</div> <!-- End of container -->
</body>
</html>