<?php

//configuracao do banco de dados

$servidor = "localhost";
$usuario_bd = "root";
$senha_bd = "123";
$banco = "proj_livro";
$con = mysqli_connect($servidor, $usuario_bd, $senha_bd, $banco);

/* check connection */
if (mysqli_connect_error()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>