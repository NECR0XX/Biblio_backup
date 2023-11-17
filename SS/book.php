<?php
require_once '../Config/config.php';
require_once 'App/Controller/LivroController.php';
require_once 'App/Controller/EmprestimoController.php';

session_start();

$livroController = new LivroController($pdo);
$emprestimoController = new EmprestimoController($pdo);

$livros = $livroController->listarLivros();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emprestar'])) {
    $livroID = $_POST['livro_id'];
    $livroNome = $_POST['nome'];
    $usuarioNome = $_SESSION['usuarioNomedeUsuario'];

    $emprestimoController->emprestarLivro($livroID, $livroNome, $usuarioNome);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['devolver'])) {
    $livroID = $_POST['livro_id'];

    $emprestimoController->devolverLivro($livroID);
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <div class="user-icon" id="user-icon" onclick="showUserInfo()">
        <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div class="user-info" id="user-info">
        <?php include '../Login/verifica_login.php'; ?>
        <h2>Olá <?php echo $_SESSION['usuarioNomedeUsuario'], "!"; ?> </h2><br>
        <button onclick="logout()"><h6>Sair</h6></button>
    </div>

    <a href="index.php">Voltar</a>
    
    <h2>Lista de Livros</h2>
    <ul>
        <?php foreach ($livros as $livro): ?>
            <li>
                <?php echo $livro['nome']; ?> -
                <?php echo $livro['categoria']; ?> -
                <?php echo $livro['quantidade']; ?> -
                <form method="post" action="book.php">
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
        <?php $livrosEmprestados = $emprestimoController->listarLivrosEmprestados($_SESSION['usuarioNomedeUsuario']); ?>
        <?php foreach ($livrosEmprestados as $emprestimo): ?>
            <li>
                <?php echo "ID do Livro: " . $emprestimo['livro_emprestimo']; ?> <br>
                <?php echo "Livro: " . $emprestimo['nome_livro']; ?> <br>
                <?php echo "Nome do Usuário: " . $emprestimo['aluno_emprestimo']; ?>
                <form method="post" action="book.php">
                    <input type="hidden" name="livro_id" value="<?php echo $emprestimo['emprestimo_id']; ?>">
                    <button type="submit" name="devolver">Devolver</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>