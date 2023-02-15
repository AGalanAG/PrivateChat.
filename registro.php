<?php

  require 'conexionDB.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username']) ) {
    $sql = "INSERT INTO user (FullName,Email,Password) VALUES (:username,:email,:password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $_POST['username']);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Cuenta creada con exito';
      echo "{$message}";
    } else {
      $message = 'Lo sentimos, ocurrio un error al crear la cuenta';
      echo "{$message}";
    }
  }
?>



<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Chat Personal</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="wrapper">
      <div class="title">Registrar usuario</div>
      <form action="registro.php" method="POST">
      <div class="field">
          <input name="username" type="text" required>
          <label>Nombre</label>
        </div>
        <div class="field">
          <input name="email" type="text" required>
          <label>Correo</label>
        </div>
        <div class="field">
          <input name="password" type="password" required>
          <label>Contraseña</label>
        </div>

        <div class="field">
          <input type="submit" value="Registrar">
        </div>
        <div class="signup-link">¿Ya estas registrado? <a href="index.php">Iniciar sesion</a></div>
      </form>
    </div>

  </body>
</html>