<?php
require('conn.php');

try {
   $conn = new PDO("mysql:host=$servername;dbname=id6200623_agenda", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $user = $_POST['username'];
   $pass = $_POST['password'];
   $sql = "SELECT Hash FROM users WHERE Email='$user'";
   $result = $conn->query($sql);
   $row = $result->fetch(PDO::FETCH_ASSOC);
   $hash = $row["Hash"];

   if (password_verify($pass, $hash)) {
    session_start();
    $_SESSION["email"] = $user;
    $data['success'] = true;
    $data['msg'] = "OK";

    $_SESSION["email"] = $user;
    echo json_encode($data);

   } else {
    $data['msg'] = "Contraseña o Email incorrectos";
    echo json_encode($data);
   }
}
catch(PDOException $e)
    {

        echo $e;

    }

    $conn = null;
?>
