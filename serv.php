<?php
  session_start();

  require 'conexionDB.php';

  if (isset($_SESSION['user_id'])) {

        $user = $_SESSION['nombre'] ;

          $id = $_SESSION['user_id'];

          $mail = $_SESSION['mail'];
    
  }


    $result=$conn->query("CALL ExistFriendS('$id')");
  
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'Nombre' => $row['Nombre'],
      'Correo' => $row['Correo']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;




?>