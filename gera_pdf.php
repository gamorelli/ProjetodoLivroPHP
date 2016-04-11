<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<?php
include 'valida_cookie.inc';
// ********* CONFIGURAÇÕES DO PROGRAMA *********
//documento
$largura = 842;
$altura = 595;
$margem_vertical = 30;
$margem_horizontal = 30;
$tamanho_fonte = 20;
$tamanho_fonte_titulo = 22;

//obtém o valor do cookie e do parâmetro
$usuario = $_COOKIE["usuario"];
$data = $_GET["data"];
$titulo = "Lista de despesas - $data";

//monta a data para busca no banco de dados
$meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
$aux = explode("-", $data);
$mes = $aux[0];
$ano = $aux[1];
$mes = array_search($mes, $meses) + 1;
$data_buscar = "$ano-$mes-01";

//consulta SQL que irá gerar o relatório
include "conecta_banco.inc";
$comandoSQL = "select descricao, valor from receitas_despesas where usuario='$usuario' and data='$data_buscar' and (tipo='DF' or tipo='DV') order by descricao";
$colunas_resutantes = array("descricao", "valor");

//tabela a ser gerada no PDF
$texto_colunas = array("Descricao", "Valor (R\$)");
$largura_coluna = array(200, 70);

//executa a consulta
include "conecta_banco.inc";
$res = $con->query($comandoSQL);

while ($linha = $res->fetch_object()) {
    $total = $linha->valor;
}

if (!$total) {
    $con->close();
    echo "O relatório não foi gerado porque a consulta não retornou registros!";
    exit;
}

//cria o documento PDF
include('./pdf/src/Cezpdf.php');

$p = new Cezpdf();
$p->ezSetMargins(30, 30, 30, 30);

$p->ezText($titulo, 22);
$p->setLineStyle(0.7);
$p->line(30, 775, 564, 775);
$p->setStrokeColor(0, 0, 0);

$p->ezText(" ", 25);

include "conecta_banco.inc";
$res = $con->query($comandoSQL);
$array = array();
while ($linha = $res->fetch_object()) {
    $array[] = array("Descrição" => $linha->descricao, "Valor" => $linha->valor);
}
$p->ezTable($array, null, null, array('fontSize' => 12, 'width' => 530, 'shadeHeadingCol' => array(0.7, 0.7, 0.7)));

$p->ezStream();

$con->close();
?>