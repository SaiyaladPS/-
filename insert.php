<?php
    require 'Connet.php';

    $fname = $_POST['form_fname'];
    $lname = $_POST['form_lname'];
    $email = $_POST['form_email'];
    $Web = $_POST['form_Web'];

        $sql = "INSERT INTO users(fname, lname, email, web) VALUES (?,?,?,?)";
        $inser_sql = $conn->prepare($sql);
        $inser_sql->bindParam(1, $fname, PDO::PARAM_STR);
        $inser_sql->bindParam(2, $lname, PDO::PARAM_STR);
        $inser_sql->bindParam(3, $email, PDO::PARAM_STR);
        $inser_sql->bindParam(4, $Web, PDO::PARAM_STR);
        $inser_sql->execute();
?>