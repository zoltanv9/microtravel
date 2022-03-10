-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Okt 14. 14:58
-- Kiszolgáló verziója: 10.1.21-MariaDB
-- PHP verzió: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `utazas`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `f_id` int(10) NOT NULL,
  `nev` varchar(250) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(250) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `reg_datum` date NOT NULL,
  `stat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`f_id`, `nev`, `email`, `tel`, `pass`, `reg_datum`, `stat`) VALUES
(1, 'Pável Tibor Tamás', 'pavel.tibor@valami.hu', '+36 30 397 6810', '896423f95929303ae8fe37f67316fb62a7b75a7a', '0000-00-00', 1),
(2, 'Teszt Jolánka', 'teszt.jolanka@valami.hu', '+36303976999', '896423f95929303ae8fe37f67316fb62a7b75a7a', '0000-00-00', 0),
(3, 'Teszt Roland', 'teszt.roland@valami.hu', '+36 1 888 8888', '4256cca8af52ab0005c25da5d59706f2c6a680db', '0000-00-00', 1),
(4, 'Teszt Feri', 'teszt.feri@valami.hu', 'Nem adott meg számot', '896423f95929303ae8fe37f67316fb62a7b75a7a', '0000-00-00', 0),
(6, 'Teszt Gábor', 'teszt.gabor@valami.hu', '+36 1 888 9999', '896423f95929303ae8fe37f67316fb62a7b75a7a', '0000-00-00', 1),
(8, 'Teszt Márton', 'teszt.marton@valami.hu', '+36 30 555 9995', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-11-20', 1),
(10, 'Albert Mari', 'teszt.mari@valami.hu', '+36 00 555 9998', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-11-27', 0),
(11, 'Teszt Joli', 'teszt.joli@valami.hu', '+36 30 555 9999', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-11-27', 0),
(12, 'Teszt Tibi', 'teszt.tibi@valami.hu', 'Nem adott meg számot', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-11-27', 0),
(13, 'Bacsó Krisztián', 'teszt.krisztian@valami.hu', '+36 12 123 4810', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-11-27', 1),
(14, 'Teszt Mónika', 'teszt.monika@valami.hu', '+36 30 397 9955', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-12-10', 1),
(15, 'Teszt Zsigmond', 'teszt.zsiga@valami.hu', '+36 20 548 8966', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-12-10', 1),
(16, 'Kovács János', 'kovacs.janos@valami.hu', '+36 70 888 9954', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-12-10', 1),
(17, 'Balázs Gábor', 'balazs.gabor@valami.hu', '+36 70 555 6655', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2020-12-18', 0),
(18, 'Teszt Matyás', 'teszt.matyi@valami.hu', '+36303976555', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2021-04-07', 0),
(19, 'Kesztyű Béla', 'k.bela@valami.hu', '+36 30 397 6888', '856b1e5118595d5d61f156b1db2f7d86bd17f9ee', '2021-04-29', 1),
(21, 'Kovács Csongor', 'tkk@valami.hu', '+36303976097', '896423f95929303ae8fe37f67316fb62a7b75a7a', '2021-10-13', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo_meta`
--

