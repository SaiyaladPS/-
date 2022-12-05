<?php 
    require 'Connet.php';

        $delete_id = $_GET['delete'];
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $delete_id,PDO::PARAM_INT);
        $stmt->execute()
?>