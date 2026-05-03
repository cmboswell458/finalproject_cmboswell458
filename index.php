<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Directory Search</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

    <h1>Student Directory Search</h1>

    <p>Your Name: Crystal Michelle Boswell</p>
    <p>Date: <?php echo date("F j, Y"); ?></p>

    <form method="POST" action="search.php">
        <label for="last_name">Enter Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>

        <button type="submit">Search</button>
    </form>

    <!-- External JavaScript -->
    <script src="scripts/main.js"></script>

</body>
</html>