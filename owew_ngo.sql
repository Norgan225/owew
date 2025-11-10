-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 07 nov. 2025 à 11:04
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `owew_ngo`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content_fr` longtext NOT NULL,
  `content_en` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `views_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `author_id`, `title_fr`, `title_en`, `slug`, `content_fr`, `content_en`, `featured_image`, `category_id`, `status`, `published_at`, `views_count`, `created_at`, `updated_at`) VALUES
(1, 3, 'L’Éducation, Clé du Développement', 'Education: The Key to Development', 'leducation-cle-du-developpement', 'L’éducation est le pilier fondamental pour bâtir une société prospère. À travers nos initiatives, nous cherchons à offrir à chaque enfant, notamment les plus défavorisés, les outils nécessaires pour réussir. Découvrez comment nos actions transforment des vies au quotidien.', 'Education is the foundation for building a prosperous society. Through our initiatives, we strive to provide every child, especially the most disadvantaged, with the tools they need to succeed. Discover how our work transforms lives every day.', 'blog/COQ3oMeUTSWWXXEZAYujeKkYweiVebN3gXpz0S3b.jpg', 1, 'published', '2025-10-30 07:37:00', 6, '2025-10-30 07:38:28', '2025-10-30 08:08:52');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-all_site_settings', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:38:{i:0;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:1;s:3:\"key\";s:12:\"site_name_fr\";s:8:\"value_fr\";s:4:\"OWEW\";s:8:\"value_en\";s:4:\"OWEW\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-25 23:16:31\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:1;s:3:\"key\";s:12:\"site_name_fr\";s:8:\"value_fr\";s:4:\"OWEW\";s:8:\"value_en\";s:4:\"OWEW\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-25 23:16:31\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:2;s:3:\"key\";s:12:\"site_name_en\";s:8:\"value_fr\";N;s:8:\"value_en\";s:4:\"OWEW\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 20:33:38\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:2;s:3:\"key\";s:12:\"site_name_en\";s:8:\"value_fr\";N;s:8:\"value_en\";s:4:\"OWEW\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 20:33:38\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:3;s:3:\"key\";s:15:\"site_tagline_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:3;s:3:\"key\";s:15:\"site_tagline_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:4;s:3:\"key\";s:15:\"site_tagline_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:4;s:3:\"key\";s:15:\"site_tagline_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:5;s:3:\"key\";s:19:\"site_description_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:5;s:3:\"key\";s:19:\"site_description_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:6;s:3:\"key\";s:19:\"site_description_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:6;s:3:\"key\";s:19:\"site_description_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"general\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:7;s:3:\"key\";s:13:\"contact_email\";s:8:\"value_fr\";s:17:\"contact@owew.info\";s:8:\"value_en\";s:17:\"contact@owew.info\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:7;s:3:\"key\";s:13:\"contact_email\";s:8:\"value_fr\";s:17:\"contact@owew.info\";s:8:\"value_en\";s:17:\"contact@owew.info\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:16:31\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:8;s:3:\"key\";s:13:\"contact_phone\";s:8:\"value_fr\";s:15:\"+225 0103578232\";s:8:\"value_en\";s:15:\"+225 0103578232\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:46:10\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:8;s:3:\"key\";s:13:\"contact_phone\";s:8:\"value_fr\";s:15:\"+225 0103578232\";s:8:\"value_en\";s:15:\"+225 0103578232\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:46:10\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:9;s:3:\"key\";s:16:\"contact_whatsapp\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:40:03\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:9;s:3:\"key\";s:16:\"contact_whatsapp\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:40:03\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:10;s:3:\"key\";s:11:\"contact_fax\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:10;s:3:\"key\";s:11:\"contact_fax\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:10;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:11;s:3:\"key\";s:18:\"contact_address_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:11;s:3:\"key\";s:18:\"contact_address_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:11;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:12;s:3:\"key\";s:18:\"contact_address_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:12;s:3:\"key\";s:18:\"contact_address_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:12;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:13;s:3:\"key\";s:16:\"contact_latitude\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:13;s:3:\"key\";s:16:\"contact_latitude\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:13;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:14;s:3:\"key\";s:17:\"contact_longitude\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:14;s:3:\"key\";s:17:\"contact_longitude\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:7:\"contact\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:14;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:15;s:3:\"key\";s:15:\"social_facebook\";s:8:\"value_fr\";s:54:\"https://www.facebook.com/profile.php?id=61573938812347\";s:8:\"value_en\";s:54:\"https://www.facebook.com/profile.php?id=61573938812347\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:47:56\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:15;s:3:\"key\";s:15:\"social_facebook\";s:8:\"value_fr\";s:54:\"https://www.facebook.com/profile.php?id=61573938812347\";s:8:\"value_en\";s:54:\"https://www.facebook.com/profile.php?id=61573938812347\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:47:56\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:15;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:16;s:3:\"key\";s:14:\"social_twitter\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:16;s:3:\"key\";s:14:\"social_twitter\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:16;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:17;s:3:\"key\";s:16:\"social_instagram\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:17;s:3:\"key\";s:16:\"social_instagram\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:17;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:18;s:3:\"key\";s:15:\"social_linkedin\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:18;s:3:\"key\";s:15:\"social_linkedin\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:18;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:19;s:3:\"key\";s:14:\"social_youtube\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:19;s:3:\"key\";s:14:\"social_youtube\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:19;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:20;s:3:\"key\";s:13:\"social_tiktok\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:20;s:3:\"key\";s:13:\"social_tiktok\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:6:\"social\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:20;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:21;s:3:\"key\";s:12:\"seo_title_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:21;s:3:\"key\";s:12:\"seo_title_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:21;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:22;s:3:\"key\";s:12:\"seo_title_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:22;s:3:\"key\";s:12:\"seo_title_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:22;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:23;s:3:\"key\";s:18:\"seo_description_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:23;s:3:\"key\";s:18:\"seo_description_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:23;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:24;s:3:\"key\";s:18:\"seo_description_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:24;s:3:\"key\";s:18:\"seo_description_en\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:24;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:25;s:3:\"key\";s:15:\"seo_keywords_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:25;s:3:\"key\";s:15:\"seo_keywords_fr\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:25;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:26;s:3:\"key\";s:19:\"google_analytics_id\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:26;s:3:\"key\";s:19:\"google_analytics_id\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:26;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:27;s:3:\"key\";s:21:\"google_tag_manager_id\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:27;s:3:\"key\";s:21:\"google_tag_manager_id\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:3:\"seo\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:27;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:28;s:3:\"key\";s:17:\"mail_from_address\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:5:\"email\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:28;s:3:\"key\";s:17:\"mail_from_address\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:5:\"email\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:28;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:29;s:3:\"key\";s:14:\"mail_from_name\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:5:\"email\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:29;s:3:\"key\";s:14:\"mail_from_name\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:5:\"email\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:29;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:30;s:3:\"key\";s:24:\"admin_notification_email\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:5:\"email\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:30;s:3:\"key\";s:24:\"admin_notification_email\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:4:\"text\";s:5:\"group\";s:5:\"email\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:30;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:31;s:3:\"key\";s:19:\"theme_primary_color\";s:8:\"value_fr\";s:7:\"#4b0082\";s:8:\"value_en\";s:7:\"#4b0082\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:10:\"appearance\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:31;s:3:\"key\";s:19:\"theme_primary_color\";s:8:\"value_fr\";s:7:\"#4b0082\";s:8:\"value_en\";s:7:\"#4b0082\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:10:\"appearance\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:31;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:32;s:3:\"key\";s:21:\"theme_secondary_color\";s:8:\"value_fr\";s:7:\"#ff9800\";s:8:\"value_en\";s:7:\"#ff9800\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:10:\"appearance\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:32;s:3:\"key\";s:21:\"theme_secondary_color\";s:8:\"value_fr\";s:7:\"#ff9800\";s:8:\"value_en\";s:7:\"#ff9800\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:10:\"appearance\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:32;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:33;s:3:\"key\";s:16:\"maintenance_mode\";s:8:\"value_fr\";s:1:\"0\";s:8:\"value_en\";s:1:\"0\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:10:\"appearance\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-29 00:26:21\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:33;s:3:\"key\";s:16:\"maintenance_mode\";s:8:\"value_fr\";s:1:\"0\";s:8:\"value_en\";s:1:\"0\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:10:\"appearance\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-29 00:26:21\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:33;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:34;s:3:\"key\";s:21:\"custom_header_scripts\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:34;s:3:\"key\";s:21:\"custom_header_scripts\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:34;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:35;s:3:\"key\";s:21:\"custom_footer_scripts\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:35;s:3:\"key\";s:21:\"custom_footer_scripts\";s:8:\"value_fr\";N;s:8:\"value_en\";N;s:4:\"type\";s:8:\"textarea\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:35;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:36;s:3:\"key\";s:16:\"enable_donations\";s:8:\"value_fr\";s:1:\"1\";s:8:\"value_en\";s:1:\"1\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-29 10:14:52\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:36;s:3:\"key\";s:16:\"enable_donations\";s:8:\"value_fr\";s:1:\"1\";s:8:\"value_en\";s:1:\"1\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-29 10:14:52\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:36;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:37;s:3:\"key\";s:17:\"enable_newsletter\";s:8:\"value_fr\";s:1:\"1\";s:8:\"value_en\";s:1:\"1\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-30 03:08:35\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:37;s:3:\"key\";s:17:\"enable_newsletter\";s:8:\"value_fr\";s:1:\"1\";s:8:\"value_en\";s:1:\"1\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-30 03:08:35\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:37;O:22:\"App\\Models\\SiteSetting\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:13:\"site_settings\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:8:{s:2:\"id\";i:38;s:3:\"key\";s:17:\"enable_volunteers\";s:8:\"value_fr\";s:1:\"1\";s:8:\"value_en\";s:1:\"1\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:11:\"\0*\0original\";a:8:{s:2:\"id\";i:38;s:3:\"key\";s:17:\"enable_volunteers\";s:8:\"value_fr\";s:1:\"1\";s:8:\"value_en\";s:1:\"1\";s:4:\"type\";s:4:\"text\";s:5:\"group\";s:8:\"advanced\";s:10:\"created_at\";s:19:\"2025-10-25 23:18:44\";s:10:\"updated_at\";s:19:\"2025-10-28 00:21:06\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:3:\"key\";i:1;s:8:\"value_fr\";i:2;s:8:\"value_en\";i:3;s:4:\"type\";i:4;s:5:\"group\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1761946424);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_fr` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description_fr` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name_fr`, `name_en`, `slug`, `description_fr`, `description_en`, `created_at`, `updated_at`) VALUES
(1, 'Projets', 'Projects', 'projets', 'Photos de nos projets en cours et réalisés dans différentes communautés', 'Photos of our ongoing and completed projects in various communities', '2025-10-30 04:41:43', '2025-10-30 04:41:43'),
(2, 'Événements', 'Events', 'evenements', 'Couverture de nos événements caritatifs, galas, collectes de fonds et activités spéciales', 'Coverage of our charity events, galas, fundraisers and special activities', '2025-10-30 04:41:43', '2025-10-30 04:41:43'),
(3, 'Équipe & Bénévoles', 'Team & Volunteers', 'equipe-benevoles', 'Photos de notre équipe, bénévoles et moments de travail en commun', 'Photos of our team, volunteers and collaborative work moments', '2025-10-30 04:41:43', '2025-10-30 04:41:43'),
(4, 'Bénéficiaires', 'Beneficiaries', 'beneficiaires', 'Les personnes et communautés que nous aidons à travers nos programmes', 'The people and communities we help through our programs', '2025-10-30 04:41:43', '2025-10-30 04:41:43'),
(5, 'Partenariats', 'Partnerships', 'partenariats', 'Rencontres avec nos partenaires, sponsors et collaborateurs institutionnels', 'Meetings with our partners, sponsors and institutional collaborators', '2025-10-30 04:41:43', '2025-10-30 04:41:43');

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied','archived') NOT NULL DEFAULT 'new',
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `status`, `replied_at`, `created_at`, `updated_at`) VALUES
(1, 'Mike Norgan', 'sticcongo@gmail.com', '0709604411', 'Information générale', 'Information test', 'read', NULL, '2025-10-30 03:58:32', '2025-10-30 03:58:40');

