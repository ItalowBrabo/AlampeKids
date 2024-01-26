<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>
<body>
<?php
include("conexao.php"); // Certifique-se de incluir seu arquivo de conexão

// Consulta todos os itens na tabela
$consulta = "SELECT * FROM itens_cad";
$resultado = $conexao->query($consulta);

if ($resultado) {
    echo "<h2>Itens Cadastrados</h2>";
    echo "<ul>";

    // Exibe os itens
    while ($item = $resultado->fetch_assoc()) {
        echo "<li>{$item['produto']} - R$ {$item['valor']}</li>";
    }

    echo "</ul>";
} else {
    echo "Erro na consulta: " . $conexao->error;
}

$conexao->close();
?>
<h2>Excluir Item</h2>
    <form action="excluir_item.php" method="post">
        <label for="id_item">Selecione o item a ser excluído:</label>
        <select name="id_item">
            <?php
            // Consulta todos os itens na tabela
            $consulta = "SELECT * FROM itens_cad";
            $resultado = $conexao->query($consulta);

            if ($resultado) {
                while ($item = $resultado->fetch_assoc()) {
                    echo "<option value='{$item['produto']}'>{$item['valor']}</option>";
                }
            } else {
                echo "Erro na consulta: " . $conexao->error;
            }
            ?>
        </select>

        <button type="submit">Excluir Item</button>
    </form>
</body>
</html>