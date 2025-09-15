<?php
require 'db_connect.php';

$result = $conn->query("SELECT * FROM favorites ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Favorite Recipes</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f9fa;
      text-align: center;
      padding: 20px;
    }
    .recipe-card {
      display: inline-block;
      width: 250px;
      margin: 15px;
      padding: 15px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    .recipe-card img {
      max-width: 100%;
      border-radius: 8px;
    }
    .recipe-card h3 {
      font-size: 18px;
      margin: 10px 0;
    }
    .recipe-card a {
      text-decoration: none;
      color: #ff5722;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>🍴 My Favorite Recipes</h1>

  <?php while($row = $result->fetch_assoc()) { ?>
    <div class="recipe-card">
      <img src="<?php echo $row['recipe_image']; ?>" alt="<?php echo $row['recipe_title']; ?>">
      <h3><?php echo $row['recipe_title']; ?></h3>
      <a href="<?php echo $row['recipe_url']; ?>" target="_blank">View Recipe</a>
    </div>
  <?php } ?>

</body>
</html>
