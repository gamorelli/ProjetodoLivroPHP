<?php
include_once 'montapagina.php';
?>
<font color="#FFFFFF">
        <p align="center">Escolha o Período de Visualização:</p>
        <br>
        <hr>
        <form method="POST" action="planilha.php">
            <p align="center">Mês:</font> <select size="1" name="mes">
                    <option value="01">Jan</option>
                    <option value="02">Fev</option>
                    <option value="03">Mar</option>
                    <option value="04">Abr</option>
                    <option value="05">Mai</option>
                    <option value="06">Jun</option>
                    <option value="07">Jul</option>
                    <option value="08">Ago</option>
                    <option value="09">Set</option>
                    <option value="010">Out</option>
                    <option value="11">Nov</option>
                    <option value="12">Dez</option>
                </select>
                <font color="#FFFFFF">
                Ano: </font><input type="text" name="ano" size="4" maxlength="4"
                            value="<?php echo date("Y", time()); ?>">
            </p>
            <p align="center"><font color="#FFFFFF">até</p>
            <p align="center">Mês: </font><select size="1" name="mes2">
                    <option value="01">Jan</option>
                    <option value="02">Fev</option>
                    <option value="03">Mar</option>
                    <option value="04">Abr</option>
                    <option value="05">Mai</option>
                    <option value="06">Jun</option>
                    <option value="07">Jul</option>
                    <option value="08">Ago</option>
                    <option value="09">Set</option>
                    <option value="010">Out</option>
                    <option value="11">Nov</option>
                    <option value="12">Dez</option>
                </select>
                <font color="#FFFFFF">Ano: </font><input type="text" name="ano2" size="4" maxlength="4" value="<?php echo date("Y", time()); ?>"> 
            </p>
            <br>
            <p align="center">&nbsp;<input type="submit" class="btn btn-success" value="Visualizar" name="ok"> </p>
        </form>
        <hr>
        <br>
    </body>
</html>