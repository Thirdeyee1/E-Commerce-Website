/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for linux-systemd (x86_64)
--
-- Host: localhost    Database: foxayvdf_new_schema
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` int(11) DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES
(45,26,'3','10x Carriage Bolts','Carriage Bolt.png',80,1,8,'2024-05-05 14:45:21'),
(46,27,'3','10x Carriage Bolts','Carriage Bolt.png',80,1,8,'2024-05-07 03:33:39');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES
(26,80.00,'paid',8,99,'Dumaguete','secret','2024-05-05 14:45:21'),
(27,80.00,'on_hold',8,0,'asda','asda','2024-05-07 03:33:39');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL,
  `payment_date` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES
(9,26,8,'02H19066HP013614B','2024-05-05 14:48:06');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(108) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_image4` varchar(255) DEFAULT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) DEFAULT NULL,
  `product_color` varchar(108) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,'10x Hex Bolts','Bolts','Threaded fasteners with hexagonal heads for secure connections in various applications.','hex bolt.webp','hex bolt.webp','hex bolt.webp','hex bolt.webp',50.00,0,'white'),
(2,'10x Socket Bolts','Bolts','Socket bolts, also called socket cap screws, feature a cylindrical head with a recessed hexagonal drive, offering a low-profile and secure fastening option in various applications.','Socket Bolt.png','Socket Bolt.png','Socket Bolt.png','Socket Bolt.png',70.00,0,'white'),
(3,'10x Carriage Bolts','Bolts','Smooth-headed fasteners for joining wood or metal, favored for their sleek appearance and secure hold.','Carriage Bolt.png','Carriage Bolt.png','Carriage Bolt.png','Carriage Bolt.png',80.00,0,'white'),
(4,'10x Lag Bolts','Bolts','Heavy-duty fasteners with coarse threads and a hexagonal head, designed for securely anchoring heavy materials to wood or metal surfaces.','Lag Bolt.png','Lag Bolt.png','Lag Bolt.png','Lag Bolt.png',50.00,0,'white'),
(5,'10x Hex Nuts','Nuts','Six-sided fasteners used with bolts and screws to secure components together by providing a threaded connection, commonly found in various sizes and materials for diverse applications in construction, machinery, and automotive industries.','hex.webp','hex.webp','hex.webp','hex.webp',20.00,0,'white'),
(6,'10x Cross Barrel Nuts','Nuts','Fasteners with a cross-shaped head and threaded barrel, ideal for creating concealed, flush connections when assembling furniture and other applications.','Cross Barrel Nut.png','Cross Barrel Nut.png','Cross Barrel Nut.png','Cross Barrel Nut.png',25.00,0,'white'),
(7,'10x Barrel Nuts','Nuts','Cylindrical fasteners with internally threaded holes, used in conjunction with bolts or screws to create strong and secure connections in various applications, ranging from furniture assembly to construction projects.','Barrel Nut.png','Barrel Nut.png','Barrel Nut.png','Barrel Nut.png',50.00,0,'white'),
(8,'10x Coupling Nuts','Nuts','Elongated hexagonal nuts with internal threading throughout their length, utilized to join two threaded rods or studs together securely, often employed in structural and mechanical applications to extend or adjust connections.','Coupling Nut.png','Coupling Nut.png','Coupling Nut.png','Coupling Nut.png',100.00,0,'white'),
(9,'10x Philips Head Screws','Screws','Common fasteners with a cross-shaped indentation on the head, easily installed and removed with a Phillips screwdriver, widely used in various industries for their convenience.','Philips Head.png','Philips Head.png','Philips Head.png','Philips Head.png',20.00,0,'white'),
(10,'10x Binding Head Screws','Screws','Fasteners with flat heads, used for a clean finish and even clamping force, often seen in woodworking and furniture assembly.','Binding Head.png','Binding Head.png','Binding Head.png','Binding Head.png',25.00,0,'white'),
(11,'10x Dome Head Screws','Screws','Fasteners with rounded heads, offering a smooth finish and security, commonly used in various applications for aesthetics and functionality.','Dome Head.png','Dome Head.png','Dome Head.png','Dome Head.png',50.00,0,'white'),
(12,'10x Flat Head Screws','Screws','Fasteners with heads that sit flush or slightly below the surface when installed, commonly used in woodworking and construction for their sleek appearance and practicality.','Flat Head.png','Flat Head.png','Flat Head.png','Flat Head.png',100.00,0,'white');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(108) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(7,'Annika Sabrina Mascardo','annikasmascardo@gmail.com','2a8f06fdfd73853f3de853d60ebd280f'),
(8,'Carlos','carlostbautista@su.edu.ph','02da0bbb40a9ece68f0eda06e90167b2');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'foxayvdf_new_schema'
--

--
-- Dumping routines for database 'foxayvdf_new_schema'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-21 14:05:05
