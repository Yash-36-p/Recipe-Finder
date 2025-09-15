<!DOCTYPE html>
<html lang="en">
<head>
  
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User not logged in, redirect to login page
    header('Location: login.php');
    exit();
}
?>

    <meta charset="UTF-8">
    <title>Recipe Finder</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1><img src="logo.png" alt="Logo" style="height: 100px; vertical-align: middle; margin-right: 60px;">
        <div class="webname">
        Recipe Finder</div>
    </h1>
        <p>Find recipes using the ingredients you have!</p>

         <div class="top-nav">
  <a href="favorites_list.php" class="favorites-btn">⭐ Go to Favorites</a>
  <button id="darkModeToggle" class="favorites-btn">🌙 Dark Mode</button>
  <a href="logout.php">
    <button class="favorites-btn">🚪Logout</button>
</a>

</div>
    </header>
    <div class="container">
        <input type="text" id="ingredients" placeholder="Enter ingredients (comma separated)">
        
        <select id="cuisine">
            <option value="">All Cuisines</option>
            <option value="Italian">Italian</option>
            <option value="Chinese">Chinese</option>
            <option value="Indian">Indian</option>
            <option value="Mexican">Mexican</option>
            <option value="American">American</option>
        </select>

        <select id="diet">
            <option value="">All Diets</option>
            <option value="vegetarian">Vegetarian</option>
            <option value="vegan">Vegan</option>
            <option value="gluten free">Gluten Free</option>
            <option value="ketogenic">Ketogenic</option>
        </select>

        <button id="searchBtn">Search Recipes</button>
        <div id="recipes"></div>
    </div>

    <footer class="footer">
      <footer class="footer_text">
        <p>&copy; 2025 Recipe Finder</p>
        </footer>
    </footer>
    <script src="script.js" defer></script>
</body>
</html>
