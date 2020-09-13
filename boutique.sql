-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 04 avr. 2020 à 15:00
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

USE dbs781078;

DROP TABLE IF EXISTS `boutique_achats`;
CREATE TABLE IF NOT EXISTS `boutique_achats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `boutique_achats` (`id`, `id_utilisateur`, `id_article`, `quantite`, `prix`) VALUES
(15, 1, 17, 4, 300),
(16, 1, 43, 4, 79.2);

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `boutique_articles`;
CREATE TABLE IF NOT EXISTS `boutique_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `promo` int(1) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_subcat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `boutique_articles` (`id`, `id_categorie`, `nom`, `prix`, `promo`, `img`, `description`, `stock`, `id_subcat`) VALUES
(17, 1, 'Pixie Clips Magimix', 75, 0, 'img/pixieclips.png', 'Pixie est la petite surdouÃ©e de Nespresso. Elle concentre une large palette de fonctionnalitÃ©s innovantes dans une machine Ã©tonnamment compacte.', 496, 2),
(31, 1, 'Senseo Quadrante', 99, 10, 'img/quadrante.png', 'La nouvelle machine Ã  cafÃ© SENSEOÂ® Quadrante maximise les saveurs du cafÃ© grÃ¢ce Ã  la technologie SENSEOÂ® Booster d\'arÃ´mes permettant Ã  l\'eau d\'entrer en contact avec la totalitÃ© des 50 grains de cafÃ© Ã  la fois, pour un goÃ»t plus riche et intense. Son sÃ©lecteur d\'intensitÃ© permet plus de choix.', 20, 1),
(30, 1, 'Vertuo Next', 179, 0, 'img/vertuo.png', 'Vertuo Next complÃ¨te la gamme de machines Vertuo . DÃ©couvrez cette nouvelle machine design, au format rÃ©solument urbain et compact. La technologie exclusive Vertuo et toutes ses qualitÃ©s, repensÃ©e pour vous avec 3 finitions de machines et de nombreux coloris.', 100, 2),
(18, 1, 'EXPRESSO EKOH', 150, 0, 'img/ekoh.png', 'FabriquÃ©e en France, Ekâ€™oh rÃ©pond aux exigences des puristes de lâ€™expresso. Une machine Ã©thique, Ã©co-conÃ§ue recyclable et rÃ©parable dotÃ©e de 21 bars de pression.', 995, 1),
(20, 1, 'Jura F9 piano', 1199, 20, 'img/jura.png', 'L\'expresso broyeur Jura F9 Piano Black est idÃ©al pour les passionnÃ©s de cafÃ© qui souhaitent dÃ©guster un cafÃ© Ã  toute heure ! Selon les goÃ»ts et les envies de chacun, vous pouvez rÃ©aliser un cafÃ© lungo, un cafÃ© crÃ¨me, un espresso ou pour les plus gourmands un cappuccino ou un latte macchiato.', 10, 3),
(21, 1, 'NUOVA SIMONELLI', 840, 0, 'img/nuova.png', 'En plus d\'un design moderne et de nouvelles courbes, la machine Oscar II bÃ©nÃ©ficie de la technologie des machines professionnelles de la marque. Pour des expressos crÃ©meux, riches en corps et en arÃ´mes.', 40, 3),
(22, 1, 'JURA ENA', 899, 0, 'img/juraena.png', 'Une machine Ã  cafÃ© automatique derniÃ¨re gÃ©nÃ©ration. Elle permet de prÃ©parer un large Ã©ventail de boissons : expresso, cafÃ© long, Latte Macchiato ou Cappuccino, mais aussi eau chaude pour vos thÃ©s.', 5, 3),
(23, 1, 'MOULIN BODUM', 149, 20, 'img/bodum.png', 'Ce broyeur Ã  cafÃ© Bodum est idÃ©al pour une utilisation domestique. TrÃ¨s simple Ã  manipuler, il vous suffit de tourner le rÃ©cipient supÃ©rieur pour rÃ©gler la mouture. IdÃ©al pour les cafÃ©s filtre et piston !', 50, 3),
(24, 1, 'SCOTT SLIMISSIMO', 399, 5, 'img/scott.png', 'Une machine Ã  grains automatique et silencieuse, Ã©quipÃ©e d\'un moulin en acier, pour moudre Ã  la minute vos cafÃ©s en grains. L\'expresso parfait Ã  portÃ©e de main!', 100, 3),
(25, 1, 'Essenza Mini', 99, 5, 'img/essenza.png', 'La nouvelle machine Essenza Mini allie facilitÃ© d\'utilisation, beautÃ© minimaliste et qualitÃ© Nespresso.', 2000, 2),
(26, 1, 'INISSIA', 99, 10, 'img/inissia.png', 'Laisse parler la couleur avec Inissia... Compacte et rapide, elle se dÃ©cline en 8 coloris pour donner libre couzrs Ã  votre imagination.', 1000, 2),
(27, 1, 'Krups Arabica', 499, 20, 'img/krups.png', 'DotÃ©e d\'une pression de 15 bars, la Krups Arabica Deluxe vous offrira un expresso d\'exception surmontÃ© d\'une fine et dÃ©licieuse mousse (crema).   RÃ©alisez jusqu\'Ã  2 boissons simultanÃ©ment (en 2 percolations) grÃ¢ce Ã  sa double buse cafÃ©.  Un plateau repose-tasse est placÃ© sur le dessus de la machine et vous permettra de prÃ©chauffer les tasses avant de les utiliser afin de les mettre Ã  tempÃ©rature idÃ©ale au moment de l\'extraction pour assurer un meilleur rÃ©sultat en tasse.  L\'Arabica Deluxe est aussi equipÃ©e d\'une buse vapeur afin de vous offrir la possibilitÃ© d\'Ã©largir la carte des boissons : Proposez de dÃ©licieux cappuccinos Ã  vos invitÃ©s.', 1000, 3),
(28, 1, 'EQ.3 S100', 699, 40, 'img/eq3', 'La  EQ.3 S100 est trÃ¨s simple d\'utilisation et permet d\'aller Ã  l\'essentiel : un  Ã©cran avec des symboles intuitifs , jumelÃ©s Ã  des  touches d\'accÃ¨s direct tactiles  et de programmation qui permettent une navigation efficace et une rÃ©alisation de boissons personnalisÃ©e.  RÃ©alisez  jusqu\'Ã  2 boissons cafÃ© simultanÃ©ment facilement et surtout trÃ¨s rapidement grÃ¢ce au systÃ¨me \"Coffee Direct\". ', 100, 3),
(29, 1, 'Delonghi Magnifica', 599, 40, 'img/delonghi.png', 'Personnaliser son cafÃ© n\'a jamais Ã©tÃ© aussi facile avec cette  machine Ã  cafÃ© expesso Ã  broyeur : CafÃ© serrÃ© ou long, extra lÃ©ger Ã  extra fort et de tempÃ©rature basse, moyenne ou Ã©levÃ©e.  Son panneau de commande vous permet de prÃ©parer simplement votre cafÃ© en appuyant un bouton. La rotation du bouton central augmente ou diminue l\'intensitÃ© de l\'arÃ´me cafÃ©.  Deux cafÃ©s peuvent Ãªtre prÃ©parÃ©s simultanÃ©ment en une seule percolation ! Option Rare !', 1000, 3),
(32, 1, 'Senseo Original', 85, 0, 'img/original.png', 'La technologie Booster d\'arÃ´mes rÃ©partit l\'eau sur la dosette de cafÃ© grÃ¢ce Ã  ses 45 trous afin d\'obtenir un goÃ»t intense, tandis que la technologie Crema plus garantit une couche de crÃ¨me d\'une finesse et d\'une onctuositÃ© optimales.', 400, 1),
(33, 1, 'Viva CafÃ©', 105, 5, 'img/viva.png', 'La machine Ã  cafÃ© SENSEOÂ® Viva CafÃ© maximise les saveurs du cafÃ© grÃ¢ce Ã  la technologie innovante SENSEOÂ® Booster d\'arÃ´mes. Les 45 buses d\'arÃ´me rÃ©partissent l\'eau chaude de maniÃ¨re optimale sur toute la dosette afin qu\'elle entre en contact avec la totalitÃ© des 50 grains de cafÃ© Ã  la fois.', 500, 1),
(34, 2, 'Or Barista', 4, 0, 'img/orbarista.png', 'DÃ©couvrez L\'OR BARISTAÂ® Grand CafÃ© Filtre, un cafÃ© aux arÃ´mes envoÃ»tants. GoÃ»tez ce mÃ©lange rond et Ã©quilibrÃ©, aux notes dÃ©licates d\'agrumes et aux arÃ´mes gÃ©nÃ©reux de noisettes grillÃ©es. Il allie une complexitÃ© Ã©lÃ©gante et une dÃ©licatesse tout en rondeur, pour un goÃ»t persistant et une expÃ©rience unique.', 1000, 5),
(35, 2, 'Or Splendente', 6, 0, 'img/orsplendente.png', 'L\'OR Espresso SPLENDENTE est un espresso d\'une qualitÃ© incomparable avec des arÃ´mes prononcÃ©s et une Ã©lÃ©gante mousse dorÃ©e. Son goÃ»t irrÃ©sistible est couronnÃ© de lÃ©gÃ¨res notes de noisettes finissant sur un zeste d\'agrumes.', 500, 5),
(36, 2, 'Lungo Elegante', 3, 0, 'img/lungo.png', 'DÃ©couvrez le caractÃ¨re tendre de L\'OR LUNGO ELEGANTE, un espresso fruitÃ© et fleuri, dominÃ© par des notes d\'agrumes et de baies noires. Sa dÃ©licate mousse dorÃ©e parfait son Ã©lÃ©gance et sa grÃ¢ce.', 400, 5),
(37, 2, 'Ristretto', 11, 5, 'img/ristretto.png', 'ComposÃ© avec soin, RISTRETTO Ã©blouit les sens grÃ¢ce Ã  son caractÃ¨re expressif et vivifiant et ses puissantes notes Ã©picÃ©es. Un ristretto idÃ©al pour un voyage intense inoubliable.', 40, 5),
(38, 2, 'CafÃ© RenÃ© Classic', 3, 20, 'img/reneclassic.png', 'Avec le CafÃ© RenÃ© Classic, comme son nom l\'indique, vous obtenez une tasse de cafÃ© traditionnelle de fÃ¨ves moyennement torrÃ©fiÃ©es.  Le cafÃ© a une couche de crÃ¨me dÃ©licieuse et vous convient parfaitement, particuliÃ¨rement pour une tasse de cafÃ© ordinaire. Le goÃ»t est aromatique, avec un bel arriÃ¨re-goÃ»t de caramel.', 200, 4),
(39, 2, 'Milka', 3.49, 20, 'img/milka.png', 'Vos tout-petits devraient-ils Ã©galement bÃ©nÃ©ficier de votre machine Senseo - ou vous contentez-vous de vous gÃ¢ter avec une tasse de cacao? Avec Milka for Senseo, vous pourrez dÃ©guster une tasse de cacao sucrÃ©e et dÃ©licieuse, qui peut Ãªtre prÃ©parÃ©e en une minute Ã  peine avec votre machine Ã  cafÃ© Senseo.  Ce paquet contient des dosettes de cafÃ© pour 8 tasses de cacao. Vous devez utiliser le grand support de bloc-notes et appuyer sur le bouton pour obtenir une tasse normale.', 1000, 4),
(40, 2, 'Senseo Classic', 3.49, 0, 'img/senseoclassic.png', 'Voulez-vous un mÃ©lange Ã©quilibrÃ© moyennement torrÃ©fiÃ© de grains d\'Arabica et de Robusta dans une tasse de cafÃ© ronde et harmonieuse? Alors, le Senseo Classic est le bon choix pour vous.  Avec Senseo Classic, vous pouvez obtenir en quelques minutes un cafÃ© savoureux et aromatique pour vous et vos invitÃ©s.', 600, 4),
(41, 2, 'Senseo Strong', 6.99, 40, 'img/senseostrong.png', 'Si vous aimez le cafÃ© noir avec beaucoup de plÃ©nitude et de goÃ»t, vous obtiendrez ici un cafÃ© qui rÃ©pond Ã  vos attentes.  Les dosettes de cette variante sont de taille double pour vous permettre de profiter d\"une grande tasse de 200 ml. de votre cafÃ© prÃ©fÃ©rÃ©. Vous devez donc utiliser l\'insert de 2 tasses puis appuyer sur le bouton de 2 tasses (ou sur le bouton de grande tasse selon le modÃ¨le de la machine).  C\'est le cafÃ© pour vous qui avez besoin d\'un petit supplÃ©ment pour ouvrir les yeux le matin, qui doit avoir un goÃ»t prononcÃ© dans le thermos lors de vos dÃ©placements, ou pour vous qui avez besoin de rester debout plus longtemps avant que la nuit fasse son apparition.  Le grand parfum du cafÃ© provient de sa torrÃ©faction foncÃ©e puissante, qui allie parfaitement amertume et intensitÃ©. Le mÃ©lange de cafÃ© d\'Arabica et de Robusta donne une saveur douce et invitante.  Câ€™est un cafÃ© plein et au bon goÃ»t - et dans une grande tasse - qui se fait facilement et simplement, avec Senseo.', 600, 4),
(42, 2, 'CafÃ© en grains : BrÃ©sil', 27.6, 40, 'img/grainbresil.png', 'Ce cafÃ© en grains Rose Diamond du BrÃ©sil  provient de la prestigieuse rÃ©gion de Cerrado au BrÃ©sil (Sud-Est) connue pour produire des cafÃ©s de haute qualitÃ© Ã  l\'identitÃ© unique. Ce blend d\'Arabicas natures dÃ©veloppe des notes gourmandes de chocolat et de cacahuÃ¨te. Conditionnement : 1kg', 1000, 6),
(43, 2, 'CafÃ© en grain : Italien', 22.8, 10, 'img/grainitalien.png', 'Ce cafÃ© en grains Le Blend Italien est un blend d\'Arabica et de Robusta spÃ©cialement assemblÃ© et torrÃ©fiÃ© par l\'Ã©quipe de torrÃ©faction des CafÃ©s Lugat pour rÃ©aliser un espresso de qualitÃ© aux notes Ã©picÃ©es. Ce Blend est composÃ© d\'Arabica du BrÃ©sil, d\'Ethiopie et du Congo et de Robusta d\'Inde. TorrÃ©faction medium spÃ©cialement Ã©tudiÃ©e pour rÃ©aliser de bons espressi. Conditionnement : 1kg. ', 996, 6),
(44, 2, 'CafÃ© en grain : Nicaragua', 54, 20, 'img/grainnicaragua.png', 'Ce cafÃ© en grains Buenos Aires est issu de la rÃ©gion de Dipilto au Nicaragua. Ce cafÃ© est cultivÃ© dans la ferme San Salvador tenue par la famille Valladarez. Il vous offrira une tasse aux arÃ´mes de fruits tropicaux et miel. Il est conditionnÃ© en 4 sachets de 250g.', 200, 6),
(45, 2, 'CafÃ© en grain : Costa Rica', 35.6, 0, 'img/graincostarica.png', 'Ce cafÃ© en grains Rio Jorco est cultivÃ© dans l\'une des plus anciennes plantations du Costa Rica au coeur de la rÃ©gion de Tarrazu. Vous aurez une tasse aux arÃ´mes de cacao et d\'amande. TorrÃ©faction medium spÃ©cialement Ã©tudiÃ©e pour rÃ©aliser de bon espressi. Conditionnement : 4x250g.', 2000, 6),
(46, 3, 'Earl Grey Green', 4.2, 0, 'img/earlgreygreen.png', 'Earl Grey Green revisite la tradition Britannique du cÃ©lÃ¨bre Earl Grey avec un thÃ© vert biologique Sencha fraÃ®chement cueilli en Chine, parfumÃ© Ã  la bergamote et aux notes subtiles d\'agrumes.', 600, 7),
(47, 3, 'Earl Grey', 3.9, 0, 'img/earlgrey.png', 'Unique mÃ©lange de Keemun et Ceylan parfumÃ© aux Ã©corces de bergamote venues directement de Calabre en Italie, ce thÃ© noir Earl Grey est synonyme d\'escapade Ã  tout moment de la journÃ©e.', 600, 8),
(48, 3, 'Roobois Orange', 4.2, 0, 'img/rooboisorange.png', 'Un dÃ©licieux et exotique Rooibos BIO d\'Afrique du Sud associÃ© Ã  de savoureuses Ã©corces d\'orange. Laissez-vous emporter pour un safari sensoriel avec cette boisson sans thÃ©ine.', 400, 9);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_avis`
--

DROP TABLE IF EXISTS `boutique_avis`;
CREATE TABLE IF NOT EXISTS `boutique_avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `note` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `boutique_avis` (`id`, `id_utilisateur`, `id_article`, `message`, `note`, `date`) VALUES
(14, 1, 43, 'Les saveurs italiennes sont au rdv!', 5, '2020-04-03 20:20:49'),
(13, 1, 34, 'Pas mal comme goÃ»t', 3, '2020-04-03 19:49:47'),
(12, 1, 31, 'TrÃ¨s bonne machine, elle fait le taff!', 5, '2020-04-03 19:49:23'),
(9, 1, 17, 'Excellent produit de trÃ¨s bonne qualitÃ©', 5, '2020-04-03 18:04:22'),
(11, 1, 46, 'Un thÃ¨s vert de bonne qualitÃ©', 4, '2020-04-03 18:51:12');

