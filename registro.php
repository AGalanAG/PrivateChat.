<?php require 'singup.php'; ?>

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