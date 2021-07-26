GERENCIADOR DE PROTOCOLOS DA SECRETARIA DE PLANEJAMENTO DE CAMBORIÚ

---------

# O que é isso?

O programa visa suprir a necessidade encontrada na secretaria referente ao controle de protocolos gerados pela mesma.
Antes disso tudo era feito manualmente, gerando baixa produtividade, extravios, conflitos e falta de comunicação, o
que estava acarretando reclamações por parte dos contribuintes.
O gerenciador está apto a controlar todos os eventos que acontecem na secretaria, tudo é armazenado em banco de dados
e fica disponível a todos os funcionários imediatamente, tornando a comunicação interna excelente.

# Como funciona?

O programa foi escrito em PHP de forma procedural, MYSQL, HTML, CSS, JAVASCRIPT e funciona basicamente em tríades e tétrades de arquivos,
cada funcionário(usuário) é cadastrado pelo secretário(administrador) que libera o nível de acesso.

# Mapa de pastas e arquivos

As extensões PHP foram omitidas para uma melhor visualização;
O sinal de interrogacão(?), significa que o arquivo em questão pode ser acessado de qualquer lugar;

* Pasta bd

Armazena os arquivos de back up e o modelo relacional do banco.

* Pasta css

Contém os arquivos CSS, esses arquivos são responsáveis pela forma, cores, tipografia, etc.

* Pasta doc

Posui arquivos brutos que foram lapidados pelo programa.

* Pasta fiscal

Guarda as fotos tiradas no momento da fiscalização de uma obra.

* Pasta fonts

Armazena as fontes usada na tipografia CSS.

* Pasta habitese

Guarda as fotos tiradas no momento da fiscalização de uma obra.

* Pasta img

Contém imagens utilizadas no programa.

* Pasta js

Os arquivos JAVASCRIPT são armazenas nessa pasta.

---------

* Entrar

    index -> login -> inicio

* Relembrar a senha

    index -> recoverSenha
    
* Verificar a autenticidade de um documento

    index -> trust
    
* Perfil

    ? -> profile -> updateFuncionario -> relacaoFuncionario
    
* Back up

    ? -> backup -> inicio
    
* Item da infração

    - Todas as infrações

        ? -> infracao
        
    - Nova infração
    
        infracao -> novaInfracao -> insertInfracao -> infracao
    
    - Editar uma infração
    
        infracao -> editaInfracao -> updateInfracao -> infracao
    
    - Excluir uma infração
    
        infracao -> deleteInfracao -> infracao

* Item do habite-se

    - Todas os itens do habite-se

        ? -> habitese
        
    - Novo item do habite-se
    
        habitese -> novaItemHabitese -> insertItemHabitese -> habitese
    
    - Editar um item do habite-se
    
        habitese -> editaItemHabitese -> updateItemHabitese -> habitese
    
    - Excluir um item do habite-se
    
        habitese -> deleteItemHabitese -> habitese

* Sair

    sair -> index

* Protocolo

    - Todos os protocolos
    
        inicio
    
    - Novo protocolo
    
        ? -> novoProtocolo -> insertProtocolo -> inicio
    
    - Enviar protocolo por e-mail
    
        inicio -> emailProtocolo -> inicio
        
    - Imprimir um protocolo
    
        inicio -> printProtocolo -> inicio
        
    - Dados de um protocolo
    
        inicio -> dadosProtocolo
        
    - Editar um protocolo
    
        inicio -> editaProtocolo -> updateProtocolo -> inicio
    
    - Excluir um protocolo
    
        inicio -> deleteProtocolo -> inicio
    
    - Buscar um protocolo pelo número
    
        ? -> search -> editaProtocolo -> updateProtocolo -> inicio
        ? -> search -> printProtocolo -> inicio
    
    - Buscar um protocolo pela inscrição do imóvel
    
        ? -> search -> editaProtocolo -> updateProtocolo -> inicio
        ? -> search -> dadosProtocolo
        ? -> search -> printProtocolo -> inicio
    
    - Buscar um protocolo pelo nome do contribuintes
    
        ? -> search -> searchOdd -> editaProtocolo -> updateProtocolo -> inicio
        ? -> search -> searchOdd -> dadosProtocolo
        ? -> search -> searchOdd -> printProtocolo -> inicio
        ? -> search -> searchOdd -> deleteProtocolo -> inicio
        
* Imóvel

    - Todos os imóveis
    
        ? -> relacaoImovel
    
    - Novo imóvel
    
        ? -> novoImovel -> insertImovel -> relacaoImovel
        
    - Dados de um imóvel
    
        relacaoImovel -> dadosImovel
        
    - Editar um imóvel
    
        relacaoImovel -> editaImovel -> updateImovel -> relacaoImovel
    
    - Excluir um imóvel
    
        relacaoImovel -> deleteImovel -> relacaoImovel
        
