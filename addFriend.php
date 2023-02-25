<?php
	  require 'conexionDB.php';
  		require 'serv.php';

	  $correo1=$_SESSION['mail'];
	  $correo2=$_POST['correo2'];
	  //$correo2="user2@gmail.com";
	  //$correo1="user1@gmail.com";
	  //echo $correo1;
	  //echo $correo2;

      $result=$conn->query("CALL AddFriends('$correo1','$correo2')");
  
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }	
  $row = mysqli_fetch_array($result);

  echo $row['msj'];

  // $json = array();
  // while($row = mysqli_fetch_array($result)) {
  //   $json[] = array(
  //     'Nombre' => $row['Nombre'],
  //     'Correo' => $row['Correo']
  //   );
  // }
  // //echo $json.length();
  // $jsonstring = json_encode($json);
  // //$jsonstring = json_encode(array("Nombre"=>"Alan","Correo"=>"agala@gmail.com"));
  // echo $jsonstring;

  ?>