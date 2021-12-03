/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : toko-buku-c10-7

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 02/12/2021 16:53:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `penerbit_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `penulis` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `berat` int(10) UNSIGNED NOT NULL,
  `dimensi` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bahasa` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cover` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ISBN` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deskripsi` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga` int(20) NOT NULL,
  `gambar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  INDEX `buku_penerbit_id_foreign`(`penerbit_id`) USING BTREE,
  INDEX `buku_kategori_id_foreign`(`kategori_id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `buku_penerbit_id_foreign` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------
INSERT INTO `buku` VALUES (1, 1, 1, 'Buku 1', 'Penulis 1', 1, '1', '1', '1', '1', '1', 20000, 'default.png', '2021-11-29 21:07:46', NULL);
INSERT INTO `buku` VALUES (2, 1, 1, 'Buku 1', 'Penulis 1', 1, '1', '1', '1', '1', '1', 20000, 'default.png', '2021-11-29 21:07:46', NULL);
INSERT INTO `buku` VALUES (3, 1, 1, 'Buku 1', 'Penulis 1', 1, '1', '1', '1', '1', '1', 20000, 'default.png', '2021-11-29 21:07:46', NULL);
INSERT INTO `buku` VALUES (4, 8, 1, 'ppkn', ' Yusnawan Lubis dan Mohamad Sodeli', 12, '20x34', 'ID', 'hard', '978-602-282-478-7', ' Yusnawan Lubis dan Mohamad Sodeli', 0, '1638196839_1b2fb928aeb06866254a.jpg', '2021-11-29 21:40:39', NULL);
INSERT INTO `buku` VALUES (5, 1, 1, 'Matematika', 'Penulis 1', 1, '1', '1', '1', '1', '1', 25000, 'default.png', '2021-12-01 04:57:45', NULL);
INSERT INTO `buku` VALUES (6, 1, 1, 'Fisika', 'Penulis 1', 1, '1', '1', '1', '1', '1', 20000, 'default.png', '2021-12-01 04:57:45', NULL);
INSERT INTO `buku` VALUES (7, 1, 1, 'Bahasa Inggri', 'Penulis 1', 1, '1', '1', '1', '1', '1', 15000, 'default.png', '2021-12-01 04:57:45', NULL);

