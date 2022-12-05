<?php
    $SERVER_NAME = 'localhost';
    $SERVER_USER = 'root';
    $SERVER_PASS = '';
    $SERVER_DBNAME = 'db_ajax';

    try{
        $conn = new PDO("mysql:host=$SERVER_NAME;dbname=$SERVER_DBNAME",$SERVER_USER,$SERVER_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connect Succss";
    } catch(PDOException $e) {
        echo "Connect Error :" . $e->getMessage();
    }
?>