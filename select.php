<?php
    require 'Connet.php';

    if (isset($_GET['id'])) {
        $idVal = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $idVal, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
    }

    if (isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql_s = "SELECT * FROM users WHERE id = :idl";
    $query = $conn->prepare($sql_s);
    $query->bindParam(':idl', $id, PDO::PARAM_INT);
    $query->execute();
    $rows = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($rows);
    }
?>