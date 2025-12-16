<?php
session_start();

$servername = "localhost";
$username_db = "root"; 
$password_db = "";
$dbname = "srh";  

$conn = new mysqli($servername, $username_db, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_email = trim($_POST['email'] ?? '');  
$login_password = trim($_POST['password'] ?? '');  

if ($login_email === '' || $login_password === '') {
    die("Please enter email and password. <a href='study-resource-hub-login.html'>Back</a>");
}

$stmt = $conn->prepare("SELECT firstname, password_hash FROM members WHERE email = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $login_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && ($login_password === $user['password_hash'])) {  
    $_SESSION['user_email'] = $login_email;
    $_SESSION['user_name'] = $user['firstname'];
    
    $stmt->close();
    $conn->close();
    header("Location: study resource hub.html.html");  
    exit();
} else {
    $stmt->close();
    $conn->close();
    echo "<center><h1 style='color:Blue;'><b><i>Wrong email or password. <a href='study-resource-hub-login.html'>Try again</a></i></b></h1></center>";
}
?>
