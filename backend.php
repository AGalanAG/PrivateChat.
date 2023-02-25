<?php 

  require 'conexionDB.php';
  require 'serv.php';

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
  //echo $json.length();
  $jsonstring = json_encode($json);
  //$jsonstring = json_encode(array("Nombre"=>"Alan","Correo"=>"agala@gmail.com"));
  echo $jsonstring;



 ?>