* Arquiteto/Engenheiro

    - Todos os arquitetos/engenheiros
    
        ? -> relacaoEngenheiro
    
    - Novo arquiteto/engenheiro
    
        ? -> novoEngenheiro -> insertEngenheiro -> relacaoEngenheiro
        
    - Dados de um arquiteto/engenheiro
    
        relacaoEngenheiro -> dadosEngenheiro
        
    - Editar um arquiteto/engenheiro
    
        relacaoEngenheiro -> editaEngenheiro -> updateEngenheiro -> relacaoEngenheiro
    
    - Excluir um arquiteto/engenheiro
    
        relacaoEngenheiro -> deleteEngenheiro -> relacaoEngenheiro

* Funcionário

    - Todos os funcionários
    
        ? -> relacaoFuncionario
    
    - Novo funcionário
    
        ? -> novoFuncionario -> insertFuncionario -> relacaoFuncionario
        
    - Dados de um funcionário
    
        relacaoFuncionario -> dadosFuncionario
        
    - Editar um funcionário
    
        relacaoFuncionario -> editaFuncionario -> updateFuncionario -> relacaoFuncionario
    
    - Excluir um funcionário
    
        relacaoFuncionario -> deleteFuncionario -> relacaoFuncionario

* Requerimento

    - Todos os requerimentos
    
        ? -> relacaoRequerimento
    
    - Novo requerimento
    
        ? -> novoRequerimento -> insertRequerimento -> relacaoRequerimento
        
    - Dados de um requerimento
    
        relacaoRequerimento -> dadosRequerimento
    
    - Imprimir um requerimento
    
        relacaoRequerimento -> dadosRequerimento
        
    - Editar um requerimento
    
        relacaoRequerimento -> editaRequerimento -> updateRequerimento -> relacaoRequerimento
    
    - Excluir um requerimento
    
        relacaoRequerimento -> deleteRequerimento -> relacaoRequerimento
    
    - Relatório dos requerimentos
    
        ? -> relatorioRequerimento -> printRelatorioRequerimento -> relacaoRequerimento

* Análise de projeto

    - Todas as análises
    
        ? -> relacaoAnalise
    
    - Nova análise
    
        ? -> novaAnalise -> insertAnalise -> relacaoAnalise
    
    - Enviar análise por e-mail
    
        relacaoAnalise -> emailAnalise -> relacaoAnalise
        
    - Imprimir uma análise
    
        relacaoAnalise -> printAnalise -> relacaoAnalise
        
    - Dados de uma análise
    
        relacaoAnalise -> dadosAnalise
        
    - Editar uma análise
    
        relacaoAnalise -> editaAnalise -> updateAnalise -> relacaoAnalise
    
    - Excluir uma análise
    
        relacaoAnalise -> deleteAnalise -> relacaoAnalise

* Fiscalização

    - Todas as notificações
    
        ? -> relacaoNotificacao
    
    - Nova notificação
    
        ? -> novaNotificacao -> insertNotificacao -> relacaoNotificacao
        
    - Imprimir uma notificação
    
        relacaoNotificacao -> printNotificacao -> relacaoNotificacao
        
    - Dados de uma notificação
    
        relacaoNotificacao -> dadosNotificacao
        
    - Editar uma notificação
    
        relacaoNotificacao -> editaNotificacao -> updateNotificacao -> relacaoNotificacao
    
    - Excluir uma notificação
    
        relacaoNotificacao -> deleteNotificacao -> relacaoNotificacao
    
    - Embargar uma obra
    
        relacaoNotificacao -> novoEmbargo -> insertEmbargo -> relacaoNotificacao
    
    - Desembargar uma obra ou editar embargo
    
        relacaoNotificacao -> editaEmbargo -> updateEmbargo -> relacaoNotificacao
    
    - Corrigir uma notificacão
    
        relacaoNotificacao -> corrigeNotificacao -> relacaoNotificacao

* Habite-se

    - Todas os habite-ses

        ? -> relacaoHabitese
        
    - Novo habite-se
    
        ? -> novoHabitese
    
    - Dados de um habite-se
    
        relacaoHabitese -> dadosHabitese
    
    - Imprimir um habite-se
    
        relacaoHabitese -> printHabitese
    
    - Editar um habite-se
    
        relacaoHabitese -> editaHabitese -> updateHabitese -> relacaoHabitese
    
    - Excluir um habite-se
    
        relacaoHabitese -> deleteHabitese -> relacaoHabitese