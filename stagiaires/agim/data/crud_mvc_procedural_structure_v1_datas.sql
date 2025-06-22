-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : dim. 01 juin 2025 à 17:12
-- Version du serveur : 11.5.2-MariaDB
-- Version de PHP : 8.3.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `crud_mvc_procedural`
--
DROP DATABASE IF EXISTS `crud_mvc_procedural`;
CREATE DATABASE IF NOT EXISTS `crud_mvc_procedural` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `crud_mvc_procedural`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idarticle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(160) NOT NULL COMMENT 'titre',
  `slug` varchar(165) NOT NULL COMMENT 'titre transformé en slug unique',
  `articletext` text NOT NULL COMMENT 'article',
  `articledatecreated` datetime DEFAULT current_timestamp() COMMENT 'date de création de la première version de l''article',
  `articlepublished` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 -> en attente\n1 -> publié\n2 -> désactivé',
  `articledatepublished` datetime DEFAULT NULL COMMENT 'date de publication',
  `user_iduser` int(10) UNSIGNED NOT NULL COMMENT 'clef étrangère, un article ne peut avoir qu''un auteur',
  PRIMARY KEY (`idarticle`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `fk_article_user_idx` (`user_iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idarticle`, `title`, `slug`, `articletext`, `articledatecreated`, `articlepublished`, `articledatepublished`, `user_iduser`) VALUES
(1, 'Être développeur à l\'ère de l\'IA qui raisonne', 'Etre-developpeur-a-l-ere-de-l-IA-qui-raisonne-par-Mani-Doraisamy', 'Être développeur à l\'ère de l\'IA qui raisonne, par Mani Doraisamy\r\n\r\nLe lancement de o3 d\'OpenAI m\'a fait remettre en question mon identité de développeur. Il y a neuf mois, j\'avais prédit que l\'IA ajouterait bientôt un comportement déterministe à ses fondements probabilistes. Pourtant, j\'ai été choqué de voir que cela se produisait la même année. Ce modèle n\'est plus seulement un générateur de mots cohérents ; il surpasse 99,8 % des développeurs en matière de codage compétitif. Bien qu\'OpenAI reste discret sur sa mise en œuvre, il semble qu\'elle soit parvenue à ce résultat grâce à la synthèse de programmes, c\'est-à-dire la capacité de générer des algorithmes à la volée, tout comme les développeurs écrivent du code pour résoudre des problèmes. Dans cet article, j\'explique à quel point la pensée d\'o3 est similaire à la façon dont nous pensons en tant que développeurs et j\'explore notre pertinence dans cette nouvelle ère de l\'IA.\r\n\r\nComment les utilisateurs créent de la logique\r\n\r\nLes utilisateurs pensent avec des données. Imaginez que vous êtes caissier dans une épicerie. Vous apprenez à calculer le montant en regardant le propriétaire le faire pour quelques clients. Sur cette base, lorsqu\'un client achète 10 carottes, vous déterminez que le prix est de 2 $, vous multipliez 2 $×10 et vous lui dites qu\'il doit payer 20 $. C\'est la raison pour laquelle les utilisateurs ont recours aux feuilles de calcul pour les tâches répétitives. Ils disposent d\'un moyen intuitif de travailler avec des données tout en écrivant des formules qui peuvent être appliquées à des lignes consécutives et dont les résultats sont immédiatement visibles :\r\n\r\n\r\n\r\nLes développeurs, quant à eux, pensent en termes d\'algèbre (c\'est-à-dire de métadonnées). Ils déclarent des variables, telles que le prix et la quantité, les multiplient et affectent le résultat à une autre variable, le montant. Ils ont la possibilité d\'exprimer cette logique dans un IDE sans voir aucune donnée. Ce n\'est qu\'au moment de l\'exécution qu\'ils peuvent appliquer les données et vérifier si leur logique fonctionne correctement. Cette capacité à abstraire la logique est ce qui distingue les développeurs des utilisateurs. C\'est ce qui leur permet de créer des logiciels de facturation qui calculent des millions de fois le montant des commandes pour des milliers de clients.\r\n\r\nComment l\'apprentissage automatique crée de la logique\r\n\r\nL\'apprentissage automatique fonctionne comme les utilisateurs. Sur la base des exemples, il trouve le modèle à l\'aide de la régression linéaire. Sur la base de ce modèle, il apprend que Montant = Prix × Quantité. C\'est comme si un élève apprenait par cœur les tables de multiplication sans comprendre pourquoi la multiplication fonctionne.\r\n\r\n\r\n\r\nUne fois qu\'il a appris ce modèle, il applique cette logique à de nouvelles entrées, tout comme une formule de tableur qui est appliquée à des lignes consécutives.\r\n\r\nComment o3 crée de la logique à la volée\r\n\r\nAvec o3, l\'IA ne pense plus comme un utilisateur. Elle pense comme un développeur. Tout comme le cerveau d\'un développeur peut réfléchir à un problème et trouver une solution à l\'aide d\'un code, o3 génère un programme (c\'est-à-dire des métadonnées) à la volée pour résoudre le problème. Une fois le programme créé, il est exécuté comme un code écrit par le développeur, produisant des résultats cohérents pour les mêmes entrées. La première partie est appelée synthèse du programme et la seconde partie est appelée exécution du programme.\r\n\r\n\r\n\r\nLa synthèse du programme revient à entendre un problème et à créer une feuille de calcul entièrement nouvelle et un tas de formules pour résoudre ce problème. Il n\'est plus nécessaire de disposer de données pour trouver des formules. Il peut créer un nouvel algorithme qui n\'existait pas auparavant et vérifier l\'exactitude de la solution pendant l\'exécution du programme, tout comme les développeurs testent et valident leur code au moment de l\'exécution.\r\n\r\nApproche pratique et approche autonome\r\n\r\n\r\n\r\nL\'arrivée de modèles de raisonnement tels que o3 modifie la manière dont les développeurs écriront le code. La plupart d\'entre nous s\'appuieront sur du code généré par l\'IA. Cependant, la question est de savoir si nous allons réviser ce code et en assumer la responsabilité. Il en résultera deux approches distinctes de la création de logiciels :\r\n\r\nApproche pratique\r\n\r\nLes développeurs utiliseront des outils tels que GitHub Copilot, alimenté par o3, pour générer du code. Cependant, ils examineront, affineront et s\'approprieront activement les résultats générés par l\'IA. Nous voyons déjà des exemples de cette approche avec des applications nouvelles, mais o3 est prêt à en faire la norme pour tous les types de développement de logiciels.\r\nApproche pratique\r\n\r\nLes utilisateurs se serviront d\'outils tels que ChatGPT, qui s\'appuient sur o3, pour résoudre leurs problèmes commerciaux. Leur demande initiale articulera les exigences de l\'entreprise dans un langage simple. Après avoir affiné les exigences, les utilisateurs interagiront avec l\'interface de chat pour les opérations suivantes. Ici, la synthèse du programme a lieu lors de l\'invite initiale, tandis que l\'exécution du programme se déroule au cours des conversations. Cette approche peut être étendue aux applications du GPT Store et à d\'autres applications à l\'aide d\'API.\r\n\r\n\r\nRésumé\r\n\r\nAvec le lancement de o3, il est clair que les utilisateurs pourront bientôt générer du code fonctionnel sans effort. Plus concrètement, les bibliothèques bien définies que nous utilisons dans les applications, telles que les paquets npm et les projets open-source, seront probablement générées par l\'IA d\'ici quelques années. Bien que certains développeurs puissent réviser et publier ce code, nous devrions supposer que, dans de nombreux cas, seule l\'IA comprendra réellement le fonctionnement de ces bibliothèques. Cela signifie-t-il que nous pouvons faire confiance à l\'IA comme nous avons fait confiance à des contributeurs inconnus de logiciels libres dans le passé ? Si l\'on étend cette analogie à la recherche sur le cancer, si l\'IA propose une solution que les chercheurs ne peuvent pas comprendre, devons-nous l\'utiliser pour sauver des vies ou l\'éviter parce que les humains ne la comprennent pas encore ? Ces questions idéologiques façonneront l\'avenir. Pour ma part, je souhaite que l\'approche pratique soit couronnée de succès. Les développeurs doivent comprendre et assumer la responsabilité de la logique générée par l\'IA s\'ils veulent la lancer en tant qu\'application pour d\'autres. Si nous renonçons à notre compréhension, le raisonnement de l\'IA mettra fin au raisonnement des humains. Notre capacité à comprendre le code généré par l\'IA décidera si nous sommes les marionnettistes ou les marionnettes de l\'IA.\r\n', '2025-06-01 17:11:49', 1, '2025-06-01 20:24:33', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `iduser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(60) NOT NULL COMMENT 'pour se connecter',
  `username` varchar(120) NOT NULL COMMENT 'nom d''affichage',
  `userpwd` varchar(300) NOT NULL COMMENT 'mot de passe hashé avec password_hash',
  `usermail` varchar(150) NOT NULL COMMENT 'email pour confirmer l''inscription, envoyer des info etc...',
  `uniqid` varchar(255) NOT NULL COMMENT 'Identifiant unique créé avec uniqid(''mvc'', true); pour les liens dans les mails',
  `active` tinyint(3) UNSIGNED DEFAULT 1 COMMENT '0 -> inactif\n1 -> actif\n2 -> banni\n3 -> en attente de validation du mail',
  `dateinscription` datetime DEFAULT current_timestamp() COMMENT 'datetime d''inscription',
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `usermail_UNIQUE` (`usermail`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `login`, `username`, `userpwd`, `usermail`, `uniqid`, `active`, `dateinscription`) VALUES
(1, 'firstUser', 'Stef Jansens', '$2y$10$Xhub8VflASU.HCmRkhq8E.X6HS6I/.DADAoYj6Ut7AoGY3Kc7OjPm', 's.jansens@gmail.com', 'mvc683c6765f34168.54713920', 1, '2025-06-01 16:51:19'),
(3, 'secondUser', 'Medhi Ben Halima', '$2y$10$EX3aMVp7.yKJBaz3Ap6qROwYgHFEXKyTmVUzmbmKmm9RkWeMIEn6C', 'md.halima@gmail.com', 'mvc683c69784afef0.29382054', 1, '2025-06-01 16:54:26'),
(4, 'thirdUser', 'Sylvia Serenna', '$2y$10$n/F5CFYDOhDdreEI/oFL4OnoptbBtGVyAIwUFyF1qFNA.5myrSrK.', 'serenna.sy@gmail.com', 'mvc683c69f51e0663.60425661', 1, '2025-06-01 16:58:16');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_user` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