-- --------------------------------------------------------

--
-- Structure de la table `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donor_name` varchar(255) NOT NULL,
  `donor_email` varchar(255) NOT NULL,
  `donor_phone` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'XOF',
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','failed','received') NOT NULL DEFAULT 'pending',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `donations`
--

INSERT INTO `donations` (`id`, `donor_name`, `donor_email`, `donor_phone`, `amount`, `currency`, `project_id`, `status`, `is_anonymous`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Jean', 'norganmike@gmail.com', '+2250709697928', 125000.00, 'XOF', NULL, 'received', 0, 'Merci beaucoup pour tout', '2025-10-29 12:31:14', '2025-10-29 12:31:14');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_fr` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `media_type` enum('image','video') NOT NULL DEFAULT 'image',
  `video_url` varchar(255) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gallery`
--

INSERT INTO `gallery` (`id`, `title_fr`, `title_en`, `description_fr`, `description_en`, `image_path`, `media_type`, `video_url`, `thumbnail_path`, `category`, `order`, `is_published`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Tes images 30 Octobre', 'pictures test October 31st', 'Images pour le test du siteweb', 'picture for website testing', 'gallery/RaWMaxFsfh3cVYmrzXMIpOY12zKyW6ZLpjwzN7BB.jpg', 'image', NULL, NULL, 'partenariats', 0, 1, 0, '2025-10-30 05:01:10', '2025-10-30 05:01:10'),
(2, 'Tes images 30 Octobre', 'pictures test October 31st', 'Images pour le test du siteweb', 'picture for website testing', 'gallery/Xp6F73IizTWTJHltKeQL4txFWwNH53ZgvRKsqHo4.jpg', 'image', NULL, NULL, 'partenariats', 1, 1, 0, '2025-10-30 05:01:10', '2025-10-30 05:01:10'),
(3, 'Tes images 30 Octobre', 'pictures test October 31st', 'Images pour le test du siteweb', 'picture for website testing', 'gallery/WVcFlPcvmYk4XqNbV7yFlKw5TrZ2U9WkSSmpz4Oq.jpg', 'image', NULL, NULL, 'partenariats', 2, 1, 0, '2025-10-30 05:01:10', '2025-10-30 05:01:10'),
(4, 'Tes images 30 Octobre', 'pictures test October 31st', 'Images pour le test du siteweb', 'picture for website testing', 'gallery/vq7hgUyKYGiJVf8O8arzKfAK2GeygQ9v4FvjZDHu.jpg', 'image', NULL, NULL, 'partenariats', 3, 1, 0, '2025-10-30 05:01:10', '2025-10-30 05:01:10'),
(5, 'Tes images 30 Octobre', 'pictures test October 31st', 'Images pour le test du siteweb', 'picture for website testing', 'gallery/gm5O9C4jAbc1lUfvD5JyrKJeQjixecORh7JdQv4J.jpg', 'image', NULL, NULL, 'partenariats', 4, 1, 0, '2025-10-30 05:01:10', '2025-10-30 05:01:10'),
(6, 'Tes images 30 Octobre', 'pictures test October 31st', 'Images pour le test du siteweb', 'picture for website testing', 'gallery/OyqQskr0wd2ywvnseA0evu41YxGR54h9awsplsvf.jpg', 'image', NULL, NULL, 'partenariats', 5, 1, 0, '2025-10-30 05:01:10', '2025-10-30 05:01:10');

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(9, '2025_10_21_170114_create_projects_table', 2),
(10, '2025_10_21_170121_create_project_images_table', 2),
(11, '2025_10_21_170127_create_testimonials_table', 2),
(12, '2025_10_21_170132_create_donations_table', 2),
(13, '2025_10_21_170137_create_categories_table', 2),
(14, '2025_10_21_170138_create_blog_posts_table', 2),
(15, '2025_10_21_170148_create_gallery_table', 2),
(16, '2025_10_21_170153_create_site_settings_table', 2),
(17, '2025_10_21_170158_create_contact_messages_table', 2),
(18, '2025_10_21_170204_create_subscribers_table', 2),
(19, '2025_10_21_170209_create_volunteers_table', 2),
(20, '2025_10_21_170937_add_role_to_users_table', 2),
(21, '2025_10_25_231750_modify_site_settings_type_column', 3),
(22, '2025_10_27_174215_add_is_featured_to_gallery_table', 4),
(23, '2025_10_28_053010_add_last_login_at_to_users_table', 5),
(24, '2025_10_29_003752_add_name_to_subscribers_table', 6),
(25, '2025_10_29_122441_remove_payment_method_and_transaction_id_from_donations_table', 7),
(26, '2025_10_30_032932_create_partnership_requests_table', 8),
(27, '2025_10_30_054148_add_media_type_to_gallery_table', 9);

-- --------------------------------------------------------

--
-- Structure de la table `partnership_requests`
--

CREATE TABLE `partnership_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_position` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `partnership_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`partnership_types`)),
  `estimated_budget` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','reviewed','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partnership_requests`
--

INSERT INTO `partnership_requests` (`id`, `organization_name`, `sector`, `contact_name`, `contact_position`, `email`, `phone`, `partnership_types`, `estimated_budget`, `message`, `status`, `reviewed_at`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 'PME AWEW', 'Technologie', 'Baldé Omar', 'Directeur Technique', 'admin@zandohebdo.com', '0799014411', '[\"financial\",\"technical\"]', '500000', 'test patenariat avec owew en tout cas merci beaucoup Président', 'approved', '2025-10-31 20:05:27', NULL, '2025-10-30 03:38:05', '2025-10-31 20:05:27');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_fr` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description_fr` text NOT NULL,
  `description_en` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `goal_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `raised_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','completed','archived') NOT NULL DEFAULT 'active',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `title_fr`, `title_en`, `slug`, `description_fr`, `description_en`, `image`, `goal_amount`, `raised_amount`, `status`, `start_date`, `end_date`, `featured`, `created_at`, `updated_at`) VALUES
(6, 'Construction d’un puits d’eau', 'Water Well Construction', 'construction-dun-puits-deau', 'Ce projet vise à construire un puits d’eau potable pour le village de Koffikro afin d’améliorer l’accès à l’eau et la santé des habitants.\r\nNous allons rénover les salles de classe et fournir du matériel scolaire à l’école primaire de Bouaké.\r\nDistribution mensuelle de kits alimentaires aux familles vulnérables dans la commune d’Abobo.\r\nSensibilisation et actions de reboisement pour protéger la forêt du parc national.', 'This project aims to build a drinking water well for the village of Koffikro to improve access to water and the health of the inhabitants.\r\nWe will renovate the classrooms and provide school supplies to the primary school in Bouaké.\r\nMonthly distribution of food kits to vulnerable families in the Abobo district.\r\nAwareness campaigns and tree planting activities to protect the national park’s forest.', NULL, 5000000.00, 0.00, 'active', '2025-11-01', '2025-12-31', 0, '2025-10-29 15:32:37', '2025-10-29 15:32:37');

-- --------------------------------------------------------

--
-- Structure de la table `project_images`
--

CREATE TABLE `project_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption_fr` varchar(255) DEFAULT NULL,
  `caption_en` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `image_path`, `caption_fr`, `caption_en`, `order`, `created_at`, `updated_at`) VALUES
(16, 6, 'projects/mQDIspd1uphdeCCDgIOxBIrTJ8HOU0oMX9drixaS.jpg', NULL, NULL, 0, '2025-10-29 15:32:37', '2025-10-29 15:32:37'),
(17, 6, 'projects/yenNkvrpezsj83rnfkm9uebpIumy1RjsZYzsP9Hw.jpg', NULL, NULL, 1, '2025-10-29 15:32:37', '2025-10-29 15:32:37'),
(18, 6, 'projects/XrzqzStOBHOwwBBIWMwGCnzu6UVTjDph5f9UJSUv.jpg', NULL, NULL, 2, '2025-10-29 15:32:37', '2025-10-29 15:32:37'),
(19, 6, 'projects/eZR0a55GrVsNqb3QiLnD0RuTzhg8ldCOrLpGMji9.jpg', NULL, NULL, 0, '2025-10-29 15:32:54', '2025-10-29 15:32:54'),
(20, 6, 'projects/d75JaqLwxwxyTBmPzzhjMg4X6pfebdqcG6qtFtaS.jpg', NULL, NULL, 0, '2025-10-29 15:33:22', '2025-10-29 15:33:22');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fb0ZMwqVyf9KZCGwoonE9bpo5wKkWqtaG5WJd2jb', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnRXYU9JbDVwZ0VBNEpPMHRaVXh4Yk5PZTNVYVVRUHdFaEZ0ZFo4ViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb250YWN0Ijt9czo2OiJsb2NhbGUiO3M6MjoiZnIiO30=', 1761942833),
('jLhwJOmj71byTUzpwqwqyI7z7ANPGboGlXIPpzcq', 3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidHNZY2o4STlnc290QU5Zclh6TWRYa055WnRGSkN4aThnTTFrMURXYyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vdGVzdGltb25pYWxzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjY6ImxvY2FsZSI7czoyOiJlbiI7fQ==', 1761893758),
('Ju9uZBlGP5IlmsUtcFtx4wDXbfQaLpZGP9CqAjsj', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDRGMUpFaXB1NHpKSkhjR2pDOUtKSHN6TUFNMml3TGtpUzFDSFhZNCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2RvbmF0aW9ucyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY29udGFjdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1761905664);

-- --------------------------------------------------------

--
-- Structure de la table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value_fr` text DEFAULT NULL,
  `value_en` text DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value_fr`, `value_en`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name_fr', 'OWEW', 'OWEW', 'text', 'general', '2025-10-25 23:16:31', '2025-10-25 23:16:31'),
(2, 'site_name_en', NULL, 'OWEW', 'text', 'general', '2025-10-25 23:16:31', '2025-10-28 20:33:38'),
(3, 'site_tagline_fr', NULL, NULL, 'text', 'general', '2025-10-25 23:16:31', '2025-10-28 00:21:06'),
(4, 'site_tagline_en', NULL, NULL, 'text', 'general', '2025-10-25 23:16:31', '2025-10-28 00:21:06'),
(5, 'site_description_fr', NULL, NULL, 'textarea', 'general', '2025-10-25 23:16:31', '2025-10-28 00:21:06'),
(6, 'site_description_en', NULL, NULL, 'textarea', 'general', '2025-10-25 23:16:31', '2025-10-28 00:21:06'),
(7, 'contact_email', 'contact@owew.info', 'contact@owew.info', 'text', 'contact', '2025-10-25 23:16:31', '2025-10-28 00:21:06'),
(8, 'contact_phone', '+225 0103578232', '+225 0103578232', 'text', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:46:10'),
(9, 'contact_whatsapp', NULL, NULL, 'text', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:40:03'),
(10, 'contact_fax', NULL, NULL, 'text', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(11, 'contact_address_fr', NULL, NULL, 'textarea', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(12, 'contact_address_en', NULL, NULL, 'textarea', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(13, 'contact_latitude', NULL, NULL, 'text', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(14, 'contact_longitude', NULL, NULL, 'text', 'contact', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(15, 'social_facebook', 'https://www.facebook.com/profile.php?id=61573938812347', 'https://www.facebook.com/profile.php?id=61573938812347', 'text', 'social', '2025-10-25 23:18:44', '2025-10-28 00:47:56'),
(16, 'social_twitter', NULL, NULL, 'text', 'social', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(17, 'social_instagram', NULL, NULL, 'text', 'social', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(18, 'social_linkedin', NULL, NULL, 'text', 'social', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(19, 'social_youtube', NULL, NULL, 'text', 'social', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(20, 'social_tiktok', NULL, NULL, 'text', 'social', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(21, 'seo_title_fr', NULL, NULL, 'text', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(22, 'seo_title_en', NULL, NULL, 'text', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(23, 'seo_description_fr', NULL, NULL, 'textarea', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(24, 'seo_description_en', NULL, NULL, 'textarea', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(25, 'seo_keywords_fr', NULL, NULL, 'text', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(26, 'google_analytics_id', NULL, NULL, 'text', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(27, 'google_tag_manager_id', NULL, NULL, 'text', 'seo', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(28, 'mail_from_address', NULL, NULL, 'textarea', 'email', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(29, 'mail_from_name', NULL, NULL, 'text', 'email', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(30, 'admin_notification_email', NULL, NULL, 'text', 'email', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(31, 'theme_primary_color', '#4b0082', '#4b0082', 'text', 'appearance', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(32, 'theme_secondary_color', '#ff9800', '#ff9800', 'text', 'appearance', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(33, 'maintenance_mode', '0', '0', 'text', 'appearance', '2025-10-25 23:18:44', '2025-10-29 00:26:21'),
(34, 'custom_header_scripts', NULL, NULL, 'textarea', 'advanced', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(35, 'custom_footer_scripts', NULL, NULL, 'textarea', 'advanced', '2025-10-25 23:18:44', '2025-10-28 00:21:06'),
(36, 'enable_donations', '1', '1', 'text', 'advanced', '2025-10-25 23:18:44', '2025-10-29 10:14:52'),
(37, 'enable_newsletter', '1', '1', 'text', 'advanced', '2025-10-25 23:18:44', '2025-10-30 03:08:35'),
(38, 'enable_volunteers', '1', '1', 'text', 'advanced', '2025-10-25 23:18:44', '2025-10-28 00:21:06');

-- --------------------------------------------------------

--
-- Structure de la table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('active','unsubscribed') NOT NULL DEFAULT 'active',
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `subscribers`
--

INSERT INTO `subscribers` (`id`, `name`, `email`, `status`, `subscribed_at`, `unsubscribed_at`, `created_at`, `updated_at`) VALUES
(1, 'Mike Kolo', 'kale@gmail.com', 'active', '2025-10-30 03:08:47', NULL, '2025-10-30 03:08:47', '2025-10-30 03:08:47');

-- --------------------------------------------------------

--
-- Structure de la table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role_fr` varchar(255) NOT NULL,
  `role_en` varchar(255) NOT NULL,
  `content_fr` text NOT NULL,
  `content_en` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `role_fr`, `role_en`, `content_fr`, `content_en`, `image`, `rating`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Mike Kolo', 'Bénéficiare', 'Beneficiary', 'Merci pour le don ça m\'a aidé', 'Thanks for the aid it\'s helps me a lot', 'testimonials/jdpanT5jKHVJ3DyWGJBzioAlJPjZTUFMC5Z5oaM4.jpg', 4, 1, '2025-10-30 06:39:24', '2025-10-30 07:04:11');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','editor','viewer') NOT NULL DEFAULT 'viewer',
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `last_login_at`, `role`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Cyr Mike Norgan', 'norganmike@gmail.com', '2025-10-31 19:25:07', 'admin', 'avatars/4a2qk8kn7Y9hXXUTfNdH0d4P80Wezlp2uL50p6X9.jpg', NULL, '$2y$12$GpwCXRaPR0qYVxoaJvQzE.R2sWAz7K6GMSyyARsD7bf.LXQOe4w7K', '7V2hJOCdcGko6l7fRTgmi7nAA1lBFjkvupO03CLTkRYpMLJtc1YunewUljNE', '2025-10-25 12:37:22', '2025-10-31 19:25:07'),
(4, 'Anick Thomas', 'blegannick777@gmail.com', NULL, 'admin', NULL, NULL, '$2y$12$oGs2mse19gCEjfUJcWJhDOCYXzXA2HDjGbDy4tdwZa3v8nMOZDQha', NULL, '2025-10-30 01:27:49', '2025-10-30 01:27:49');

