-- after create the schema execute this
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `author` varchar(45) DEFAULT NULL,
  `book_description` mediumtext,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;


-- execute this sql for add some examples
INSERT INTO `books` VALUES (1,'The Hobbit','J.R.R Tolkien',NULL),(2,'Sherlock Holmes','Arthur Conan Doyle',NULL),(3,'Harry Potter','JK Rowling',NULL),(4,'The Summoner','Taran Matharu','When blacksmith apprentice Fletcher discovers that he has the ability to summon demons from another world, he travels to Adept Military Academy. There the gifted are trained in the art of summoning.'),(5,'Prince of Thorns','Mark Lawrence','From being a privileged royal child, raised by a loving mother, Jorg Ancrath has become the Prince of Thorns, a charming, immoral boy leading a grim band of outlaws in a series of raids and atrocities. The world is in chaos: violence is rife, nightmares everywhere. Jorg has the ability to master the living and the dead, but there is still one thing that puts a chill in him.');
