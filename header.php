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
            <li class="user user-menu"><a href="profile.php"><i class="fa fa-tasks"></i> <span>Perfil</span></a></li>
            <li class="user user-menu"><a href="timbrado.php"><i class="fa fa-file-text"></i> <span>Timbrado</span></a></li>
            <?php
                if((base64_decode($_SESSION['type']) == 'ADM') or (base64_decode($_SESSION['type']) == 'ROT')) {
                    echo'
                    <li class="user user-menu"><a href="documentacaoAnalise.php"><i class="fa fa-list"></i> <span>Documenta&ccedil;&atilde;o</span></a></li>
                    <li class="user user-menu"><a href="infracao.php"><i class="fa fa-eye"></i> <span>Infra&ccedil;&otilde;es</span></a></li>
                    <li class="user user-menu"><a href="habitese.php"><i class="fa fa-building"></i> <span>Habite-se</span></a></li>
                    <!--<li class="user user-menu"><a class="toggle-bkp" href="backup.php"><i class="fa fa-save"></i> <span>Back up</span></a></li>-->';
                }
            ?>
            <li class="user user-menu"><a href="sair.php"><i class="fa fa-power-off"></i> <span>Sair</span></a></li>
            <?php
                include_once('conexao.php');

                //antes de listar os protocolos, verifica a licenca
                $sql = "SELECT idlicenca_app,monitor FROM licenca_app";
                $res = mysql_query($sql);
                $ret = mysql_num_rows($res);

                    if($ret != 0) {
                        $lin = mysql_fetch_object($res);

                            if($lin->monitor == 'X') {
                                echo'<script>location.href = "inicioLock.php";</script>';
                            } else {
                                if(base64_decode($_SESSION['type']) == 'ROT') {
                                    echo'<li class="user user-menu"><a class="close-app" href="#"><i class="fa fa-ban"></i> <span>Bloquear</span></a></li>';
                                }
                            }
                    }

                unset($sql,$res,$ret,$lin);
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
