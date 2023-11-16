<?php
require_once 'App/Model/UserModel.php';


class UserController {
    private $userModel;

    public function __construct($pdo) {

        $this->userModel = new UserModel($pdo);
    }

    public function criarUser($nome, $email, $senha) {
        $this->userModel->criarUser($nome, $email, $senha);
    }
}
?>