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