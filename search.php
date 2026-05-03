<?php
// Show errors (for development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// --- Connect to database ---
$host = "localhost";
$username = "root";
$password = "mysql";
$database = "student_directory";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Get form input safely ---
$lastName = $_POST['last_name'] ?? '';

// --- Prepare stored procedure call ---
$stmt = $conn->prepare("CALL search_students(?)");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameter and execute
$stmt->bind_param("s", $lastName);
$stmt->execute();

// --- Execute and fetch results ---
$result = $stmt->get_result();

$students = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Handle stored procedure multiple result sets
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

<div class="container">

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

</div>

</body>
</html>