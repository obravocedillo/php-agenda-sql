<?php

    require('conn.php');
    session_start();
    $email =  $_SESSION['email'];
    

    $id = $_POST["id"];




    try {
       $conn = new PDO("mysql:host=$servername;dbname=id6200623_agenda", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $sql = "DELETE FROM Events WHERE id=$id";
       $conn->exec($sql);


       $data['success'] = true;
       $data['msg'] = "OK";
       echo json_encode($data);


    }
    catch(PDOException $e)
    {
        echo $e;
    }
        $conn = null;

 ?>
