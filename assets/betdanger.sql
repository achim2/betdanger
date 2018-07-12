-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Gép: localhost
-- Létrehozás ideje: 2018. Júl 12. 00:15
-- Kiszolgáló verziója: 5.7.22-0ubuntu0.16.04.1
-- PHP verzió: 7.0.30-0ubuntu0.16.04.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `betdanger`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`id`, `content_id`, `user_id`, `status`, `body`, `created_at`) VALUES
(9, 54, 81, 'enabled', 'almalee', '2018-04-17 19:26:19'),
(10, 54, 81, 'disabled', 'wtf almel&eacute;&eacute;?', '2018-04-17 19:27:15'),
(57, 48, 81, 'enabled', 'my comment 23', '2018-05-09 20:19:20');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `status` enum('not public','public') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `content`
--

INSERT INTO `content` (`id`, `user_id`, `category_id`, `title`, `slug`, `image_name`, `body`, `status`, `created_at`) VALUES
(48, 81, 2, ' Vestibulum ornare', 'vestibulum-ornare', 'amf_0.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vel mauris nec ligula fringilla tristique. Aliquam vitae enim nec nibh egestas laoreet a sed erat. Aliquam et massa imperdiet, tristique risus vitae, sollicitudin magna. Aenean ultricies vel metus at ultrices. Proin a nulla sed ipsum bibendum tempus nec in libero. Phasellus tempus molestie tortor non maximus. Pellentesque ullamcorper ultrices libero, in posuere purus semper in. Aenean imperdiet convallis metus, non finibus neque consectetur sed. Suspendisse tincidunt laoreet ipsum quis ornare. Aliquam sagittis vestibulum tempor. Quisque vehicula finibus quam, eu mattis leo mollis a. Vestibulum ornare, nibh ut porta accumsan, elit augue aliquam lorem, sodales auctor odio erat aliquet erat. Nam sed lectus tempus, iaculis nisl ac, tempus urna. Etiam bibendum nec dui semper tempus.', 'public', '2018-05-06 15:43:19'),
(49, 81, 3, 'Curabitur luctus pretium elit hendrerit pharetra.', 'curabitur-luctus-pretium-elit', 'amf_1.jpg', 'Curabitur luctus pretium elit hendrerit pharetra. Nulla facilisi. Donec id risus lorem. Curabitur sed mollis arcu. Nam interdum ultricies mauris sit amet faucibus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc ut imperdiet sem. Aenean tempor ullamcorper orci et venenatis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec accumsan elit dapibus nibh vehicula molestie. Fusce ut varius metus. Donec ultrices ex et leo laoreet, non efficitur nibh varius. Morbi a rhoncus libero, non faucibus augue. Vestibulum sed consectetur est. Nunc euismod tellus ut urna imperdiet, pellentesque rutrum turpis sagittis. Fusce fermentum mauris rutrum mattis commodo.', 'public', '2018-04-02 15:28:49'),
(50, 81, 4, 'Vivamus commodo odio.', 'vivamus-commodo-odio-', 'amf_2.jpg', 'Vivamus commodo odio vitae mi imperdiet, ac posuere est auctor. Nam elit felis, porta non augue et, suscipit faucibus ante. Vestibulum congue justo ante, eget iaculis mi bibendum quis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque lobortis tincidunt odio elementum iaculis. Sed scelerisque suscipit aliquet. Nam lorem purus, lobortis a eros sed, facilisis malesuada orci. Donec vehicula ullamcorper laoreet. Phasellus ultricies libero ut purus iaculis accumsan. Praesent velit enim, euismod eu varius in, ultrices id nulla. Mauris pellentesque porta pretium. In in lacus et erat pretium ultricies. Vestibulum sollicitudin metus sed ex scelerisque, sed pretium est maximus. Vivamus faucibus blandit mi, sed consectetur quam pellentesque vitae. Integer sed velit in mauris dignissim commodo. Donec vel turpis ac purus condimentum varius.', 'public', '2018-04-02 15:28:36'),
(51, 81, 2, 'Praesent condimentum gravida lorem eget suscipit.', 'praesent-condimentum-gravida-lorem', 'amf_3.jpg', 'Praesent condimentum gravida lorem eget suscipit. Duis tempus sodales odio, ac finibus justo pharetra eget. Nunc non varius magna. Mauris finibus odio ut lectus dignissim, at pretium enim rutrum. Fusce elementum hendrerit sapien, et cursus enim pellentesque quis. In id nulla at mi pharetra ullamcorper bibendum sed orci. Fusce ac leo vitae mi sodales porta. Phasellus varius suscipit velit sed ultricies. Sed eu scelerisque est, sed venenatis nisi. Integer eget elit tincidunt risus ultrices fringilla. Sed finibus risus at ipsum porttitor semper. Nulla condimentum efficitur libero eget finibus. Nunc volutpat leo vel arcu ornare fringilla. Duis nec semper arcu. Aliquam viverra ante nec ante posuere facilisis.\r\n\r\n', 'public', '2018-04-02 15:28:15'),
(52, 81, 2, 'Duis ut velit diam. ', 'duis-ut-velit-diam-', 'amf_4.jpg', 'Duis ut velit diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque et sem auctor, posuere lacus feugiat, dictum sem. Nulla facilisi. Nunc pharetra velit a nunc efficitur, vitae mollis velit ullamcorper. Nam tellus lorem, dignissim et auctor eget, posuere vitae mauris. Nulla sit amet vehicula sem. In vel dignissim neque, vitae vulputate mi. Nulla eget magna rhoncus, pretium sapien nec, dictum est.', 'not public', '2018-04-02 15:27:54'),
(53, 81, 2, 'Vivamus eget justo quis ipsum imperdiet molestie.', 'vivamus-eget-justo-quis', 'amf_5.jpg', 'Vivamus eget justo quis ipsum imperdiet molestie. Pellentesque vitae enim leo. Suspendisse feugiat mollis est eu malesuada. Maecenas id nunc eu nunc bibendum tempor. In in interdum nibh, a vestibulum elit. Nulla ut lobortis odio. Nulla facilisi. Sed eu nibh ipsum. Donec pretium mi ac nulla pellentesque posuere. In porttitor tortor sit amet tellus iaculis, id fermentum velit maximus. Phasellus quis lacus vel lorem tempor imperdiet. Aliquam euismod, nisi vitae laoreet varius, sem erat sodales augue, vel placerat risus erat eu purus. Vivamus aliquam, erat at ullamcorper condimentum, eros leo ornare sem, et lobortis libero nisi vitae odio.', 'not public', '2018-04-02 15:27:37'),
(54, 81, 3, 'Pellentesque feugiat dolor.', 'pellentesque-feugiat-dolor-', 'amf_6.jpg', 'Pellentesque feugiat dolor vel risus posuere, id luctus justo ultricies. Integer efficitur tristique elit ut suscipit. Aenean nec tempus erat. Donec eros lorem, lacinia eu sapien porta, semper luctus odio. Suspendisse potenti. Suspendisse semper mi lorem, ac porta velit pellentesque sit amet. Duis sollicitudin tincidunt ultrices. Nunc rutrum ante non metus placerat feugiat. Nulla a nisl orci. Donec a vehicula ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dapibus quis nisi eget hendrerit.', 'public', '2018-04-02 15:29:04'),
(55, 81, 3, 'Mauris accumsan iaculis lobortis. ', 'mauris-accumsan-iaculis-lobortis-', 'amf_7.jpg', 'Mauris accumsan iaculis lobortis. Morbi dapibus sapien in iaculis ullamcorper. Nullam accumsan fermentum nulla, et fermentum lorem euismod sit amet. Sed at facilisis sem, quis facilisis nisi. Vestibulum gravida feugiat ligula, vitae euismod lorem mollis id. Nam sit amet orci non diam lacinia dapibus. Nam venenatis sollicitudin pretium. Etiam neque orci, tempor vitae dolor at, gravida varius urna. Duis dignissim laoreet vehicula. Cras ex metus, dapibus ut accumsan eget, consectetur vitae sapien. In congue, eros at facilisis rutrum, nibh eros finibus mauris, eu hendrerit nunc eros quis magna. Nullam sollicitudin dapibus leo quis posuere. Aliquam dignissim urna a massa bibendum, a egestas sem molestie. Etiam vulputate, sapien eu varius malesuada, diam magna gravida ligula, at porttitor arcu enim ac nunc. Donec eget risus ac erat eleifend aliquam posuere id neque.', 'public', '2018-04-02 15:29:46');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `content_category`
--

