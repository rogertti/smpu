<?php
    $msgnull = 'Algum campo obrigat&oacute;rio est&aacute; vazio.';
    
    if (empty($_POST['rand'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['ultimo_usuario'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['autentico'])) { echo'Vari&aacute;vel de controle nula.'; exit; }
    if (empty($_POST['requerimento'])) { echo $msgnull; exit; } else { $filtro = 1; }
    if (empty($_POST['codigo'])) { echo $msgnull; exit; } else { $filtro++; }
    if (empty($_POST['situacao'])) { echo $msgnull; exit; } else { $filtro++; }
    
    if ($filtro == 3) {
        //n„o permitir ' ou "
        $_POST['situacao'] = str_replace("'","&#39;",$_POST['situacao']);
        $_POST['situacao'] = str_replace('"','&#34;',$_POST['situacao']);
        $_POST['observacao'] = str_replace("'","&#39;",$_POST['observacao']);
        $_POST['observacao'] = str_replace('"','&#34;',$_POST['observacao']);
        
        //trantando a taxa
        $_POST['taxa'] = str_replace(',','',$_POST['taxa']);
        
        //tratando a chave
        $_POST['autentico'] = substr($_POST['autentico'],0,10);
        
        include_once('conexao.php');
        
        //verifica se cadastro já existe
        $sql = "SELECT codigo FROM protocolo WHERE codigo = '".$_POST['codigo']."' OR requerimento_idrequerimento = ".$_POST['requerimento']."";
        $res = mysql_query($sql);
        $ret = mysql_num_rows($res);
            
            if ($ret != 0) {
                echo'Protocolo j&aacute; cadastrado. Verifique se o requerimento n&atilde;o possui protocolo aberto.'; exit;
            }
            
        unset($sql,$res,$ret);
        
        $sql = "INSERT INTO protocolo (requerimento_idrequerimento,codigo,taxa,situacao,observacao,monitor,autentico,ultimo_usuario) VALUES (".$_POST['requerimento'].",'".$_POST['codigo']."','".$_POST['taxa']."','".$_POST['situacao']."','".$_POST['observacao']."','O','".$_POST['autentico']."','".$_POST['ultimo_usuario']."')";
        $res = mysql_query($sql);
        
            if (!$res) {
                echo'Tente novamente.'; exit;
            }
            else {
                //e-mail
                $sql2 = "SELECT requerente,email,recolhimento,entrada,hora FROM requerimento WHERE idrequerimento = '".$_POST['requerimento']."'";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);
                    
                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        
                        //invertendo data 00/00/0000   
                        $ano = substr($lin2->entrada,0,4);
                        $mes = substr($lin2->entrada,5,2);
                        $dia = substr($lin2->entrada,8);
                        $lin2->entrada = $dia."/".$mes."/".$ano;
                        
                        ini_set('SMTP','smtp.camboriu.sc.gov.br');
                        ini_set('smtp_port',587);
                        
                        $nome = "SMPU";
                        $remetente = "protocolo.smpu@camboriu.sc.gov.br";
                        $assunto = "Abertura do protocolo ".$_POST['codigo'];
                        $header = implode("\n",array("From: $nome <$remetente>","Subject: $assunto","Return-Path: $remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=utf-8"));
                        $conteudo = '
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <meta charset="UTF-8">
                            <title></title>
                            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
                            <style>
                                body {
                                    -webkit-font-smoothing: antialiased; 
                                    -webkit-text-size-adjust: none; width: 100% !important; 
                                    height: 100%; 
                                    line-height: 1.6;
                                    font-family: "Source Sans Pro",Helvetica Neue,Helvetica,Arial,sans-serif;
                                    font-size: 14px;
                                    background-color: #f6f6f6;
                                }

                                img {
                                    max-width: 100%;
                                }
                            </style>
                        </head>
                        <body>
                            <h3>Prezado(a) Senhor(a) '.$lin2->requerente.'.</h3>
                            
                            <div>
                                <p>
                                    Voc&ecirc; abriu um protocolo na secretaria de planejamento urbano de Cambori&uacute; no dia <strong>'.$lin2->entrada.'</strong> &agrave;s <strong>'.$lin2->hora.'</strong> h.<br/>
                                    O n&uacute;mero do seu protocolo &eacute; o <strong>'.$_POST['codigo'].'</strong>, referente a <strong>'.$lin2->recolhimento.'</strong>.<br/><br/>
                                </p>
                                <p>
                                    Atenciosamente,<br/>
                                    Prefeitura Municipal de Cambori&uacute;<br/>
                                    Secretaria de Planejamento Urbano<br/><br/>
                                    <img src="http://smpu.camboriu.sc.gov.br/img/flag.jpg" />
                                </p>
                            </div>
                        </body>
                        </html>';
                        
                        mail($lin2->email,$assunto,$conteudo,$header);   

                        unset($nome,$remetente,$assunto,$header,$conteudo,$ano,$mes,$dia);
                    }
                
                unset($sql2,$res2,$ret2,$lin2);
                
                //impressão
                $sql2 = "SELECT idprotocolo FROM protocolo WHERE codigo = '".$_POST['codigo']."'";
                $res2 = mysql_query($sql2);
                $ret2 = mysql_num_rows($res2);

                    if ($ret2 != 0) {
                        $lin2 = mysql_fetch_object($res2);
                        $idprotocolo = $lin2->idprotocolo;
                        $pyprotocolo = md5('idprotocolo');
                        echo'<script>document.location = "printProtocolo.php?'.$pyprotocolo.'='.$idprotocolo.'"</script>';
                    }
                    else {
                        echo'true';
                    }
            }
    
        mysql_close($conexao);
        unset($conexao,$charset,$sql,$res,$ret,$filtro,$msgnull,$sql2,$res2,$ret2,$lin,$idprotocolo,$pyprotocolo);   
    }
    else {
        echo'Tente novamente.'; 
    }
?>