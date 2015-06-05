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
                <a class="navbar-brand" href="home">Metezers</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="mes_cours">Vos cours</a></li>
                    <li><a href="#">Tous les cours</a></li>
                    <li><a href="gestion_cours">Gestion des cours</a></li>
                    <li><a href="utilisateurs">Utilisateurs</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profil"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Profil</a></li>
                    <li><a href="home/deconnexion">Deconnexion</a></li>
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
                <a class="navbar-brand" href="home">Metezers</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="vos_cours">Vos cours</a></li>
                    <li><a href="#">Tous les cours</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profil"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Profil</a></li>
                    <li><a href="home/deconnexion">Deconnexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>';
        }
    }
?>