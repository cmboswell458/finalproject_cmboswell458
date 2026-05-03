<?php
// Get search query
$query = isset($_GET['query']) ? trim($_GET['query']) : "";

// Sample dataset (replace with your real data if needed)
$data = ["luggage", "bag", "suitcase", "travel kit"];

// Search logic
$results = [];

if ($query !== "") {
    foreach ($data as $item) {
        if (stripos($item, $query) !== false) {
            $results[] = $item;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

    <h1>Search Results</h1>

    <!-- 🔍 SEARCH FORM -->
    <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search..." value="<?php echo htmlspecialchars($query); ?>">
        <button type="submit">Search</button>
    </form>

    <hr>

    <!-- ✅ RESULTS DISPLAY -->
    <?php if (!empty($results)): ?>
        <ul>
            <?php foreach ($results as $result): ?>
                <li><?php echo htmlspecialchars($result); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        
        <!-- 🚨 NO RESULTS POPUP -->
        <div id="noResultsPopup">
            No results found. Please try again.
        </div>

    <?php endif; ?>

    <br>

    <!-- ✅ FIXED HOME BUTTON (NO DELAY) -->
    <button type="button" id="homeBtn">Go Back Home</button>

    <!-- JS FILE -->
    <script src="scripts/main.js"></script>

</body>
</html>