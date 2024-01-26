<?php

include("conexao.php"); // Certifique-se de incluir seu arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valores fixos pré-criados
    $produto = $_POST["produto"];
    $valor = $_POST["valor"];

    // Insere os dados na tabela
    $inserirProduto = $conexao->prepare("INSERT INTO itens_cad (produto, valor) VALUES (?, ?)");
    $inserirProduto->bind_param("ss", $produto, $valor);

    if ($inserirProduto->execute()) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar produto: " . $conexao->error;
    }

    $inserirProduto->close();
}

$conexao->close();

?>