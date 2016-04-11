<font color="#FFFFFF">
<?php
include_once 'montapagina.php';
?>
<p align="center">Exclusão de Registros:</p>
<hr>
<p align="center">
    <?php
    include 'valida_cookie.inc';
    $usuario = $_COOKIE["usuario"];
    $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
    // obtém todos os registros do usuário
    include "conecta_banco.inc";
    $comandoSQL = "select id, descricao, data, valor from receitas_despesas where usuario='$usuario' order by data desc";
    $res = $con->query($comandoSQL);
    if (!$res) {
        echo "Não há receitas e despesas no período escolhido!";
        exit;
    } else {
        while ($row = $res->fetch_object()) {

            $id = $row->id;
            $descricao = $row->descricao;
            $data = $row->data;
            $valor = $row->valor;

            $aux = explode("-", $data);
            $ano = $aux[0];
            $mes = $aux[1];
            $dia = $aux[2];
            $nome_mes = $meses[$mes - 1];
            echo "$nome_mes/$ano - $descricao (R\$$valor) ";
            echo " - <a href=\"elimina.php?id=$id\">Excluir</a><br>";
        }
    }

    $con->close();
    ?>
</p>
<hr>
<p align="center"><a href="principal.php" class="btn btn-success">Voltar</a></p>
</body>
</html>


