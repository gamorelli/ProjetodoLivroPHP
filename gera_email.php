<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<?php
include 'valida_cookie.inc';
include './PHPMailer/Mail.php';
error_reporting(E_ALL);

if (!isset($_GET["email"])) {
    $data = $_GET["data"];
    echo "<html><body>";
    echo "<form method=\GET\" action=\"gera_email.php\">";
    echo "<input type=\"hidden\" name=\"data\" size=\"30\" value=\"{$data}\">";
    echo "Seu e-mail: <input type=\"text\" name=\"email\" size=\"30\">";
    echo "<input type=\"submit\" name=\"enviar\" value=\"Enviar\">";
    echo "</form>";
    echo "</body></html>";
} else {
    $email = $_GET["email"];
    if (strlen($email) < 8 || substr_count($email, "@") != 1 ||
            substr_count($email, ".") == 0)
        echo "O e-mail digitado é inválido! ";
    else {
        $usuario = $_COOKIE["usuario"];
        $data = $_GET["data"];
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
        $total = 0;
        while ($linha = $res->fetch_object()) {
            $descricoes[] = $linha->descricao;
            $valores[] = $linha->valor;
            $total += $linha->valor;
        }
    }
    $con->close();
// --- monta a mensagem e manda o e-mail ---
    $msg = "<h2>Lista de despesas - $data</h2><hr>";
    for ($i = 0; $i < sizeof($descricoes); $i++) {
        $descricao = $descricoes[$i];
        $valor = $valores[$i];
        $msg .= "{$descricao} - R\${$valor}<br>";
    }

    $msg .= "<hr>Total de Despesas: <b>R\${$total}</b>";

    $phpmail = new Mail();
    $phpmail->Send(array('0' => array('email' => $email, "nome" => $email)), "Despesas de {$data}", $msg);
}
?>

<a href="principal.php" class="btn btn-success">Voltar</a></p>