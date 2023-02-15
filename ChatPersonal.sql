CREATE TABLE `User` (
  `IdUsers` int PRIMARY KEY AUTO_INCREMENT,
  `FullName` varchar(255),
  `Email` varchar(255),
  `Password` varchar(255)
);

CREATE TABLE `Friends` (
  `IdFriends` int PRIMARY KEY,
  `email` varchar(255),
  `FullName` varchar(255),
   `Userid` int,
    FOREIGN KEY (`Userid`) REFERENCES `User` (`IdUsers`)
);

CREATE TABLE `Chats` (
  `IdChat` int PRIMARY KEY,
  `Message` varchar(255),
   `Emmisor` int,
   `Reciver` int,
    FOREIGN KEY (`Emmisor`) REFERENCES `User` (`IdUsers`),
    FOREIGN KEY (`Reciver`) REFERENCES `Friends` (`IdFriends`)
);


