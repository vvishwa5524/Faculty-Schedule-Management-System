<?php
include 'connections.php'; // Include your DB connection
session_start();

// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//     die("Access denied. Only admins can send messages.");
// }

if (!isset($_GET['user_id'])) {
    die("No user ID specified.");
}

$user_id = $_GET['user_id'];
$sender_name = $_SESSION['Name'];

// Fetch the teacher's name
$query = "SELECT Name FROM teachers_list WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['user_id' => $user_id]);
$teacher = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$teacher) {
    die("Teacher not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Insert the message into the messages table
    $insertQuery = "INSERT INTO messages (sender_id,sender_name,receiver_id, message, sent_at) VALUES (:sender_id,:sname, :receiver_id, :message, NOW())";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([
        'sender_id' => $_SESSION['user_id'], // Admin's user_id
        'sname'=>$sender_name,
        'receiver_id' => $user_id,
        'message' => $message
    ]);

    echo "Message sent successfully to " . htmlspecialchars($teacher['Name']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message to <?= htmlspecialchars($teacher['Name']) ?></title>
    <style>
        /* Basic reset for margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Center the entire page content */
body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f9; /* Soft background color */
    color: #333; /* Primary text color */
}

/* Header styling */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #444;
    text-align: center;
}

/* Form container styling */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    max-width: 400px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Label styling */
label {
    font-size: 16px;
    margin-bottom: 8px;
    color: #555;
}

/* Textarea styling */
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    resize: vertical;
    margin-bottom: 15px;
}

/* Submit button styling */
input[type="submit"] {
    padding: 10px 20px;
    border: none;
    background-color: #4CAF50; /* Button background color */
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Link styling */
a {
    color: #4CAF50;
    text-decoration: none;
    font-size: 14px;
    margin-top: 25px;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <h1>Send Message to <?= htmlspecialchars($teacher['Name']) ?></h1>

    <form method="post" action="">
        <label for="message">Message:</label><br>
        <textarea name="message" id="message" rows="5" cols="50" required></textarea><br><br>
        <input type="submit" value="Send Message">
    </form>

    <p><a href="display_teachers2.php">Back to Teachers List</a></p>
</body>
</html>
