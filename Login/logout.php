<?php 
session_start();
unset($_SESSION['usuarioEmail']);
header('Location: login.php');
exit();

/*
Finaliza a sessão do usuario
e leva ele de volta para a 
página de login
*/