-- ----------------------------
-- Table structure for detail_pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `detail_pemesanan`;
CREATE TABLE `detail_pemesanan`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pemesanan_id` int(10) UNSIGNED NOT NULL,
  `buku_id` int(10) UNSIGNED NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `sub_total` int(10) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  INDEX `detail_pemesanan_pemesanan_id_foreign`(`pemesanan_id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  CONSTRAINT `detail_pemesanan_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_pemesanan
-- ----------------------------
INSERT INTO `detail_pemesanan` VALUES (8, 17, 2, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (9, 17, 3, 20000, 40000, 2);
INSERT INTO `detail_pemesanan` VALUES (10, 18, 3, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (11, 18, 5, 25000, 25000, 1);
INSERT INTO `detail_pemesanan` VALUES (12, 19, 3, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (13, 20, 3, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (14, 20, 5, 25000, 25000, 1);
INSERT INTO `detail_pemesanan` VALUES (15, 21, 2, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (16, 21, 3, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (17, 21, 5, 25000, 25000, 1);
INSERT INTO `detail_pemesanan` VALUES (18, 22, 5, 25000, 25000, 1);
INSERT INTO `detail_pemesanan` VALUES (19, 22, 6, 20000, 20000, 1);
INSERT INTO `detail_pemesanan` VALUES (20, 23, 3, 20000, 40000, 2);
INSERT INTO `detail_pemesanan` VALUES (21, 23, 4, 0, 0, 1);
INSERT INTO `detail_pemesanan` VALUES (22, 23, 5, 25000, 50000, 2);
INSERT INTO `detail_pemesanan` VALUES (23, 24, 5, 25000, 25000, 1);
INSERT INTO `detail_pemesanan` VALUES (24, 25, 3, 20000, 40000, 2);
INSERT INTO `detail_pemesanan` VALUES (25, 25, 4, 0, 0, 1);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Agama dan filsafat', '2021-11-29 21:07:46', NULL);
INSERT INTO `kategori` VALUES (2, 'Buku Anak', '2021-11-29 21:07:46', NULL);
INSERT INTO `kategori` VALUES (3, 'Kesehatan', '2021-11-29 21:07:46', NULL);
INSERT INTO `kategori` VALUES (4, 'Komik', '2021-11-29 21:07:46', NULL);
INSERT INTO `kategori` VALUES (5, 'Pelajaran', '2021-11-29 21:07:46', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (25, '2021-11-08-085853', 'App\\Database\\Migrations\\UserMigration', 'default', 'App', 1638194863, 1);
INSERT INTO `migrations` VALUES (26, '2021-11-24-204535', 'App\\Database\\Migrations\\KategoriMigration', 'default', 'App', 1638194863, 1);
INSERT INTO `migrations` VALUES (27, '2021-11-24-213640', 'App\\Database\\Migrations\\PenerbitMigration', 'default', 'App', 1638194863, 1);
INSERT INTO `migrations` VALUES (28, '2021-11-25-214401', 'App\\Database\\Migrations\\BukuMigration', 'default', 'App', 1638194863, 1);
INSERT INTO `migrations` VALUES (31, '2021-12-01-094641', 'App\\Database\\Migrations\\PemesananMigration', 'default', 'App', 1638354200, 2);
INSERT INTO `migrations` VALUES (34, '2021-12-01-103235', 'App\\Database\\Migrations\\PemesananMigration', 'default', 'App', 1638366409, 3);
INSERT INTO `migrations` VALUES (37, '2021-12-01-210102', 'App\\Database\\Migrations\\StatusPembayaranMigration', 'default', 'App', 1638396736, 4);

-- ----------------------------
-- Table structure for pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_hp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  INDEX `pemesanan_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  CONSTRAINT `pemesanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemesanan
-- ----------------------------
INSERT INTO `pemesanan` VALUES (17, 5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', 'Generates an insert string based on the data you supply, and runs the query. You can either pass an array or an object to the function. Here is an example using an array:', '2021-12-01 20:51:13', NULL);
INSERT INTO `pemesanan` VALUES (18, 5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', 'Kasturian, Ternate', '2021-12-01 23:14:55', NULL);
INSERT INTO `pemesanan` VALUES (19, 5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', 'asdasdas asdasd', '2021-12-02 02:14:39', NULL);
INSERT INTO `pemesanan` VALUES (20, 5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', '123123123123', '2021-12-02 02:53:09', NULL);
INSERT INTO `pemesanan` VALUES (21, 5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', '12312 12312 12312312', '2021-12-02 02:53:48', NULL);
INSERT INTO `pemesanan` VALUES (22, 5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', 'aasdasdasdasd', '2021-12-02 05:44:31', NULL);
INSERT INTO `pemesanan` VALUES (23, 2, 'Risna', '081212121212', 'admin@example.com', 'asdasda asdas asda sda asd', '2021-12-02 05:55:40', NULL);
INSERT INTO `pemesanan` VALUES (24, 2, 'Risna', '081212121212', 'admin@example.com', 'asdasd asdad sdas', '2021-12-02 05:57:49', NULL);
INSERT INTO `pemesanan` VALUES (25, 2, 'Risna', '081212121212', 'admin@example.com', 'sdfsdfsdfsdfsdfsdfsdf sdfsdf sdfsdfs sdfsdf sdfs', '2021-12-02 06:26:10', NULL);

-- ----------------------------
-- Table structure for penerbit
-- ----------------------------
DROP TABLE IF EXISTS `penerbit`;
CREATE TABLE `penerbit`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `penerbit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penerbit
-- ----------------------------
INSERT INTO `penerbit` VALUES (1, 'Flashbooks', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (2, 'Indiva Media Kreasi', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (3, 'Kanaya Press', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (4, 'Romancious', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (5, '3L Comic', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (6, 'AB Publisher Yogyakarta', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (7, 'Abata Press', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (8, 'Abdi Pustaka', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (9, 'Adhi Sarana Nusantara', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (10, 'Adi Bintang', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (11, 'Adi Citra Cemerlang', '2021-11-29 21:07:46', NULL);
INSERT INTO `penerbit` VALUES (12, 'Adibintang', '2021-11-29 21:07:46', NULL);

-- ----------------------------
-- Table structure for status_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `status_pembayaran`;
CREATE TABLE `status_pembayaran`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pemesanan_id` int(10) UNSIGNED NOT NULL,
  `status` enum('dibayar','belum dibayar') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'belum dibayar',
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `status_pembayaran_pemesanan_id_foreign`(`pemesanan_id`) USING BTREE,
  CONSTRAINT `status_pembayaran_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status_pembayaran
-- ----------------------------
INSERT INTO `status_pembayaran` VALUES (5, 21, 'dibayar', '2021-12-02 05:30:36', '2021-12-02 05:31:27');
INSERT INTO `status_pembayaran` VALUES (6, 17, 'dibayar', '2021-12-02 05:35:21', NULL);
INSERT INTO `status_pembayaran` VALUES (7, 19, 'dibayar', '2021-12-02 05:35:24', NULL);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_hp` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` enum('MEMBER','ADMIN') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gambar` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, '', '', '', 'admin', '$2y$10$JWTxFRXbpHIn5nZk10FOM.xcNZMLY/IpYFpRJWcmJIY7FxuzUxrpy', 'ADMIN', 'default.png', '2021-11-29 21:07:45', NULL);
INSERT INTO `user` VALUES (2, 'Risna', '081212121212', 'admin@example.com', 'user2', '$2y$10$ZzWFV6QYa8rXxhxR5aV1.e9zHqQRWp5tFRcpqAVgZpz7MhNewNyPa', 'MEMBER', 'default.png', '2021-11-29 21:07:46', NULL);
INSERT INTO `user` VALUES (3, 'Risto', '081212121212', 'admin@example.com', 'user3', '$2y$10$MeovLPElXuyOV2qysdzc9eXCFGjTEZbZaKJISO7nZlrOvtOV044rq', 'MEMBER', 'default.png', '2021-11-29 21:07:46', NULL);
INSERT INTO `user` VALUES (4, 'Rinso', '081212121212', 'admin@example.com', 'user4', '$2y$10$TiijBp3D0skyg2/xwPe6HOIedb0dD676L6c4UW42M7OLnClJE84H2', 'MEMBER', 'default.png', '2021-11-29 21:07:46', NULL);
INSERT INTO `user` VALUES (5, 'Rifaldi Ardan', '0823213045392', 'efalardan2020@gmail.com', 'efalardan', '$2y$10$yub.vlRYbTNp27dtspblcOOchj4a8UU.XtOR.uKJRtMLY0VtbDKxO', 'MEMBER', '1638350488_6d7d2bd9a004682fd359.png', '2021-12-01 16:21:29', NULL);

SET FOREIGN_KEY_CHECKS = 1;
