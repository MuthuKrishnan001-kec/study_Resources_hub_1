<?php
$conn = new mysqli('localhost', 'root', '', 'srh');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
