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
    <br>
    <br>
    <body>
        <h2 align="center"><font color="#00FF00">$$$</font> Controle de Gastos Mensais <font color="#00FF00">$$$</font></h2>
<!--        <p align="center"><font color="#FFFFFF">Usuário: <b><?php echo $_COOKIE["usuario"]; ?></b></p>-->

        <p align="center"><font color="#FFFFFF">Digite seus Dados de Identificação para acessar o Sistema:</font></p>
<!--        <h3 align="center"><font color="#FFFFFF">Digite seus Dados de Identificação para acessar o Sistema:</font></h3>-->
<br>
<br>
        <form method="POST" action="login.php">
           <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Usuário" name="usuario" aria-describedby="basic-addon1">
            </div>
                <br>        
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">*</span>
                    <input type="text" class="form-control" placeholder="Senha" name="senha" aria-describedby="basic-addon1">
                    <br>
                </div>
                <br>  
                <br>
                <p align="center"><input type="submit" class="btn btn-success" value="Efetuar Login" name="entrar"></p>
                <br>
                <br>
               
        </form>
    </body>
</html> 