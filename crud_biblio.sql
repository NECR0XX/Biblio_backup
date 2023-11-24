-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Nov-2023 às 13:42
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
-- Banco de dados: `crud_biblio`
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
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL
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
(19, 'Moby Dick', 'Ficção', 4, '../uploads/moby dick.jpg', 3),
(20, '7 Desafios Para Ser Rei', 'Fantasia', 2, '../uploads/7 desafios.png', 4),
(22, 'A 5 Passos de você', 'Romance', 3, '../uploads/a5passos.jpg', 1),
(23, 'Como eu era antes de você', 'Romance', 1, '../uploads/como eu era.webp', 1),
(24, 'Confissões de uma garota excluída, mal-amada e (um pouco) dramática ', 'Romance', 2, '../uploads/14-confissoes.jpg', 1),
(25, 'O feiticeiro de terramar', 'Fantasia', 4, '../uploads/feiticeiro.webp', 4),
(26, 'Conjurador: O aprendiz', 'Fantasia', 3, '../uploads/conjurador.jpg', 4),
(27, 'Prince of thorns', 'Fantasia', 4, '../uploads/prince.png', 4),
(28, 'O hobbit', 'Fantasia', 1, '../uploads/hobbit_amazon.jpg', 4),
(29, 'Jogador Nº1', 'Ficção', 5, '../uploads/jogador-numero-1--foto-1.jpg', 3),
(30, 'Neuromancer', 'Ficção', 1, '../uploads/neuromancer.jpg', 3),
(31, 'Dimensão Sci-fi', 'Ficção', 3, '../uploads/dimensão.jpg', 3),
(32, 'Contos intergalácticos ', 'Ficção', 4, '../uploads/contos intergalaticos.jpg', 3),
(33, 'O vilarejo', 'Terror', 2, '../uploads/vilarejo.jpg', 2),
(34, 'Bird box', 'Terror', 3, '../uploads/bIRD.webp', 2),
(35, 'O livro maldito', 'Terror', 2, '../uploads/livro.webp', 2),
(36, 'Amigo Imaginário ', 'Terror', 1, '../uploads/Amigo.jpg', 2),
(37, 'Cemitério Maldito', 'Terror', 2, '../uploads/cemiterio.jpg', 2),
(39, 'A culpa é das estrelas', 'Romance', 3, '../uploads/a culpa é das estrelas.jpg', 1);

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
(6, 'Bibliotecário ', 'biblio@gmail.com', 'qawsed', 1),
(7, 'Bibliotecária', 'biblio@gmail.com', '12345', 1),
(8, 'Administrador', 'biblio@gmail.com', 'qweasd', 1),
(9, 'Wesley', 'wesley@gmail.com', '12345', 2),
(10, 'Fabio', 'fabio@gmail.com', 'qawsed', 2);

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
  MODIFY `emprestimo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `livro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
