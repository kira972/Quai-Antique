-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 mars 2023 à 19:03
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quai-antique`
--

-- --------------------------------------------------------

--
-- Structure de la table `allergie`
--

CREATE TABLE `allergie` (
  `id` int(11) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `allergie`
--

INSERT INTO `allergie` (`id`, `description`) VALUES
(91, 'Oeuf'),
(92, 'Lait'),
(93, 'Gluten'),
(94, 'Moutarde'),
(95, 'Arachide'),
(96, 'Poissons'),
(97, 'Soja'),
(98, 'Sulfites'),
(99, 'Fruits à coque'),
(100, 'Céleri');

-- --------------------------------------------------------

--
-- Structure de la table `allergie_reservation`
--

CREATE TABLE `allergie_reservation` (
  `allergie_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `allergie_reservation`
--

INSERT INTO `allergie_reservation` (`allergie_id`, `reservation_id`) VALUES
(91, 154),
(91, 158),
(91, 159),
(92, 166),
(92, 169),
(92, 170),
(93, 160),
(93, 169),
(93, 171),
(93, 172),
(93, 173),
(93, 174),
(93, 175),
(93, 176),
(93, 177),
(93, 178),
(93, 179),
(93, 180),
(93, 181),
(93, 182),
(93, 183),
(94, 157),
(94, 169),
(95, 160),
(96, 155),
(97, 159),
(97, 164),
(97, 168),
(99, 159),
(99, 168),
(100, 164);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(61, 'repellendus'),
(62, 'quisquam'),
(63, 'quos'),
(64, 'voluptas'),
(65, 'culpa'),
(66, 'aut');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230310220605', '2023-03-10 23:06:17', 9),
('DoctrineMigrations\\Version20230310221400', '2023-03-10 23:14:10', 15),
('DoctrineMigrations\\Version20230310221951', '2023-03-10 23:19:58', 13),
('DoctrineMigrations\\Version20230310222348', '2023-03-10 23:24:00', 10),
('DoctrineMigrations\\Version20230310222730', '2023-03-10 23:27:37', 7),
('DoctrineMigrations\\Version20230310223256', '2023-03-10 23:33:07', 13),
('DoctrineMigrations\\Version20230310223517', '2023-03-10 23:35:27', 8),
('DoctrineMigrations\\Version20230310223756', '2023-03-10 23:38:04', 9),
('DoctrineMigrations\\Version20230310223952', '2023-03-10 23:40:00', 9),
('DoctrineMigrations\\Version20230311012930', '2023-03-11 02:29:44', 176),
('DoctrineMigrations\\Version20230313233410', '2023-03-14 00:34:41', 42),
('DoctrineMigrations\\Version20230314021456', '2023-03-14 03:15:08', 24);

-- --------------------------------------------------------

--
-- Structure de la table `formule`
--

CREATE TABLE `formule` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` longtext NOT NULL,
  `name` varchar(50) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formule`
--

