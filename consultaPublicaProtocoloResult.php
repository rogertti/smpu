<?php
    if(empty($_POST['rand'])) { die('Acesso não autorizado.'); }

    include_once('conexao.php');
    
    //buscando os dados do protocolo
    $sql = "SELECT requerimento_idrequerimento AS requerimento,codigo,taxa,situacao,observacao,monitor FROM protocolo WHERE codigo = '".$_POST['protocolo']."'";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);
    
        if($ret > 0){
            $lin = mysql_fetch_object($res);
            
                // Antes mostrava observacao na primeira condição, agora não mais. Esse IF faz coisas iguais =/
                if(!empty($lin->observacao)){
                    $guiaprotocolo = '<h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;"><!--<pre>'.$lin->observacao.'</pre><br>-->'.$lin->situacao.'</h3>';
                }else{
                    $guiaprotocolo = '<h3 class="text-muted well well-sm no-shadow" style="margin-top: 10px;text-align: center;">'.$lin->situacao.'</h3>';
                }
            
            echo'
            <div class="row invoice-info">
                <div class="col-xs-12">
                    <h1 style="text-align: center;">PROTOCOLO '.$lin->codigo.'</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    '.$guiaprotocolo.'
                </div>
            </div>';
            
            //buscando os dados do requerimento
            $sql2 = "SELECT imovel_idimovel AS imovel,requerente,cpf_cnpj,telefone,email,recolhimento,entrada,hora,construcao FROM requerimento WHERE idrequerimento = ".$lin->requerimento."";
            $res2 = mysql_query($sql2);
            $ret2 = mysql_num_rows($res2);
            
                if($ret2 > 0){
                    $lin2 = mysql_fetch_object($res2);
                    
                        if(!empty($lin2->construcao)){
                            $guiarequerimento = '<span class="text-muted well well-sm no-shadow">'.strtoupper($lin2->recolhimento.' - '.$lin2->construcao).'</span>';
                        }else{
                            $guiarequerimento = '<span class="text-muted well well-sm no-shadow">'.strtoupper($lin2->recolhimento).'</span>';
                        }
                    
                    //invertendo data 00/00/0000   
                    $ano = substr($lin2->entrada,0,4);
                    $mes = substr($lin2->entrada,5,2);
                    $dia = substr($lin2->entrada,8);
                    $lin2->entrada = $dia."/".$mes."/".$ano;
                    
                    echo'
                    <div class="row invoice-info">
                        <div class="col-xs-12 bord">
                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO REQUERIMENTO</strong></span>
                        </div>
                    </div>
                    <br/>
                    <div class="row invoice-info">
                        <div class="col-xs-12 text-center">
                            '.$guiarequerimento.'
                        </div>
                    </div>
                    <br>
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Requerente: </strong><span>'.strtoupper($lin2->requerente).'</span>
                        </div>
                        <div class="col-xs-3">
                            <strong>CPF/CNPJ: </strong><span>'.strtoupper($lin2->cpf_cnpj).'</span>
                        </div>
                        <div class="col-xs-3">
                            <strong>Telefone: </strong><span>'.strtoupper($lin2->telefone).'</span>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-xs-6">
                            <strong>Email: </strong><span>'.strtoupper($lin2->email).'</span>
                        </div>
                        <div class="col-xs-3">
                            <strong>Entrada: </strong><span>'.strtoupper($lin2->entrada).'</span>
                        </div>
                        <div class="col-xs-3">
                            <strong>Hora: </strong><span>'.strtoupper($lin2->hora).' h</span>
                        </div>
                    </div>
                    <br>';
                    
                    //buscando os dados do imóvel
                    $sql3 = "SELECT contribuinte_idcontribuinte AS contribuinte,inscricao,matricula,cep,endereco,apto,complemento,edificio_condominio,bairro,cidade,estado,tipo_obra,garagem,lote,quadra,loteamento,fracao,area_lote,area_unidade,area_anexo,area_englobada,area_construida,habitese,alvara FROM imovel WHERE idimovel = ".$lin2->imovel."";
                    $res3 = mysql_query($sql3);
                    $ret3 = mysql_num_rows($res3);
                    
                        if($ret3 > 0){
                            $lin3 = mysql_fetch_object($res3);
                            
                            echo'
                            <div class="row invoice-info">
                                <div class="col-xs-12 bord">
                                    <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO IM&Oacute;VEL</strong></span>
                                </div>
                            </div>
                            <br/>
                            <div class="row invoice-info">
                                <div class="col-xs-3">
                                    <strong>Inscri&ccedil;&atilde;o: </strong><span>'.strtoupper($lin3->inscricao).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Matr&iacute;cula: </strong><span>'.strtoupper($lin3->matricula).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Habite-se: </strong><span>'.strtoupper($lin3->habitese).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>&Aacute;lvara: </strong><span>'.strtoupper($lin3->alvara).'</span>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-xs-3">
                                    <strong>CEP: </strong><span>'.strtoupper($lin3->cep).'</span>
                                </div>
                                <div class="col-xs-6">
                                    <strong>Endere&ccedil;o: </strong><span>'.strtoupper($lin3->endereco.' - '.$lin3->apto.' - '.$lin3->complemento.' - '.$lin3->edificio_complemento).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Bairro: </strong><span>'.strtoupper($lin3->bairro).'</span>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-xs-3">
                                    <strong>Loteamento: </strong><span>'.strtoupper($lin3->loteamento).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Cidade: </strong><span>'.strtoupper($lin3->cidade).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Estado: </strong><span>'.strtoupper($lin3->estado).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Tipo de Obra: </strong><span>'.strtoupper($lin3->tipo_obra).'</span>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-xs-3">
                                    <strong>Garagem: </strong><span>'.strtoupper($lin3->garagem).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Lote: </strong><span>'.strtoupper($lin3->lote).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Quadra: </strong><span>'.strtoupper($lin3->quadra).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Fra&ccedil;&atilde;o: </strong><span>'.strtoupper($lin3->fracao).'</span>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-xs-3">
                                    <strong>&Aacute;rea Lote: </strong><span>'.strtoupper($lin3->area_lote).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>&Aacute;rea Unidade: </strong><span>'.strtoupper($lin3->area_unidade).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>&Aacute;rea Englobada: </strong><span>'.strtoupper($lin3->area_englobada).'</span>
                                </div>
                                <div class="col-xs-3">
                                    <strong>&Aacute;rea Constru&iacute;da: </strong><span>'.strtoupper($lin3->area_construida).'</span>
                                </div>
                            </div>
                            <br>';
                            
                            //buscando os dados do contribuinte
                            $sql4 = "SELECT nome,codigo,cpf_cnpj FROM contribuinte WHERE idcontribuinte = ".$lin3->contribuinte."";
                            $res4 = mysql_query($sql4);
                            $ret4 = mysql_num_rows($res4);
                            
                                if($ret4 > 0){
                                    $lin4 = mysql_fetch_object($res4);
                                    
                                    echo'
                                    <div class="row invoice-info">
                                        <div class="col-xs-12 bord">
                                            <span class="lead"><strong>INFORMA&Ccedil;&Otilde;ES DO CONTRIBUINTE</strong></span>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row invoice-info">
                                        <div class="col-xs-4">
                                            <strong>Nome: </strong><span>'.strtoupper($lin4->nome).'</span>
                                        </div>
                                        <div class="col-xs-4">
                                            <strong>C&oacute;digo: </strong><span>'.strtoupper($lin4->codigo).'</span>
                                        </div>
                                        <div class="col-xs-4">
                                            <strong>CPF/CNPJ: </strong><span>'.strtoupper($lin4->cpf_cnpj).'</span>
                                        </div>
                                    </div>';
                                }
                            
                            unset($sql4,$res4,$ret4,$lin4);
                        }
                    
                    unset($sql3,$res3,$ret3,$lin3);
                }
            
            unset($sql2,$res2,$ret2,$lin2,$guiarequerimento,$dia,$mes,$ano);
        }else{
            echo'<p class="text-center lead">Nada encontrado nesse protocolo</p>';
        }

    unset($conexao,$charset,$sql,$res,$ret,$lin,$guiaprotocolo);
?>