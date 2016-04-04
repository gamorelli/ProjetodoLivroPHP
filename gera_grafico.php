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
////inclui o arquivo com as configurações
//include 'config_grafico.inc';
////cria imagem e define as cores
//$imagem = imagecreate($largura, $altura);
//$fundo = imagecolorallocate($imagem, 236, 226, 226);
//$preto = imagecolorallocate($imagem, 0, 0, 0);
//$azul = imagecolorallocate($imagem, 0, 0, 255);
//$verde = imagecolorallocate($imagem, 0, 255, 0);
//$vermelho = imagecolorallocate($imagem, 255, 0, 0);
//$amarelo = imagecolorallocate($imagem, 255, 255, 0);
//$laranja = imagecolorallocate($imagem, 255, 153, 0);
//$magenta = imagecolorallocate($imagem, 255, 128, 255);
//$ciano = imagecolorallocate($imagem, 128, 255, 255);
//$verde_escuro = imagecolorallocate($imagem, 0, 128, 0);
//$cinza = imagecolorallocate($imagem, 192, 192, 192);
//$cores = array($azul, $verde, $vermelho, $amarelo, $laranja, $magenta, $ciano, $verde_escuro, $cinza);
////definicao dos dados
include "conecta_banco.inc";
$comandoSQL = "SELECT descricao, valor from receitas_despesas where usuario='$usuario' and data='$data_buscar' and (tipo='DF' or tipo='DV')";
$res = $con->query($comandoSQL);
////$res = mysqli_query($con, "select descricao, valor from receitas_despesas where usuario='$usuario' and data='$data_buscar' and (tipo='DF' or tipo='DV')");
////$num_linhas = $res->rows;
//
//if (!$res) {
//    echo "Não há receitas e despesas no período escolhido!";
//    exit;
//} else {
//
//
//    while ($row = $res->fetch_object()) {
//        //for ($i = 0; $i < $num_linhas; $i++) {
//
//        $dados[] = $res->data;
//        $valores[] = $res->data;
//    }
//    $con->close();
////calculo do total
//    $total = 0;
//    $num_linhas = sizeof($dados);
//    for ($i = 0; $i < $num_linhas; $i++)
//        $total += $valores[$i];
////desenha o gráfico
//    imageellipse($imagem, $centrox, $centroy, $diametro, $diametro, $preto);
//    imagestring($imagem, 3, 3, 3, "Total despesas: R\$total", $preto);
//    $raio = $diametro / 2;
//    for ($i = 0; $i < num_linhas; $i++) {
//        $percentual = ($valores[$i] / $total) * 100;
//        $percentual = number_format($percentual, 2);
//        $percentual .= "%";
//        $val = 360 * ($valores[$i] / total);
//        $angulo += $val;
//        $angulo_meio = $angulo - ($val / 2);
//        $x_final = $centrox + $raio * cos(deg2rad($angulo));
//        $y_final = $centroy + (- $raio * sin(deg2rad($angulo)));
//        $x_meio = $centrox + ($raio / 2 * cos(deg2rad($angulo_meio)));
//        $y_meio = $centroy + (- $raio / 2 * sin(deg2rad($angulo_meio)));
//        $x_texto = $centrox + ($raio * cos(deg2rad($angulo_meio))) * 1.2;
//        $y_texto = $centroy + (- $raio * sin(deg2rad($angulo_meio))) * 1.2;
//        imageline($imagem, $centrox, $centroy, $x_final, $y_final, $preto);
//        imagefilltoborder($imagem, $x_meio, $y_meio, $preto, $cores[$i % sizeof($cores)]);
//        imagestring($imagem, 2, $x_texto, $y_texto, $percentual, $preto);
//    }
//// ***** CRIAÇÃO DA LEGENDA *****
//    if ($exibir_legenda == "sim") {
//        //acha a maior string
//        $maior_tamanho = 0;
//        for ($i = 0; $i < $num_linhas; $i++)
//            if (strlen($dados[$i]) > $maior_tamanho)
//                $maior_tamanho = strlen($dados[$i]);
//        //calcula os pontos de inicio e fim do quadrado 
//        $x_inicio_legenda = $lx - $largura_fonte * ($maior_tamanho + 4);
//        $y_inicio_legenda = $ly;
//        $x_fim_legenda = $lx;
//        $y_fim_legenda = $ly + $num_linhas * ($altura_fonte + $espaco_entre_linhas) + 2 * margem_vertical;
//        ImageRectangle($imagem, $x_inicio_legenda, $y_inicio_legenda, $x_fim_legenda, $y_fim_legenda, $preto);
//        //começa a desenhar os dados
//        for ($i = 0; $i < num_linhas; $i++) {
//            $x_pos = $x_inicio_legenda + $largura_fonte * 3;
//            $y_pos = $y_inicio_legenda + $i * ($altura_fonte + $espaco_entre_linhas) + $margem_vertical;
//            imagestring($imagem, $fonte, $x_pos, $y_pos, $dados[$i], $preto);
//            imagefilledrectangle($imagem, $x_pos - 2 * $largura_fonte, $y_pos, $x_pos - $largura_fonte, $y_pos + $altura_fonte, $cores[$i % sizeof($cores)]);
//            imagerectangle($imagem, $x_pos - 2 * $largura_fonte, $y_pos, $x_pos + $largura_fonte, $y_pos + $altura_fonte, $preto);
//        }
//    }
//    imagepng($imagem);
//    imagedestroy($imagem);
//}
//?>

<?php

include 'valida_cookie.inc';

//calculo do total
    $total = 0;
    $num_linhas = sizeof($dados);
    for ($i = 0; $i < $num_linhas; $i++){
    $dados['descricao'] = $res['descricao'];
    $dados['valor'] = $res['valor'];
    }
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Language', 'Speakers (in millions)'],
          ['Assamese', 13],
          ['Bengali', 83], 
          ['Bodo', 1.4],
          ['Dogri', 2.3], 
          ['Gujarati', 46], ['Hindi', 300],
          ['Kannada', 38], ['Kashmiri', 5.5], ['Konkani', 5],
          ['Maithili', 20], ['Malayalam', 33], ['Manipuri', 1.5],
          ['Marathi', 72], ['Nepali', 2.9], ['Oriya', 33],
          ['Punjabi', 29], ['Sanskrit', 0.01], ['Santhali', 6.5],
          ['Sindhi', 2.5], ['Tamil', 61], ['Telugu', 74], ['Urdu', 52]
        ]);

        var options = {
          title: 'Relatório das Despesas',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>