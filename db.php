<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "recipe_app";

// 1. Connect without selecting a DB first
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Create DB if missing
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// 3. Select DB
$conn->select_db($dbname);

// 4. Create tables if missing
$tables = [
    "users" => "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL
    )",

    "favorites" => "CREATE TABLE IF NOT EXISTS favorites (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        recipe_title VARCHAR(255),
        recipe_url VARCHAR(255),
        recipe_image VARCHAR(255),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )"
];

foreach ($tables as $name => $query) {
    if ($conn->query($query) !== TRUE) {
        die("Error creating $name table: " . $conn->error);
    }
}
?>
