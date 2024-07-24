-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2024 at 01:20 AM
-- Server version: 8.0.38
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_cedea`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, '{\"id\":\"Cedea Seafood\",\"en\":\"Cedea Seafood\"}', 'cedea-seafood', '2024-03-25 02:57:43', '2024-03-25 12:22:47'),
(3, '{\"id\":\"Teman Laut\",\"en\":\"Teman Laut\"}', 'teman-laut', '2024-03-25 03:13:37', '2024-03-25 12:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\PostNews', 1, '15d49cd2-bf0a-43b7-87e9-3c7cbdd63f13', 'post_image', 'CSR-JAKARTA-CEDEA-768x576', '01HSFT698444C5T5YT51ZQNQPY.jpg', 'image/jpeg', 'public', 'public', 75311, '[]', '[]', '[]', '[]', 1, '2024-03-20 23:11:52', '2024-03-20 23:11:52'),
(2, 'App\\Models\\PostNews', 2, 'e83c0099-b044-4625-8b61-b4b69e1a1973', 'post_image', 'korean-wave-cedea-nct-dream-give-away-768x768', '01HSFTPNFASD3J3A7CWXGVA76J.jpg', 'image/jpeg', 'public', 'public', 106612, '[]', '[]', '[]', '[]', 1, '2024-03-20 23:20:48', '2024-03-20 23:20:48'),
(3, 'App\\Models\\PostRecipes', 1, 'd240dea6-dbec-4aaf-a4ca-c558afcd23c1', 'post_image', 'CHIKUWA-SAUS-PADANG-THUMBNAIL-01-01-01-768x439', '01HSSVQ289JHQ5MQ91RY0G307G.jpg', 'image/jpeg', 'public', 'public', 116756, '[]', '[]', '[]', '[]', 1, '2024-03-24 20:50:54', '2024-03-24 20:50:54'),
(4, 'App\\Models\\PostRecipes', 2, '19b86ca8-68c7-4b2e-b8ee-43b37febb7d5', 'post_image', 'CHICKEN-DUMPLING-TAICHAN-THUMBNAIL-01-768x439', '01HSSVRTV8334H944H05RW01XP.jpg', 'image/jpeg', 'public', 'public', 117331, '[]', '[]', '[]', '[]', 1, '2024-03-24 20:51:51', '2024-03-24 20:51:51'),
(12, 'App\\Models\\Products\\Category', 3, 'e7193a49-62fd-4a80-b26a-e6a29b1e9237', 'products', 'logo-teman-laut', '01HSWEX5S27KFM63GY2PWDQEBE.png', 'image/png', 'public', 'public', 68215, '[]', '[]', '[]', '[]', 1, '2024-03-26 04:04:46', '2024-03-26 04:04:46'),
(15, 'App\\Models\\Products\\Product', 1, 'cabc9d06-8f87-413e-ba58-c6c13fb72116', 'products', 'Baso Ikan Sayuran 500gr', '01HTCKNN16B7X5T9M07Y6JG7F5.png', 'image/png', 'public', 'public', 2116530, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:35:53', '2024-04-01 17:35:53'),
(16, 'App\\Models\\Products\\Category', 1, '24eef59b-d3d0-4f66-a56c-fc85a7ed9565', 'products', 'logo-cedea', '01HTCKPZ06KEQ7VW0M5T7BS3RN.png', 'image/png', 'public', 'public', 13064, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:36:36', '2024-04-01 17:36:36'),
(17, 'App\\Models\\Products\\Product', 2, '46fb996b-f56c-44cc-b723-ca62d6a3d65b', 'products', 'Baso Ikan Sayuran Goreng 500gr', '01HTCKSF4KY0P85ZJJNV2W7T15.png', 'image/png', 'public', 'public', 2195734, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:37:58', '2024-04-01 17:37:58'),
(18, 'App\\Models\\Products\\Product', 3, '1655e990-b2b9-4683-b1b6-faf034eca448', 'products', 'Baso Ikan Sedang 500gr', '01HTCKTMARSYDSV4RP1QMRX6WR.png', 'image/png', 'public', 'public', 2115332, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:38:36', '2024-04-01 17:38:36'),
(19, 'App\\Models\\Products\\Product', 4, 'f15012b7-b495-4b2f-a44a-554994f5e583', 'products', 'Baso Ikan Udang 500gr', '01HTCKVHWV72KGH2CMX1Z20D0R.png', 'image/png', 'public', 'public', 2217819, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:39:06', '2024-04-01 17:39:06'),
(20, 'App\\Models\\Products\\Product', 5, 'dd406365-1ca7-425a-b23d-819433716aa3', 'products', 'Baso Ikan & Cumi 500gr', '01HTCKXTKB88P592NG16R9119K.png', 'image/png', 'public', 'public', 2126468, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:40:21', '2024-04-01 17:40:21'),
(21, 'App\\Models\\Products\\Product', 6, 'a820cffd-ee7c-4c2e-86e0-1b6a89619f68', 'products', 'Baso Ikan Besar 500gr', '01HTCKYFHTDMGBKNHD939C1WBA.png', 'image/png', 'public', 'public', 2118813, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:40:42', '2024-04-01 17:40:42'),
(22, 'App\\Models\\Products\\Product', 7, '564a8c0e-2040-41ce-a1a2-185208cfe462', 'products', 'Baso Ikan dan Udang (Prawn Ball) 500gr', '01HTCM1V1MHXKG5EJM44H4HD7H.png', 'image/png', 'public', 'public', 2227101, '[]', '[]', '[]', '[]', 1, '2024-04-01 17:42:32', '2024-04-01 17:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_21_025010_create_post_news_table', 1),
(6, '2024_03_21_025019_create_post_recipes_table', 1),
(7, '2024_03_21_030244_create_media_table', 1),
(8, '2024_03_25_074418_create_products_table', 1),
(9, '2024_03_25_074430_create_categories_table', 1),
(10, '2024_03_25_091708_create_tag_tables', 1),
(11, '2024_03_25_105019_make_translation_attributes_to_columns', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_news`
--

