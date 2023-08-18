-- MySQL dump 10.19  Distrib 10.2.44-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: akm9821_inventory
-- ------------------------------------------------------
-- Server version	10.2.44-MariaDB-cll-lve

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
-- Current Database: `akm9821_inventory`
--


--
-- Table structure for table `daftar_barang`
--

DROP TABLE IF EXISTS `daftar_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `daftar_barang` (
  `id` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tersedia` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL,
  `kondisi_rusak` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daftar_barang`
--

LOCK TABLES `daftar_barang` WRITE;
/*!40000 ALTER TABLE `daftar_barang` DISABLE KEYS */;
INSERT INTO `daftar_barang` (`id`, `nama_barang`, `kategori`, `jumlah`, `tersedia`, `dipinjam`, `kondisi_rusak`) VALUES ('pryktr','Proyektor','Elektronik',2,2,0,0),('sjd','Sajadah','Alat Ibadah',10,10,0,0),('spkr','Speaker','Elektronik',1,1,0,0),('srg','Sarung','Alat Ibadah',10,10,0,0);
/*!40000 ALTER TABLE `daftar_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori_barang`
--

DROP TABLE IF EXISTS `kategori_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(99) NOT NULL,
  `kode_kategori` varchar(99) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9186 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori_barang`
--

LOCK TABLES `kategori_barang` WRITE;
/*!40000 ALTER TABLE `kategori_barang` DISABLE KEYS */;
INSERT INTO `kategori_barang` (`id`, `kategori`, `kode_kategori`) VALUES (5558,'Alat Ibadah','Alat Ibadah'),(7417,'Elektronik','Elektronik');
/*!40000 ALTER TABLE `kategori_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id` int(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
INSERT INTO `transaksi` (`id`, `user`, `tipe`, `nama_barang`, `kategori`, `jumlah`, `keterangan`, `status`, `tanggal`, `jam`) VALUES (24743,'akmal','Pinjam Barang','Speaker','Elektronik',1,'Tidak ada keterangan','Sudah Dikembalikan','2021-11-16','02:10:46'),(45671,'akmal','Pinjam Barang','Sajadah','Alat Ibadah',2,'Sholat Jumat','Sudah Dikembalikan','2021-11-16','02:09:59');
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_wa` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `no_wa`, `role`) VALUES (4,'admin','272874d450b7f8381b1174133ac62b40','Akmal Maulana Basri','akmalmaulanabasri@gmail.com','089668258695','admin'),(8,'akmal','272874d450b7f8381b1174133ac62b40','akmal','akmalmaulanabasri711@gmail.com','0821','member');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'akm9821_inventory'
--

--
-- Dumping routines for database 'akm9821_inventory'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-17 12:04:40