CREATE TABLE `content_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `content_category`
--

INSERT INTO `content_category` (`id`, `name`) VALUES
(1, 'uncategorised'),
(2, 'news'),
(3, 'preview'),
(4, 'blog');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `content_tag_relationship`
--

CREATE TABLE `content_tag_relationship` (
  `id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `content_tag_relationship`
--

INSERT INTO `content_tag_relationship` (`id`, `content_id`, `tag_id`) VALUES
(18, 53, 7),
(19, 53, 11),
(20, 53, 12),
(21, 52, 7),
(22, 52, 13),
(23, 51, 7),
(24, 51, 14),
(25, 51, 15),
(26, 50, 16),
(27, 50, 17),
(28, 50, 18),
(31, 49, 19),
(32, 54, 7),
(33, 54, 19),
(34, 55, 7),
(35, 55, 8),
(36, 55, 9),
(37, 55, 20),
(45, 48, 7),
(46, 48, 13);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(255) NOT NULL,
  `option` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `settings`
--

INSERT INTO `settings` (`id`, `name`, `slug`, `option`) VALUES
(1, 'Image', 'image', 1),
(2, 'Author', 'author', 1),
(3, 'Short description', 'short_description', 1),
(4, 'Tags', 'tags', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(7, 'nfl'),
(8, 'titans'),
(9, 'carolina'),
(11, 'westwirginia'),
(12, 'stadium'),
(13, 'qb'),
(14, 'newengland'),
(15, 'patriots'),
(16, 'defense'),
(17, 'offens'),
(18, 'ravens'),
(19, 'greenbay'),
(20, 'kids');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` enum('user','administrator','moderator') NOT NULL DEFAULT 'user',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `newsletter` enum('yes','no') NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(255) DEFAULT NULL,
  `verify` varchar(255) DEFAULT 'not verified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `username`, `password`, `email`, `newsletter`, `join_date`, `ip_address`, `verify`) VALUES
(81, 'moderator', 'achim2', '$2y$10$7VQbmll42RZYkS0vprpq3eRfnSoZc2qL.OFe2hc36SlCLowZUDAiy', 'ahimjuhasz@gmail.com', 'yes', '2017-11-02 17:04:58', '127.0.0.1', 'verified'),
(82, 'administrator', 'viki06', '$2y$10$mMWcV1xcEx3NPjItyszrX.ZudARDZ1X/.y/C9Uz1kV7dxL9jGh5Qy', 'viki0626@gmail.com', 'no', '2017-11-02 17:04:58', '127.0.0.1', 'tilted'),
(87, 'moderator', 'TestUser', '$2y$10$ufx19Aq18/ynj7SW8VzxjeHZjmik4xQBof7PnPMgQzMe67ej0ImqK', 'testuser@gmail.com', 'no', '2018-07-11 22:07:50', '127.0.0.1', 'verified');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `content_category`
--
ALTER TABLE `content_category`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `content_tag_relationship`
--
ALTER TABLE `content_tag_relationship`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT a táblához `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT a táblához `content_category`
--
ALTER TABLE `content_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT a táblához `content_tag_relationship`
--
ALTER TABLE `content_tag_relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT a táblához `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT a táblához `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
