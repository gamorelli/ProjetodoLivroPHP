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
                <h2 align="center"><font color="#00FF00">$$$</font> Controle de Gastos Mensais <font color="#00FF00">$$$</font></h2>
        <!--        <p align="center"><font color="#FFFFFF">Usuário: <b><?php echo $_COOKIE["usuario"]; ?></b></p>-->

                <p align="center"><font color="#FFFFFF">Seja bem-vindo! Escolha a Opção Desejada:</font></p>
                <br>
                <br>

                <div class="list-group"><p align="center">
                        <a href="#" class="list-group-item disabled">Incluir:</a>
                        <a href="incluir.php?tipo=RF" class="list-group-item">Receitas Fixas</a>
                        <a href="incluir.php?tipo=RV" class="list-group-item">Receitas Variáveis</a>
                        <a href="incluir.php?tipo=DF" class="list-group-item">Despesas Fixas</a>
                        <a href="incluir.php?tipo=DV" class="list-group-item">Despesas Variáveis</a>
                </div>


                <div class="list-group"><p align="center">
                        <a href="#" class="list-group-item disabled">Visualizar:</a>
                        <a href="periodo.php" class="list-group-item">Planilha de Gastos Mensais</a>
                </div>
                <div class="list-group"><p align="center">
                        <a href="#" class="list-group-item disabled">Excluir:</a>
                        <a href="excluir.php" class="list-group-item">Excluir Receitas e Despesas</a>
                        <br>
                </div>

            </body>
        </html>