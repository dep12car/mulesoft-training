<?php
    //Local Server
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "movies";

    try {
        $con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo "Connected successfully";
        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>