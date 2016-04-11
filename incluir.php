<?php
include_once 'montapagina.php';
$usuario = $_COOKIE["usuario"];
$tipo = $_GET["tipo"];
if ($tipo == "RF") {
    $titulo = "RECEITAS FIXAS";
} elseif ($tipo == "RV") {
    $titulo = "RECEITAS VARIÁVEIS";
} elseif ($tipo == "DF") {
    $titulo = "DESPESAS FIXAS";
} elseif ($tipo == "DV") {
    $titulo = "DESPESAS VARIÁVEIS";
}
?>

<script language="javascript">
    function valida_dados(formulario)
    {
        if (formulario.descricao_nova.value == "" &&
                formulario.descricao[0].checked == true) {
            alert("Você não digitou a Descrição.");
            return false;
        }
        if (formulario.ano.value.leigth < 4) {
            alert("Digite o Ano com 4 dígitos.");
            return false;
        }
        if (formulario.valor.value == "") {
            alert("Você não digitou o Valor.");
            return false;
        }
        return true;
    }
</script>
<font color="#FFFFFF">
<p align="center">Inclusão de <b><?php echo $titulo; ?></b>:</p>        
<br>
<hr>
<form method="POST" action="gravar.php" name="formulario" onSubmit="return valida_dados(this)">
    <input type="hidden" name="tipo" value="<?php echo $tipo; ?>" checked>
    <p align="center">
        Descrição:
        <input type="radio" name="descricao" value="nova" checked>
        Nova:</font> <input type="text" name="descricao_nova" size="20" onkeydown="javascript:formulario.descricao[0].checked = true">
        <input type="radio" value="existente" name="descricao"> <font color="#FFFFFF">Existente: </font>
        <select size="1" name="descricao" onChange="javascript:formulario.descricao[1].checked = true">
            <?php
            //monta a lista das descrições já existentes para esse tipo 
            include "conecta_banco.inc";
            $comandoSQL = "SELECT distinct(descricao) FROM receitas_despesas WHERE usuario='padrao' and tipo='$tipo' order by descricao";
            $res = $con->query($comandoSQL);
            if (!$res) {
                echo "-";
                exit;
            } else {
                while ($linha = $res->fetch_object()) {
                    $descricao = $linha->descricao;
                    echo "<option value=\"$descricao\">$descricao</option>";
                }
            }

            $con->close();
            ?>

        </select>
    </p>
    <p align="center"><font color="#FFFFFF">Mês:</font> <select size="1" name="mes">
            <option value="1">Jan</option>
            <option value="2">Fev</option>
            <option value="3">Mar</option>
            <option value="4">Abr</option>
            <option value="5">Mai</option>
            <option value="6">Jun</option>
            <option value="7">Jul</option>
            <option value="8">Ago</option>
            <option value="9">Set</option>
            <option value="10">Out</option>
            <option value="11">Nov</option>
            <option value="12">Dez</option>
        </select>
        <font color="#FFFFFF">
        Ano:</font> <input type="text" name="ano" size="4" maxlength="4" value="<?php echo date("Y", time()); ?>">
    </p>
    <p align="center"><font color="#FFFFFF">Valor: </font> <input type="text" name="valor" size="10" maxlength="10"></p>         
    <br>
    <p align="center"><input type="submit" class="btn btn-success" value="Enviar" name="enviar"></p>
</form>
<hr> 
<br>
<br>