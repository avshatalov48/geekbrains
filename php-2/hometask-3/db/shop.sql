-- MySQL dump 10.13  Distrib 5.6.37, for Win64 (x86_64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.6.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Смартфоны'),(2,'Планшеты'),(3,'Ноутбуки'),(4,'ПК'),(5,'Аудиотехника'),(6,'Телевизоры'),(7,'Игры и приставки'),(8,'Уценка');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (1,1,4,'Хороший телевизор. Доволен, как слон.'),(2,2,4,'Данный телевизор приобретался исключительно для игр в связке с Playstation 4 PRO. Картинку выдаёт отличную, цвета сочные, всё смотрится просто отлично.'),(3,3,2,'Купил уже второй такой - матери, сериалы смотреть. За эти деньги - вне конкуренции.'),(4,4,3,'Алюминиевый корпус и выглядит отлично, и чувствуется в руке здорово - сразу видно что нормальное устройство, а не просто какая-то дешёвка. Скорость работы приятно радует, ничего не подвисает и не лагает, в игрушки я как-то и не играю, а на всё остальное производительности устройства хватает с хорошим запасом. Смело рекомендую к покупке, вещица вполне себе нормальная и разочарований от покупки нет.');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,8,'Тест','no-photo.jpg','Краткое описание товара','Подробное описание товара',100),(2,1,'Смартфон 1','smartphone_001.jpg','Краткое описание 1','Описание 1',200),(3,1,'Смартфон 2','smartphone_002.jpg','Краткое описание 2','Описание 2',300),(4,6,'Телевизор LG 49LJ540V','tv-lg.jpg','49\" (124 см) LED-телевизор LG 49LJ540V черный','LED-телевизор LG 49LJ540V с экраном в 49\", разрешение которого составляет 1920х1080. Такой экран обеспечит яркое, чёткое, реалистичное изображение и даст возможность получить максимум удовольствия от просмотра фильмов и телепередач. Телевизор оборудован аналоговым и цифровым тюнером. Вам не придётся приобретать дополнительное оборудование, чтобы смотреть передачи цифрового ТВ. В телевизоре присутствует технология Virtual Surround Plus, которая обеспечит Вам мощный и реалистичный объёмный звук. Технология Smart TV открывает телевизору доступ в интернет. Вы сможете смотреть видео с онлайн-ресурсов, пользоваться разнообразными приложениями. Разъёмы HDMI и USB позволят легко подключить к телевизору USB-накопители, проигрыватели дисков различного типа, а также другие устройства, чтобы воспроизводить видеоконтент на большом ярком экране.',38999);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_id` int(11) DEFAULT NULL,
  `login` varchar(32) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `surname` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (12,1,'admin','123','Alexander',NULL,NULL,NULL,'The site administrator'),(14,1,'admin','123','Alexander',NULL,NULL,NULL,'The site administrator'),(15,1,'user2','123456789','Миша','Галустян',NULL,NULL,'The site administrator'),(16,1,'admin','123','Alexander',NULL,NULL,NULL,'The site administrator'),(17,1,'admin','123','Alexander',NULL,NULL,NULL,'The site administrator'),(18,1,'admin','123','Alexander',NULL,NULL,NULL,'The site administrator'),(19,1,'admin','123','Alexander',NULL,NULL,NULL,'The site administrator'),(20,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(21,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(22,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(23,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(24,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(25,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(26,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(27,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(28,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(29,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(30,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!'),(31,1,'user1','12345','Гадя','Петрович','gadya@mail.ru','322-223','Потерялася я!');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-30 22:54:34
