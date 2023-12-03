<?php
require_once '../config/config.php';
require_once 'App/Controller/LivroController.php';


$livroController = new LivroController($pdo);
$livros = $livroController->listarLivrosPorCategoria(3);
$categorias = [];

foreach ($livros as $livro) {
    $categoria = $livro['categoria'];
    if (!isset($categorias[$categoria])) {
        $categorias[$categoria] = [];
    }
    $categorias[$categoria][] = $livro;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<section>
<a href="book.php">Voltar</a>
    <!-- COMPETIDOES -->
    <?php foreach ($categorias as $categoria => $livrosDaCategoria): ?>
    <h2><?php echo $categoria; ?></h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livrosDaCategoria as $livro): ?>
                <tr>
                    <td><?php echo $livro['livro_id']; ?></td>
                    <td><?php
                    if (!empty($livro['imagem'])) {
                        echo '<img src="' . $livro['imagem'] . '" alt="Imagem do Livro" width="100">';
                    } else {
                        echo 'Sem Imagem';
                    }
                    ?></td>
                    <td><?php echo $livro['nome']; ?></td>
                    <td><?php echo $livro['categoria']; ?></td>
                    <td><?php echo $livro['quantidade']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>
    </section>

</body>
</html>