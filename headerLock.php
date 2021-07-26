<a class="logo"></a>

<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="user user-menu"><a href="sair.php"><i class="fa fa-power-off"></i> <span>Sair</span></a></li>
            <?php
                if(base64_decode($_SESSION['type']) == 'ROT') {
                    if(base64_decode($_SESSION['lic']) == 'O') {
                        echo'<li class="user user-menu"><a class="close-app" href="#"><i class="fa fa-ban"></i> <span>Bloquear</span></a></li>';
                    } else {
                        echo'<li class="user user-menu"><a class="open-app" href="#"><i class="fa fa-check"></i> <span>Desbloquear</span></a></li>';
                    }
                }
            ?>
        </ul>
    </div>
</nav>


<div class="page-bkp">
    <div class="tb">
        <span class="page-bkp-close">&times;</span>
        <div class="tb-cell">
            <img src="img/loader.gif" title="Carregando..." alt="Carregando">
        </div> <!-- /.tb-cell -->
    </div> <!-- /.tb -->
</div> <!-- /.page-bkp -->