-- --------------------------------------------------------

--
-- Structure de la table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `skills` text DEFAULT NULL,
  `availability` varchar(255) DEFAULT NULL,
  `motivation_fr` text NOT NULL,
  `motivation_en` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `email`, `phone`, `skills`, `availability`, `motivation_fr`, `motivation_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ballo Lacina Traoré', 'sticcongo@gmail.com', '0707éé4411', 'Âge: 30 | Profession: Etudiant | Compétences: compétence 01\r\nCOmpétence 02 | Domaines: Tech & Digital', 'weekend', 'J\'aime être bénévole c\'est pour moi le plus important', NULL, 'pending', '2025-10-30 03:54:00', '2025-10-30 03:54:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  ADD KEY `blog_posts_author_id_foreign` (`author_id`),
  ADD KEY `blog_posts_status_index` (`status`),
  ADD KEY `blog_posts_category_id_index` (`category_id`),
  ADD KEY `blog_posts_published_at_index` (`published_at`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_slug_index` (`slug`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_messages_status_index` (`status`);

--
-- Index pour la table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donations_status_index` (`status`),
  ADD KEY `donations_project_id_index` (`project_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_category_index` (`category`),
  ADD KEY `gallery_is_published_index` (`is_published`),
  ADD KEY `gallery_order_index` (`order`),
  ADD KEY `gallery_is_featured_index` (`is_featured`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partnership_requests`
--
ALTER TABLE `partnership_requests`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`),
  ADD KEY `projects_status_index` (`status`),
  ADD KEY `projects_featured_index` (`featured`);

--
-- Index pour la table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_images_project_id_index` (`project_id`),
  ADD KEY `project_images_order_index` (`order`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`),
  ADD KEY `site_settings_key_index` (`key`),
  ADD KEY `site_settings_group_index` (`group`);

--
-- Index pour la table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`),
  ADD KEY `subscribers_email_index` (`email`),
  ADD KEY `subscribers_status_index` (`status`);

--
-- Index pour la table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_is_published_index` (`is_published`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `volunteers_email_unique` (`email`),
  ADD KEY `volunteers_status_index` (`status`),
  ADD KEY `volunteers_email_index` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `partnership_requests`
--
ALTER TABLE `partnership_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `project_images_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
