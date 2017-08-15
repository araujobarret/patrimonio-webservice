-- phpMyAdmin SQL Dump
-- version 4.6.6deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 07, 2017 at 11:03 AM
-- Server version: 5.6.30-1
-- PHP Version: 7.0.15-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `patrimonio`
--

-- --------------------------------------------------------

--
-- Table structure for table `bem`
--

CREATE TABLE `bem` (
  `cod` int(11) NOT NULL,
  `cod_tombamento` int(11) NOT NULL,
  `sigla_setor` varchar(20) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `estado` varchar(12) NOT NULL,
  `numero_serie` varchar(40) DEFAULT NULL,
  `valor_aquisicao` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bem_pertence_grupo`
--

CREATE TABLE `bem_pertence_grupo` (
  `cod_grupo_bem` varchar(20) NOT NULL,
  `cod_bem` int(11) NOT NULL,
  `meses_vida_util` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comissao`
--

CREATE TABLE `comissao` (
  `cod` int(11) NOT NULL,
  `portaria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comissao_usuario`
--

CREATE TABLE `comissao_usuario` (
  `login_usuario` varchar(50) NOT NULL,
  `cod_comissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entrada`
--

CREATE TABLE `entrada` (
  `cod` int(11) NOT NULL,
  `descricao` varchar(120) DEFAULT NULL,
  `login_usuario_patrimonio` varchar(40) NOT NULL,
  `data` datetime NOT NULL,
  `cod_processo` int(11) NOT NULL,
  `cod_pessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_aquisicao`
--

CREATE TABLE `entrada_aquisicao` (
  `cod_entrada` int(11) NOT NULL,
  `nota_fiscal` varchar(50) NOT NULL,
  `nota_empenho` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_comodato`
--

CREATE TABLE `entrada_comodato` (
  `cod_entrada` int(11) NOT NULL,
  `data_saida` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_doacao`
--

CREATE TABLE `entrada_doacao` (
  `cod_entrada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `entrada_incorporação`
--

CREATE TABLE `entrada_incorporação` (
  `cod_entrada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grupo_bem`
--

CREATE TABLE `grupo_bem` (
  `cod` varchar(20) NOT NULL,
  `descricao` varchar(40) NOT NULL,
  `meses_vida_util` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `modo_desfazimento`
--

CREATE TABLE `modo_desfazimento` (
  `cod` int(5) NOT NULL,
  `descricao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movimentacao`
--

CREATE TABLE `movimentacao` (
  `cod` int(11) NOT NULL,
  `data_solicitacao` datetime NOT NULL,
  `data_liberação` datetime DEFAULT NULL,
  `data_recebimento` datetime DEFAULT NULL,
  `status` char(1) NOT NULL,
  `login_usuario_setor_origem` varchar(40) NOT NULL,
  `login_usuario_setor_destino` varchar(40) NOT NULL,
  `login_usuario_patrimonio_liberacao` varchar(40) DEFAULT NULL,
  `setor_origem` varchar(20) NOT NULL,
  `setor_destino` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movimentacao_bem`
--

CREATE TABLE `movimentacao_bem` (
  `cod_movimentacao` int(11) NOT NULL,
  `cod_bem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa`
--

CREATE TABLE `pessoa` (
  `cod` int(11) NOT NULL,
  `endereco` varchar(60) DEFAULT NULL,
  `bairro` varchar(20) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `uf` char(2) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `telefone1` varchar(14) DEFAULT NULL,
  `telefone2` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_fisica`
--

CREATE TABLE `pessoa_fisica` (
  `cod_pessoa` int(11) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_juridica`
--

CREATE TABLE `pessoa_juridica` (
  `cod_pessoa` int(11) NOT NULL,
  `cnpj` varchar(15) NOT NULL,
  `razao_social` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `processo`
--

CREATE TABLE `processo` (
  `cod` int(11) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `assunto` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saida`
--

CREATE TABLE `saida` (
  `cod` int(11) NOT NULL,
  `descricao` varchar(120) DEFAULT NULL,
  `login_usuario_patrimonio` varchar(40) NOT NULL,
  `cod_processo` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saida_cessao`
--

CREATE TABLE `saida_cessao` (
  `cod_saida` int(11) NOT NULL,
  `data_entrada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saida_desfazimento`
--

CREATE TABLE `saida_desfazimento` (
  `cod_saida` int(11) NOT NULL,
  `cod_modo_desfazimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `saida_doacao`
--

CREATE TABLE `saida_doacao` (
  `cod_saida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `setor`
--

CREATE TABLE `setor` (
  `sigla` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setor`
--

INSERT INTO `setor` (`sigla`) VALUES
('SAHI'),
('SASG'),
('SINF');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `login` varchar(50) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_chefe_setor`
--

CREATE TABLE `usuario_chefe_setor` (
  `login_usuario` varchar(50) NOT NULL,
  `sigla_setor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_comum`
--

CREATE TABLE `usuario_comum` (
  `login_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usuario_patrimonio`
--

CREATE TABLE `usuario_patrimonio` (
  `login_usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bem`
--
ALTER TABLE `bem`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `sigla_setor` (`sigla_setor`);

--
-- Indexes for table `bem_pertence_grupo`
--
ALTER TABLE `bem_pertence_grupo`
  ADD PRIMARY KEY (`cod_grupo_bem`,`cod_bem`),
  ADD KEY `cod_bem` (`cod_bem`);

--
-- Indexes for table `comissao`
--
ALTER TABLE `comissao`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `comissao_usuario`
--
ALTER TABLE `comissao_usuario`
  ADD PRIMARY KEY (`login_usuario`,`cod_comissao`),
  ADD KEY `cod_comissao` (`cod_comissao`);

--
-- Indexes for table `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `cod_processo` (`cod_processo`),
  ADD KEY `cod_pessoa` (`cod_pessoa`),
  ADD KEY `login_usuario_patrimonio` (`login_usuario_patrimonio`);

--
-- Indexes for table `entrada_aquisicao`
--
ALTER TABLE `entrada_aquisicao`
  ADD PRIMARY KEY (`cod_entrada`);

--
-- Indexes for table `entrada_comodato`
--
ALTER TABLE `entrada_comodato`
  ADD PRIMARY KEY (`cod_entrada`);

--
-- Indexes for table `entrada_doacao`
--
ALTER TABLE `entrada_doacao`
  ADD PRIMARY KEY (`cod_entrada`);

--
-- Indexes for table `entrada_incorporação`
--
ALTER TABLE `entrada_incorporação`
  ADD PRIMARY KEY (`cod_entrada`);

--
-- Indexes for table `grupo_bem`
--
ALTER TABLE `grupo_bem`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `modo_desfazimento`
--
ALTER TABLE `modo_desfazimento`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `setor_origem` (`setor_origem`),
  ADD KEY `setor_destino` (`setor_destino`),
  ADD KEY `login_usuario_setor_origem` (`login_usuario_setor_origem`),
  ADD KEY `login_usuario_setor_destino` (`login_usuario_setor_destino`),
  ADD KEY `login_usuario_patrimonio_liberacao` (`login_usuario_patrimonio_liberacao`);

--
-- Indexes for table `movimentacao_bem`
--
ALTER TABLE `movimentacao_bem`
  ADD PRIMARY KEY (`cod_movimentacao`,`cod_bem`),
  ADD KEY `cod_bem` (`cod_bem`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `pessoa_fisica`
--
ALTER TABLE `pessoa_fisica`
  ADD PRIMARY KEY (`cod_pessoa`);

--
-- Indexes for table `pessoa_juridica`
--
ALTER TABLE `pessoa_juridica`
  ADD PRIMARY KEY (`cod_pessoa`);

--
-- Indexes for table `processo`
--
ALTER TABLE `processo`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `saida`
--
ALTER TABLE `saida`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `login_usuario_patrimonio` (`login_usuario_patrimonio`),
  ADD KEY `cod_processo` (`cod_processo`);

--
-- Indexes for table `saida_cessao`
--
ALTER TABLE `saida_cessao`
  ADD PRIMARY KEY (`cod_saida`);

--
-- Indexes for table `saida_desfazimento`
--
ALTER TABLE `saida_desfazimento`
  ADD PRIMARY KEY (`cod_saida`),
  ADD KEY `cod_modo_desfazimento` (`cod_modo_desfazimento`);

--
-- Indexes for table `saida_doacao`
--
ALTER TABLE `saida_doacao`
  ADD PRIMARY KEY (`cod_saida`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`sigla`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`);

--
-- Indexes for table `usuario_chefe_setor`
--
ALTER TABLE `usuario_chefe_setor`
  ADD PRIMARY KEY (`login_usuario`),
  ADD KEY `sigla_setor` (`sigla_setor`);

--
-- Indexes for table `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD PRIMARY KEY (`login_usuario`);

--
-- Indexes for table `usuario_patrimonio`
--
ALTER TABLE `usuario_patrimonio`
  ADD PRIMARY KEY (`login_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bem`
--
ALTER TABLE `bem`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comissao`
--
ALTER TABLE `comissao`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entrada`
--
ALTER TABLE `entrada`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `processo`
--
ALTER TABLE `processo`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `saida`
--
ALTER TABLE `saida`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bem`
--
ALTER TABLE `bem`
  ADD CONSTRAINT `bem_ibfk_1` FOREIGN KEY (`sigla_setor`) REFERENCES `setor` (`sigla`);

--
-- Constraints for table `bem_pertence_grupo`
--
ALTER TABLE `bem_pertence_grupo`
  ADD CONSTRAINT `bem_pertence_grupo_ibfk_1` FOREIGN KEY (`cod_grupo_bem`) REFERENCES `grupo_bem` (`cod`),
  ADD CONSTRAINT `bem_pertence_grupo_ibfk_2` FOREIGN KEY (`cod_bem`) REFERENCES `bem` (`cod`);

--
-- Constraints for table `comissao_usuario`
--
ALTER TABLE `comissao_usuario`
  ADD CONSTRAINT `comissao_usuario_ibfk_1` FOREIGN KEY (`login_usuario`) REFERENCES `usuario` (`login`),
  ADD CONSTRAINT `comissao_usuario_ibfk_2` FOREIGN KEY (`cod_comissao`) REFERENCES `comissao` (`cod`);

--
-- Constraints for table `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_1` FOREIGN KEY (`cod_processo`) REFERENCES `processo` (`cod`),
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`cod_pessoa`) REFERENCES `pessoa` (`cod`),
  ADD CONSTRAINT `entrada_ibfk_3` FOREIGN KEY (`login_usuario_patrimonio`) REFERENCES `usuario_patrimonio` (`login_usuario`);

--
-- Constraints for table `entrada_aquisicao`
--
ALTER TABLE `entrada_aquisicao`
  ADD CONSTRAINT `entrada_aquisicao_ibfk_1` FOREIGN KEY (`cod_entrada`) REFERENCES `entrada` (`cod`);

--
-- Constraints for table `entrada_comodato`
--
ALTER TABLE `entrada_comodato`
  ADD CONSTRAINT `entrada_comodato_ibfk_1` FOREIGN KEY (`cod_entrada`) REFERENCES `entrada` (`cod`);

--
-- Constraints for table `entrada_doacao`
--
ALTER TABLE `entrada_doacao`
  ADD CONSTRAINT `entrada_doacao_ibfk_1` FOREIGN KEY (`cod_entrada`) REFERENCES `entrada` (`cod`);

--
-- Constraints for table `entrada_incorporação`
--
ALTER TABLE `entrada_incorporação`
  ADD CONSTRAINT `entrada_incorporação_ibfk_1` FOREIGN KEY (`cod_entrada`) REFERENCES `entrada` (`cod`);

--
-- Constraints for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`setor_origem`) REFERENCES `setor` (`sigla`),
  ADD CONSTRAINT `movimentacao_ibfk_2` FOREIGN KEY (`setor_destino`) REFERENCES `setor` (`sigla`),
  ADD CONSTRAINT `movimentacao_ibfk_3` FOREIGN KEY (`login_usuario_setor_origem`) REFERENCES `usuario_chefe_setor` (`login_usuario`),
  ADD CONSTRAINT `movimentacao_ibfk_4` FOREIGN KEY (`login_usuario_setor_destino`) REFERENCES `usuario_chefe_setor` (`login_usuario`),
  ADD CONSTRAINT `movimentacao_ibfk_5` FOREIGN KEY (`login_usuario_patrimonio_liberacao`) REFERENCES `usuario_patrimonio` (`login_usuario`);

--
-- Constraints for table `movimentacao_bem`
--
ALTER TABLE `movimentacao_bem`
  ADD CONSTRAINT `movimentacao_bem_ibfk_1` FOREIGN KEY (`cod_movimentacao`) REFERENCES `movimentacao` (`cod`),
  ADD CONSTRAINT `movimentacao_bem_ibfk_2` FOREIGN KEY (`cod_bem`) REFERENCES `bem` (`cod`);

--
-- Constraints for table `pessoa_fisica`
--
ALTER TABLE `pessoa_fisica`
  ADD CONSTRAINT `pessoa_fisica_ibfk_1` FOREIGN KEY (`cod_pessoa`) REFERENCES `pessoa` (`cod`);

--
-- Constraints for table `pessoa_juridica`
--
ALTER TABLE `pessoa_juridica`
  ADD CONSTRAINT `pessoa_juridica_ibfk_1` FOREIGN KEY (`cod_pessoa`) REFERENCES `pessoa` (`cod`);

--
-- Constraints for table `saida`
--
ALTER TABLE `saida`
  ADD CONSTRAINT `saida_ibfk_1` FOREIGN KEY (`login_usuario_patrimonio`) REFERENCES `usuario_patrimonio` (`login_usuario`),
  ADD CONSTRAINT `saida_ibfk_2` FOREIGN KEY (`cod_processo`) REFERENCES `processo` (`cod`);

--
-- Constraints for table `saida_cessao`
--
ALTER TABLE `saida_cessao`
  ADD CONSTRAINT `saida_cessao_ibfk_1` FOREIGN KEY (`cod_saida`) REFERENCES `saida` (`cod`);

--
-- Constraints for table `saida_desfazimento`
--
ALTER TABLE `saida_desfazimento`
  ADD CONSTRAINT `saida_desfazimento_ibfk_1` FOREIGN KEY (`cod_saida`) REFERENCES `saida` (`cod`),
  ADD CONSTRAINT `saida_desfazimento_ibfk_2` FOREIGN KEY (`cod_modo_desfazimento`) REFERENCES `modo_desfazimento` (`cod`);

--
-- Constraints for table `saida_doacao`
--
ALTER TABLE `saida_doacao`
  ADD CONSTRAINT `saida_doacao_ibfk_1` FOREIGN KEY (`cod_saida`) REFERENCES `saida` (`cod`);

--
-- Constraints for table `usuario_chefe_setor`
--
ALTER TABLE `usuario_chefe_setor`
  ADD CONSTRAINT `usuario_chefe_setor_ibfk_1` FOREIGN KEY (`login_usuario`) REFERENCES `usuario` (`login`),
  ADD CONSTRAINT `usuario_chefe_setor_ibfk_2` FOREIGN KEY (`sigla_setor`) REFERENCES `setor` (`sigla`);

--
-- Constraints for table `usuario_comum`
--
ALTER TABLE `usuario_comum`
  ADD CONSTRAINT `usuario_comum_ibfk_1` FOREIGN KEY (`login_usuario`) REFERENCES `usuario` (`login`);

--
-- Constraints for table `usuario_patrimonio`
--
ALTER TABLE `usuario_patrimonio`
  ADD CONSTRAINT `usuario_patrimonio_ibfk_1` FOREIGN KEY (`login_usuario`) REFERENCES `usuario` (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
