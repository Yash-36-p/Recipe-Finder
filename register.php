<?php
session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "recipefinder");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Hash password before saving
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            echo "✅ Registration successful. <a href='login.php'>Login here</a>";
        } else {
            echo "⚠️ Error: " . $stmt->error;
        }
    } else {
        echo "⚠️ Please fill in all fields.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    

  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #ff9966, #ff5e62);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      text-align: center;
      width: 300px;
    }
    h2 { margin-bottom: 20px; color: #333; }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #ff5e62;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover { background: black; }
    .switch {
      margin-top: 15px;
      font-size: 14px;
    }
    .switch a {
      color: #667eea;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Register</button>
    </form>
    <div class="switch">
