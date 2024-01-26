<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$bd = "cad1";

$conexao=mysqli_connect($servidor, $usuario, $senha, $bd);

if(!$conexao){
    die("Ocorreu um ERRO!" .mysqli_connect_errno());
}


?>