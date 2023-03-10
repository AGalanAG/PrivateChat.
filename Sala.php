<?php  require 'serv.php'; //require 'backend.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sala</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>

<!-- Header -->
<div class="header">
  <h1>Sala de chat</h1>

</div>

<!-- Navigation Bar -->
<div class="navbar" id="bar">
  <!-- <a href="#" id="add">Contactos</a> -->
  <a href="#" id="usnombre"><?= $user; ?></a>
  <a href="#" id="usmail"> <?= $mail; ?> </a>
  <a href="#" id="add">Agregar amigo</a> 
   <a href="cerrar.php">Cerrar sesion</a>
  
</div>

<!-- The flexible grid (content) -->
<div class="row">
  <div class="side">
    <h2>Contactos</h2>
    <div class="contactos" id="contactos">

    </div>
  
  </div>
  <div class="main">
  <h3>Mensajes</h3>
    <div class="mensajes"> 
    <div class="texto" id="user">Mensaje 1</div>
    <div class="texto">Mensaje 2</div>
    <div class="texto" id="user">Mensaje 3</div>
    <div class="texto">Mensaje 4</div>
    <div class="texto"id="user">Mensaje 5</div>
    <div class="texto">Mensaje 6</div>
    <div class="texto"id="user">Mensaje 7</div>
    <div class="texto">Mensaje 8</div>
    <div class="texto"id="user">Mensaje 9</div>
    <div class="texto"id="user">Mensaje 10</div>
    <div class="texto">Mensaje 11</div>
    <div class="texto"id="user">Mensaje 12</div>
    <div class="texto"id="user">Mensaje 13</div>
    <div class="texto">Mensaje 14</div>
    <div class="texto">Mensaje 15</div>
   
    </div>
    <div class="SectionAct">
        <input type="text" placeholder="Escribir mensaje">
        <button type="submit">Enviar</button>
    </div>
   
  </div>
</div>

 
</body>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="cliente.js"  type="text/javascript"></script>
</html>