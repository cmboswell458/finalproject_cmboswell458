<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Directory Search</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<div class="container">

    <h1>Student Directory Search</h1>

    <p>Your Name: Crystal Michelle Boswell</p>
    <p>Date: <?php echo date("F j, Y"); ?></p>

    <form method="POST" action="search.php">
        <label for="last_name">Enter Last Name:</label>
        <input 
            type="text" 
            name="last_name" 
            id="last_name" 
            required 
            aria-label="Enter last name"
            placeholder="e.g. Smith"
        >

        <button type="submit">Search</button>
    </form>

</div>

<!-- JavaScript -->
<script src="scripts/main.js"></script>

</body>
</html>