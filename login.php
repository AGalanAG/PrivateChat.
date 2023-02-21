<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /ChatPersonal/Sala.php');
  }
  require 'conexionDB.php';

  if (!empty($_POST['email']) && !empty($_POST['password']) ) {

    $mail = $_POST['email'];
    //$pass = password_verify($_POST['password'];
    $result=$conn->query("CALL ExistUser('$mail')");
    $row = mysqli_fetch_array($result);

    if (!$row) {
    echo "Falló CALL: (" . $conn->errno . ") " . $conn->error;
    }else{
            if ($row !=null && password_verify($_POST['password'], $row['Password'])) 
            {
              $_SESSION['user_id'] = $row['IdUsers'];
              $_SESSION['mail'] = $row['Email'];
              $_SESSION['nombre'] = $row['FullName'];
              header("Location:/ChatPersonal/Sala.php");
            } else {
                      $message = 'Lo sentimos, ocurrio un error!';
                      echo "{$message}";
                    }

          }
}


  // if (!empty($_POST['email']) && !empty($_POST['password'])) {
  //   $records = $conn->prepare('SELECT   IdUsers,FullName,Email, Password FROM user WHERE Email = :email');
  //   $records->bindParam(':email', $_POST['email']);
  //   $records->execute();
  //   $results = $records->fetch(PDO::FETCH_ASSOC);

  //   $message = '';

  //   if ($results !=null && count($results) >0 && password_verify($_POST['password'], $results['Password'])) {
  //     $_SESSION['user_id'] = $results['IdUsers'];
  //     header("Location:/ChatPersonal/Sala.php");
  //   } else {
  //     $message = 'Lo sentimos, ocurrio un error!';
  //     echo "{$message}";
  //   }
  // }

?>