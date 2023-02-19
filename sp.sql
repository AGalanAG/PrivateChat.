--SP para ver los mensajes de una conversacion, el correo de los dos usuarios.
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `VerMensajes`(IN `correo1` VARCHAR(255), IN `correo2` VARCHAR(255))
BEGIN
--Consultamos los id de cada usuario y los almacenamos en variables.
set @mail1=(SELECT user.IdUsers from user WHERE user.Email =correo1);
  set @mail2=(SELECT user.IdUsers from user WHERE user.Email =correo2);
--Consultamos el id de la conversacion que corresponde a los dos usuarios.
    set @idConv=(SELECT DISTINCT chats.IdRela from chats WHERE
                 chats.User1 = @mail1 AND chats.User2=@mail2 OR
                 chats.User1 = @mail2 AND chats.User2=@mail1);
--Consultamos los mensajes correspondientes al id de la conversacion. 
    SELECT message.Message FROM message
     INNER JOIN chats 
        ON message.IdMsj = chats.IdMessage AND chats.IdRela = @idConv
        ORDER BY message.MsjDate ASC;


END$$
DELIMITER ;

--SP para consultar un usuario para el login.   
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ExistUser`(IN `correo` VARCHAR(255))
BEGIN

SELECT   IdUsers,FullName,Email, Password FROM user WHERE Email = correo;


END$$
DELIMITER ;



--SP para registrar usuarios.
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Registrar`(IN `FullName` VARCHAR(255), IN `Email` VARCHAR(255), IN `Password` VARCHAR(255))
BEGIN

set @check = (SELECT user.IdUsers FROM user WHERE user.Email=Email);
IF @check != ' ' THEN
    set @mensaje="Correo ya registrado, Ingresa uno diferente";
    SELECT @mensaje;
 ELSE

  INSERT INTO user values(' ',FullName,Email,Password);

 END IF;
 

END$$
DELIMITER ;

--SP para agregar una amistad.
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddFriends`(IN `correo1` VARCHAR(255),IN `correo2` VARCHAR(255))
BEGIN

set @mail1=(SELECT user.IdUsers from user WHERE user.Email =correo1);
  set @mail2=(SELECT user.IdUsers from user WHERE user.Email =correo2);
--Consultamos el id de la conversacion que corresponde a los dos usuarios.
      set @idConv=(SELECT DISTINCT chats.IdRela from chats WHERE
                 chats.User1 = @mail1 AND chats.User2=@mail2 OR
                 chats.User1 = @mail2 AND chats.User2=@mail1);

        IF @idConv != ' ' THEN

            set @mensaje="La Relacion ya existe";
            SELECT @mensaje;

        ELSE

        set @User1 = (SELECT COUNT(user.IdUsers) from user WHERE user.IdUsers = @mail1);
        set @User2 = (SELECT COUNT(user.IdUsers) from user WHERE user.IdUsers = @mail2);

            IF @User1 >0 AND @User2 >0 THEN

                INSERT INTO friends values(' ',@mail1,@mail2);

                set @idrelacion =(SELECT friends.IdRelacion from friends WHERE friends.User1id = @mail1 AND friends.User2id=@mail2);
                --INSERT INTO chats VALUES(' ',@idrelacion,NULL,@mail1,@mail2);
                 
            ELSE
                set @Error="Ocurrio un error";
                SELECT @Error;

            END IF;
        END IF;

END$$
DELIMITER ;


 

-- Consutlta para saber los id de las relaciones que tiene un usuario
SELECT friends.IdRelacion FROM friends WHERE friends.User1id = 1 OR friends.User2id = 1;
--Consulta para ver los amigos
SELECT user.FullName from user WHERE user.IdUsers = (
SELECT friends.User2id from friends WHERE friends.IdRelacion = 1 AND friends.User1id=1);

--Consulta para ver los amigos cuando user1 es el usuario de la sesion y user2 es su amigo

SELECT user.FullName from user WHERE user.IdUsers = (
SELECT friends.User2id from friends WHERE friends.IdRelacion = (SELECT friends.IdRelacion FROM friends WHERE friends.User1id = IdUsers OR friends.User2id = IdUser) AND friends.User1id=IdUser);

--Consulta para ver los amigos cuando user2 es el usuario de la sesion y user1 es su amigo

SELECT user.FullName from user WHERE user.IdUsers = (
SELECT friends.User1id from friends WHERE friends.IdRelacion = (SELECT friends.IdRelacion FROM friends WHERE friends.User1id = IdUsers OR friends.User2id = IdUsers) AND friends.User2id=IdUsers);


--SP para ver los amigos de un usuario.

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ExistFriendS`(IN `Id` INT)
BEGIN
    DECLARE IdRela INTEGER DEFAULT 0;
    DECLARE var_final INTEGER DEFAULT 0;

    DECLARE cursor1 CURSOR FOR SELECT friends.IdRelacion FROM friends WHERE friends.User1id = Id OR friends.User2id = Id;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET var_final = 1;
    CREATE TEMPORARY TABLE Amigos (Nombre VARCHAR(255));

set @num = (SELECT COUNT(friends.IdRelacion) FROM friends WHERE friends.User1id = Id OR friends.User2id = Id);

   IF @num > 0 THEN


      OPEN cursor1;

          bucle: LOOP

            FETCH cursor1 INTO IdRela;

            IF var_final = 1 THEN
              LEAVE bucle;
            END IF;

            set @numRel = (SELECT COUNT(friends.User2id) from friends
             WHERE friends.IdRelacion = IdRela AND friends.User1id=Id);
            IF @numRel > 0 THEN

                set @nombre=(SELECT user.FullName from user WHERE user.IdUsers = (SELECT friends.User2id from friends WHERE friends.IdRelacion = IdRela AND friends.User1id=Id));
                INSERT INTO Amigos values(@nombre);

            ELSE

                set @nombre=(SELECT user.FullName from user WHERE user.IdUsers = (SELECT friends.User1id from friends WHERE friends.IdRelacion = IdRela AND friends.User2id=Id));
                INSERT INTO Amigos values(@nombre);

            END IF;


          END LOOP bucle;
      CLOSE cursor1;
      SELECT * FROM Amigos;

   ELSE


      set @nohay = "No hay Amigos";
      SELECT @nohay;

      
   END IF;


END$$
DELIMITER ;


BEGIN
CREATE TEMPORARY TABLE Fecha (FechaAHORA datetime);

INSERT INTO Fecha VALUES (NOW());
SELECT * FROM Fecha;
END

--SP para insertar mensaje en un chat.
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `crearMSJ`(IN `correo1` VARCHAR(255), IN `correo2` VARCHAR(255),IN `msj` VARCHAR(255))
BEGIN

set @mail1=(SELECT user.IdUsers from user WHERE user.Email =correo1);
  set @mail2=(SELECT user.IdUsers from user WHERE user.Email =correo2);

    set @idConv=(SELECT friends.IdRelacion FROM friends WHERE friends.User1id = @mail1 AND friends.User2id = @mail2 OR friends.User1id = @mail2 AND friends.User2id = @mail1);

        IF @idConv != ' ' THEN
            set @Tiempo=NOW();
            INSERT INTO message values(' ',msj,@Tiempo,@mail1);

            set @IdMsj= (SELECT message.IdMsj from message WHERE message.Message=msj AND message.MsjDate = @Tiempo AND message.IdSender = @mail1);

            INSERT INTO chats VALUES(' ',@idConv,@IdMsj,@mail1,@mail2);

            
            
        ELSE
            set @mensaje="No hay relacion";
            SELECT @mensaje;
        END IF;


END$$
DELIMITER ;