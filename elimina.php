<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<html>
    <body>
        <h2 align="center">Exclusão de Registros</h2>
        <?php
        include 'valida_cookie.inc';
        $usuario = $_COOKIE["usuario"];
        $id = $_GET['id'];
        // conecta ao vanco de dados e exclui o registro
        include "conecta_banco.inc";
         $comandoSQL = "delete from receitas_despesas where usuario='$usuario' and id='$id'";
        $res = $con->query($comandoSQL);
       // $res = mysql_query($con, "delete from receitas_despesas where usuario='$usuario' and id='$id'");
        $con->close();
        ?>
        <br>
        <div class="alert alert-success" role="alert">
        <p align="center">Exclusão Realizada!</p>
        </div>
        <br>
        <p align="center"><a href="excluir.php" class="btn btn-success">Excluir Outra</a></p>  
        <p align="center"><a href="principal.php" class="btn btn-success">Voltar</a></p>
    </body>
</html>
