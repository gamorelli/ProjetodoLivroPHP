<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<?php


//<form class="form-horizontal">
//  <div class="form-group">
//    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
//    <div class="col-sm-10">
//      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
//    </div>
include 'valida_cookie.inc';
if (!isset($_POST["email"])) {
    #$data = $_GET["data"];
    echo "<html><body>";
    echo "<form method=\POST\" action=\"gera_email.php\">";
    echo "<input type=\"hidden\" name=\"email\" size=\"30\">";
    echo "Seu e-mail: <input type=\"text\" name=\"email\" size=\"30\">";
    echo "<input type=\"submit\" name=\"enviar\" value=\"Enviar\">";
    echo "</form>";
    echo "</body></html>";
} else {
    $email = $_POST["email"];
    if (strlen($email) < 8 || substr_count($email, "@") != 1 ||
            substr_count($email, ".") == 0)
        echo "O e-mail digitado é inválido! ";
    else {
        $usuario = $_COOKIE["usuario"];
        $data = $_POST["data"];
        $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
        $aux = explode("-", $data);
        $mes = $aux[0];
        $ano = $aux[1];
        $mes = array_search($mes, $meses) + 1;
        $data_buscar = "$ano-$mes-01";
// - definição dos dados --
        include "conecta_banco.inc";
        $comandoSQL = "SELECT descricao, valor from receitas_despesas where usuario='$usuario' and data='$data_buscar' and (tipo='DF' or tipo='DV')"
                . "order by descricao";
        $res = $con->query($comandoSQL);
        //    $res = mysqli_query($con, "select descricao, valor from receitas_despesas where usuario='$usuario' and data='$data_buscar' and (tipo='DF' or tipo='DV')"
        //          . "order by descricao");
        $num_linhas = $res->rows;
        for ($i = 0; $i < $num_linhas; $i++) {
            $descricoes[] = $res->data[$i][0];
            $valores[] = $res->data[$i][1];
        }
        $con->close();
// - calculo do total --
        $total = 0;
        $num_linhas = sizeof($descrições);
        for ($i = 0; $i < $num_linhas; $i++)
            $total += $valores[$i];
// - monta a mensagem e manda o e-mail --
        $msg = "Lista de despesas - $data\n\n";
        for ($i = 0; $i < $num_linhas; $i++)
            $total += $valores[$i];
// - monta a mensagem e manda o e-mail --
        $msg = "Lista de Despesas - $data\n\n";
        for ($i = 0; $i < $num_linhas; $i++) {
            $descricao = $descricoes[$i];
            $valor = $valores[$i];
            $msg .= "$descricao - R\$$valor\n";
        }
        $msg .= "\nTotal de despesas: R\$$total";
        mail($email, "Despesas de $data", $msg, "From: seuemail@seudominio.com.br", "-r seuemail@seudominio.com.br");
        echo "As despesas de $data foram enviadas para o e-mail especificado.";
    }
}
?>