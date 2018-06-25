<?php

    require('conn.php');
    session_start();
    $email =  $_SESSION['email'];
    $eventos = array();

    $titulo = $_POST["titulo"];
    $startDate = $_POST["start_date"];
    $allDay = $_POST["allDay"];
    $endDate = $_POST["end_date"];
    $endHour = $_POST["end_hour"];
    $startHour = $_POST["start_hour"];




    try {
       $conn = new PDO("mysql:host=$servername;dbname=id6200623_agenda", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $sql = "SELECT user_id FROM users WHERE Email='$email'";

       $result = $conn->query($sql);
       $row = $result->fetch(PDO::FETCH_ASSOC);
       $id = $row["user_id"];



       if($id != null){


               $sql2 = "INSERT INTO Events (user_id, titulo, inicio, hora_inicio, finalizacion, hora_finalizacion, tipo)
                VALUES ('{$id}', '{$titulo}', '{$startDate}', '{$startHour}', '{$endDate}', '{$endHour}', '{$allDay}')";
                $conn->exec($sql2);



                $data['success'] = true;
                $data['msg'] = "OK";
                echo json_encode($data);




       }

    }
    catch(PDOException $e)
    {
        echo $e;
    }
        $conn = null;

 ?>
