<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /ChatPersonal/Sala.php');
  }
  require 'conexionDB.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT   IdUsers,FullName,Email, Password FROM user WHERE Email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if ($results !=null && count($results) >0 && password_verify($_POST['password'], $results['Password'])) {
      $_SESSION['user_id'] = $results['IdUsers'];
      header("Location:/ChatPersonal/Sala.php");
    } else {
      $message = 'Lo sentimos, ocurrio un error!';
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
      <div class="title">Iniciar sesion</div>
      <form action="index.php" method="POST">
        <div class="field">
          <input name="email" type="text" required>
          <label>Correo</label>
        </div>
        <div class="field">
          <input name="password" type="password" required>
          <label>Contraseña</label>
        </div>

        <div class="field">
          <input type="submit" value="Iniciar">
        </div>
        <div class="signup-link">¿No estas registrado? <a href="registro.php">Registrar</a></div>
      </form>
    </div>

  </body>
</html>
