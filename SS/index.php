<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/Css/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="Public/Js/script.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="user-icon" id="user-icon" onclick="showUserInfo()">
        <ion-icon name="person-circle-outline"></ion-icon>
    </div>
    <div class="user-info" id="user-info">
    <?php
        session_start();
        include '../Login/verifica_login.php'
    ?>
    <h2>Olá <?php echo $_SESSION['usuarioNomedeUsuario'] , "!"; ?> </h2><br>
    <button onclick="logout()"><h6>Sair</h6></button></div>

    <a href="book.php">Livros</a>
</body>
</html>