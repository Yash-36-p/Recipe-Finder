<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "recipefinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['title']) && isset($_POST['url']) && isset($_POST['image'])){
    $title = $_POST['title'];
    $url = $_POST['url'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("INSERT INTO favorites (recipe_title, recipe_url, recipe_image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $url, $image);
    if($stmt->execute()){
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
}
?>
