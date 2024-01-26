<?php
include("conexaom.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $cpf = $_POST["CPF"];
    $senha_atual = $_POST["senha_atual"];
    $nova_senha = $_POST["nova_senha"];

    // Substitua "cadastro" pelo nome real da sua tabela no banco de dados
    $stmt = $conexao->prepare("UPDATE cadastro SET senha = ? WHERE cpf = ?");
    
    // Verifique se a preparação da instrução foi bem-sucedida
    if ($stmt) {
        // Vincule os parâmetros
        mysqli_stmt_bind_param($stmt, "si", $nova_senha, $cpf);

        // Execute a instrução preparada
        $result = mysqli_stmt_execute($stmt);

        // Verifique se a execução foi bem-sucedida
        if ($result) {
            $mensagem = "Senha redefinida com sucesso!";
        } else {
            $erro = "Erro ao redefinir senha: " . mysqli_stmt_error($stmt);
        }

        // Feche a instrução preparada
        mysqli_stmt_close($stmt);
    } else {
        $erro = "Erro na preparação da instrução: " . mysqli_error($conexao);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial;
            background-color: #FFEFD5;
        }

        #log,
        #cad {
            width: 40%;
            box-sizing: border-box;
            float: left;
            margin-top: 5%;
            margin-left: 100px;
        }

        #logo {
            width: 300px;
            height: 100px;
            margin-left: 40%;
            margin-top: 10px;
        }

        button {
            width: 150px;
            height: 50px;
            font-family: comic sans ms;
            font-size: large;
            background-color: transparent;
        }

        header {
            background-color: #ffe1e6;
        }
    </style>
    <header><a href="paginaPrin.html"><img id="logo" src="imagens/logoo.png"></a></header>
</head>
<body>
   <h1>SENHA ALTERADA COM SUCESSO!</h1>
</body>
</html>
