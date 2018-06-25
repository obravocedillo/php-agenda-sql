<?php
require('conn.php');

try {
   $conn = new PDO("mysql:host=$servername;dbname=id6200623_agenda", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $hashed_password = password_hash("pedro123", PASSWORD_DEFAULT);
   $hashed_password2 = password_hash("raul123", PASSWORD_DEFAULT);
   $hashed_password3 = password_hash("samuel123", PASSWORD_DEFAULT);

   $sql = "INSERT INTO users (Email, Nombre, Cumpleaños,Hash)
    VALUES ('pedro@gmail.com', 'Pedro Jimenez Cedillo', '1/03/98', '{$hashed_password}'),
    ('raul@gmail.com', 'Raul Jimenez Montoya', '10/05/94', '{$hashed_password2}'),
    ('samuel@gmail.com', 'Samuel Perez Gomez', '26/11/90', '{$hashed_password3}')";

    $conn->exec($sql);
    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    if($e->errorInfo[1] === 1062){
        echo 'Duplicate entry';
    }else{
        echo $e;
    }
}

    $conn = null;
?>