INSERT INTO `formule` (`id`, `price`, `description`, `name`, `menu_id`) VALUES
(28, 20.5, 'Nobis quia eius ipsum aut omnis et. Molestias repudiandae qui recusandae non.', 'blanditiis', 10),
(29, 26.3, 'Eum maiores beatae voluptas. Maxime excepturi quia sunt molestias quis delectus voluptatem.', 'dolorum', 10),
(30, 28.8, 'Voluptas dolor omnis nam. Aperiam harum et omnis vel omnis omnis est et.', 'culpa', 10);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`) VALUES
(10, 'dolor', 'Iste nisi est ea consectetur. Dolor sequi quo nostrum eos maxime itaque.');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `opening_time`
--

CREATE TABLE `opening_time` (
  `id` int(11) NOT NULL,
  `lunch_open` time NOT NULL,
  `lunch_close` time NOT NULL,
  `dinner_open` time NOT NULL,
  `dinner_close` time NOT NULL,
  `day_of_week` varchar(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `opening_time`
--

INSERT INTO `opening_time` (`id`, `lunch_open`, `lunch_close`, `dinner_open`, `dinner_close`, `day_of_week`, `restaurant_id`) VALUES
(55, '12:00:00', '14:00:00', '19:00:00', '22:00:00', 'lundi', 10),
(56, '12:00:00', '14:00:00', '19:00:00', '22:00:00', 'mardi', 10),
(57, '12:00:00', '14:00:00', '19:00:00', '22:00:00', 'mercredi', 10),
(58, '12:00:00', '14:00:00', '19:00:00', '22:00:00', 'jeudi', 10),
(59, '12:00:00', '14:00:00', '19:00:00', '22:00:00', 'vendredi', 10),
(60, '12:00:00', '14:00:00', '19:00:00', '22:00:00', 'samedi', 10);

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `filename` varchar(255) NOT NULL,
  `is_favorite` tinyint(1) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `picture`
--

INSERT INTO `picture` (`id`, `name`, `description`, `filename`, `is_favorite`, `product_id`) VALUES
(63, 'Fajitas', 'Ea dolore voluptas voluptas aut. Nostrum consequuntur vitae dolorum delectus nulla numquam quas. Impedit beatae tempora eius voluptatum animi eum. Animi laboriosam quod qui. Nam et voluptas ut.', 'fajitas.png', 0, 162),
(64, 'Assortiment', 'Commodi tempore dolor illo iusto minima corporis qui. Perferendis laborum qui sunt nesciunt. Labore dolorem sit sed explicabo omnis quisquam. Rem est est molestias tempore voluptate.', 'assortiment.jpg', 0, 181),
(65, 'Buffet fiesta', 'Rerum nostrum corrupti nostrum ut nulla aperiam. Et ab rerum modi ipsum voluptatem. Ut delectus esse voluptas nostrum. Quod voluptatem ut atque vel non iusto et.', 'buffet-fiesta.jpg', 0, 175),
(66, 'Burritos', 'Voluptatem tempore perferendis architecto rerum perferendis sint id. Atque atque doloribus repellat consequatur. Unde non est eligendi officia est fugit aut eaque. A totam dicta autem quasi iste sed.', 'burritos.jpg', 0, 179),
(67, 'Carlota', 'Aliquam repellat nesciunt quo assumenda commodi laborum qui soluta. Corporis quibusdam et ut aspernatur aut eveniet eum. Nesciunt ullam occaecati et deleniti maiores.', 'carlota.jpg', 0, 195),
(68, 'Ceviche', 'Voluptas reiciendis quis beatae nihil eaque. Sunt fugiat voluptas enim laudantium. Qui beatae voluptatum est.', 'ceviche.jpg', 1, 190),
(69, 'Cheesecake caramel', 'Quia iste et odio dignissimos quia. Et id soluta porro magnam. Sapiente possimus officiis fuga officiis similique quam inventore consectetur.', 'cheesecake-caramel.png', 1, 168),
(70, 'Chilaquiles rojos', 'Doloremque cupiditate quis tenetur atque et. Vel ratione optio cupiditate quia ut qui sed. Sequi sit id sit est necessitatibus iste.', 'chilaquiles-rojos.png', 1, 178),
(71, 'Chilaquiles', 'Provident et voluptatem quo animi minima. Ab aliquid doloremque et est enim nisi deleniti. Eum architecto explicabo error. Et enim quam sint commodi quas. Cum nihil laudantium sed explicabo.', 'chilaquiles.jpg', 0, 196),
(72, 'Chilicon', 'Nihil aliquid laboriosam earum velit eaque omnis provident. Consequatur voluptas rerum ullam ex autem ullam. Fugit omnis qui non et qui. Ut aliquam ipsa quia. Explicabo hic deleniti eaque id sint ab dignissimos. Vero et dolor dolore ex quis. Dolorem dolore non labore eum sequi quisquam et.', 'chilicon.jpg', 0, 184),
(73, 'Chololat épicé', 'Accusamus itaque et provident rerum odio quam accusamus. Est pariatur consequatur id rem. Ipsum iste vel qui ut cum. Iste distinctio ut quis impedit voluptatum magni. Et voluptates ipsum expedita. Ut et quae velit voluptatum vitae aut. Nobis esse fugit consequuntur numquam accusantium quo.', 'chololat-epice.jpg', 1, 164),
(74, 'Churros', 'Quo voluptas totam id cum. Esse aliquam iure suscipit consequatur. Et nemo a explicabo blanditiis facilis ut laboriosam. Atque tenetur quis earum velit dolorem omnis enim voluptatem.', 'churros.jpg', 0, 186),
(75, 'Crevette', 'Sequi quibusdam dolores voluptatem vitae. Repudiandae ad voluptatem explicabo et tenetur fugiat rem. Vel dolores dolores et ratione et deleniti illum accusantium.', 'crevette.jpg', 0, 194),
(76, 'Empanadas', 'Deserunt est tempora harum dolores minus voluptates. Ad quidem provident iusto eligendi. Quo et laborum esse veniam nihil aut expedita. Hic similique atque aperiam fugiat necessitatibus eius aut. Qui ratione voluptas quis cum error dolores.', 'empanadas.jpeg', 1, 180),
(77, 'Enchilada', 'Deserunt sed mollitia dignissimos eius nemo sint at ea. Atque iste consequatur et debitis. Possimus inventore sed dolor nihil. Illo nulla quis consectetur eveniet exercitationem ut ut. Esse non mollitia autem est totam est nisi. Dolor quas repellendus ullam qui.', 'enchilada.jpg', 1, 182),
(78, 'Entrées', 'Ea ullam et in voluptas. Ea possimus laudantium incidunt rerum. Minus consectetur quasi consequatur et similique maiores. Libero fugit dignissimos magnam sit dolore. Dolorum est consequatur quia molestias aliquid. Quis sunt assumenda hic ut tenetur et.', 'entrees.jpg', 1, 176),
(79, 'Horchata', 'Beatae iusto repellat consequatur iste voluptatem nulla. Quis hic quia ab corporis repudiandae similique sunt. Et quis omnis eum odio ut ipsam. Itaque quo aliquam optio necessitatibus ut aliquam. Incidunt deleniti omnis aut similique autem laborum. Dolores aut eos rerum delectus est.', 'horchata.jpg', 1, 192),
(80, 'Crevette', 'Est dolor in minima consectetur. Voluptas sapiente ut et aut temporibus quos quia vel. Veritatis nam tenetur amet rem. Quia id reiciendis ea libero.', 'crevette.jpg', 0, 169),
(81, 'Chilaquiles rojos', 'Aut sit voluptate nam. Labore odit voluptas non nam. Omnis alias voluptas ex consequuntur ut. Accusantium nesciunt mollitia consequatur et nostrum. Voluptatem consequatur totam cupiditate tempore vero id. Et exercitationem rerum eum dolor voluptatem voluptatem id.', 'chilaquiles-rojos.png', 0, 197),
(82, 'Chilicon', 'Eveniet hic blanditiis voluptas maxime placeat quia. Sint ut rem odio enim laudantium voluptates corporis. Ut voluptatibus ut quaerat placeat et dolor pariatur. Sequi aut voluptate consequatur impedit.', 'chilicon.jpg', 0, 189),
(84, 'mexicain-avocat', 'Et cumque esse debitis et a autem doloremque. Hic molestias nemo qui corrupti et officia a temporibus. Ipsum aut officiis placeat sit quam recusandae et.', 'mexicain-avocat.jpg', 1, 198),
(85, 'Mexican', 'Consequatur aut et et. Ipsa autem vel ipsa magnam consequuntur velit. Blanditiis accusamus dicta enim dolorum est beatae. Quia qui aliquid qui esse. Et perferendis qui eligendi velit. Et quidem perspiciatis quia eligendi amet. Perferendis voluptates qui voluptas.', 'mexican.jpg', 1, 161),
(86, 'Plat mexicain', 'Dolores eos sapiente et vel necessitatibus. Voluptatem consectetur numquam ea aut minima. Rerum quia ut occaecati quisquam modi aut autem. Eos et beatae ullam sunt vel repellat mollitia.', 'plat-mexicain.jpg', 1, 188),
(87, 'Poisson', 'Sed quia et esse eum occaecati nesciunt aliquam. Omnis ut occaecati ea ut. Quaerat qui necessitatibus tempore consequatur harum similique voluptas. Voluptas a maxime ut qui quasi inventore.', 'poisson.jpg', 0, 167),
(88, 'Poisson', 'Eveniet error consequatur minima veniam. Ut et quis aut rerum. Voluptatem incidunt quod maiores neque blanditiis nihil. Et voluptate sunt possimus dignissimos cum. Rem ab exercitationem minima facere omnis.', 'poisson1.jpeg', 0, 174),
(89, 'Poisson', 'Dolor omnis vel est quia consequuntur voluptatem ullam. In dolores tenetur aut facilis possimus est. Sit commodi nemo recusandae magnam. Eveniet enim atque saepe omnis quasi. Adipisci et sit nihil qui ullam blanditiis aspernatur.', 'poisson2.jpg', 0, 163),
(90, 'Poisson', 'Voluptas tempore ut animi rerum quia. Doloribus officiis sed id quia sunt. Ratione sint accusamus exercitationem minus quod. Magni qui ad quia nihil sint quo.', 'poisson3.jpg', 0, 177),
(91, 'Poisson', 'Fuga a aut dolores quos ut laborum qui. Nobis quis aut saepe error voluptatibus laudantium. At tempore iusto ipsum nihil cupiditate qui amet dolore. Excepturi distinctio voluptates totam fugiat ab dolor incidunt et. Eaque vel accusantium explicabo facilis quidem odit.', 'poisson4.jpg', 1, 185),
(92, 'Pozole', 'Ipsam ut enim ea nemo. Excepturi at qui aut perspiciatis unde error rerum. Ut omnis quia suscipit. Deleniti aut fugiat magni beatae vero voluptatum in sit. Maxime natus ea et est aut. Voluptatem laboriosam totam quaerat reiciendis.', 'pozole.jpg', 0, 173),
(93, 'Pudding', 'Beatae sed molestias animi consequuntur. Voluptas doloribus ut quo dolorem. Impedit inventore modi est ratione laudantium et. Qui sed incidunt dolorem corporis. Quia numquam dignissimos officiis eaque. Rem iure molestiae aut et odit. Saepe corporis itaque officia laborum. Aut ut quis autem quo.', 'pudding.jpg', 1, 183),
(94, 'Quesadilla', 'Esse id aperiam delectus laudantium debitis placeat. Nobis et sit illo eum id aliquam natus. Libero doloribus sunt voluptatibus quae.', 'quesadillaS.jpg', 1, 191),
(95, 'Quesadilla', 'Eos recusandae eos rerum nostrum eum. Voluptas minus explicabo eum. Occaecati consequatur perferendis rerum eum atque et.', 'quesadilla-2.jpeg', 1, 165),
(96, 'Tacos beef', 'Earum quisquam minima accusamus ex voluptatum sequi. Dicta aut rem facere dolor debitis. Occaecati est sunt accusantium suscipit sunt. Eos natus vitae sit. Sed enim illum qui itaque. Optio molestias eos amet. Et magnam expedita ea.', 'tacos-beef.jpg', 1, 166),
(97, 'Tacos saumon', 'Molestias et facilis commodi facilis sed. Commodi fugiat rem assumenda ut optio. Et sit est quae aut dignissimos beatae tempora. Labore animi quis ut praesentium consequuntur error magni tenetur. Magnam exercitationem praesentium cumque. Libero voluptas quod nobis.', 'tacos-saumon.jpg', 0, 187),
(98, 'Tacos', 'Laboriosam non quisquam ducimus nihil. Voluptates repudiandae quos sunt fugiat. Dolorem et eaque optio aut odio odit repellat. In est perspiciatis ut quam pariatur quia et. Non ducimus asperiores nobis voluptas. Nulla dolorem aut quibusdam mollitia voluptatibus voluptas quibusdam et.', 'tacos.jpg', 1, 171),
(99, 'Tostadas', 'Est repellendus numquam numquam dolores debitis et a. Rerum debitis explicabo totam. Voluptate inventore earum nihil iusto est omnis libero.', 'tostadas.jpg', 1, 172),
(100, 'Viandes', 'Possimus sed repudiandae mollitia doloribus animi corrupti. Et facilis voluptas molestiae itaque sed. Facere nesciunt nisi praesentium est mollitia.', 'viandes.jpg', 0, 193);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `category_id`) VALUES
(161, 'rerum', 24.8, 65),
(162, 'consequatur', 34.1, 64),
(163, 'illum', 19.2, 63),
(164, 'voluptas', 27.8, 66),
(165, 'et', 19.4, 64),
(166, 'hic', 28, 64),
(167, 'nobis', 21.2, 66),
(168, 'tempora', 34.4, 65),
(169, 'rerum', 27.9, 62),
(171, 'rerum', 19.5, 62),
(172, 'quasi', 27.5, 64),
(173, 'nisi', 30.3, 61),
(174, 'maxime', 30.4, 62),
(175, 'molestias', 29.2, 66),
(176, 'enim', 25.5, 66),
(177, 'qui', 24.7, 65),
(178, 'vel', 21.5, 61),
(179, 'numquam', 28.3, 62),
(180, 'soluta', 25.2, 62),
(181, 'placeat', 22.2, 65),
(182, 'ipsam', 33, 66),
(183, 'ut', 23.1, 66),
(184, 'odio', 28.7, 62),
(185, 'iusto', 30.1, 63),
(186, 'dolorem', 29.8, 65),
(187, 'quam', 32.5, 61),
(188, 'repudiandae', 21.2, 64),
(189, 'id', 19.1, 66),
(190, 'est', 25.6, 62),
(191, 'voluptas', 21.2, 61),
(192, 'laborum', 29.1, 62),
(193, 'et', 24.9, 66),
(194, 'in', 35.8, 66),
(195, 'corrupti', 35.1, 62),
(196, 'omnis', 27.2, 66),
(197, 'voluptates', 31.7, 64),
(198, 'quis', 26.4, 61);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `hour` time NOT NULL,
  `number_cover` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `name`, `date`, `hour`, `number_cover`, `user_id`, `restaurant_id`) VALUES
(153, 'ut', '2023-01-23 21:41:40', '21:30:00', 4, 166, 10),
(154, 'explicabo', '2023-02-09 20:22:25', '21:00:00', 9, 165, 10),
(155, 'voluptatum', '2023-03-01 16:13:12', '13:30:00', 3, 161, 10),
(156, 'odit', '2022-12-25 15:04:01', '13:30:00', 5, 159, 10),
(157, 'architecto', '2022-12-28 23:50:28', '14:00:00', 6, 156, 10),
(158, 'sunt', '2023-01-31 05:37:26', '21:00:00', 5, 155, 10),
(159, 'autem', '2023-02-13 02:23:41', '13:30:00', 1, 160, 10),
(160, 'non', '2023-02-10 05:54:01', '21:30:00', 9, 162, 10),
(161, 'voluptatum', '2023-03-05 11:00:09', '12:30:00', 10, 159, 10),
(162, 'ea', '2023-01-10 01:36:33', '12:30:00', 7, 167, 10),
(163, 'corrupti', '2023-01-26 14:10:28', '13:30:00', 1, 164, 10),
(164, 'illo', '2022-12-23 20:46:35', '12:00:00', 7, 156, 10),
(165, 'vero', '2022-12-16 16:08:29', '20:00:00', 2, 164, 10),
(166, 'odit', '2022-12-15 20:54:13', '13:00:00', 2, 162, 10),
(167, 'voluptates', '2022-12-31 09:12:54', '21:30:00', 2, 159, 10),
(168, 'earum', '2023-01-08 07:51:47', '19:00:00', 5, 157, 10),
(169, 'marilyn', '2023-03-23 00:00:00', '14:00:00', 5, NULL, 10),
(170, 'marilyn', '2023-03-22 00:00:00', '11:00:00', 7, NULL, 10),
(171, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(172, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(173, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(174, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(175, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(176, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(177, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(178, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(179, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(180, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(181, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(182, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(183, 'jacqu', '2023-03-16 00:00:00', '11:00:00', 4, NULL, 10),
(184, 'hshshs', '2023-03-22 00:00:00', '11:00:00', 5, NULL, 10),
(185, 'fkfjkfj', '2023-03-15 00:00:00', '11:00:00', 3, NULL, 10),
(186, 'jjjjj', '2023-03-21 00:00:00', '11:00:00', 5, NULL, 10),
(187, 'jjjjj', '2023-03-21 00:00:00', '11:00:00', 5, NULL, 10),
(188, 'jjjjj', '2023-03-21 00:00:00', '11:00:00', 5, NULL, 10),
(189, 'hshshs', '2023-03-22 00:00:00', '11:00:00', 5, NULL, 10);

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `mail` varchar(180) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `post_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `address`, `city`, `mail`, `phone_number`, `post_code`) VALUES
(10, 'Quai Antique', '27, rue du Paradis', 'Nantes', 'QuaiAntique@resto.fr', '0596523023', '44000');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `default_number_cover` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `default_number_cover`) VALUES
(153, 'jean27@renard.fr', '[\"ROLE_ADMIN\"]', '$2y$13$z3of.ZksHGPCIzsfC933beTjhKNkUH8xhL2VSS5aWAW./9HF3Ssu6', 'Agnès', 'Fernandez', NULL),
(154, 'wguerin@traore.fr', '[\"ROLE_ADMIN\"]', '$2y$13$NZZzjhDrUFYCV4/aSVRa2ePfXMnDkYb8.TNQSj8k0RNjVFB11rD8C', 'William', 'Lagarde', NULL),
(155, 'leleu.andre@club-internet.fr', '[\"ROLE_MEMBER\"]', '$2y$13$snowhpuzAfnuVNOlQuj03.aBPYWoQqWoHDZm5nyGemQnnGuCPN74K', 'Marthe', 'Grondin', 8),
(156, 'slombard@gonzalez.com', '[\"ROLE_MEMBER\"]', '$2y$13$aK22SZEI4l/lfD1drNKFfeLkNqXLJKwLGc57xSejDeLC6mlXYDCjC', 'Margot', 'Bousquet', 3),
(157, 'eugene.payet@deoliveira.com', '[\"ROLE_MEMBER\"]', '$2y$13$7WFh9skHVRaCbkISVJ5qtOLwGBkEjyrKkhIC15xGGnVOi6h8ZDKny', 'Isaac', 'Duval', 9),
(158, 'emmanuel.garnier@voisin.com', '[\"ROLE_MEMBER\"]', '$2y$13$6qRjGMVYG3YFGsHG0QxSUuPhUzb8GslPSIHOmBrm2s.gBLu75zzU.', 'Mathilde', 'Ruiz', 8),
(159, 'martine.marie@noos.fr', '[\"ROLE_MEMBER\"]', '$2y$13$9/ku.aM9ncNYIgB7vqid5.9ODnCzMKmN5XIyuYHw0W7EttpIP4aAK', 'Charles', 'Bernier', 3),
(160, 'guy22@wanadoo.fr', '[\"ROLE_MEMBER\"]', '$2y$13$Emm.V9SLs9QZv.1hB5XIc.cbFRU7r6/4.e9pf3eiwDgfItUeFY1H.', 'Laure', 'Ollivier', 9),
(161, 'bernard20@hotmail.fr', '[\"ROLE_MEMBER\"]', '$2y$13$LFrwa2ekPxO0i4yiNzO.e.A7HWiBD10MJhipBuXY5EDwQNPO6vA0S', 'Jeannine', 'Jacques', 2),
(162, 'vincent.jacques@dbmail.com', '[\"ROLE_MEMBER\"]', '$2y$13$XsDPSzUjXECg2CE4l.TR7OxjA4q6jzzqt9XVFx3FkXY/XEu73cN0m', 'Hélène', 'Laporte', 2),
(163, 'vincent74@yahoo.fr', '[\"ROLE_MEMBER\"]', '$2y$13$AhPWGnZYzC23RTeAZSSpYO//Y4kQbb86LulVjDIhtAmmk6U7kkBWu', 'Émile', 'Clerc', 9),
(164, 'alain82@sfr.fr', '[\"ROLE_MEMBER\"]', '$2y$13$mUBktTtCEFlJ7Y3.6nxxTuvbWeWDUd6zp.OZrCfC.LGevzXTr7sFq', 'Charles', 'Chartier', 6),
(165, 'vregnier@club-internet.fr', '[\"ROLE_MEMBER\"]', '$2y$13$F1hsEQCC/SaAJqSD8O7d9u.lNqbbZoZVdJbn7OWWBqax5HqCnrvR6', 'Yves', 'Marty', 6),
(166, 'daniel.laure@wanadoo.fr', '[\"ROLE_MEMBER\"]', '$2y$13$DvoQq.z8kAm.5JE3Uu25aeBARNB5hd69.aqqPqUgsRqam.o31jN46', 'Claude', 'Fournier', 10),
(167, 'laurent03@free.fr', '[\"ROLE_MEMBER\"]', '$2y$13$e8bBZ9VSF4hdtFmENvTo.OMMo/cvOx.fpOnsA1qWAbYrdJnIsOZ0.', 'Amélie', 'Lopez', 2),
(168, 'hpottier@laposte.net', '[\"ROLE_MEMBER\"]', '$2y$13$q11v6UfDfUBgJ2UblaNcs.gns2YjguNb4W4xUEwUqRVtab/jcxgrm', 'Daniel', 'Garcia', 3),
(169, 'albert.dupont@test.fr', '[\"ROLE_MEMBER\"]', '$2y$13$E92dEkpJ7RGtlC0k29UGjul3JutNw8RN4vdGGme4ODCpkVGfi/gB6', 'albert', 'dupont', 6);

