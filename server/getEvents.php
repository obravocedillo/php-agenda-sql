<?php
    require('conn.php');
    session_start();
    $email =  $_SESSION['email'];
    $eventos = array();
    try {
       $conn = new PDO("mysql:host=$servername;dbname=id6200623_agenda", $username, $password);
       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


       $sql = "SELECT user_id FROM users WHERE Email='$email'";

       $result = $conn->query($sql);
       $row = $result->fetch(PDO::FETCH_ASSOC);
       $id = $row["user_id"];

       if($id != null){
           $sql2 = "SELECT * FROM Events WHERE user_id = $id";
           $result2 = $conn->query($sql2);


           while ($row2 = $result2->fetch()) {
               $tempId;
               $tempTitulo;
               $tempInicio;
               $tempHoraInicio;
               $tempFinal;
               $tempHoraFinal;
               $tempDiaCompleto;

               $tempId = $row2["id"];
               $tempTitulo = $row2["titulo"];
               $tempInicio = $row2["inicio"];
               $tempHoraInicio = $row2["hora_inicio"];
               $tempFinal = $row2["finalizacion"];
               $tempHoraFinal = $row2["hora_finalizacion"];
               $tempDiaCompleto = $row2["tipo"];

               if(strlen($tempHoraInicio) <= 0){


                   $tempDiaCompleto = true;
                   array_push($eventos,array("id"=>$tempId,"title"=>$tempTitulo,
                   "start"=>$tempInicio,"allDay"=>$tempDiaCompleto));


               }elseif(strlen($tempHoraInicio) >= 0){
                    $tempDiaCompleto = false;
                   array_push($eventos,array("id"=>$tempId,"title"=>$tempTitulo,
                   "start"=>$tempInicio."T".$tempHoraInicio,"allDay"=>$tempDiaCompleto,
                   "end"=>$tempFinal."T".$tempHoraFinal));
               }



           }



            $data['success'] = true;
            $data['msg'] = "OK";
            $data['eventos'] = $eventos;
            echo json_encode($data);
       }




    }
    catch(PDOException $e)
    {
        echo $e;
    }
        $conn = null;

 ?>
