<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<?php
include 'valida_cookie.inc';
//header("Content-type: image/png");
$usuario = $_COOKIE["usuario"];
$data = $_GET["data"];
$meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
$aux = explode("-", $data);
$mes = $aux[0];
$ano = $aux[1];
$mes = array_search($mes, $meses) + 1;
$data_buscar = "$ano-$mes-01";
////definicao dos dados
include "conecta_banco.inc";
$comandoSQL = "SELECT descricao, valor from receitas_despesas where usuario='$usuario' and data='$data_buscar' and (tipo='DF' or tipo='DV')";
$res = $con->query($comandoSQL);
$array = array();

$total = 0;
while ($linha = $res->fetch_object()) {
    $total += $linha->valor;
    $array[] = array("descricao" => $linha->descricao, "valor" => $linha->valor);
}
?>
<html>
    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            var json = JSON.parse('<?php echo json_encode($array); ?>');
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                var dataTable = new google.visualization.DataTable();
                // Define as colunas
                dataTable.addColumn({type: 'string', id: 'Descrição'});
                dataTable.addColumn({type: 'number', id: 'Valor'});
                // Define Linhas
                for (var i = 0; i < json.length; i++) {
                    dataTable.addRow([
                        json[i]["descricao"],
                        parseFloat(json[i]["valor"])
                    ]);
                }

                var options = {
                    title: 'Relatório das Despesas',
                    legend: 'none',
                    pieSliceText: 'label',
                    slices: {4: {offset: 0.2},
                        12: {offset: 0.3},
                        14: {offset: 0.4},
                        15: {offset: 0.5},
                    },
                };

                chart.draw(dataTable, options);
            }
        </script>
    </head>
    <body>
        <label>Valor total das Despesas: <?php echo $total?></label>
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </body>
</html>