<?php
require_once 'App/Model/HistoricoModel.php';

class HistoricoController {
    private $historicoModel;

    public function __construct($pdo) {
        $this->historicoModel = new HistoricoModel($pdo);
    }

    public function listarHistorico($usuarioId) {
        $historico = $this->historicoModel->listarHistorico($usuarioId);
        var_dump($historico);
        return $historico;
    }
}
?>
