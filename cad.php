<?php 
   function validarCPF($cpf) {
	   //Estraindo os 9 primeiro digitos do cpf digitados pelo usuario
	   
	   $digitos = substr($cpf, 0, 9); //Substr usado para extrair uma parte da string cpf começando do 0 ao 9
	   
	   //Criando um vetor com os multiplicadores 10 ao 2 / 11 ao 2 para o primeiro e segundo dígito
	   $multiplicador1 = [10, 9, 8, 7, 6, 5, 4, 3, 2];
	   $multiplicador2 = [11, 10, 9, 8, 7, 6, 5, 4, 3, 2];
	   
	   //Calculando o primeiro dígito verificador
	   $soma = 0;
	   for($i = 0; $i < 9; $i++) {
		   //+= operador de atribuicao composta pega o valor direito e e armazena a esquerda
		   $soma += $digitos[$i] * $multiplicador1[$i];
	   }
	   
	   // calculando o resto da divisão
	   $resto1 = $soma % 11;
       $digitoCalculado1 = 11 - ($resto1 < 2 ? 0 : $resto1);
	 
	  // Adicionando o primeiro dígito calculado aos dígitos para calcular o segundo dígito
      $digitos .= $digitoCalculado1;
      
	  // Calculando o segundo dígito verificador
    $soma = 0;
    for($i = 0; $i < 10; $i++) {
        $soma += $digitos[$i] * $multiplicador2[$i];
    }
    $resto2 = $soma % 11;
    $digitoCalculado2 = 11 - ($resto2 < 2 ? 0 : $resto2);
	 
    //verificando o décimo digito
	$decimoPrimeiroDigito = (int)$cpf[10];
	   
	if ($digitoCalculado2 == $decimoPrimeiroDigito) {
        return true; // CPF validado com sucesso
    } else {
        return false; // CPF incorreto
    }

}

// Conecta-se ao servidor MySQL
$host = "127.0.0.1";
$usuario = "root";
$senha_bd = "";

$conexao_servidor = new mysqli($host, $usuario, $senha_bd);

// Verifica se a conexão foi estabelecida com sucesso
if ($conexao_servidor->connect_error) {
    die("Conexão falhou: " . $conexao_servidor->connect_error);
}

// Conecta-se ao banco de dados
$banco = "cad1";
$conexao = new mysqli($host, $usuario, $senha_bd, $banco);

// Verifica se a conexão ao banco de dados foi estabelecida com sucesso
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

// Recupera os dados do formulário
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$senha = $_POST["senha"];

// Verifica se o CPF já está cadastrado
$sql_verificar_cpf = "SELECT * FROM cadastro WHERE cpf = '$cpf'";
$resultado_cpf = $conexao->query($sql_verificar_cpf);

if ($resultado_cpf->num_rows > 0) {
    // CPF já cadastrado
    echo "CPF já cadastrado. Por favor, use outro CPF.";
    exit;
}

// Verifica CPF
if (!validarCPF($cpf)) {
    echo "CPF inválido. Por favor, digite um CPF válido.";
    exit;
}

// Verifica se o e-mail já está cadastrado
$sql_verificar_email = "SELECT * FROM cadastro WHERE email = '$email'";
$resultado_email = $conexao->query($sql_verificar_email);

if ($resultado_email->num_rows > 0) {
    // E-mail já cadastrado
    echo "E-mail já cadastrado. Por favor, use outro e-mail.";
    exit;
}

// Prepara e executa a inserção no banco de dados
$sql_inserir = "INSERT INTO cadastro (nome, cpf, email, senha) VALUES ('$nome', '$cpf', '$email', '$senha')";

if ($conexao->query($sql_inserir) === TRUE) {
        // Redireciona para a página principal
        header("Location: realizado.html");
        exit(); // Certifique-se de encerrar a execução após o redirecionamento
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
}

// Fecha a conexão
$conexao->close();
?>