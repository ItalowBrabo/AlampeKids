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

// Recupera os dados do formulário
$cpf = $_POST["cpf"];
$senha = $_POST["senha"];

// Consulta SQL para verificar se o usuário existe
$sql_verificar_usuario = "SELECT * FROM cadastro WHERE cpf = ?";
$stmt = $conexao->prepare($sql_verificar_usuario);

// Verifica se a preparação da instrução foi bem-sucedida
if (!$stmt) {
    die('Erro na preparação da instrução SQL: ' . $conexao->error);
}

// Bind do parâmetro
$stmt->bind_param("s", $cpf);

// Executa a instrução SQL
$stmt->execute();

// Obtém o resultado da consulta
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Usuário existe, verifica a senha
    $usuario = $resultado->fetch_assoc();

    // Mensagens de depuração para análise
    var_dump($senha, $usuario["senha"]); // Verifica se a senha é igual e a quantidade de caracteres

    if ($senha === $usuario["senha"]) {
        // Senha correta, redireciona para a página principal
        header("Location: realizado.html");
        exit(); // Certifique-se de encerrar a execução após o redirecionamento
    } else {
        // Senha incorreta
        echo "Senha incorreta. Tente novamente.";
    }
} else {
    // Usuário não encontrado
    echo "Usuário não encontrado. Faça o cadastro primeiro.";
}

// Fecha a conexão
$stmt->close();
$conexao->close();
?>
