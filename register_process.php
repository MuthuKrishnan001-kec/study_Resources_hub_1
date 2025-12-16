<?php

require 'db_connect.php';

$firstname = trim($_POST['firstname'] ?? '');
$lastname  = trim($_POST['lastname'] ?? '');
$dob       = $_POST['dob'] ?? '';
$gender    = $_POST['gender'] ?? '';
$email     = trim($_POST['email'] ?? '');
$password  = trim($_POST['password'] ?? '');  // add trim
$password2 = trim($_POST['password2'] ?? '');

if ($password !== $password2) {
    die('Passwords do not match. <a href="New Register1.html">Go back</a>');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email format. <a href="New Register1.html">Go back</a>');
}

$password_hash = trim($_POST['password']);

$stmt = $conn->prepare(
    'INSERT INTO members (firstname, lastname, dob, gender, email, password_hash)
     VALUES (?, ?, ?, ?, ?, ?)'
);

if (!$stmt) {
    die('Prepare failed: ' . $conn->error);
}

$stmt->bind_param('ssssss',
    $firstname,
    $lastname,
    $dob,
    $gender,
    $email,
    $password_hash
);

if (!$stmt->execute()) {
    if ($conn->errno == 1062) { // duplicate email
        die('This email is already registered. <a href="New Register1.html">Go back</a>');
    } else {
        die('Database error: ' . $conn->error);
    }
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Confirm Registration</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #e3f2fd;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .container {
      background-color: #ffffff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      max-width: 500px;
      width: 100%;
    }
    h1 {
      margin-bottom: 10px;
      text-align: center;
      color: #0d47a1;
    }
    p {
      text-align: center;
      margin-bottom: 20px;
      color: #333333;
    }
    .row {
      margin: 6px 0;
    }
    .label {
      font-weight: bold;
      color: #004d40;
    }
    .buttons {
      margin-top: 20px;
      text-align: center;
    }
    .buttons form {
      display: inline-block;
      margin: 0 5px;
    }
    .buttons button {
      background-color: #0d47a1;
      color: #ffffff;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }
    .buttons button:hover {
      background-color: #1565c0;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Confirm Your Details</h1>
    <p>Your account has been registered. Please review your information below.</p>

    <div class="row"><span class="label">First Name: </span><span><?php echo htmlspecialchars($firstname); ?></span></div>
    <div class="row"><span class="label">Last Name: </span><span><?php echo htmlspecialchars($lastname); ?></span></div>
    <div class="row"><span class="label">Date of Birth: </span><span><?php echo htmlspecialchars($dob); ?></span></div>
    <div class="row"><span class="label">Gender: </span><span><?php echo htmlspecialchars($gender); ?></span></div>
    <div class="row"><span class="label">Email: </span><span><?php echo htmlspecialchars($email); ?></span></div>

    <div class="buttons">
      <form action="study resource hub login page.html" method="get">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <button type="submit">Go to Login</button>
      </form>
      <form action="New Register1.html" method="get">
        <button type="submit">Register Another</button>
      </form>
    </div>
  </div>
</body>
</html>
