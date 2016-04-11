<?php
include "valida_cookie.inc";
?>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <style>
            h2 {
                color: #FFFFFF;
                text-shadow: 1px 1px 1px black;
            }
        </style>
        <title>Controle de Gastos Mensais</title>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="principal.php">Controle de Gastos Mensais</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <a href="index.php" class="btn btn-success">Efetuar Logout</a></p>
                    </form>
                </div>
                <h2 align="center"><font color="#00FF00">$$$</font> Controle de Gastos Mensais <font color="#00FF00">$$$</font></h2>
        </nav>

        <?php
        $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");
        $usuario = $_COOKIE["usuario"];
//obtém os valores digitados
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
        $mes2 = $_POST['mes2'];
        $ano2 = $_POST['ano2'];

//colocar datas no formato AAAA-MM-DD para consulta
        $data = "$ano-$mes-01";
        $data2 = "$ano2-$mes2-01";
        $array_datas = $RF = $RV = $DF = $DV = array();

//acessa o banco de dados e obtém os registros do usuário e do período
        include "conecta_banco.inc";
        $comandoSQL = "SELECT descricao,tipo,data,valor FROM receitas_despesas ";
        $comandoSQL .= "WHERE usuario = '$usuario' and data >= '$data' and data <= '$data2' order by data, descricao";
        $res = $con->query($comandoSQL);
        if (!$res) {
            echo "Não há receitas e despesas no período escolhido!";
            exit;
        } else {

            while ($row = $res->fetch_object()) {

                //print_r($row);die;        
                $descricao = $row->descricao;
                $tipo = $row->tipo;
                $data = $row->data;
                $valor = $row->valor;

                $aux = explode("-", $data);
                $ano = $aux[0];
                $mes = $aux[1];
                $dia = $aux[2];
                $numero_mes = $mes - 1;
                $data = $meses[$numero_mes] . "-" . $ano;

                if (!in_array($data, $array_datas))
                    $array_datas[] = $data;
                if ($tipo == "RF") { //receita fixa
                    if (!in_array($descricao, $RF))
                        $RF[] = $descricao;
                    $receitas_fixas[$descricao][$data] = $valor;
                    if (isset($total_receitas[$data]))
                        $total_receitas[$data] += $valor;
                    else
                        $total_receitas[$data] = $valor;
                }
                elseif ($tipo == "RV") {  //receita variável
                    if (!in_array($descricao, $RV))
                        $RV[] = $descricao;
                    $receitas_variaveis[$descricao][$data] = $valor;
                    if (isset($total_receitas[$data]))
                        $total_receitas[$data] += $valor;
                    else
                        $total_receitas[$data] = $valor;
                }

                elseif ($tipo == "DF") {  //receita variável
                    if (!in_array($descricao, $DF))
                        $DF[] = $descricao;
                    $despesas_fixas[$descricao][$data] = $valor;
                    if (isset($total_despesas[$data]))
                        $total_despesas[$data] += $valor;
                    else
                        $total_despesas[$data] = $valor;
                }
                elseif ($tipo == "DV") {  //receita variável
                    if (!in_array($descricao, $DV))
                        $DV[] = $descricao;
                    $despesas_variaveis[$descricao][$data] = $valor;
                    if (isset($total_despesas[$data]))
                        $total_despesas[$data] += $valor;
                    else
                        $total_despesas[$data] = $valor;
                }
            }


//coloca os dados em arrays 
            // for ($i = 0; $i < $linhas; $i++) {
            // }
        }

        $con->close();
        $numero_colunas = sizeof($array_datas);
        $colunas_html = $numero_colunas + 1;
        ?>
        <hr>
        <div style="margin-top: 98px"align="center">
            <center>
                <table class="table" border="1" cellspacing="0">
                    <tr>
                        <td width="142"></td>
                        <?php
//exibe das datas
                        foreach ($array_datas as $data)
                            echo "<td align=\"center\" width=\"100\"><b><font color=\"#000080\">$data</font></b></td>";
                        ?>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5">
                            <b>RECEITAS FIXAS</b></td>
                    </tr>
                    <?php
