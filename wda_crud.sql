-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql313.infinityfree.com
-- Tempo de geração: 11/04/2025 às 07:34
-- Versão do servidor: 10.6.19-MariaDB
-- Versão do PHP: 7.2.22

create database wda_crud;
use wda_crud;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `wda_crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(15) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(1, 'Fulano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet1', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2024-11-21 17:52:53'),
(2, 'Ciclano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
(4, 'testudo', '12345678930', '2024-11-12 00:00:00', 'abc paulista', 'paulistano', '12345678', 'São Bernardo', 'sp', '15999999999', '33333333', '1234567', '2024-11-21 18:50:25', '2024-11-21 18:50:25'),
(7, 'Maria Luiza Gallonetti Vieira de C111', '32143214321', '2010-03-05 00:00:00', 'skjhdhbshbd111', 'gsdjhgdjhaksg111', '12312321', 'Itu', 'SP', '1543112599', '15966447733', '213213213', '2025-03-26 14:10:44', '2025-03-26 14:11:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `descr` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `name`, `address`, `hood`, `city`, `state`, `created`, `modified`, `descr`, `photo`) VALUES
(1, 'Rogério Balas', 'Rua MMDC, 123', 'Vila Barão', 'Sorocaba', 'SP', '2016-05-24 00:00:00', '2024-11-28 19:09:55', 'Casa sobrado com vista para o pôr do Sol, com mercado próximo.', 'imagem_2024-11-28_190952031.png'),
(8, 'Gustavo', 'Ronaldo K. Piccini, 290', 'Alphaville', 'Votorantim', 'SP', '2024-11-28 18:57:15', '2024-11-28 19:02:44', 'Casa luxuosa em condomínio de alto padrão, localizado na zona sul.', 'imagem_2024-11-28_190243802.png'),
(13, 'Zezinho Zica', 'Rua da quebrada', 'lalalala', 'Sorocaba', 'SP', '2025-03-26 14:14:41', '2025-03-26 14:14:41', 'Uma casinha', 'casinha.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `password`, `foto`) VALUES
(2, 'Mary Zica', 'mazi', '786098767869', NULL),
(3, 'Fugiru Nakombi', 'fugina', '623485634753234', NULL),
(20, 'lopes', 'kaka', '$2y$10$H7zZaG01uK5hXX1ReYrkT.Q0NQlvMHIFoO.XKNyCO3/AqMs7HSVFK', 'IMG-20150104-WA0001.jpg'),
(24, 'lopes', 'admin', '$2y$10$Qtc2El9Cl5ckzBSPmCN1fOozGglFLNWzsE/9A032Z5bVCSH2gCthS', 'imagem_2024-11-21_183320103.png'),
(25, 'dog(teste)', 'gustagol', '$2y$10$EQlSyE8AjDSBigjS1oHlZOgiyE2kGNhlIr83FmfQWWudu.5XC8Lp2', 'dogmau.jpg'),
(26, 'AKBIDKH', 'slk', '$2y$10$Y7ToNa4RkXj3biTiXwVGOuf1uHJHtGMZcqM0JLofrTdxyoVPgggpO', 'imagem_2025-03-15_180612110.png');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
