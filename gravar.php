<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<html>
    <body>
        <h2 align="center">Inclusão de Registros</h2>
        <br>
        <?php
        include 'valida_cookie.inc';
//obtém os valores digitados
        $usuario = $_COOKIE["usuario"];
        $tipo = $_POST["tipo"];
        $descricao = $_POST["descricao"];
        $mes = $_POST["mes"];
        $ano = $_POST["ano"];
        $valor = $_POST['valor'];
        $data = "$ano-$mes-01"; //data no formato MySQL
        if ($descricao == "nova")
            $nova_descricao = $_POST["descricao_nova"];
        else
            $nova_descricao = $_POST["descricao_existente"];

        $comandoSQL = "insert into receitas_despesas (usuario,descricao,tipo,data,valor) values";
        $comandoSQL .= " ('$usuario', '$nova_descricao', '$tipo', '$data', $valor)";
//acesso ao banco de dados
        include "conecta_banco.inc";
        $res = mysqli_query($con, $comandoSQL);
        echo "<html><body>";
        if ($res) {
            echo "<p align=\"center\" class=\"alert alert-success\" role=\"alert\">Inclusão Realizada com Sucesso!</p>";
        } else {
            echo "<p align=\"center\" class=\"alert alert-danger\" role=\"alert\">Erro na Inclusão!</p>";
        }
        ?>
        <br>
        <?php
        echo "<p align=\"center\"><a href=\"incluir.php?tipo=$tipo\" class=\"btn btn-success\">Incluir outra</a></p>";
        echo "<p align=\"center\"><a href=\"principal.php?tipo=$tipo\" class=\"btn btn-success\">Voltar</a></p>";
        echo "</body></html>";
        $con->close();
        ?>