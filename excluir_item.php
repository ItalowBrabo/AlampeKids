<?php
include("conexao.php"); // Certifique-se de incluir seu arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o ID do item a ser excluído do formulário
    $id_item = $_POST["id_item"];

    // Executa a exclusão no banco de dados
    $excluirItem = $conexao->prepare("DELETE FROM itens_cad WHERE id = ?");
    $excluirItem->bind_param("i", $id_item);

    if ($excluirItem->execute()) {
        echo "Item excluído com sucesso!";
    } else {
        echo "Erro ao excluir item: " . $conexao->error;
    }

    $excluirItem->close();
}

$conexao->close();
?>