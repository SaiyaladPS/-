<?php
require 'Connet.php';

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$Web = $_POST['Web'];
$sql = 'UPDATE users SET fname = :fname, lname = :lname, email = :email, web = :Web WHERE id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
$stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':Web', $Web, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

echo $stmt
?>