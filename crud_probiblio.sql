-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Dez-2023 às 17:16
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud_probiblio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_livros`
--

CREATE TABLE `categoria_livros` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categoria_livros`
--

INSERT INTO `categoria_livros` (`id`, `nome`) VALUES
(1, 'Romance'),
(2, 'Terror'),
(3, 'Ficção'),
(4, 'Fantasia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `emprestimo_id` int(11) NOT NULL,
  `livro_emprestimo` varchar(255) NOT NULL,
  `nome_livro` varchar(255) NOT NULL,
  `aluno_emprestimo` varchar(255) NOT NULL,
  `data_emprestimo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`emprestimo_id`, `livro_emprestimo`, `nome_livro`, `aluno_emprestimo`, `data_emprestimo`) VALUES
(48, '44', 'Bird box', 'Mel', '2023-12-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id_hstorico` int(11) NOT NULL,
  `emprestimo_id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL,
  `nome_livro` varchar(255) NOT NULL,
  `nome_aluno` varchar(255) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `livro_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`livro_id`, `nome`, `categoria`, `quantidade`, `imagem`, `categoria_id`) VALUES
(43, 'Como eu era antes de você', 'Romance', 3, '../uploads/como eu era.webp', 1),
(44, 'Bird box', 'Terror', 2, '../uploads/bIRD.webp', 2),
(45, 'Neuromancer', 'Ficção', 3, '../uploads/neuromancer.jpg', 3),
(46, 'O hobbit', 'Fantasia', 3, '../uploads/hobbit_amazon.jpg', 4),
(47, 'Vermelho branco sangue azul', 'Romance', 3, '../uploads/vermelho-branco.webp', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`, `tipo_usuario`) VALUES
(6, 'Bibliotecário', 'biblio@gmail.com', '12345', 1),
(7, 'Bibliotecária', 'biblio@gmail.com', '12345', 1),
(8, 'Administrador', 'biblio@gmail.com', '12345', 1),
(25, 'Mel', 'mel@gmail.com', '12345', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria_livros`
--
ALTER TABLE `categoria_livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`emprestimo_id`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_hstorico`),
  ADD KEY `historico_id_FK` (`emprestimo_id`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`livro_id`),
  ADD KEY `livro_categoria_id_FK` (`categoria_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria_livros`
--
ALTER TABLE `categoria_livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `emprestimo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id_hstorico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `livro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `livro_categoria_id_FK` FOREIGN KEY (`categoria_id`) REFERENCES `categoria_livros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
