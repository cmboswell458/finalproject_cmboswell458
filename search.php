<?php
// Show errors (helpful during testing)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = "localhost";
$username = "root";
$password = "mysql";
$database = "student_directory";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form input safely
$lastName = $_POST['last_name'] ?? '';

// Prepare stored procedure
$stmt = $conn->prepare("CALL search_students(?)");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $lastName);
$stmt->execute();

$result = $stmt->get_result();

// Store results
$students = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Fix for stored procedure multi-result issue
while ($conn->more_results() && $conn->next_result()) {;}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

    <h1>Search Results</h1>

    <a href="index.php">← Back to Home</a>

    <?php if (empty($students)): ?>
        <p>No students found.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>

            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    <?php endif; ?>

</body>
</html>