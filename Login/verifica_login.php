<?php
if(!$_SESSION['usuarioEmail'] or !$_SESSION['usuarioNomedeUsuario']) {
    header('Location: ../Login/login.php');
    exit();
}
/* 
Aqui está analisando se o email ou
o nome de usuario é igual ao do banco de dados,
se for entra no site, se não volta para a página de
login e mostra o erro de "email ou senha invalido"
*/