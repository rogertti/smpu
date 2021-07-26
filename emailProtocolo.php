<?php
    require_once('phpmailer/PHPMailerAutoload.php');
    include_once('conexao.php');

    $sql = "SELECT idprotocolo,codigo FROM protocolo WHERE idprotocolo = ".$_POST['idprotocolo']."";
    $res = mysql_query($sql);
    $ret = mysql_num_rows($res);

        if($ret != 0) {
            $lin = mysql_fetch_object($res);

            //selecionando os dados do requerimento
            $sql2 = "SELECT requerimento.requerente,requerimento.email FROM requerimento,protocolo WHERE requerimento.idrequerimento = protocolo.requerimento_idrequerimento AND protocolo.idprotocolo = ".$lin->idprotocolo."";
            $res2 = mysql_query($sql2);
            $ret2 = mysql_num_rows($res2);

                if($ret2 != 0) {
                    $lin2 = mysql_fetch_object($res2);
                }

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
                        O seu processo sob o protocolo n&uacute;mero <strong>'.$lin->codigo.'</strong> est&aacute; apto para retirada junto &agrave; Secretaria Municipal de Planejamento Urbano.
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
            $mail->Subject  = "Retirada do protocolo ".$lin->codigo; // Assunto da mensagem
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

            /*ini_set('SMTP','smtp.camboriu.sc.gov.br');
            ini_set('smtp_port',587);

            $nome = "SMPU";
            $remetente = "protocolo.smpu@camboriu.sc.gov.br";
            $assunto = "Retirada do protocolo ".$lin->codigo;
            $header = implode("\n",array("From: $nome <$remetente>","Subject: $assunto","Return-Path: $remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=utf-8"));
            
                if(!mail($lin2->email,$assunto,$conteudo,$header)) {
                    echo'E-mail n&atilde;o enviado.';
                }
                else {
                    echo'true';
                }

            unset($nome,$remetente,$assunto,$header,$conteudo);*/
        }

    mysql_close($conexao);
    unset($conexao,$charset,$sql,$res,$ret,$lin,$sql2,$res2,$ret2,$lin2);
?>
