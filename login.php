<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<?php

// obtem oa valores digitados

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

//acesso ao banco de dados

include "conecta_banco.inc";
global $con;
$res = mysqli_query($con, "SELECT * FROM usuarios_autorizados where usuario='$usuario' and senha='$senha'") or die(mysqli_error($con));

$linhas = mysqli_affected_rows($con) > 0;
if ($linhas == 0) {  //testa se a consulta retornou algum registro        
    echo"<html><body>";
    echo"<p align=\"center\">O login nao foi realizado porque os dados digitados sao invalidos.</p>";
    echo"<p align=\"center\"><a href=\"index.php\"><input type=\"submit\" class=\"btn btn-success\" value=\"Voltar\" name=\"sair\"></p></a></p>";
    echo"</body></html>";
} else {
    setcookie("usuario", $usuario);
    setcookie("senha", $senha);
    header("Location: principal.php"); //direciona para a pagina inicial dos usuarios cadastrados    
}
$con->close();
?>