//exibe as receitas fixas
                    for ($i = 0; $i < sizeof($RF); $i++) {
                        $descricao = $RF[$i];
                        echo "<tr><td width=\"142\">$descricao</td>";
                        for ($j = 0; $j < $numero_colunas; $j++) {
                            $data = $array_datas[$j];
                            if (isset($receitas_fixas[$descricao][$data])) {
                                $valor = $receitas_fixas[$descricao][$data];
                                echo "<td align=\"center\" width=\"100\">$valor</td>";
                            } else
                                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5">
                            <b>RECEITAS VARIÁVEIS</b></td>
                    </tr>
                    <?php
                    //exibe as receitas variáveis
                    for ($i = 0; $i < sizeof($RV); $i++) {
                        $descricao = $RV[$i];
                        echo "<tr><td width=\"142\">$descricao</td>";

                        for ($j = 0; $j < $numero_colunas; $j++) {
                            $data = $array_datas[$j];
                            if (isset($receitas_variaveis[$descricao][$data])) {
                                $valor = $receitas_variaveis[$descricao][$data];
                                echo "<td align=\"center\" width=\"100\">$valor</td>";
                            } else
                                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td width="142"bgcolor="#D7FFFF"><b>Total Receitas:</b></td>
                        <?php
                        //exibe o total de receitas 
                        foreach ($array_datas as $data) {
                            if (isset($total_receitas[$data]))
                                $total = $total_receitas[$data];
                            else
                                $total = 0;
                            echo "<td align=\"center\" bgcolor=\"#D7FFFF\" width=\"100\">
                                    <b>$total</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5"><b>DESPESAS FIXAS</b></td>
                    </tr>
                    <?php
                    //exibe as despesas fixas
                    for ($i = 0; $i < sizeof($DF); $i++) {
                        $descricao = $DF[$i];
                        echo "<tr><td width=\"142\">$descricao</td>";

                        for ($j = 0; $j < $numero_colunas; $j++) {
                            $data = $array_datas[$j];
                            if (isset($despesas_fixas[$descricao][$data])) {
                                $valor = $despesas_fixas[$descricao][$data];
                                echo "<td align=\"center\" width=\"100\">$valor</td>";
                            } else
                                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="<?php echo $colunas_html; ?>" bgcolor="#F5F5F5">
                            <b>DESPESAS VARIÁVEIS</b></td>
                    </tr>
                    <?php
                    //exibe as despesas variáveis
                    for ($i = 0; $i < sizeof($DV); $i++) {
                        $descricao = $DV[$i];
                        echo "<tr><td width=\"142\">$descricao</td>";

                        for ($j = 0; $j < $numero_colunas; $j++) {
                            $data = $array_datas[$j];
                            if (isset($despesas_variaveis[$descricao][$data])) {
                                $valor = $despesas_variaveis[$descricao][$data];
                                echo "<td align=\"center\" width=\"100\">$valor</td>";
                            } else
                                echo "<td align=\"center\" width=\"100\">&nbsp;&nbsp;</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td width="142"bgcolor="#D7FFFF"><b>Total Despesas:</b></td>
                        <?php
                        //exibe o total de despesas
                        foreach ($array_datas as $data) {
                            if (isset($total_despesas[$data]))
                                $total = $total_despesas[$data];
                            else
                                $total = 0;
                            echo "<td align=\"center\" bgcolor=\"#FFE1E1\" width=\"100\">
                            <b>$total</b></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td width="142"><b>GRÁFICO DESPESAS</b></td>
                        <?php
                        //exibe o link para a geração do gráfico
                        foreach ($array_datas as $data) {
                            if (isset($total_despesas[$data]))
                                echo "<td align=\"center\" width\"100\">
                                    <a href=\"gera_grafico.php?data=$data\">
                                        <img src=\"grafico.gif\" border=\"0\" width=\"50\" height=\"50\"></a></td>";
                            else
                                echo "<td align=\"center\" width=\"100\">-</td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <td width="142"><b>PDF DESPESAS</b></td>
                        <?php
                        //exibe o link para a geração do PDF
                        foreach ($array_datas as $data) {
                            if (isset($total_despesas[$data]))
                                echo "<td align=\"center\" width=\"100\">
                                <a href=\"gera_pdf.php?data=$data\" target=\"blank\">
                                    <img src=\"pdf.gif\" border=\"0\" width=\"50\" height=\"50\"></a></td>";
                            else
                                echo "<td align = \"center\" width=\"100\">-</td>";
                        }
                        ?> 
                    </tr>
                    <tr>
                        <td width="142"><b>E-MAIL DESPESAS</b></td>
                        <?php
                        //exibe o link para o envio do e-mail
                        foreach ($array_datas as $data) {
                            if (isset($total_despesas[$data]))
                                echo "<td align=\"center\" width=\"100\">
                                <a href=\"gera_email.php?data=$data\">
                                    <img src=\"email.gif\" border=\"0\" width=\"50\" height=\"50\"></a></td>";
                            else
                                echo "<td align = \"center\" width=\"100\">-</td>";
                        }
                        ?> 
                    </tr>
                    <tr>
                        <td width="142" bgcolor="#CCFFCC"><b>SALDO</b></td>
                        <?php
                        //exibe o saldo (AZUL positivo, VERMELHO negativo)
                        foreach ($array_datas as $data) {
                            $saldo = 0;
                            if (isset($total_receitas[$data]))
                                $saldo += $total_receitas[$data];
                            if (isset($total_despesas[$data]))
                                $saldo -= $total_despesas[$data];
                            if ($saldo < 0)
                                $cor = "#FF0000"; //vermelho
                            else
                                $cor = "#0000FF"; //azul
                            echo "<td align=\"center\" bgcolor=\"#CFFCC\" width=\"100\">
                                <font color=\"$cor\">
                                    <b>$saldo</b></font></td>";
                        }
                        ?>
                    </tr>
                </table>
            </center>
        </div>
        <p align="center"><a href="principal.php" class="btn btn-success">Voltar</a></p>
    </body>
</html>