-- --------------------------------------------------------

--
-- Structure de la table `user_allergie`
--

CREATE TABLE `user_allergie` (
  `user_id` int(11) NOT NULL,
  `allergie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_allergie`
--

INSERT INTO `user_allergie` (`user_id`, `allergie_id`) VALUES
(156, 95),
(157, 96),
(159, 94),
(162, 99),
(163, 98),
(164, 92),
(164, 93),
(164, 97),
(168, 91),
(168, 100),
(169, 91);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `allergie`
--
ALTER TABLE `allergie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `allergie_reservation`
--
ALTER TABLE `allergie_reservation`
  ADD PRIMARY KEY (`allergie_id`,`reservation_id`),
  ADD KEY `IDX_658428367C86304A` (`allergie_id`),
  ADD KEY `IDX_65842836B83297E7` (`reservation_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `formule`
--
ALTER TABLE `formule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_605C9C98CCD7E912` (`menu_id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `opening_time`
--
ALTER TABLE `opening_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_89115E6EB1E7706E` (`restaurant_id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_16DB4F894584665A` (`product_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD12469DE2` (`category_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`),
  ADD KEY `IDX_42C84955B1E7706E` (`restaurant_id`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Index pour la table `user_allergie`
--
ALTER TABLE `user_allergie`
  ADD PRIMARY KEY (`user_id`,`allergie_id`),
  ADD KEY `IDX_FE557A4AA76ED395` (`user_id`),
  ADD KEY `IDX_FE557A4A7C86304A` (`allergie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `allergie`
--
ALTER TABLE `allergie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT pour la table `formule`
--
ALTER TABLE `formule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `opening_time`
--
ALTER TABLE `opening_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT pour la table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `allergie_reservation`
--
ALTER TABLE `allergie_reservation`
  ADD CONSTRAINT `FK_658428367C86304A` FOREIGN KEY (`allergie_id`) REFERENCES `allergie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_65842836B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formule`
--
ALTER TABLE `formule`
  ADD CONSTRAINT `FK_605C9C98CCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Contraintes pour la table `opening_time`
--
ALTER TABLE `opening_time`
  ADD CONSTRAINT `FK_89115E6EB1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `FK_16DB4F894584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_42C84955B1E7706E` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`);

--
-- Contraintes pour la table `user_allergie`
--
ALTER TABLE `user_allergie`
  ADD CONSTRAINT `FK_FE557A4A7C86304A` FOREIGN KEY (`allergie_id`) REFERENCES `allergie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FE557A4AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
