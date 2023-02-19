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