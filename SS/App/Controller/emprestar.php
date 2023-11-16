<?php
session_start();
require_once '../../../Config/config.php';

if (isset($_POST['emprestar'])) {
    $usuarioNome = $_SESSION['usuarioNomedeUsuario'];
    $livroID = $_POST['livro_id'];
    $livroNome = $_POST['nome'];

    $consultaLivro = $pdo->prepare("SELECT quantidade FROM livros WHERE livro_id = ?");
    $consultaLivro->execute([$livroID]);
    $livro = $consultaLivro->fetch(PDO::FETCH_ASSOC);

    if ($livro && $livro['quantidade'] > 0) {
        $novaQuantidade = $livro['quantidade'] - 1;
        $atualizarQuantidade = $pdo->prepare("UPDATE livros SET quantidade = ? WHERE livro_id = ?");
        $atualizarQuantidade->execute([$novaQuantidade, $livroID]);

        $emprestimo = isset($_SESSION['emprestimo']) ? $_SESSION['emprestimo'] : array();
        $emprestimofei = array(
            'livro_id' => $livroID,
            'livro_nome' => $livroNome,
            'usuario_nome' => $usuarioNome
        );
        $emprestimo[] = $emprestimofei;
        $_SESSION['emprestimo'] = $emprestimo;

        header('Location: ../../book.php');
        exit();
    }
}
?>
