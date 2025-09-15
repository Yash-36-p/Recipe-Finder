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

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: index.php"); // redirect to main app
            exit;
        } else {
            echo "❌ Invalid password!";
        }
    } else {
        echo "❌ User does not exist!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>


  <title>Login</title>
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
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover { background: black; }
    .switch {
      margin-top: 15px;
      font-size: 14px;
    }
    .switch a {
      color: #ff5e62;
      text-decoration: none;
      font-weight: bold;
    }
    .error { color: red; margin-bottom: 10px; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
    </form>
    <div class="switch">
      Don’t have an account? <a href="register.php">Register</a>
    </div>
  </div>
</body>
</html>
