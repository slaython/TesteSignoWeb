-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Jul-2022 às 03:56
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `testesignoweb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `swenquetes`
--

CREATE TABLE `swenquetes` (
  `ID` int(11) NOT NULL,
  `TITULO` varchar(255) NOT NULL,
  `DATAINICIO` date NOT NULL,
  `DATAFIM` date NOT NULL,
  `DESCRICAO` varchar(255) NOT NULL,
  `CRIADOEM` timestamp NOT NULL DEFAULT current_timestamp(),
  `MODIFICADOEM` timestamp NULL DEFAULT current_timestamp(),
  `STATUS` int(11) NOT NULL,
  `ICONE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `swenquetes`
--

INSERT INTO `swenquetes` (`ID`, `TITULO`, `DATAINICIO`, `DATAFIM`, `DESCRICAO`, `CRIADOEM`, `MODIFICADOEM`, `STATUS`, `ICONE`) VALUES
(13, 'Teste de titulo', '2022-07-24', '2022-08-24', 'teste de descrição', '2022-07-24 21:09:39', NULL, 1, '<em class=\"icon ni ni-cc-alt2-fill\"></em>'),
(14, 'Teste de enquete 2', '2022-07-24', '2022-08-10', 'Teste de descrição 2', '2022-07-24 21:10:30', NULL, 1, '<em class=\"icon ni ni-cc-alt2-fill\"></em>'),
(15, 'Teste de Descrição Slaython', '2022-07-24', '2022-12-31', 'Teste de descrição criada por slaython', '2022-07-24 21:14:34', NULL, 1, '<em class=\"icon ni ni-cc-alt2-fill\"></em>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `swmenu`
--

CREATE TABLE `swmenu` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(255) NOT NULL,
  `ICONE` varchar(255) NOT NULL,
  `CAMINHO` varchar(255) NOT NULL,
  `CRIADOEM` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `swmenu`
--

INSERT INTO `swmenu` (`ID`, `NOME`, `ICONE`, `CAMINHO`, `CRIADOEM`) VALUES
(2, 'Gerenciar Enquetes', '<em class=\"icon ni ni-setting-fill\"></em>', 'gerenciar-enquetes', '2022-07-19 00:51:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `swrespostasenquetes`
--

CREATE TABLE `swrespostasenquetes` (
  `IDRESPOSTA` int(11) NOT NULL,
  `IDENQUETE` int(11) NOT NULL,
  `RESPOSTA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `swrespostasenquetes`
--

INSERT INTO `swrespostasenquetes` (`IDRESPOSTA`, `IDENQUETE`, `RESPOSTA`) VALUES
(19, 13, 'Resposta 1'),
(20, 13, 'Resposta 2'),
(21, 13, 'Resposta 3'),
(22, 13, 'Resposta 4'),
(23, 13, NULL),
(24, 14, 'Resposta 1'),
(25, 14, 'Resposta 2'),
(26, 14, 'Resposta 3'),
(27, 14, NULL),
(28, 14, NULL),
(29, 15, 'teste de resposta'),
(30, 15, 'teste de resposta 2'),
(31, 15, 'teste de resposta 3'),
(32, 15, 'teste de resposta 4'),
(33, 15, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `swusuarios`
--

CREATE TABLE `swusuarios` (
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `swvotos`
--

CREATE TABLE `swvotos` (
  `IDVOTO` int(11) NOT NULL,
  `IDRESPOSTA` int(11) NOT NULL,
  `IDENQUETE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `swvotos`
--

INSERT INTO `swvotos` (`IDVOTO`, `IDRESPOSTA`, `IDENQUETE`) VALUES
(16, 19, 13),
(17, 20, 13),
(18, 21, 13),
(19, 22, 13),
(20, 25, 14),
(21, 30, 15),
(22, 32, 15);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `swenquetes`
--
ALTER TABLE `swenquetes`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `swmenu`
--
ALTER TABLE `swmenu`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `swrespostasenquetes`
--
ALTER TABLE `swrespostasenquetes`
  ADD PRIMARY KEY (`IDRESPOSTA`);

--
-- Índices para tabela `swusuarios`
--
ALTER TABLE `swusuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `swvotos`
--
ALTER TABLE `swvotos`
  ADD PRIMARY KEY (`IDVOTO`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `swenquetes`
--
ALTER TABLE `swenquetes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `swmenu`
--
ALTER TABLE `swmenu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `swrespostasenquetes`
--
ALTER TABLE `swrespostasenquetes`
  MODIFY `IDRESPOSTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `swusuarios`
--
ALTER TABLE `swusuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `swvotos`
--
ALTER TABLE `swvotos`
  MODIFY `IDVOTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
