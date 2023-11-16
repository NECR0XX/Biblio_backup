<?php
require_once '../Config/config.php';
require_once 'App/Controller/LivroController.php';

$livroController = new LivroController($pdo);

$livros = $livroController->listarLivros();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="Public/Js/script.js"></script>
    <script src="Public/Js/emprestimo.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Sisteminha para o quando o icone de usuario for clicado aparecer algumas coisas -->
    <div class="user-icon" id="user-icon" onclick="showUserInfo()">
        <ion-icon name="person-circle-outline"></ion-icon> <!-- Se quiser trocar o icone tira isso aqui -->
    </div>
    <div class="user-info" id="user-info">

    <!-- Verificando o usuário para mostrar o "Olá (Nome do Usuario)" --> 
    <?php
        session_start();
        include '../Login/verifica_login.php'
    ?>
    <h2>Olá <?php echo $_SESSION['usuarioNomedeUsuario'] , "!"; ?> </h2><br>
    <button onclick="logout()"><h6>Sair</h6></button></div>

    <a href="index.php">Voltar</a>
    <h2>Lista de Livros</h2>
    <ul>
        <?php foreach ($livros as $livro): ?>
            <li>
                <?php echo $livro['nome']; ?> -
                <?php echo $livro['categoria']; ?> -
                <?php echo $livro['quantidade']; ?> -
                <form method="post" action="App/Controller/emprestar.php">
                    <input type="hidden" name="livro_id" value="<?php echo $livro['livro_id']; ?>">
                    <input type="hidden" name="nome" value="<?php echo $livro['nome']; ?>">
                    <button type="submit" name="emprestar">Emprestar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Sistema para fazer aparecer o ID do livro, Nome do livro e Nome do usuario que emprestou o livro -->
    <h2>Livros Emprestados</h2>
    <ul>
        <?php if (isset($_SESSION['emprestimo'])): ?>
            <?php foreach ($_SESSION['emprestimo'] as $emprestimo): ?>
                <li>
                    <?php if (isset($emprestimo['livro_id'])): ?>
                        ID do Livro: <?php echo $emprestimo['livro_id']; ?> - <br>
                    <?php endif; ?>

                    <?php if (isset($emprestimo['livro_nome'])): ?>
                        Livro: <?php echo $emprestimo['livro_nome']; ?> -
                    <?php endif; ?>

                    <?php if (isset($emprestimo['usuario_nome'])): ?>
                        Nome do Usuário: <?php echo $emprestimo['usuario_nome']; ?> -
                        <form method="post" action="App/Controller/devolver.php">
                            <input type="hidden" name="livro_id" value="<?php echo $emprestimo['livro_id']; ?>">
                            <button type="submit" name="devolver">Devolver</button>
                        </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Nenhum livro emprestado.</li>
        <?php endif; ?>
    </ul>

</body>
</html>