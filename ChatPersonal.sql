CREATE TABLE `User` (
  `IdUsers` int PRIMARY KEY AUTO_INCREMENT,
  `FullName` varchar(255),
  `Email` varchar(255),
  `Password` varchar(255)
);

CREATE TABLE `Friends` (
  `IdRelacion` int PRIMARY KEY AUTO_INCREMENT,
  `User1id` int,
  `User2id` int
);

CREATE TABLE `Chats` (
  `IdChat` int PRIMARY KEY AUTO_INCREMENT,
  `IdRela` int,
  `IdMessage` int,
  `User1` int,
  `User2` int
);

CREATE TABLE `Message` (
  `IdMsj` int PRIMARY KEY AUTO_INCREMENT,
  `Message` varchar(255),
  `MsjDate` datetime,
  `IdSender` int
);



ALTER TABLE `Friends` ADD FOREIGN KEY (`User1id`) REFERENCES `User` (`IdUsers`);
ALTER TABLE `Friends` ADD FOREIGN KEY (`User2id`) REFERENCES `User` (`IdUsers`);
ALTER TABLE `Chats` ADD FOREIGN KEY (`IdRela`) REFERENCES `Friends` (`IdRelacion`);
ALTER TABLE `Chats` ADD FOREIGN KEY (`User1`) REFERENCES `Friends` (`User1id`);
ALTER TABLE `Chats` ADD FOREIGN KEY (`User2`) REFERENCES `Friends` (`User2id`);
ALTER TABLE `Chats` ADD FOREIGN KEY (`IdMessage`) REFERENCES `Message` (`IdMsj`);