-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Maio-2017 às 11:18
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores`
--

CREATE TABLE `autores` (
  `id` int(6) NOT NULL,
  `ultimo_nome` varchar(255) DEFAULT NULL,
  `primeiro_nome` varchar(45) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `nacionalidades_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `autores`
--

INSERT INTO `autores` (`id`, `ultimo_nome`, `primeiro_nome`, `data_nascimento`, `nacionalidades_id`) VALUES
(2, 'Salinger', 'J. D', NULL, 1),
(3, 'Orwell', 'George', '1903-06-25', 2),
(4, 'Doyle', 'Arthur Conan', '1959-05-22', 2),
(5, 'Martin', 'George R. R.', '1948-09-20', 1),
(6, 'Tolkien', 'J. R. R.', '1892-01-03', 3),
(7, 'Rowling', 'J. K.', '1965-07-31', 2),
(8, 'Lovecraft', 'H. P.', '1890-08-20', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores_has_livros`
--

CREATE TABLE `autores_has_livros` (
  `autores_id` int(6) NOT NULL,
  `livros_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `autores_has_livros`
--

INSERT INTO `autores_has_livros` (`autores_id`, `livros_id`) VALUES
(2, 2),
(3, 5),
(4, 6),
(4, 10),
(4, 11),
(5, 7),
(5, 8),
(5, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `edicoes`
--

CREATE TABLE `edicoes` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `numero_edicao` tinyint(2) DEFAULT NULL,
  `livros_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `editoras`
--

CREATE TABLE `editoras` (
  `id` int(6) NOT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `nif` varchar(200) DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editoras`
--

INSERT INTO `editoras` (`id`, `nome`, `nif`, `morada`) VALUES
(1, '	Little, Brown and Company', NULL, '	United States'),
(2, '	Secker & Warburg', NULL, 'United Kingdom'),
(3, 'Ward Lock & Co', NULL, '	United Kingdom');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `subtitulo` varchar(255) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `descricao` mediumtext,
  `comentarios` mediumtext,
  `editoras_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `isbn`, `titulo`, `subtitulo`, `data_publicacao`, `descricao`, `comentarios`, `editoras_id`) VALUES
(2, '	978972564974', 'The Catcher in the Rye', 'À Espera no Centeio ou Uma Agulha num Palheiro', '1951-07-15', ' A controversial novel originally published for adults, it has since become popular with adolescent readers for its themes of teenage angst and alienation.[4][5] It has been translated into almost all of the world\'s major languages.', NULL, 1),
(5, '978-0-14-1187', 'Nineteen Eighty-Four', '1984', '1949-06-08', NULL, NULL, 2),
(6, '	978972102268', 'A Study in Scarlet', 'Um Estudo em Vermelho', '1888-06-12', NULL, NULL, 3),
(7, '9788562936524', 'A Game of Thrones', NULL, '2010-09-01', NULL, NULL, 3),
(8, '9788580440270', 'A Clash of Kings', NULL, '1998-11-16', NULL, NULL, 3),
(9, '9788580442625', 'A Storm of Swords', NULL, '2000-08-08', NULL, NULL, 1),
(10, '9788179910665', 'The Hound of the Baskervilles', NULL, '1902-01-01', NULL, NULL, 1),
(11, '1234567891123', 'The Sign of the Four', NULL, '0001-01-01', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro_has_localidade`
--

CREATE TABLE `livro_has_localidade` (
  `livro_ISBN` varchar(100) NOT NULL,
  `localidade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `localidade`
--

CREATE TABLE `localidade` (
  `id` int(11) NOT NULL,
  `nomel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nacionalidades`
--

CREATE TABLE `nacionalidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `cctld` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `nacionalidades`
--

INSERT INTO `nacionalidades` (`id`, `nome`, `cctld`) VALUES
(1, 'Americano', NULL),
(2, 'Britanico', NULL),
(3, 'África do Sul', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`,`nacionalidades_id`),
  ADD KEY `fk_autores_nacionalidades1_idx` (`nacionalidades_id`);

--
-- Indexes for table `autores_has_livros`
--
ALTER TABLE `autores_has_livros`
  ADD PRIMARY KEY (`autores_id`,`livros_id`),
  ADD KEY `fk_autores_has_livros_livros1_idx` (`livros_id`),
  ADD KEY `fk_autores_has_livros_autores1_idx` (`autores_id`);

--
-- Indexes for table `edicoes`
--
ALTER TABLE `edicoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_edi_livros_id_idx` (`livros_id`);

--
-- Indexes for table `editoras`
--
ALTER TABLE `editoras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`,`editoras_id`),
  ADD UNIQUE KEY `isbn_UNIQUE` (`isbn`),
  ADD KEY `fk_livros_editoras1_idx` (`editoras_id`);

--
-- Indexes for table `livro_has_localidade`
--
ALTER TABLE `livro_has_localidade`
  ADD PRIMARY KEY (`livro_ISBN`,`localidade_id`),
  ADD KEY `fk_livro_has_localidade_localidade1_idx` (`localidade_id`);

--
-- Indexes for table `localidade`
--
ALTER TABLE `localidade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nacionalidades`
--
ALTER TABLE `nacionalidades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `edicoes`
--
ALTER TABLE `edicoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `editoras`
--
ALTER TABLE `editoras`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `localidade`
--
ALTER TABLE `localidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nacionalidades`
--
ALTER TABLE `nacionalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `autores`
--
ALTER TABLE `autores`
  ADD CONSTRAINT `fk_autores_nacionalidades1` FOREIGN KEY (`nacionalidades_id`) REFERENCES `nacionalidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `autores_has_livros`
--
ALTER TABLE `autores_has_livros`
  ADD CONSTRAINT `fk_autores_has_livros_autores1` FOREIGN KEY (`autores_id`) REFERENCES `autores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autores_has_livros_livros1` FOREIGN KEY (`livros_id`) REFERENCES `livros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `edicoes`
--
ALTER TABLE `edicoes`
  ADD CONSTRAINT `fk_edi_livros_id` FOREIGN KEY (`livros_id`) REFERENCES `livros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `fk_livros_editoras1` FOREIGN KEY (`editoras_id`) REFERENCES `editoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `livro_has_localidade`
--
ALTER TABLE `livro_has_localidade`
  ADD CONSTRAINT `fk_livro_has_localidade_localidade1` FOREIGN KEY (`localidade_id`) REFERENCES `localidade` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
