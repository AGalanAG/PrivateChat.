<?php
  session_start();

  require 'conexionDB.php';

  if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT IdUsers,FullName,Email, Password FROM user WHERE IdUsers = :IdUsers');
        $records->bindParam(':IdUsers', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

            if (count($results) > 0) {
                  $user = $results;
                $id=$user['IdUsers'];

            // $records2 = $conn->prepare('SELECT FullName FROM friends WHERE Userid = :id ');
            // $records2->bindParam(':id', $_SESSION['user_id']);
            // $records2->execute();
            // $results2 = $records2->fetch(PDO::FETCH_ASSOC);

            //                     if (count($results2) > 0) {
            //     $frieds=$results2;
            //      $message = 1;
            //    }

                    $sql = "SELECT FullName FROM friends WHERE Userid = $id ";
                  $result = $conn->prepare($sql);
                  $result->execute([]);
                  $friends = $result->fetchAll();
                      if ($friends != null) {
                          $message = 1;
                          foreach ($friends as $friend):
                            endforeach;

                      }else{
                            $message=0;
                    
                          }


            }

  }


?>


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
  <a href="#" id="add">Contactos</a>
  <a href="#"><?= $user['FullName']; ?></a>
   <a href="cerrar.php">Cerrar sesion</a>
  
</div>

<!-- The flexible grid (content) -->
<div class="row">
  <div class="side">
    <h2>Contactos</h2>
    <div class="contactos">
        <?php
        if (!empty($_POST['Friend'])){
          echo $Friend;
        }

        if ($message==1) {
           echo $friend['FullName'];  echo $id;
         }else{
          echo "No hay amigos";
         }
        ?>
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
 <script src="socket.io.js"></script>
  <script src="scripts.js"></script>
</body>
</html>