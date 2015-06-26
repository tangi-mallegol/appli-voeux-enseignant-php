<?php
    function showNavbar($administrateur = false){
        if($administrateur == true){
echo '<div id="top-navbar" >
    <nav class="navbar navbar-default ">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/Projet/index.php/mes_cours" style="background-color: rgb(94, 176, 94);color: white;">Metezers</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/Projet/index.php/mes_cours"><span class="glyphicon glyphicon-home" style="margin-right: 5px;" aria-hidden="true"></span>Mes cours</a></li>
                    <li><a href="/Projet/index.php/tous_les_cours">Tous les cours</a></li>
                    <li><a href="/Projet/index.php/utilisateurs">Utilisateurs</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/Projet/index.php/mes_cours/deconnexion">Deconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>';
        }
        else{
            echo '<div id="top-navbar" >
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/Projet/index.php/mes_cours" style="background-color: rgb(94, 176, 94);color: white;">Metezers</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/Projet/index.php/mes_cours"><span class="glyphicon glyphicon-home" style="margin-right: 5px;" aria-hidden="true"></span> Mes cours</a></li>
                    <li><a href="/Projet/index.php/tous_les_cours">Tous les cours</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/Projet/index.php/mes_cours/deconnexion">Deconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>';
        }
    }
?>
