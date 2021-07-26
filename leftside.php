<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- search form -->
    <form class="sidebar-form search-main">
        <div class="input-group">
            <input type="text" id="criterio" class="form-control" title="Busca de protocolo" placeholder="Busca de protocolo..." required />
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- Sidebar user panel -->
    <div class="callout callout-warning">
        <!--<h4>I am a warning callout!</h4>-->
        <p><i class="fa fa-angle-double-right"></i> <i>Pelo n&uacute;mero do protocolo<br>(0000/0000);</i></p>
        <p><i class="fa fa-angle-double-right"></i> <i>Pela inscri&ccedil;&atilde;o do im&oacute;vel<br>(00.00.000.0000.000);</i></p>
        <p><i class="fa fa-angle-double-right"></i> <i>Pelo nome do requerente ou documento do requerente;</i></p>
    </div>
    <!-- /.user panel -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <?php
            if(base64_decode($_SESSION['type']) == 'ADM') {
                $adm = '
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> <span>Funcion&aacute;rio</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="novoFuncionario.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                        <li><a href="relacaoFuncionario.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                    </ul>
                </li>';
                $admactA = '
                <li class="treeview active">
                    <a href="#"><i class="fa fa-user"></i> <span>Funcion&aacute;rio</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="novoFuncionario.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                        <li><a href="relacaoFuncionario.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                    </ul>
                </li>';
                $admactB = '
                <li class="treeview active">
                    <a href="#"><i class="fa fa-user"></i> <span>Funcion&aacute;rio</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="novoFuncionario.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                        <li class="active"><a href="relacaoFuncionario.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                    </ul>
                </li>';
            }
            else {
                $adm = '';
                $admactA = '';
                $admactB = '';
            }

            switch($mn) {
                case 1:
                    echo'
                    <li class="active"><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '2a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '2b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li class="active"><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '3a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '3b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li class="active"><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '4a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$admactA.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '4b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$admactB.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '5a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview active">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '5b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview active">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li class="active"><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '5c':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview active">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li class="active"><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '5d':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview active">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li class="active"><a href="relacaoAnoVigenteRequerimento.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;    
                    
                case 6:
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '7a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '7b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li class="active"><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;
                    
                case '7c':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            <li class="active"><a href="relacaoAnoVigenteAnalise.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '8a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '8b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li class="active"><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;
                    
                case '8c':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            <li class="active"><a href="relacaoAnoVigenteNotificacao.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '9a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '9b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li class="active"><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '9c':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li class="active"><a href="relacaoAnoVigenteHabitese.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;    
                    
                case '10a':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li class="active"><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                case '10b':
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li class="active"><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;

                default:
                    echo'
                    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> <span>In&iacute;cio</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building-o"></i> <span>Im&oacute;vel/Obra</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoImovel.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoImovel.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Arquiteto/Engenheiro</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoEngenheiro.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>'
                    .$adm.
                    '<li class="treeview">
                        <a href="#"><i class="fa fa-tag"></i> <span>Requerimento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoRequerimento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <!--<li><a href="relacaoAnoVigenteRequerimento.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>-->
                            <li><a href="relacaoRequerimento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                            <li><a href="relatorioRequerimento.php"><i class="fa fa-angle-double-right"></i> Relat&oacute;rio</a></li>
                        </ul>
                    </li>
                    <li><a href="novoProtocolo.php"><i class="fa fa-ticket"></i> <span>Novo protocolo</span></a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-rss"></i> <span>An&aacute;lise de projeto</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaAnalise.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            <!--<li><a href="relacaoAnoVigenteAnalise.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>-->
                            <li><a href="relacaoAnalise.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-hdd-o"></i> <span>Cadastramento</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoCadastramento.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <li><a href="relacaoCadastramento.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-eye"></i> <span>Fiscaliza&ccedil;&atilde;o</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novaNotificacao.php"><i class="fa fa-angle-double-right"></i> Nova</a></li>
                            <!--<li><a href="relacaoAnoVigenteNotificacao.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>-->
                            <li><a href="relacaoNotificacao.php"><i class="fa fa-angle-double-right"></i> Todas</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-building"></i> <span>Habite-se</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="novoHabitese.php"><i class="fa fa-angle-double-right"></i> Novo</a></li>
                            <!--<li><a href="relacaoAnoVigenteHabitese.php"><i class="fa fa-angle-double-right"></i> '.date('Y').'</a></li>-->
                            <li><a href="relacaoHabitese.php"><i class="fa fa-angle-double-right"></i> Todos</a></li>
                        </ul>
                    </li>';
                break;
            }
        ?>
    </ul>
</section>
<!-- /.sidebar -->
