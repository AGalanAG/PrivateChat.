<?php

  require 'conexionDB.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username']) ) {

    $user = $_POST['username'];
    $mail = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!$conn->query("CALL Registrar('$user','$mail','$pass')")) {
    echo "Falló CALL: (" . $conn->errno . ") " . $conn->error;
    }else{
  $message = 'Cuenta creada con exito';
      echo "<div class=title>{$message}</div>";

    }

    // $sql = "INSERT INTO user (FullName,Email,Password) VALUES (:username,:email,:password)";
    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(':username', $_POST['username']);
    // $stmt->bindParam(':email', $_POST['email']);
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // $stmt->bindParam(':password', $password);

    // if ($stmt->execute()) {
    //   $message = 'Cuenta creada con exito';
    //   echo "{$message}";
    // } else {
    //   $message = 'Lo sentimos, ocurrio un error al crear la cuenta';
    //   echo "{$message}";
    // }
  }
?>