CREATE TABLE `felhasznalo_meta` (
  `fm_id` int(10) NOT NULL,
  `f_id` int(10) NOT NULL,
  `f_kedv_varos` varchar(250) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `felhasznalo_meta`
--

INSERT INTO `felhasznalo_meta` (`fm_id`, `f_id`, `f_kedv_varos`) VALUES
(9, 21, 'Párizs'),
(10, 21, 'London'),
(11, 21, 'Berlin'),
(12, 21, 'Budapest'),
(13, 19, 'Madrid'),
(14, 19, 'Lisszabon'),
(15, 1, 'Párizs'),
(16, 1, 'London'),
(17, 1, 'Róma');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `utazasok`
--

CREATE TABLE `utazasok` (
  `ut_id` int(100) NOT NULL,
  `utazas_id` varchar(20) NOT NULL,
  `utazas_nev` varchar(250) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `utazas_tipus` varchar(150) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `utazas_jelleg` varchar(80) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `utazas_leiras` varchar(1500) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `utazas_ar` varchar(20) NOT NULL,
  `utazas_kep` varchar(500) NOT NULL,
  `utazas_ind_datum` varchar(20) NOT NULL,
  `utazas_reg_datum` varchar(15) NOT NULL,
  `utazas_stat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `utazasok`
--

INSERT INTO `utazasok` (`ut_id`, `utazas_id`, `utazas_nev`, `utazas_tipus`, `utazas_jelleg`, `utazas_leiras`, `utazas_ar`, `utazas_kep`, `utazas_ind_datum`, `utazas_reg_datum`, `utazas_stat`) VALUES
(1, 'T-2020-1', 'Barcelona', 'Repülő', 'Normal', 'Nulla tristique hendrerit leo, nec pulvinar dui cursus at. Proin feugiat diam volutpat, mattis neque non, malesuada odio. Phasellus leo nunc, porta sed sem eget, tincidunt tincidunt eros.', '106 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608217295-barcelona.jpg', '2021-07-16', '2020-12-16', 1),
(2, 'T-2020-2', 'Utazás Rómába', 'Autóbusz', 'First minute', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis feugiat leo. Ut iaculis augue quis eros sollicitudin ullamcorper. Maecenas dapibus sit amet est id rutrum. Mauris cursus porta metus, eu tempor nibh posuere vulputate.', '132 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608217145-roma.jpg', '2021-02-27', '2020-12-16', 1),
(3, 'T-2020-3', 'Ciprus hajóval', 'Hajó', 'First minute', 'Nullam ultrices laoreet purus, non tempor ante egestas eu. Etiam mollis pretium consectetur. Aliquam erat volutpat. Etiam quis ipsum et turpis maximus viverra. ', '238 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608217493-ciprus.jpg', '2021-04-30', '2020-12-16', 1),
(4, 'T-2020-4', 'Berlin', 'Repülő', 'Last minute', 'Nulla tristique hendrerit leo, nec pulvinar dui cursus at. Proin feugiat diam volutpat, mattis neque non, malesuada odio. Phasellus leo nunc, porta sed sem eget, tincidunt tincidunt eros.', '78 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608217236-berlin.jpg', '2021-03-31', '2020-12-16', 1),
(5, 'T-2020-5', 'Utazás Párizsba', 'Autóbusz', 'Normal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis feugiat leo. Ut iaculis augue quis eros sollicitudin ullamcorper. Maecenas dapibus sit amet est id rutrum. Mauris cursus porta metus, eu tempor nibh posuere vulputate. ', '130 000 Ft', 'kopvhl5niholvp18ggmnuiq6o6-1608290856-paris.jpg', '2021-04-15', '2020-12-16', 1),
(6, 'T-2020-6', 'Utazás Madridba', 'Autóbusz', 'Normal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis feugiat leo. Ut iaculis augue quis eros sollicitudin ullamcorper. Maecenas dapibus sit amet est id rutrum. Mauris cursus porta metus, eu tempor nibh posuere vulputate.', '195 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608217002-madrid.jpg', '2021-03-19', '2020-12-16', 1),
(7, 'T-2020-7', 'Bécsi városnézés', 'Autóbusz', 'Last minute', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis feugiat leo. Ut iaculis augue quis eros sollicitudin ullamcorper. Maecenas dapibus sit amet est id rutrum. Mauris cursus porta metus, eu tempor nibh posuere vulputate.', '58 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608216938-becs.jpg', '2021-01-24', '2020-12-17', 1),
(8, 'T-2020-8', 'Kolozsvári városnézés', 'Autóbusz', 'All in', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin quis feugiat leo. Ut iaculis augue quis eros sollicitudin ullamcorper. Maecenas dapibus sit amet est id rutrum. Mauris cursus porta metus, eu tempor nibh posuere vulputate.', '65 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608216878-kolozsvar.jpg', '2021-01-14', '2020-12-17', 0),
(9, 'T-2020-9', 'Hajóval Kubába', 'Hajó', 'Normal', 'Nullam ultrices laoreet purus, non tempor ante egestas eu. Etiam mollis pretium consectetur. Aliquam erat volutpat. Etiam quis ipsum et turpis maximus viverra. ', '465 000 Ft', 'a7lddrhhci7nm5ckfns2ijs8f7-1608217435-cuba.jpg', '2021-02-24', '2020-12-17', 1),
(10, 'T-2020-10', 'Hajózás Marokkóba', 'Hajó', 'First minute', 'Nullam ultrices laoreet purus, non tempor ante egestas eu. Etiam mollis pretium consectetur. Aliquam erat volutpat. Etiam quis ipsum et turpis maximus viverra. ', '498 000 Ft', 'kopvhl5niholvp18ggmnuiq6o6-1608287076-marocco.jpg', '2021-04-25', '2020-12-17', 1),
(11, 'T-2020-11', 'Londoni látogatás ', 'Repülő', 'Normal', 'Etiam dictum pharetra interdum. Quisque tristique, enim non condimentum convallis, nisl dui ullamcorper justo, ac finibus massa nisi at metus. Morbi at ipsum eros.', '195 000 Ft', 'kopvhl5niholvp18ggmnuiq6o6-1608277949-london.jpg', '2021-10-30', '2020-12-18', 1),
(12, 'T-2021-12', 'Utazás Londonba', 'Repülő', 'Normal', 'Fusce lobortis nisl non orci ornare lacinia. Sed luctus dapibus ex nec accumsan. Duis eu odio eget turpis malesuada cursus. Vivamus faucibus luctus ornare. Aliquam ante tellus, consectetur eu aliquet et, iaculis vel urna. Proin et ante fringilla, pharetra mi non, condimentum felis.', '235.000 Ft', 'i5eoi86nm4ls40n5np39ro1834-1619074839-london-500x500.jpg', '2021-11-09', '2021-04-22', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`f_id`);

--
-- A tábla indexei `felhasznalo_meta`
--
ALTER TABLE `felhasznalo_meta`
  ADD PRIMARY KEY (`fm_id`);

--
-- A tábla indexei `utazasok`
--
ALTER TABLE `utazasok`
  ADD PRIMARY KEY (`ut_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `f_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT a táblához `felhasznalo_meta`
--
ALTER TABLE `felhasznalo_meta`
  MODIFY `fm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT a táblához `utazasok`
--
ALTER TABLE `utazasok`
  MODIFY `ut_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
