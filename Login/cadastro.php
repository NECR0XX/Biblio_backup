<?php
require_once '../Config/config.php';
require_once 'App/Controller/UserController.php';

$userController = new UserController($pdo);

if (isset($_POST['nome']) && 
    isset($_POST['email']) &&
    isset($_POST['senha'])) 
{
    $userController->criarUser($_POST['nome'], $_POST['email'], $_POST['senha']);
    header('Location: #');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>
    <a href="login.php">Voltar</a>
    <h1>Fazer Cadastro</h1>

    <!-- Formulário de cadastro -->
    <form method="post">
        <input type="text" name="nome" placeholder="Nome Usuário" required><br>
        <input type="text" name="email" placeholder="E-mail" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <button type="submit">Adicionar User</button>
    </form>

</body>
</html>