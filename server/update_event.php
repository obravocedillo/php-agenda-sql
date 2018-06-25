<?php

    require('conn.php');
    session_start();
    $email =  $_SESSION['email'];

    $id = $_POST["id"];
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $endHour = $_POST["end_hour"];
    $startHour = $_POST["start_hour"];



    try {
       $conn = new PDO("mysql:host=$servername;dbname=id6200623_agenda", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE Events SET  inicio='$startDate',hora_inicio='$startHour', finalizacion='$endDate', hora_finalizacion='$endHour' WHERE id=$id";
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
