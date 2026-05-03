<?php
// ===== DATABASE CONNECTION =====
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "student_directory";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ===== GET SEARCH INPUT =====
$searchTerm = "";
$results = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = trim($_POST["last_name"]);

    // ===== PREPARED STATEMENT TO CALL STORED PROCEDURE =====
    $stmt = $conn->prepare("CALL search_students(?)");
    $stmt->bind_param("s", $searchTerm);

    $stmt->execute();

    // Get result set
    $results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Search</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<h1>Student Search</h1>

<!-- 🔍 SEARCH FORM -->
<form method="POST" action="search.php">
    <input type="text" name="last_name" placeholder="Enter last name (e.g. Smith)" required>
    <button type="submit">Search</button>
</form>

<br>

<!-- ✅ RESULTS -->
<?php if ($results && $results->num_rows > 0): ?>

    <table border="1" style="margin: 0 auto; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>

        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
            </tr>
        <?php endwhile; ?>

    </table>

<?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>

    <!-- 🚨 POPUP FOR NO RESULTS -->
    <div id="noResultsPopup">
        No students found.
    </div>

<?php endif; ?>

<br>

<!-- ✅ HOME BUTTON (NO DELAY FIX) -->
<button type="button" id="homeBtn">Go Back Home</button>

<script src="scripts/main.js"></script>

</body>
</html>

<?php
// Close connections cleanly
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
?>

