<?php
    require_once('phpmailer/PHPMailerAutoload.php');
    include_once('conexao.php');

    #$pyanalise = md5('idanalise');                    
    $sql = "SELECT * FROM analise WHERE idanalise = 486";
    #$sql = "SELECT * FROM analise WHERE idanalise = ".$_POST['idanalise']."";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);

        if($ret != 0) {
            $lin = mysql_fetch_object($res);
            $conteudo = '';
            
            if(!empty($lin->datado)) {
                //invertendo a data 00/00/0000
                $ano = substr($lin->datado,0,4);
                $mes = substr($lin->datado,5,2);
                $dia = substr($lin->datado,8);
                $lin->datado = $dia."/".$mes."/".$ano;
            }
            
            //selecionando os dados do protocolo
            $sql2 = "SELECT protocolo.codigo,imovel.inscricao,contribuinte.nome,requerimento.requerente,requerimento.construcao,requerimento.area,imovel.endereco,imovel.apto,imovel.complemento,imovel.edificio_condominio,imovel.bairro,imovel.lote,imovel.quadra,imovel.loteamento,requerimento.email FROM contribuinte,imovel,requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND imovel.idimovel = requerimento.imovel_idimovel AND contribuinte.idcontribuinte = imovel.contribuinte_idcontribuinte AND protocolo.idprotocolo = ".$lin->protocolo_idprotocolo."";
            $res2 = mysql_query($sql2);
            $ret2 = mysql_num_rows($res2);

                if($ret2 != 0) {
                    $lin2 = mysql_fetch_object($res2);
                    
                    /*if(empty($lin2->email)) {
                        echo'N&atilde;o foi cadastrado nenhum email no requerimento.';
                        exit;
                    }*/
                    
                    $conteudo .= '
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

                            pre {
                                font-family: "Source Sans Pro",Helvetica Neue,Helvetica,Arial,sans-serif;
                            }

                            table {
                                width: 100%;
                                border-collapse: collapse;
                                font-family: "Source Sans Pro",Helvetica Neue,Helvetica,Arial,sans-serif;
                                font-size: 14px;

                            }

                            table tr {
                                height: 36px;
                                border-bottom: 1px solid #ddd;
                            }

                            table th {
                                text-align: left;
                            }
                        </style>
                    </head>
                    <body>
                        <div>
                            <table>
                                <tr><th>Protocolo</th><td>'.$lin2->codigo.'</td><th>Endere&ccedil;o</th><td>'.$lin2->endereco.' - '.$lin2->apto.' - '.$lin2->complemento.' - '.$lin2->edificio_condominio.' - '.$lin2->bairro.'</td></tr>
                                <tr><th>Inscri&ccedil;&atilde;o</th><td>'.$lin2->inscricao.'</td><th>Lote</th><td>'.$lin2->lote.'</td></tr>
                                <tr><th>Propriet&aacute;rio</th><td>'.$lin2->nome.'</td><th>Quadra</th><td>'.$lin2->quadra.'</td></tr>
                                <tr><th>Requerente</th><td>'.$lin2->requerente.'</td><th>Loteamento</th><td>'.$lin2->loteamento.'</td></tr>
                                <tr><th>Tipo de obra</th><td>'.$lin2->construcao.'</td><th>&Aacute;rea</th><td>'.$lin2->area.' m&sup2;</td></tr>
                                <tr><th>Situa&ccedil;&atilde;o</th><td>'.$lin->situacao.'</td><th>ART/RRT</th><td>'.$lin->art_rrt.'</td></tr>
                                <tr><th>Respons&aacute;vel</th><td>'.$lin->responsavel.'</td><th>Parecer</th><td>'.$lin->parecer.'</td></tr>
                                <tr><th>Data da an&aacute;lise</th><td>'.$lin->datado.'</td></tr>
                                <tr><td></td></tr>
                                <tr><th>Projeto Arquitet&ocirc;nico</th><td colspan="3"><pre class="prefy">'.html_entity_decode($lin->arquitetonico).'</pre></td></tr>
                                <tr><th>Projeto Hidrosanit&aacute;rio</th><td colspan="3"><pre class="prefy">'.html_entity_decode($lin->hidrosanitario).'</pre></td></tr>
                            </table>';

                            if($lin->parecer == 'Com pendências') {
                                $conteudo .= '
                                <p>
                                    <span><strong>Observa&ccedil;&otilde;es:</strong></span><br><br>
                                    <span>&bull; N&atilde;o ser&atilde;o aceitos colagens, corretivos e rasuras a m&atilde;o livre nos projetos;</span><br>
                                    <span>&bull; O projeto ser&aacute; reanalisado, podendo ter novas altera&ccedil;&otilde;es conforme rean&aacute;lise;</span><br>
                                    <span>&bull; O projeto submetido a pre-an&aacute;lise, an&aacute;lise ou rean&aacute;lise, ser&aacute; devolvido no prazo máximo de 20 dias &uacute;teis, conforme lei municipal;</span><br/>
                                    <span><strong><i>Os prazos podem ser prorrogados por igual per&iacute;odo, a crit&eacute;rio da autoridade competente.</i></strong></span>
                                <p>';
                            }

                            $conteudo .= '
                            <p>
                                Atenciosamente,<br/>
                                Prefeitura Municipal de Cambori&uacute;<br/>
                                Secretaria de Planejamento Urbano<br/><br/>
                                <img src="http://smpu.camboriu.sc.gov.br/img/flag.jpg" />
                            </p>
                        </div>
                    </body>
                    </html>';

                    $mail = new PHPMailer();
                    $mail->IsSMTP(); // Define que a mensagem será SMTP
                    $mail->Host = "smtp.camboriu.sc.gov.br"; // Endereço do servidor SMTP
                    $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
                    $mail->Username = 'protocolo.smpu@camboriu.sc.gov.br'; // Usuário do servidor SMTP
                    $mail->Password = 'smpu9500'; // Senha do servidor SMTP
                    //$mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    // Define o remetente
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->From = "protocolo.smpu@camboriu.sc.gov.br"; // Seu e-mail
                    $mail->FromName = "Theodora"; // Seu nome
                    // Define os destinatário(s)
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->AddAddress($lin2->email);
                    $mail->AddCC('arquiteta.theodora@gmail.com'); // Copia
                    //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
                    // Define os dados técnicos da Mensagem
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
                    //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
                    // Define a mensagem (Texto e Assunto)
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    $mail->Subject  = "Análise de projeto, protocolo ".$lin2->codigo; // Assunto da mensagem
                    $mail->Body = $conteudo;
                    $mail->AltBody = "";
                    // Define os anexos (opcional)
                    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
                    //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
                    // Envia o e-mail
                    $enviado = $mail->Send();
                    // Limpa os destinatários e os anexos
                    $mail->ClearAllRecipients();
                    $mail->ClearAttachments();

                        if(!$enviado) {
                            echo'E-mail n&atilde;o enviado. '.$mail->ErrorInfo;
                        }
                        else {
                            echo'true';
                        }

                    /*ini_set('SMTP','smtp.cidadedecamboriu.sc.gov.br');
                    #ini_set('SMTP','smtp.uni5.net');
                    ini_set('smtp_port',587);

                    $nome = "SMPU";
                    $remetente = "protocolo.smpu@camboriu.sc.gov.br";
                    $nome_cc = "Theodora";
                    $email_cc = "arquiteta.theodora@gmail.com";
                    $assunto = "Análise de projeto, protocolo ".$lin2->codigo;
                    $header = implode("\n",array("From: $nome <$remetente>","Subject: $assunto","Return-Path: $remetente","Cc: $nome_cc <$email_cc>","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=utf-8"));

                        if(!mail($lin2->email,$assunto,$conteudo,$header)) {
                            echo'E-mail n&atilde;o enviado.';
                        }
                        else {
                            echo'true';
                        }

                    unset($nome,$remetente,$assunto,$header,$conteudo,$dia,$mes,$ano,$nome_cc,$email_cc);*/
                }
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2,$pyanalise);
?>
