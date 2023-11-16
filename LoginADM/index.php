<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Public/Js/script.js"></script>
    <title>Document</title>
</head>
<body>
    <!-- Verificando o usuário para mostrar o "Olá (Nome do Usuario)" --> 
    <?php
        session_start();
        include '../Login/verifica_login.php'
    ?>
    <h2>Olá <?php echo $_SESSION['usuarioNomedeUsuario'] , "!"; ?> </h2><br>
    <button onclick="logout()"><h6>Sair</h6></button><br>
    
    <!-- Botões para os adms editarem os livros e os usuarios -->
    <a href="livro.php">Livros</a><br>
    <a href="users.php">Users</a><br>
</body>
</html>