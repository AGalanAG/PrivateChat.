<?php require 'login.php'; ?>

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