-- --------------------------------------------------------

--
-- Structure de la table `boutique_categories`
--

DROP TABLE IF EXISTS `boutique_categories`;
CREATE TABLE IF NOT EXISTS `boutique_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boutique_categories`
--

INSERT INTO `boutique_categories` (`id`, `nom`, `id_utilisateur`) VALUES
(1, 'Machines', 1),
(2, 'CafÃ©s', 1),
(3, 'ThÃ©s', 1);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_panier`
--

DROP TABLE IF EXISTS `boutique_panier`;
CREATE TABLE IF NOT EXISTS `boutique_panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boutique_panier`
--

INSERT INTO `boutique_panier` (`id`, `id_utilisateur`, `id_article`, `quantite`, `prix`) VALUES
(71, 1, 17, 1, 75);

-- --------------------------------------------------------

--
-- Structure de la table `boutique_subcategories`
--

DROP TABLE IF EXISTS `boutique_subcategories`;
CREATE TABLE IF NOT EXISTS `boutique_subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `boutique_subcategories`
--

INSERT INTO `boutique_subcategories` (`id`, `id_categorie`, `nom`) VALUES
(1, 1, 'Machines &agrave dosettes'),
(2, 1, 'Machines &agrave capsules'),
(3, 1, 'Machines &agrave grains'),
(4, 2, 'Dosettes'),
(5, 2, 'Capsules expresso'),
(6, 2, 'Caf&eacutes moulu'),
(7, 3, 'Th&eacutes vert'),
(8, 3, 'Th&eacutes noir'),
(9, 3, 'Th&eacutes bio');

-- --------------------------------------------------------

--
-- Structure de la table `boutique_utilisateurs`
--

DROP TABLE IF EXISTS `boutique_utilisateurs`;
CREATE TABLE IF NOT EXISTS `boutique_utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `tel` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `boutique_utilisateurs` (`id`, `login`, `password`, `mail`, `adresse`, `rank`, `tel`) VALUES
(3, 'nico', '$2y$12$S1nhZqdNgcY/PnmI5.T2weOcW87PHhGoKdMsJbZ3sNYuqLtM38cG6', 'nico@gmail.com', 'nico', 1, '0606060606'),
(1, 'admin', '$2y$12$I/Z9eb.n4xa8pi3uESRDlezW9mAbmHT8btBwK6HpYegYSyW2/ZOFa', 'admin@gmail.com', 'admin', 1, '0606060606'),
(4, 'test', '$2y$12$Si5yJGP0TF2xpTOHalxNN.haTZksOxI.6BDoWVSY5NwOma4eoZ5ru', 'test@gmail.com', 'test', 0, '0606060606');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
