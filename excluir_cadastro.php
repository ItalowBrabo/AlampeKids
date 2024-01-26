<?php
// Conecta-se ao banco de dados
$host = "127.0.0.1";
$usuario_bd = "root";
$senha_bd = "";
$banco = "cad1";

$conexao = new mysqli($host, $usuario_bd, $senha_bd, $banco);

// Verifica se a conexão ao banco de dados foi estabelecida com sucesso
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Verifica se o CPF foi enviado via POST
if (isset($_POST["cpf_excluir"])) {
    $cpf_excluir = $_POST["cpf_excluir"];

    // Exiba o CPF para depuração
    echo "CPF a ser excluído: " . $cpf_excluir . "<br>";

    // Consulta SQL para excluir o registro
    $sql_excluir_registro = "DELETE FROM cadastro WHERE cpf = ?";

    // Prepara a instrução SQL
    $stmt = $conexao->prepare($sql_excluir_registro);

    // Verifica se a preparação da instrução foi bem-sucedida
    if (!$stmt) {
        die('Erro na preparação da instrução SQL: ' . $conexao->error);
    }

    // Bind do parâmetro
    $stmt->bind_param("s", $cpf_excluir);

    // Executa a instrução SQL
    $stmt->execute();

    // Exibe mensagens para depuração
    echo "Número de linhas afetadas: " . $stmt->affected_rows . "<br>";

    // Verifica se a exclusão foi bem-sucedida
    if ($stmt->affected_rows > 0) {
        // Exibe mensagem para depuração
        echo "Redirecionando para login.html...<br>";

        // Redireciona para a página principal
        header("Location: login.html");
        exit(); // Certifique-se de encerrar a execução após o redirecionamento
    } else {
        echo "Nenhum registro foi excluído. Verifique se o CPF é válido.";
    }

    // Fecha a conexão
    $stmt->close();
} else {
    echo "CPF não fornecido. Por favor, forneça o CPF a ser excluído.";
}

// Fecha a conexão
$conexao->close();
?>