CREATE TABLE `post_news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_publish` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_news`
--

INSERT INTO `post_news` (`id`, `title`, `slug`, `content`, `is_publish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"id\":\"CEDEA PEDULI 2023, DARI KITA UNTUK SEMUA\"}', 'cedea-peduli-2023-dari-kita-untuk-semua', '{\"id\":\"<p>Menjelang Hari Raya Idul Fitri 1444 H, PT CitraDimensi Arthali kembali menjalankan bentuk kepedulian dan tanggung jawab sosial perusahaan ( <em>Corporate Social Responsibility – CSR</em> ).</p><p>Kegiatan CSR CEDEA PEDULI ini selalu di lakukan PT CitraDimensi Arthali, selaku pemilik brand CEDEA , sebagai pioneer makanan beku berbasis seafood, kepedulian terhadap lingkungan sekitar terus di cerminkan dengan melakukan kegiatan yang bersifat sosial. Bertepatan dengan bulan suci Ramadhan kali ini, team CSR dari CEDEA serentak melakukan kegiatan sosial berupa penyaluran bantuan kepedulian terhadap saudara saudara kita yang membutuhkan di sejumlah kota di Indonesia. Kegiatan tersebut dilakukan oleh karyawan dan karyawati PT CitraDimensi Arthali secara langsung dengan mendatangi Yayasan/ Panti Jompo /Daerah yang membutuhkan.</p><p>Sejumlah Panti Jompo dan juga area yang menjadi lokasi donasi kepedulian PT. CitraDimensi Arthali, diantaranya :</p><p>Jakarta :<em> Panti Sosial Tresna Werdha Budi Mulia 3</em></p><p>Jawa Timur – UPTD Griya Werda<br>Jawa Barat – Lembaga kesejahteraan sosial lanjut usia Fakku Raqabah Kota Bandung<br>Lampung – Panti Jompo Tresna WerdhaJawa tengah – Panti Jompo GPKP Usia Lanjut Aisyiyah Surakarta</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;CSR-SURABAYA-CEDEA.jpg&quot;,&quot;filesize&quot;:132680,&quot;height&quot;:637,&quot;href&quot;:&quot;https://cedea_web_project.test/storage/goTXzAtZpQGCDkdrCpHq3iEHsFk3AG949EQOXGD3.jpg&quot;,&quot;url&quot;:&quot;https://cedea_web_project.test/storage/goTXzAtZpQGCDkdrCpHq3iEHsFk3AG949EQOXGD3.jpg&quot;,&quot;width&quot;:1274}\\\" data-trix-content-type=\\\"image/jpeg\\\" data-trix-attributes=\\\"{&quot;presentation&quot;:&quot;gallery&quot;}\\\" class=\\\"attachment attachment--preview attachment--jpg\\\"><a href=\\\"https://cedea_web_project.test/storage/goTXzAtZpQGCDkdrCpHq3iEHsFk3AG949EQOXGD3.jpg\\\"><img src=\\\"https://cedea_web_project.test/storage/goTXzAtZpQGCDkdrCpHq3iEHsFk3AG949EQOXGD3.jpg\\\" width=\\\"1274\\\" height=\\\"637\\\"><figcaption class=\\\"attachment__caption\\\"><span class=\\\"attachment__name\\\">CSR-SURABAYA-CEDEA.jpg</span> <span class=\\\"attachment__size\\\">129.57 KB</span></figcaption></a></figure></p><p>Kegiatan yang rutin di lakukan oleh pemilik merk CEDEA ini selain merupakan bentuk tanggung jawab sosial perusahaan kepada lingkungan dan ekonomi sekitar, juga di maksudkan agar setiap karyawan/ karyawati PT CitraDimensi Arthali ini senantiasa memiliki jiwa sosial, hal ini dilakukan dengan selalu melibatkan karyawan/ karyawati dari berbagai divisi di perusahaan untuk turut serta dalam penyerahan donasi tersebut.</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;CSR-YOGYA-CEDEA.jpg&quot;,&quot;filesize&quot;:309160,&quot;height&quot;:1200,&quot;href&quot;:&quot;https://cedea_web_project.test/storage/zGVqNIXqqDcNpIjZXq1iBSAd2enkYZLNYs8IWjgk.jpg&quot;,&quot;url&quot;:&quot;https://cedea_web_project.test/storage/zGVqNIXqqDcNpIjZXq1iBSAd2enkYZLNYs8IWjgk.jpg&quot;,&quot;width&quot;:1600}\\\" data-trix-content-type=\\\"image/jpeg\\\" data-trix-attributes=\\\"{&quot;presentation&quot;:&quot;gallery&quot;}\\\" class=\\\"attachment attachment--preview attachment--jpg\\\"><a href=\\\"https://cedea_web_project.test/storage/zGVqNIXqqDcNpIjZXq1iBSAd2enkYZLNYs8IWjgk.jpg\\\"><img src=\\\"https://cedea_web_project.test/storage/zGVqNIXqqDcNpIjZXq1iBSAd2enkYZLNYs8IWjgk.jpg\\\" width=\\\"1600\\\" height=\\\"1200\\\"><figcaption class=\\\"attachment__caption\\\"><span class=\\\"attachment__name\\\">CSR-YOGYA-CEDEA.jpg</span> <span class=\\\"attachment__size\\\">301.91 KB</span></figcaption></a></figure></p><p>Merk Cedea sendiri adalah produk makanan beku dengan bahan Ikan Olahan Bermutu bisnis yang di mulai sejak tahun 1997 ini terus berkembang, dan hingga saat ini telah memiliki 3 pabrik pengolahan produk ikan olahan di Muara Baru Jakarta Utara, Medan, Dan Majalengka Jawa Barat. Sebagai pioneer produsen bakso ikan dan juga sejumlah produk yang sudah dikenal oleh masyarakat seperti : Cedea Fish Dumpling Cheese, Cedea Fish Dumpling Chicken, Cedea Steamboat, dan beragam produk lain yang sangat di gemari oleh masyarakat Indonesia.</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image/jpeg&quot;,&quot;filename&quot;:&quot;csr-lampung-cedea-768x432.jpg&quot;,&quot;filesize&quot;:58094,&quot;height&quot;:432,&quot;href&quot;:&quot;https://cedea_web_project.test/storage/3ywWJTwpP0Y5uVCY8CqtOEbS1UnwXhKDpfMRAypE.jpg&quot;,&quot;url&quot;:&quot;https://cedea_web_project.test/storage/3ywWJTwpP0Y5uVCY8CqtOEbS1UnwXhKDpfMRAypE.jpg&quot;,&quot;width&quot;:768}\\\" data-trix-content-type=\\\"image/jpeg\\\" data-trix-attributes=\\\"{&quot;presentation&quot;:&quot;gallery&quot;}\\\" class=\\\"attachment attachment--preview attachment--jpg\\\"><a href=\\\"https://cedea_web_project.test/storage/3ywWJTwpP0Y5uVCY8CqtOEbS1UnwXhKDpfMRAypE.jpg\\\"><img src=\\\"https://cedea_web_project.test/storage/3ywWJTwpP0Y5uVCY8CqtOEbS1UnwXhKDpfMRAypE.jpg\\\" width=\\\"768\\\" height=\\\"432\\\"><figcaption class=\\\"attachment__caption\\\"><span class=\\\"attachment__name\\\">csr-lampung-cedea-768x432.jpg</span> <span class=\\\"attachment__size\\\">56.73 KB</span></figcaption></a></figure></p><p>Sebagai pelopor produk olahan bermutu di Indonesia, CEDEA terus berinovasi untuk menghadirkan produk berkualitas dan sesuai untuk kebutuhan pasar yang terus berkembang. Hal ini tercermin dari tingginya permintaan seluruh produk CEDEA dari pasar domestik dan juga ke mancanegara.&nbsp; Seluruh produk CEDEA, sudah bisa Anda dapatkan di toko frozen food terdekat, supermarket dan <a href=\\\"https://biolinky.co/cedeaseafood\\\"><span style=\\\"text-decoration: underline;\\\">marketplace</span></a> . Untuk Informasi dan update promo mengenai CEDEA Seafood Anda juga bisa mengunjungi website official <a href=\\\"https://cedeaseafood.com/\\\"><span style=\\\"text-decoration: underline;\\\">Cedea Ikan Olahan Bermutu</span></a> maupun laman <a href=\\\"https://www.youtube.com/c/CedeaSeafood\\\"><span style=\\\"text-decoration: underline;\\\">Youtube Official CEDEA Seafood</span></a><span style=\\\"text-decoration: underline;\\\">.</span></p>\"}', 1, NULL, '2024-03-20 23:11:50', '2024-03-25 11:09:13'),
(2, '{\"id\":\"NONTON NCT DREAM GRATIS, CEDEA GIVE AWAY TIKET KOREAN WAVE 2022\",\"en\":\"\"}', 'nonton-nct-dream-gratis-cedea-give-away-tiket-korean-wave-2022', '{\"id\":\"<p>Korean Wave TRANS TV 2022 berlangsung di Trans Studio Mall Cibubur pada Rabu (27/9), pada kesempatan kali ini CEDEA sebagai salah satu sponsor Korean Wave 2022 mengadakan give away puluhan tiket konser NCT Dream, melalui kegiatan di instagram <a href=\\\"https://www.instagram.com/cedeaseafood/\\\">@cedeaseafood </a>dan juga di booth CEDEA selama konser berlangsung.</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:281,&quot;url&quot;:&quot;https://cedeaseafood.com/wp-content/uploads/2022/09/give-away-tiket-nct-dream-cedea-.jpg&quot;,&quot;width&quot;:500}\\\" data-trix-content-type=\\\"image\\\" class=\\\"attachment attachment--preview\\\"><img src=\\\"https://cedeaseafood.com/wp-content/uploads/2022/09/give-away-tiket-nct-dream-cedea-.jpg\\\" width=\\\"500\\\" height=\\\"281\\\"><figcaption class=\\\"attachment__caption\\\"></figcaption></figure></p><p><br>Salah satu pemenang Give Away Tiket di booth CEDEA<br><br></p><p>Ribuan penggemar NCT Dream yang datang ke acara tersebut berkesempatan mendapat tiket gratis yang di undi dengan syarat pembelian produk di booth CEDEA sebesar Rp 50.000 dan berhak mendapatkan nomor undian Give Away tiket</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:281,&quot;url&quot;:&quot;https://cedeaseafood.com/wp-content/uploads/2022/09/KOREAN-WAVE-NCT-DREAM-CEDEA-GIVE-AWAY-2022.jpg&quot;,&quot;width&quot;:500}\\\" data-trix-content-type=\\\"image\\\" class=\\\"attachment attachment--preview\\\"><img src=\\\"https://cedeaseafood.com/wp-content/uploads/2022/09/KOREAN-WAVE-NCT-DREAM-CEDEA-GIVE-AWAY-2022.jpg\\\" width=\\\"500\\\" height=\\\"281\\\"><figcaption class=\\\"attachment__caption\\\"></figcaption></figure></p><p><br>Pemenang Give Away Tiket Korean Wave 2022<br><br></p><p>NCT DREAM merupakan grup K-Pop yang menjadi tamu spesial pada malam hari ini.</p><p>Grup besutan SM Entertainment itu secara khusus terbang ke Indonesia untuk menghibur NCTzen (sebutan untuk penggemar NCT).</p><p>Renjun, Jeno, Jaemin, Chenle, dan Jisung membuka penampilan mereka dengan membawakan lagu <em>Beatbox</em>.</p><p>Kelima anggota NCT DREAM menari dengan energik dan on point, sukses membuat penonton menjerit.</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image&quot;,&quot;url&quot;:&quot;https://cedeaseafood.com/wp-content/uploads/2022/09/CEDEA-KOREAN-WAVE-NCT-DREAM.jpg&quot;}\\\" data-trix-content-type=\\\"image\\\" class=\\\"attachment attachment--preview\\\"><img src=\\\"https://cedeaseafood.com/wp-content/uploads/2022/09/CEDEA-KOREAN-WAVE-NCT-DREAM.jpg\\\" width=\\\"500\\\" height=\\\"281\\\"><figcaption class=\\\"attachment__caption\\\"></figcaption></figure></p><p>Cedea menghadirkan produk yang sesuai dengan target market NCTzen, yaitu CEDEA Premium pack yang terdiri dari Otak Otak ala Singapore, Salmon Ball, Fish Roll, Fish Dumpling Cheese, Fish Dumpling Chicken kemasan 200 gr yang dilengkapi saus dipping sebagai cocolan nya.</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:1024,&quot;url&quot;:&quot;https://cedeaseafood.com/wp-content/uploads/2022/09/KV-POSTER-PREMIUM-PACK-Lapor-Pak-T7-01-921x1024.jpg&quot;,&quot;width&quot;:921}\\\" data-trix-content-type=\\\"image\\\" class=\\\"attachment attachment--preview\\\"><img src=\\\"https://cedeaseafood.com/wp-content/uploads/2022/09/KV-POSTER-PREMIUM-PACK-Lapor-Pak-T7-01-921x1024.jpg\\\" width=\\\"921\\\" height=\\\"1024\\\"><figcaption class=\\\"attachment__caption\\\"></figcaption></figure></p><p><br>Cedea Premium Pack 200 gr<br><br></p><p>Pengunjung Trans Studio Mall Cibubur juga di manjakan dengan hadirnya Korean Food yang diaplikasikan dari aneka produk CEDEA, pengunjung dapat menikmati lezatnya produk CEDEA secara langsung yang di kemas dalam sajian korean food.</p><p><figure data-trix-attachment=\\\"{&quot;contentType&quot;:&quot;image&quot;,&quot;height&quot;:281,&quot;url&quot;:&quot;https://cedeaseafood.com/wp-content/uploads/2022/09/CEDEA-BOOTH-KOREAN-WAVE-NCT.jpg&quot;,&quot;width&quot;:500}\\\" data-trix-content-type=\\\"image\\\" class=\\\"attachment attachment--preview\\\"><img src=\\\"https://cedeaseafood.com/wp-content/uploads/2022/09/CEDEA-BOOTH-KOREAN-WAVE-NCT.jpg\\\" width=\\\"500\\\" height=\\\"281\\\"><figcaption class=\\\"attachment__caption\\\"></figcaption></figure></p><p><br>Antrian di booth CEDEA Korean Wave 2022<br><br></p><p>Sebagai pelopor produk olahan bermutu di Indonesia, CEDEA terus berinovasi untuk menghadirkan produk berkualitas dan sesuai untuk kebutuhan pasar yang terus berkembang. Hal ini tercermin dari tingginya permintaan seluruh produk CEDEA dari pasar domestik dan juga ke mancanegara.&nbsp; Seluruh produk CEDEA, sudah bisa Anda dapatkan di toko frozen food terdekat, supermarket dan <a href=\\\"https://biolinky.co/cedeaseafood\\\">marketplace</a> . Untuk Informasi dan update promo mengenai CEDEA Seafood Anda juga bisa mengunjungi website official <a href=\\\"https://cedeaseafood.com/\\\">Cedea Ikan Olahan Bermutu</a> maupun laman <a href=\\\"https://www.youtube.com/c/CedeaSeafood\\\">Youtube Official CEDEA Seafood</a></p><p>Tunggu keseruan lain nya bersama CEDEA, Ikan Olahan Bermutu.</p>\",\"en\":\"\"}', 1, NULL, '2024-03-20 23:20:47', '2024-03-25 11:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `post_recipes`
--

CREATE TABLE `post_recipes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_publish` tinyint(1) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_recipes`
--

INSERT INTO `post_recipes` (`id`, `title`, `slug`, `content`, `is_publish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '{\"id\":\"CHIKUWA SAOS PADANG – CHEF VANIA WIBISONO\",\"en\":null}', 'chikuwa-saos-padang-chef-vania-wibisono', '{\"id\":\"<p><strong>Bahan bahan</strong></p><ul><li>250 gr Cedea Chikuwa Mini</li><li>1 bawang bombay</li><li>2 sdm saus sambal</li><li>2 sdm saus tomat</li><li>1/2 sdm saus tiram</li><li>1/2 sdm kecap manis</li><li>1/2 sdt kaldu jamur</li><li>1/2 sdt merica bubuk</li><li>garam secukupnya</li></ul><p><strong>bumbu halus :</strong></p><ul><li>4 bawang merah</li><li>5 bawang putih</li><li>cabe rawit/cabe keriting sesuai selera</li><li>1 ruas jahe</li></ul><p><strong>Cara membuat:</strong></p><ul><li>Tumis bumbu halus hingga harum kemudian masukkan bawang bombay tumis sampai layu.</li><li>Masukkan air,kaldu jamur,merica bubuk,kecap manis dan semua saus masak hingga mendidih</li><li>kemudian masukkan Cedea Chikuwa aduk rata masak hingga mengental dan bumbu meresap.</li><li>Kemudian Sajikan</li></ul>\",\"en\":null}', 1, NULL, '2024-03-24 20:50:53', '2024-03-25 11:21:40'),
(2, '{\"id\":\"CHICKEN DUMPLING BUMBU TAICHAN ALA CEDEA – CHEF BILLY KALANGI\",\"en\":null}', 'chicken-dumpling-bumbu-taichan-ala-cedea-chef-billy-kalangi', '{\"id\":\"<p><strong>Bahan :</strong></p><ul><li>CEDEA Fish Dumpling Chicken</li><li>20 rawit merah</li><li>5 bh cabe merah besar, buang biji</li><li>3 siung bawang putih</li><li>¼ sdt kaldu jamur</li><li>Secukupnya gula dan garam</li><li>Secukupnya minyak untuk menumis</li></ul><p><strong>Bahan Pelengkap:</strong></p><ul><li>Lontong</li><li>Irisan jeruk nipis</li><li>Bawang putih goreng, remukkan</li></ul><p><strong>Cara membuat :</strong></p><ol><li>Untuk membuat sambal, rebus cabai rawit, cabai merah besar dan bawang putih, lalu angkat dan ulek/blender bersama dengan gula, garam dan kaldu jamur.</li><li>Setelah itu tumis sambal dengan sedikit minyak, lalu masukan CEDEA Fish Dumpling Chicken dan tambahkan sisa air rebusan cabe apabila terlalu kering.</li><li>Angkat dan sajikan dengan bahan pelengkap.</li></ol>\",\"en\":null}', 1, NULL, '2024-03-24 20:51:51', '2024-03-25 11:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_youtube` tinyint(1) NOT NULL DEFAULT '0',
  `youtube_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `description`, `has_youtube`, `youtube_id`, `created_at`, `updated_at`) VALUES
(1, '{\"id\":\"Baso Ikan Sayuran\",\"en\":null}', 'baso-ikan-sayuran', 1, '{\"id\":\"<p><strong>Baso Ikan Sayuran</strong></p>\",\"en\":null}', 0, NULL, '2024-03-25 13:02:23', '2024-03-25 13:02:23'),
(2, '{\"id\":\"Baso Ikan Sayuran Goreng\",\"en\":null}', 'baso-ikan-sayuran-goreng', 1, '{\"id\":\"<p><strong>Baso Ikan Sayuran Goreng</strong></p>\",\"en\":null}', 0, NULL, '2024-04-01 17:37:58', '2024-04-01 17:37:58'),
(3, '{\"id\":\"Baso Ikan Sedang\",\"en\":null}', 'baso-ikan-sedang', 1, '{\"id\":\"<p><strong>Baso Ikan Sedang</strong></p>\",\"en\":null}', 0, NULL, '2024-04-01 17:38:36', '2024-04-01 17:38:36'),
(4, '{\"id\":\"Baso Ikan Udang\",\"en\":null}', 'baso-ikan-udang', 1, '{\"id\":\"<p><strong>Baso Ikan Udang</strong></p>\",\"en\":null}', 0, NULL, '2024-04-01 17:39:05', '2024-04-01 17:39:05'),
(5, '{\"id\":\"Baso Ikan dan Cumi\",\"en\":null}', 'baso-ikan-dan-cumi', 1, '{\"id\":\"<p><strong>Baso Ikan dan Cumi</strong></p>\",\"en\":null}', 0, NULL, '2024-04-01 17:40:21', '2024-04-01 17:40:21'),
(6, '{\"id\":\"Baso Ikan Besar\",\"en\":null}', 'baso-ikan-besar', 1, '{\"id\":\"<p><strong>Baso Ikan Besar</strong></p>\",\"en\":null}', 0, NULL, '2024-04-01 17:40:42', '2024-04-01 17:40:42'),
(7, '{\"id\":\"Baso Ikan & Udang (Prawn Bali)\",\"en\":null}', 'baso-ikan-udang-prawn-bali', 1, '{\"id\":\"<p><strong>Baso Ikan &amp; Udang (Prawn Bali)</strong></p>\",\"en\":null}', 0, NULL, '2024-04-01 17:42:32', '2024-04-01 17:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint UNSIGNED NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taggable_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`tag_id`, `taggable_type`, `taggable_id`) VALUES
(1, 'App\\Models\\Products\\Product', 1),
(1, 'App\\Models\\Products\\Product', 2),
(1, 'App\\Models\\Products\\Product', 3),
(1, 'App\\Models\\Products\\Product', 4),
(1, 'App\\Models\\Products\\Product', 5),
(1, 'App\\Models\\Products\\Product', 6),
(1, 'App\\Models\\Products\\Product', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` json NOT NULL,
  `slug` json NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_column` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `type`, `order_column`, `created_at`, `updated_at`) VALUES
(1, '{\"en\": \"Baso Series\", \"id\": \"Baso Series\"}', '{\"en\": \"baso-series\", \"id\": \"baso-series\"}', 'product_tags', 1, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(2, '{\"id\": \"Crab Stick Series\"}', '{\"id\": \"crab-stick-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(3, '{\"id\": \"Korean Odeng Series\"}', '{\"id\": \"korean-odeng-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(4, '{\"id\": \"Cartoon Series\"}', '{\"id\": \"cartoon-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(5, '{\"id\": \"Fish Dumpling Series\"}', '{\"id\": \"fish-dumpling-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(6, '{\"id\": \"Fish Roll Series\"}', '{\"id\": \"fish-roll-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(7, '{\"id\": \"Premium Pack\"}', '{\"id\": \"premium-pack\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(9, '{\"id\": \"Chikuwa Series\"}', '{\"id\": \"chikuwa-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(10, '{\"id\": \"Otak-Otak Series\"}', '{\"id\": \"otak-otak-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(11, '{\"id\": \"Premium Salmon Sausage Series\"}', '{\"id\": \"premium-salmon-sausage-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49'),
(12, '{\"id\": \"Steamboat Series\"}', '{\"id\": \"steamboat-series\"}', 'product_tags', NULL, '2024-03-25 13:02:24', '2024-03-25 13:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Cedea', 'admin@admin.com', NULL, '$2y$12$RgIthEL1/obQ9jL57UvElOZo6ol3DwhwjkTQEczHkuBEz3vHDUMzu', NULL, '2024-03-20 19:55:08', '2024-03-20 19:55:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post_news`
--
ALTER TABLE `post_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_recipes`
--
ALTER TABLE `post_recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD UNIQUE KEY `taggables_tag_id_taggable_id_taggable_type_unique` (`tag_id`,`taggable_id`,`taggable_type`),
  ADD KEY `taggables_taggable_type_taggable_id_index` (`taggable_type`,`taggable_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_news`
--
ALTER TABLE `post_news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_recipes`
--
ALTER TABLE `post_recipes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
