<?php
$host = 'localhost';
$dbname = 'srh';  
$username = 'root';
$password = '';   

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$email = trim($_POST['email'] ?? '');
if (empty($email)) {
    die('Email is required.');
}

$stmt = $pdo->prepare("SELECT email, password_hash, firstname FROM members WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();
?>
