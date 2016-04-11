<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<?php
if (isset($_COOKIE["usuario"]))
    $usuario = $_COOKIE["usuario"];
if (isset($_COOKIE["senha"]))
    $senha = $_COOKIE["senha"];
if (!(empty($usuario) OR empty($senha))) {
    include "conecta_banco.inc";
    $res = mysqli_query($con, "SELECT * FROM usuarios_autorizados WHERE usuario='$usuario' and senha='$senha'");

    if (mysqli_affected_rows($con) == 0) {
        setcookie("usuario");
        setcookie("senha");
        echo"Voce nao efetuou o LOGIN!";
        exit;
    }
} else {
    echo"Voce nao efetuou o LOGIN!";
    exit;
}
$con->close();
?>