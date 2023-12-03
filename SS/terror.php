<?php
require_once '../config/config.php';
require_once 'App/Controller/LivroController.php';
require_once 'App/Controller/EmprestimoController.php';

session_start();

$livroController = new LivroController($pdo);
$emprestimoController = new EmprestimoController($pdo);

$livros = $livroController->listarLivrosPorCategoria(2);
$categorias = [];

foreach ($livros as $livro) {
    $categoria = $livro['categoria'];
    if (!isset($categorias[$categoria])) {
        $categorias[$categoria] = [];
    }
    $categorias[$categoria][] = $livro;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emprestar'])) {
    $livroID = $_POST['livro_id'];
    $livroNome = $_POST['nome'];
    $usuarioNome = $_SESSION['usuarioNomedeUsuario'];

    $emprestimoController->emprestarLivro($livroID, $livroNome, $usuarioNome);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .livro {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            overflow: hidden;
        }

        .livro img {
            max-width: 100px;
            max-height: 150px;
            margin-right: 10px;
            float: left;
        }

        .livro .info {
            float: left;
        }

        .livro button {
            clear: both;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    
<section>
    <a href="book.php">Voltar</a>
    <!-- COMPETICOES -->
    <?php foreach ($categorias as $categoria => $livrosDaCategoria): ?>
        <h2><?php echo $categoria; ?></h2>
        <?php foreach ($livrosDaCategoria as $livro): ?>
            <div class="livro">
                <img src="<?php echo $livro['imagem'] ?? ''; ?>" alt="Imagem do Livro">
                <div class="info">
                    <h3><?php echo $livro['nome']; ?></h3>
                    <p>Categoria: <?php echo $livro['categoria']; ?></p>
                    <p>Quantidade: <?php echo $livro['quantidade']; ?></p>
                    <form method="post" action="">
                        <input type="hidden" name="livro_id" value="<?php echo $livro['livro_id']; ?>">
                        <input type="hidden" name="nome" value="<?php echo $livro['nome']; ?>">
                        <button type="submit" name="emprestar">Emprestar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</section>

</body>
</html>
