<?
class Trans
{	

/*
/// CLASSE DE AVISOS
// Esta classe contem os avisos de a��o, como ao tentar criar uma conta com um E-mail j� existente
// Para usar ultilize a fun��o getWarning('nome.aviso')
*/

	private $warnings = array
	(
		/*
		/// AVISOS GERAIS
		// Estes avisos podem aparecer em qualquer tipo de modulo
		*/
		'geral.entradasReservadas' => array(
			'br' => array(
				'title' => 'Entradas reservadas.',
				'msg' => 'Os campos foram preenchidos com entradas reservadas, de uso interno do sistema, por favor, tente novamente com outro tipo de entradas.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')	
		),
		
		'geral.camposVazios' => array(
			'br' => array(
				'title' => 'Campos vazios.',
				'msg' => 'Voc� n�o digitou corretamente todos campos necessarios em seu formulario, por favor, tente novamente.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			
	
		'geral.emailInvalido' => array(
			'br' => array(
				'title' => 'E-mail invalido.',
				'msg' => 'Este n�o � um endere�o de e-mail valido ou existente, para criar sua conta � necessario preencher o formulario com um endere�o de e-mail valido e existente.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'geral.emailInvalido2' => array(
			'br' => array(
				'title' => 'E-mail invalido.',
				'msg' => 'Este n�o � um endere�o de e-mail valido, por favor, tente novamente com outro endere�o e-mail.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		

		'geral.emailFalhou' => array(
			'br' => array(
				'title' => 'Falha ao enviar e-mail.',
				'msg' => 'Ouve uma falha ao tentar lhe enviar o e-mail, desculpe pelo transtorno, tente novamente mais tarde.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'geral.falhaConfPass' => array(
			'br' => array(
				'title' => 'Senha incorreta!',
				'msg' => 'A senha informada para confirma��o est� incorreta, para efetuar esta opera��o � necessario confirmar a senha por motivos de seguran�a.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'geral.sendEmailError' => array(
			'br' => array(
				'title' => 'Falha ao enviar email',
				'msg' => 'Ouve uma falha em nosso servidor de emails que impossibilitou o envio do seu email. A ultima opera��o foi anulada. Tente novamente mais tarde.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),				
		
		/*
		/// AVISOS LOGIN
		// Estes avisos aparecem ao efetuar o login
		*/	
		'login.contaSenhaIncorreta' => array(
			'br' => array(
				'title' => 'Conta ou senha incorreta.',
				'msg' => 'A conta e (ou) senha est�o incorretas, por favor tente novamente.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),
	
		/*
		/// AVISOS CONTAS
		// Estes avisos aparecem ao criar uma conta e em modulos relacionados a conta
		*/
		'contas.emailExistente' => array(
			'br' => array(
				'title' => 'E-mail existente.',
				'msg' => 'Este e-mail j� existe em outra conta, por favor, tente novamente utilizando outro e-mail.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'contas.emailChanged' => array(
			'br' => array(
				'title' => 'E-mail modificado com sucesso',
				'msg' => 'O e-mail registrado em sua conta foi modificado com sucesso.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
	
		'contas.naoExiste' => array(
			'br' => array(
				'title' => 'Conta inexistente!',
				'msg' => 'A conta informada n�o existe no banco de dados, para efetuar esta opera��o � necessario entrar com uma conta valida.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
	
		'contas.sucesso' => array(
			'br' => array(
				'title' => 'Conta criada com sucesso!',
				'msg' => array ('Parabens! A sua conta foi criada com sucesso! O numero de sua conta �: <big>','</big>. <br> Foi enviado um email informativo com os dados de acesso de sua conta ao endere�o de email <b></b>. <br><br>Tenha um bom jogo!')
			),
			'us' => array(
				'title' => '',
				'msg' => '')		
		),
		
		'contas.termoQuestoes' => array(
			'br' => array(
				'title' => 'Termos n�o aceitos.',
				'msg' => 'Para configurar as perguntas e respostas em sua conta � necessario aceitar com os termos de uso e seguran�a que voc� deve ter com estas informa��es.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'contas.umaPergunta' => array(
			'br' => array(
				'title' => 'Quantidade de perguntas e respostas.',
				'msg' => 'Para configurar as perguntas e respostas corretamente em sua conta � necessario preencher ao menos a primeira pergunta e resposta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'contas.caracteresPerguntas' => array(
			'br' => array(
				'title' => 'Quantidade de caracteres.',
				'msg' => 'As perguntas e respostas devem possuir entre 5 e 35 caracteres.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'contas.perguntasRespostasSucesso' => array(
			'br' => array(
				'title' => 'Pergunta(s) e Resposta(s) configuradas com sucesso!',
				'msg' => 'As perguntas e respostas foram configuradas corretamente de acordo com os dados informados. A partir de agora sua conta possui um grau de seguran�a maior.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		

		/*
		/// AVISOS RECUPERA��O DE CONTA
		// Estes avisos aparecem ao recuperar a conta
		*/			
		
		'recovery.contaIncorreta' => array(
			'br' => array(
				'title' => 'Conta incorreta',
				'msg' => 'O numero de conta informado n�o consta em nosso banco de dados.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'recovery.senhaIncorreta' => array(
			'br' => array(
				'title' => 'Senha incorreta',
				'msg' => 'A senha informado n�o corresponde a senha da conta deste personagem.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			

		'recovery.emailIncorreto' => array(
			'br' => array(
				'title' => 'E-mail incorreto',
				'msg' => 'O endere�o de e-mail informado nao corresponde ao endere�o de e-mail criado para esta conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'recovery.keyErro' => array(
			'br' => array(
				'title' => 'Chave invalida',
				'msg' => 'A chave de gera��o de nova senha digitada para esta conta est� incorreta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		

		'recovery.AccDontHaveKey' => array(
			'br' => array(
				'title' => 'Chave invalida',
				'msg' => 'N�o existe uma chave de recupera��o para esta conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),				

		'recovery.passwordSucesso' => array(
			'br' => array(
				'title' => 'Senha recuperada com sucesso!',
				'msg' => 'Foi enviado uma mensagem ao e-mail cadastrado em sua conta contendo as informa��es necessarias para gerar uma nova senha.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'recovery.accountSucesso' => array(
			'br' => array(
				'title' => 'Conta recuperada com sucesso!',
				'msg' => 'Foi enviado um lembrete do numero de sua conta ao e-mail cadastrado em sua conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'maxTriesBlocked' => array(
			'br' => array(
				'title' => 'Recurso bloqueado',
				'msg' => 'Est� conta recebeu tr�s erros nas respostas secretas e por motivos de seguran�a este recurso foi bloqueado para est� conta pelas proximas 24 horas.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'questionIncorrect' => array(
			'br' => array(
				'title' => 'Resposta incorreta',
				'msg' => 'Uma ou mais de suas respostas est�o incorretas. Este recurso ser� bloqueado por 24h caso voc� torne a errar as respostas mais'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'questionRemoved' => array(
			'br' => array(
				'title' => 'Perguntas e Respostas removidas com sucesso',
				'msg' => 'Todas as perguntas e respostas configuradas em sua conta foram removidas com sucesso! Para registrar novas perguntas e respostas agora basta acessar sua conta e clicar no bot�o "Set Questions" localizado abaixo das informa��es de seguran�a de sua conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'questionNonAccept' => array(
			'br' => array(
				'title' => 'N�o possui este recurso',
				'msg' => 'Est� conta n�o possui perguntas e respostas configuradas corretamente, este recurso est� inutilizavel por esta conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			

		'recovery.bothSucesso' => array(
			'br' => array(
				'title' => 'Conta recuperada com sucesso!',
				'msg' => 'Foi enviado um lembrete do numero de sua conta e um link para gerar uma nova senha ao e-mail cadastrado em sua conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'beneficts_errorAgree' => array(
			'br' => array(
				'title' => 'Clausulas e Regras de Contribui��o!',
				'msg' => 'Infelizmente voc� s� est� permitido a efetuar uma contribui��o com a UltraxSoft se aceitar nossas clausulas e regras para este servi�o.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'recovery.newpasswordSucesso' => array(
			'br' => array(
				'title' => 'Senha gerada com sucesso!',
				'msg' => 'Foi enviado uma mensagem ao e-mail cadastrado em sua conta contendo sua nova senha.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),				

		/*
		/// AVISOS PERSONAGENS
		// Estes avisos aparecem ao criar um personagem
		*/	
		'char.nomeInvalido' => array(
			'br' => array(
				'title' => 'Formato do nome invalido.',
				'msg' => 'O nome escolhido para seu personagem possui um modelo de formata��o n�o permitida, tente novamente seguindo estas regras:<br><br> 
						<li>Seu nome n�o pode come�ar ou terminar com um \'espa�o\'.</li>
						<li>N�o use mais de um \'espa�os\' entre as palavras.</li>
						<li>N�o � permitido mais que tr�s palavras em seu nome.</li>
						<li>Somente s�o permitidos os caracteres: a-z, A-Z, espa�o, hifen (-) e aspas simples.</li>
						<li>O seu nome n�o deve possuir mais que 30 caracteres.</li>
						<li>O seu nome n�o deve possuir menos que 3 caracteres.</li>
						<li>A terceira palavra de seu nome n�o deve possuir menos que 3 caracteres.</li>
						<li>A primeira letra da primeira palavra de seu nome deve ser maiuscula.</li>
						<li>A primeira letra da terceira palavra de seu nome deve ser maiuscula.</li>'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			

		'char.nomeExistente' => array(
			'br' => array(
				'title' => 'Nome j� utilizado!',
				'msg' => 'O nome escolhido para seu personagem j� est� em uso em nosso banco de dados por outro jogador, por favor, tente outro nome.!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'char.erroDesconhecido' => array(
			'br' => array(
				'title' => 'Falha ao criar o personagem!',
				'msg' => 'Devido a uma falha critica n�o foi pessivel criar seu personagem, um relatorio do erro foi enviado a equipe, tente novamente mais tarde.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			
		
		'char.sucesso' => array(
			'br' => array(
				'title' => 'Personagem criado com sucesso!',
				'msg' => 'O seu personagem foi criado com sucesso! <br><br> Voc� j� pode come�ar a se divertir conosco, para jogar basta fazer o login no IP do servidor escolhido, para saber o IP do seu servidor acesse-o pelo nome no menu direito Servidores!<br><br>Desejamos uma boa divers�o!<br>Equipe UltraxSoft.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'char.preferencias.sucesso' => array(
			'br' => array(
				'title' => 'Prefer�ncias modificadas com sucesso!',
				'msg' => 'As pref�rencias de seu personagem foram modificadas com sucesso!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		

		'char.naoExiste' => array(
			'br' => array(
				'title' => 'Personagem n�o encontrado',
				'msg' => 'N�o foi encontrado nenhum personagem com o nome informado em nosso banco de dados. Note que o nome do personagem precisa ser digitado corretamente para ser encontrado.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),				
		
		/*
		/// AVISOS MUDAN�A DE SENHA
		// Estes avisos aparecem ao mudar senha
		*/			
		'changepass.antigaIncorreta' => array(
			'br' => array(
				'title' => 'Antiga senha incorreta!',
				'msg' => 'A confirma��o da antiga senha falhou, para modificar sua senha � necessario confirmar a antiga senha.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'changepass.confFalhou' => array(
			'br' => array(
				'title' => 'Confirma��o falhou!',
				'msg' => 'A confirma��o da nova senha falhou, por motivos de seguran�a � necessario confirmar a nova senha para efetuar a mudan�a.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'changepass.iguais' => array(
			'br' => array(
				'title' => 'Senhas identicas!',
				'msg' => 'A sua nova senha � identica a antiga senha, para modificar sua senha � necessario que a nova senha seja diferente da antiga senha.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'changepass.tamanhoInvalido' => array(
			'br' => array(
				'title' => 'Tamanho da senha invalido!',
				'msg' => 'A sua nova senha deve conter entre 5 e 25 caracteres.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'changepass.sucesso' => array(
			'br' => array(
				'title' => 'Senha modificada com sucesso!',
				'msg' => 'Sua senha foi modificada com sucesso! � recomendavel voc� sair e entrar novamente em sua conta para que ela seja atualizada com sucesso.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		/*
		/// AVISOS INFORMA��ES PESSOAIS
		// Estes avisos aparecem ao editar as informa��es pessoais da conta.
		*/			
		'containfo.tamanhoInvalido' => array(
			'br' => array(
				'title' => 'Tamanho das informa��es invalidos!',
				'msg' => 'As informa��es pessoais de sua conta devem conter no maximo 25 caracteres para nome real e localiza��o e 50 caracteres para url.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'containfo.sucesso' => array(
			'br' => array(
				'title' => 'Informa��es pessoais modificadas com sucesso!',
				'msg' => 'A mudan�a das informa��es pessoais desta conta foram efetuadas com sucesso!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		/*
		/// AVISOS MUDAN�A DE EMAIL
		// Estes avisos aparecem ao mudar o e-mail da conta
		*/			
		'changeemail.identico' => array(
			'br' => array(
				'title' => 'E-mails identicos!',
				'msg' => 'O novo e-mail � identico ao e-mail j� utilizado nesta conta, para que a mudan�a seja feita � necessario que o novo email seja diferente do atual.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),
		
		'changeemail.emailInvalido' => array(
			'br' => array(
				'title' => 'E-mail invalido!',
				'msg' => 'O novo e-mail n�o � um endere�o valido, esta mudan�a requer que o novo e-mail seja valido.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'changeemail.sucesso' => array(
			'br' => array(
				'title' => 'Modifica��o agendada com sucesso!',
				'msg' => 'A mudan�a de seu email foi agendada com sucesso!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'beneficts_characterError' => array(
			'br' => array(
				'title' => 'Error',
				'msg' => 'Character does not exist or uses syntaxes reserved.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			
		
		'changeemail.cancelSucesso' => array(
			'br' => array(
				'title' => 'Modifica��o de E-mail cancelada!',
				'msg' => 'A mudan�a de e-mail solicitada para sua conta foi cancelada com sucesso, agora n�o haver� mais nenhuma mudan�a.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'deletechar.charNaoExiste' => array(
			'br' => array(
				'title' => 'Problema ao tentar deletar!',
				'msg' => 'N�o foi encontrado um personagem com o nome especificado!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'deletechar.charNaoPosse' => array(
			'br' => array(
				'title' => 'Problema ao tentar deletar!',
				'msg' => 'O personagem especificado n�o � de sua posse!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'deletechar.sucess' => array(
			'br' => array(
				'title' => 'Personagem deletado!',
				'msg' => array('O personagem especificado ser� deletado daqui a ',' dias!')), 		
			'us' => array(
				'title' => '',
				'msg' => array('',''))		
		),
		
		'canceldeletechar.sucess' => array(
			'br' => array(
				'title' => 'O personagem n�o ser� mais deletado',
				'msg' => array('O personagem especificado <b>j� n�o ser� mais</b> deletado daqui a ',' dias!')), 		
			'us' => array(
				'title' => '',
				'msg' => array('',''))		
		),

		/*
		/// AVISOS DE PAGAMENTOS
		// Estes avisos aparecem nos modulos sobre Pagamentos
		*/			
		'payments.activationSuccess' => array(
			'br' => array(
				'title' => 'Pagamento Ativado!',
				'msg' => 'O pagamento foi ativado com sucesso! Foi enviado um e-mail para o jogador contendo as informa��es para ativa��o.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'payments.accepted' => array(
			'br' => array(
				'title' => 'Contribui��o confirmada!',
				'msg' => 'Parabens! Agora com sua contribui��o confirmada voc� pode j� desfrutar de todos beneficios disponiveis! Obrigado por contribuir e tenha um bom jogo!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'guilds.cantUseName' => array(
			'br' => array(
				'title' => 'Nome inv�lido',
				'msg' => 'J� existe uma guild com o nome especificado.'), 		
			'us' => array(
				'title' => 'Invalid name',
				'msg' => 'A guild with that name already exists.')		
		),
		
		'guilds.charNaoPosse' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => 'Personagem n�o encontrado em sua conta.'), 		
			'us' => array(
				'title' => 'Error',
				'msg' => 'Character not founded in your account.')		
		),
		
		'guilds.lowerLevel' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => array('O personagem selecionado n�o tem o level m�nimo de ', ' necess�rio.')), 		
			'us' => array(
				'title' => 'Error',
				'msg' => array('The selected character does not have the necessary level(', ').'))		
		),
		
		'guilds.wrongPassword' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => 'Password n�o confere.'), 		
			'us' => array(
				'title' => 'Error',
				'msg' => 'Password does not match.')		
		),
		
		'guilds.alreadyHaveGuild' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => 'Voc� j� tem ou faz parte de uma guilda.'), 		
			'us' => array(
				'title' => 'Error',
				'msg' => 'You already have or is a member of a guild.')		
		),
		
		'guilds.success' => array(
			'br' => array(
				'title' => 'Sucesso!',
				'msg' => 'Guild criada com sucesso!'), 		
			'us' => array(
				'title' => 'Success',
				'msg' => 'Guild created sucessfully')		
		),
		
		'guilds.disbanded' => array(
			'br' => array(
				'title' => 'Guilda debandada',
				'msg' => 'A guilda foi debandada com sucesso!'), 		
			'us' => array(
				'title' => 'Debanded guild',
				'msg' => 'Guild disbanded sucessfully')		
		),
		
		'guilds.notPremium' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => '� necess�rio que o player selecionado seja premium account.'), 		
			'us' => array(
				'title' => 'Error',
				'msg' => 'Is necessary that the selected player be a premium account.')		
		),
		
		'guilds.disbandConf' => array(
			'br' => array(
				'title' => 'Tem certeza disso?',
				'msg' => 'Tem certeza de que voc� deseja debandar sua guilda? Confirme esta a��o escrevendo sua senha abaixo:'),
			'us' => array(
				'title' => 'Area you sure?',
				'msg' => 'Area you sure if you want disband your guild? Please, confirm this action writing your password down:')
		),
		
		'guilds.passLeadership' => array(
			'br' => array(
				'title' => 'Tem certeza disso?',
				'msg' => 'Tem certeza de que voc� deseja passar a lideran�a de sua guilda? Confirme esta a��o escolhendo o novo l�der e escrevendo sua senha abaixo:'),
			'us' => array(
				'title' => 'Area you sure?',
				'msg' => 'Area you sure if you want pass the leadership of your guild? Please, confirm this action selecting a new leader and writing your password down:')
		),
		
		'guilds.passLeadershipSuccess' => array(
			'br' => array(
				'title' => 'Lideran�a transferida!',
				'msg' => 'A lideran�a de sua guilda foi transferida com sucesso!'),
			'us' => array(
				'title' => 'Leadership Transfered',
				'msg' => 'The Leadership of your guild was sucessfully transfered.')
		),
		
		'guilds.invalidRankName' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => 'O nome digitado para o rank cont�m caracteres/palavras invalidas!'),
			'us' => array(
				'title' => 'Error',
				'msg' => 'The name writed to the rank has invalid characters/words!')
		),
		
		'guilds.rankNameChanged' => array(
			'br' => array(
				'title' => 'Nome do Rank alterado',
				'msg' => 'O nome do rank foi alterado com sucesso!'),
			'us' => array(
				'title' => 'Rank name changed',
				'msg' => 'The name of the rank was sucessfully changed!')
		),
		
		'guilds.ranksNumbers' => array(
			'br' => array(
				'title' => 'N�mero de ranks redefinido',
				'msg' => 'O n�mero de ranks foi redefinido com sucesso!'),
			'us' => array(
				'title' => 'Number of ranks redefined',
				'msg' => 'The number of ranks was sucessfully redefined!')
		),
		
		'guilds.playerNotThisGuild' => array(
			'br' => array(
				'title' => 'Erro',
				'msg' => 'O personagem selecionado n�o foi encontrado em sua guilda.'),
			'us' => array(
				'title' => 'Error',
				'msg' => 'The selected character not was founded in your guild.')
		)
	);		

/*
/// CLASSE DE DESCRI��ES
// Est� classe � destinada a exibi��o de descri��es de paginas, como a descri��o na pagina de cria��o de contas
// Para usar ultilize a fun��o getDescription('nome.descri��o')
*/
	private $descriptions = array
	(
		//DESCRI��O DE PAGINAS ACCOUNT
		'account.register' => array(
			'br' => 'Crie sua conta agora mesmo e come�e a se divertir no Darghos! Para criar sua conta � apenas necessario ter um e-mail disponivel, pois as informa��es de sua conta ser�o enviadas a ele.',
			'us' => 'Create now your account and start fun in Darghos! To create a new account only is necessary have an e-mail disponible, because your account informations has sended to his.'),	
		
		'account.changepassword' => array(
			'br' => 'Atravez deste recurso voc� pode modificar a senha de sua conta sempre que achar necessario. N�s recomendamos que voc� modifique sua senha a cada 15 dias para maior seguran�a.',
			'us' => ''),	
			
		'account.login' => array(
			'br' => 'Efetue o login em sua conta e voc� podera trocar sua senha, trocar seu endere�o de email, criar um personagem, efetuar uma contribui��o entre outros recursos de manuseio de sua conta. N�o tem uma conta ainda? Clique <a href="?act=account.register">aqui</a> e crie a sua agora mesmo.',
			'us' => ''),		
			
		'account.main' => array(
			'br' => '<center><b>Bem vindo ao painel de administra��o e manuseio de sua conta.</b></center>',
			'us' => '<center><b>Welcome to management panel of your account.</b></center>'),				
	
		'account.changeinfos' => array(
			'br' => 'Modifique as informa��es pessoais de sua conta, essas informa��es estar�o visiveis a outros jogadores que acessarem a pagina de qualquer personagem desta conta. Para ocultar as informa��es pessoais apenas deixe os campos abaixo em branco.',
			'us' => ''),		
			
		'account.changeemail' => array(
			'br' => array('Voc� pode efetuar uma troca de e-mail registrado em sua conta, isto � importante em casos de perda de acesso a conta de e-mail. Por motivos de seguran�a esta mudan�a leva ', ' dias para ser completada. � importante lembrar que voc� poder� cancelar a mudan�a a qualquer momento antes dos ', ' dias pela pagina principal de administra��o de sua conta. Preencha os dados abaixo para solicitar uma mudan�a de e-mail registrada em sua conta.'),
			'us' => array('', '', '')),		
			
		'account.deletechar' => array(
			'br' => array('Voc� pode deletar um personagem que voc� n�o usa mais, para que voc� possa criar outros. Esta exclus�o demora ', ' dias para ser completada, por motivos de seguran�a neste per�odo de ', ' dias, voc� poder� cancelar a exclus�o do mesmo.'),
			'us' => array('', '', '')),
	
		'account.canceldeletechar' => array(
			'br' => array('Voc� pode deletar um personagem que voc� n�o usa mais, para que voc� possa criar outros. Esta exclus�o demora ', ' dias para ser completada, por motivos de seguran�a neste per�odo de ', ' dias, voc� poder� cancelar a exclus�o do mesmo.<br> Se deseja cancelar a exclus�o, preencha o formul�rio abaixo:'),
			'us' => array('', '', '')),
	
		'account.cancelchangeemail' => array(
			'br' => array('Atrav�s deste recurso voc� pode cancelar uma mudan�a de e-mail em at� ', ' dias antes da concretiza��o da mudan�a. Note este cancelamento s� estar� disponivel at� a concretiza��o da mudan�a, e ap�s concretizada a mudan�a � irreversivel.'),
			'us' => array('', '')),		
			
		'account.setQuestions' => array(
			'br' => 'Para aumentar a seguran�a de sua conta voc� pode configurar perguntas e respostas secretas e em sua conta. O modo de recupera��o de conta por perguntas pessoais � a forma mais efetiva de recupera��o, pois com elas � possivel modificar o e-mail registrado em sua conta de forma instantanea, e assim recuperar os dados de sua conta al�m de voc� tambem poder re-configurar novas perguntas em sua conta no futuro.<br>
			<br>
			Voc� pode configurar de uma a tr�s perguntas e respostas, sendo que quanto mais perguntas e respostas forem configuradas, maior � o grau de seguran�a.<br>
			<br>
			<b>Recomenda��es de perguntas e respostas:</b><br>
			<br>
			Ultilize fatos importantes, que voc� jamais esqueceria, e procure fazer respostas objetivas e diretas, por exemplo:<br>
			<br>
			<i><b>P:</b> Qual � meu nome?</i><br>
			<br>
			<b>R:</b> <del>Meu nome � Jo�o.</del><br>
			<font size="1">(n�o recomendado)</font><br>
			<b>R:</b> Jo�o<br>
			<font size="1">(recomendado)</font><br>
			<br>
			Recomendamos tamb�m que na hora de escolher a quantidade de perguntas e respostas voc� ultilize o famoso ditado "um � pouco, dois � bom, porem tr�s pode ser de mais".<br>
			<br>
			<b><font color="red">Notas Importantes:</font></b><br>
			<br>
			O sistema � extremamente sensivel, portanto para recuperar sua conta pelas perguntas voc� ter� de informar as respostas exatamente como as configurou.',
			'us' => ''),			
			
		'account.registration' => array(
			'br' => 'Atravez desta pagina voc� ir� efetuar um registro em sua conta com todas as suas informa��es pessoais. Este registro � muito importante pois ele permite que voc� obtenha uma chave de recupera��o para sua conta, que � o metodo mais eficaz de recupera��o para casos de perda de acesso da conta no futuro (esquecimento, hacking, etc.).
			<br>
			<br>
			Com o registro de conta voc� ainda poder� solicitar uma nova chave de recupera��o, caso voc� perca a primeira. Este � um processo ainda em desenvolvimento (n�o est� disponivel) pois para garantir a seguran�a da conta a nova chave ser� enviada atravez de uma carta ao endere�o fornecido neste registro.
			<br>
			<br>
			Preencha todos os campos abaixo corretamente e lembre-se de sempre manter esses dados atualizados mesmo ap�s o registro.
			<br>
			<br>
			<i>Todas informa��es fornecidas neste formulario s�o expressamente confidenciais e reservadas ap�nas a um restrito grupo de administradores do Darghos responsaveis por este setor. Por favor leiam abaixo a nossa politica de compromisso com a privacidade de seus dados.*</i>',
			'us' => ''),				
		
		'lostInterfaceStep2' => array(
			'br' => 'Selecione a op��o abaixo que mais se aproxima a solu��o de seu problema e ent�o clique em "Submit"<br>
					<br>
					� importante dizer que a recupera��o de numero de contas e senhas � efetuada atravez do envio de uma mensagem contendo as informa��es necessarias para recupera��o da conta ao e-mail registrado na mesma.<br>
					<br>
					Caso voc� n�o possua mais acesso a este e-mail, � possivel modificar este e-mail para um outro e-mail que voc� possua acesso de forma instantanea respondendo corretamente a todas perguntas configuradas em sua conta.<br>
					<br>
					Caso voc� n�o possua mais acesso ao e-mail registrado em sua conta e n�o se recorde das respostas para as perguntas secretas (ou n�o tenha configurado as perguntas na conta, ainda quando tinha acesso a mesma) infelizmente, pelo motivo de falta de informa��es concretas nem a interface de recupera��o de contas, nem mesmo a equipe, conseguir� recuperar est� conta, que estar� para sempre perdida.<br>
				',
			'us' => ''),	
			
		'lostInterfaceStep3_1' => array(
			'br' => 'Escreva abaixo o e-mail registrado na conta do personagem junto com a atual senha de acesso e clique no bot�o "Submit" e ser� lhe enviado uma mensagem ao endere�o de e-mail contendo o numero de sua conta.',
			'us' => ''),	
		
		'lostInterfaceStep3_1' => array(
			'br' => 'Escreva abaixo o e-mail registrado na conta do personagem junto com a atual senha de acesso e clique no bot�o "Submit" e ser� lhe enviado uma mensagem ao endere�o de e-mail contendo o numero de sua conta.',
			'us' => ''),	
			
		'beneficts_Step3Mod1' => array(
		'br' => 'No Darghos voc� pode fazer uma contribui��o e a recompensa ser ativa para voc� mesmo, ou para um outro jogador (um amigo por exemplo). Selecione abaixo para quem deve ser ativado a recomensa de sua doa��o.',
		'us' => ''),	
		
		'beneficts_Step3Mod2' => array(
		'br' => 'Selecione abaixo o m�todo de pagamento. PagSeguro � para apenas residentes do Brasil, Caso resida fora do Brasil utilize o m�todo da Paypal.',
		'us' => ''),	
		
		'beneficts_Step3Mod3' => array(
		'br' => 'Entre com a senha de sua conta, ela � necesaria para a autentica��o. Depois selecione o modo de ativa��o, e por fim, selecione a dura��o de sua contribui��o e clique no bot�o "Pr�ximo".',
		'us' => ''),	
		
		'beneficts_Step3Mod3_2' => array(
		'br' => 'Leia atentamente os dados abaixos referentes a sua contribui��o, caso tudo esteja correto, clique em "Confirm". Note que ao clicar no bot�o, o pagamento ser� processado imediatamente, portanto somente clique se tiver certeza que est� tudo certo.',
		'us' => ''),	
			
		'lostInterfaceStep3_2' => array(
			'br' => 'Escreva abaixo o e-mail registrado na conta do personagem e clique no bot�o "Submit" e ser� lhe enviado uma mensagem ao endere�o de e-mail contendo as informa��es para prosseguir na recupera��o de sua conta.',
			'us' => ''),	
			
		'beneficts_Step3Mod3_1' => array(
			'br' => 'Preencha abaixo o seu nome real e um comentario, estes dados ir�o aparecer ao dono da conta quando esta premium account for ser ativada. Ent�o selecione a dura��o que voc� desejar e clique em "Pr�ximo".',
			'us' => ''),	
		
		'lostInterfaceStep3_6' => array(
			'br' => 'Escreva abaixo o e-mail registrado na conta do personagem e clique no bot�o "Submit" e ser� lhe enviado uma mensagem ao endere�o de e-mail contendo as informa��es para prosseguir na recupera��o de sua conta.',
			'us' => ''),	
			
		'lostInterfaceStep3_3' => array(
			'br' => 'Escreva abaixo a chave informada no e-mail da etapa passada junto com o numero da conta e clique no bot�o "Submit" e ser� lhe enviado uma mensagem ao endere�o de e-mail contendo sua nova senha.',
			'us' => ''),	

		'lostInterfaceStep3_7' => array(
			'br' => 'Preencha todos os campos do formulario abaixo para continuar o processo de modifica��o de e-mail registrado em sua conta instant�neamente.<br>',
			'us' => ''),	
			
		'lostInterfaceStep3_8' => array(
			'br' => 'Preencha todos os campos do formulario abaixo para continuar o processo de modifica��o perguntas e respostas secretas configuradas em sua conta.<br>',
			'us' => ''),				
			
		'lostInterfaceStep3_4' => array(
			'br' => 'Escreva abaixo o e-mail registrado na conta do personagem junto o numero da conta e clique no bot�o "Submit" e ser� lhe enviado uma mensagem ao endere�o de e-mail contendo as informa��es do proximo passo para gerar uma nova senha para sua conta.',
			'us' => ''),	
			
		'lostInterfaceStep3_5' => array(
			'br' => 'Nesta etapa do processo de modifica��o das perguntas e respostas registradas em sua conta voc� ter� de responder corretamente todas respostas as perguntas secretas na qual voc� configurou em sua conta.<br><br> S�o permitidas ap�nas 3 tentativas sem sucesso desta opera��o por dia, portanto, caso voc� venha a errar as respostas das perguntas secretas 3 vezes este recurso ser� desabilitado para sua conta durante 24h por motivos de seguran�a.',
			'us' => ''),	
			
		'benefictsStep1' => array(
			'br' => 'O Darghos &eacute; um jogo gratuito, e voc&ecirc; pode joga-lo pelo tempo em que quiser, entretanto para manter um servidor com a qualidade do Darghos n&oacute;s temos muitas despezas com hospedagem, desenvolvimento e empregados dedicados somente ao Darghos&nbsp;entre outros. Para manter tudo isso n&oacute;s adotamos ao sistema na qual voc&ecirc; pode contribuir conosco com uma pequena quantia e ter recursos extras liberados por um tempo determinado.<br>',
			'us' => ''),	
			
		'benefictsStep2' => array(
			'br' => 'Aqui voc� pode contribuir com o Darghos. Quando voc� contribui, voc� recebe uma s�rie de beneficios dentro e fora do jogo durante um periodo, para saber mais sobre os beneficios por favor visite a se��o <a href="?page=contribute.beneficts">vantagens premium</a>.<br>',
			'us' => ''),	
			
		'benefictsStep3_1' => array(
			'br' => 'Antes de comprar sua premium account, � necessario ler, e aceitar as clausulas de servi�o listadas abaixo:<br>',
			'us' => ''),	
			
		'lostInterface' => array(
			'br' => 'Caso voc� tenha esquecido ou perdido o acesso a sua conta de seu personagem voc� ainda pode recupera-la atravez deste sistema, a interface de recupera��o de contas.<br>
					<br>
					<b>O sistema de Inteface de Recupera��o pode lhe ajudar a:</b><br>
					<br>
					<li>Recuperar o numero de sua conta caso voc� tenha esquecido o mesmo.</li>
					<li>Obter uma nova senha de acesso caso voc� tenha perdido a mesma.</li>
					<li>Modificar o e-mail registrado em sua conta de forma instanan�a respondendo as perguntas secretas de sua conta caso voc� tenha perdido o acesso ao mesmo.</li>
					<li>Modificar as perguntas e respostas secretas registradas em sua conta.</li><br>
					<br>
					Para come�ar a recupera��o de sua conta, preencha o formulario abaixo com o nome do personagem na qual voc� quer recuperar a conta e clique em "Submit" para que o sistema lhe auxilie no restante do processo de recupera��o.
					',
			'us' => ''),			
			
		'recovery.password' => array(
			'br' => 'Preencha os campos abaixa para iniciar o processo que ir� gerar uma nova senha para sua conta. Lembrando que voc� precisar� ter acesso a conta de e-mail registrada em sua conta.',
			'us' => ''),			

		'recovery.account' => array(
			'br' => 'Preencha os campos abaixa para iniciar o processo que ir� recuperar o numero de sua conta. Lembrando que voc� precisar� ter acesso a conta de e-mail registrada em sua conta.',
			'us' => ''),			

		'recovery.both' => array(
			'br' => 'Preencha os campos abaixa para iniciar o processo que ir� recuperar o numero e gerar uma nova senha para sua conta. Lembrando que voc� precisar� ter acesso a conta de e-mail registrada em sua conta.',
			'us' => ''),	

		'recovery.newpassword' => array(
			'br' => 'Preencha os campos abaixo para que o sistema confirme a chave de recupera��o de senha e gerar uma nova senha para sua conta. A nova senha ser� enviada ao email cadastrado em sua conta.',
			'us' => ''),				

		//DESCRI��O DE PAGINAS CHARACTER
		'character.create' => array(
			'br' => 'Bem vindo ao criador de novos personagens, aqui voc� ir� escolher as suas preferencias para o seu novo personagem como nome, sexo, voca��o e cidade entre outros.
					 <br>
					 <br>
					 Este � o primeiro passo e voc� ter� de escolher o modo de inicio de seu personagem. Voc� pode optar por iniciar em rookgaard, que � uma ilha isolada aonde voc� ter� os primeiros contatos com o jogo, muito recomendada a jogadores iniciantes. Ou poder� optar por iniciar sua jornada em Main Land, que � j� o palco principal do jogo, op��o recomendada a jogadores que j� possuem os conhecimentos basicos do jogo.',
			'us' => ''),

		'character.description' => array(
			'br' => 'Atravez desta pagina voc� ir� montar as caracteristicas de seu novo personagem, como o seu nome (apelido), sexo, voca��o, residencia alem de selecionar o mundo na qual seu personagem ser� criado. Lembrando que � recomendado que crie personagens em mundos com popula��o vazia ou mediana alem de que para melhor desempenho durante o jogo � tambem recomendavel que selecione um mundo em que o servidor fique o mais proximo possivel de seu pa�s.',
			'us' => ''),	

		'character.preferences' => array(
			'br' => 'Atravez desta pagina voc� pode escrever um comentario que ser� exibido quando alguem acessar o perfil de seu personagem. Voc� tambem pode optar por tornar este personagem oculto em sua conta.',
			'us' => ''),				

		'character.details' => array(
			'br' => 'Preencha os campos abaixo para obter informa��es detalhadas sobre qualquer personagem do jogo.',
			'us' => ''),					
			
		//DESCRI��O DE PAGINAS ADMIN	
		'admin.payments' => array(
			'br' => '<center><b>Bem vindo ao gerenciador financeiro do Darghos.</b></center>',
			'us' => ''),

		'admin.payments.new' => array(
			'br' => 'Efetue lan�amento de novos pagamentos atravez deste recurso, lembrando que o campo Jogador � referente ao numero de conta do jogador e Identifica��o � referente ao numero de autentica��o fornecido pelo org�o/metodo escolhido pelo jogador. Ap�s o pagamento ter sido lan�ado o jogador receber� um e-mail de comunica��o e dever� aceitar o pagamento acessando sua conta.',
			'us' => ''),	

		//DESCRI��O DE PAGINAS PAGAMENTOS	
		'payments.detail' => array(
			'br' => 'Atravez desta pagina voc� pode visualizar detalhes de um pagamento efetuado, alem de efetuar a��es se necessario, como por exemplo, aceitar um pagamento. Veja abaixo os detalhes de seu pagamento.',
			'us' => ''),	

		'payments.accept' => array(
			'br' => 'Atravez desta pagina voc� pode aceitar um pagamento efetuado e assim come�ar a desfrutar dos beneficios de sua contribui��o, leia atentamente todas clausulas abaixo antes de aceitar o pagamento.',
			'us' => ''),	

		//DESCRI��O DE PAGINAS COMUNIDADE			
	
		'community.highscores' => array(
			'br' => 'Visualize os maiores pontuadores em qualquer uma das habilidades dos personagens. Selecione abaixo o mundo na qual voc� deseja visualizar os maiores pontuadores.',
			'us' => ''),	
	
		'community.guilds' => array(
			'br' => 'Selecione abaixo o mundo do qual voc� deseja visualizar as guildas. Clique em qualquer bot�o Ver para saber mais informa��es sobre a guilda.',
			'us' => 'Please select the game world of your choice to see the list of all existing guilds on it. Click on any view button to get more information about a guild.')
	
	);	

/*
/// CLASSE DE MODELOS DE EMAILS
// Esta classe contem os modelos de emails para envio, como o email enviado ao criar uma conta.
// Cuidado ao alterar os valores pois contem separadores de arrays para inser��o dos dados de saida
// Para usar ultilize a fun��o getEmailCount('nome.email')
*/
	
	private $emailCount = array
	(
/*
//// Email de cria��o de nova conta
*/
		'account.register' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,</p>
<p>Este � um email informativo contendo as informa��es de acesso para sua conta criada no <a href=\"http://www.darghos.com\"><b>Darghos</b></a>.</p>

<p>Conta: <b>','</b><br>
Senha: <b>','</b></p>

<p>Voc� precisar� destes dados para efetuar o login em nosso website e acessar a administra��o de sua conta e mudar para uma senha de sua preferencia alem de criar seu personagem e come�ar a se divertir alem de muitas outras ultilidades!</p>

<p>Para efetuar o login em sua conta clique <a href=\"http://www.darghos.com/index.php?act=account.login\"><b>aqui</b></a>.</p>

<p>Lembrando que � altamente recomendavel que voc� memorize as informa��es de acesso de sua conta para uma maior seguran�a.</p>

<p>Nos vemos no Darghos!<br>
Equipe UltraxSoft.</p>
</body>
</html>'),
			'us' => ''),		
/*
//// Email para comunicado de solicita��o de mudan�a de email.
*/	
		'account.changeemail' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,</p>
<p>Este � um email informativo de uma solicita��o para mudan�a do e-mail registrado em sua conta no Darghos. Abaixo segue o novo email como informado em nosso website:</p>

<p>Novo e-mail: <b>','</b></p>

<p>Por motivos de seguran�a est� mudan�a necessita de uma espera de ',' dias para que seja concluida. Voc� pode cancelar esta mudan�a a qualquer momento dentro do prazo especificado acessando sua conta no Darghos e seguindo as instru��es da pagina principal.</p>

<p>Para acessar sua conta clique <a href=\"http://www.darghos.com/index.php?act=account.login\"><b>aqui</b></a>.</p>

<p>Lembrando que � impossivel cancelar esta mudan�a ap�s o prazo de espera de ',' dias.</p>

<p>Nos vemos no Darghos!<br>
Equipe UltraxSoft.</p>
</body>
</html>'),
			'us' => ''),		

/*
//// Email para envio da chave de gera��o de nova senha para conta
*/	
			
		'recovery.password' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,<br>
Foi solicitado uma nova senha para sua conta pelo sistema de Contas Perdidas no Darghos. Para concluir a gera��o de uma nova senha voc� deve acessar o endere�o abaixo informando a sua chave de gera��o de nova senha.
<br>
<br>
Chave de gera��o de nova senha: <b>','</b>
<br>
<a href="http://www.darghos.com/index.php?act=lostInterface&step=confirmKey">http://www.darghos.com/index.php?act=lostInterface&step=confirmKey</a>
<br>
<br>
Caso voc� n�o tenha solicitado uma nova senha apenas ignore esta mensagem.
<br>
<br>
Nos vemos no Darghos!<br>
Equipe UltraxSoft.
</p>'),
			'us' => ''),	

/*
//// Email para envio do numero da Conta
*/	
			
		'recovery.account' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,<br>
Foi solicitado uma recupera��o do numero de sua conta atravez do sistema de Contas Perdidas no Darghos. Abaixo segue o numero de sua conta.
<br>
<br>
Numero da conta: <b>','</b>
<br>
<br>
Procure memorizar o numero de sua conta e por motivos de seguran�a jamais partilhe sua conta.
<br>
<br>
Nos vemos no Darghos!<br>
Equipe UltraxSoft.
</p>'),
			'us' => ''),	

/*
//// Email para envio do numero da Conta e Gerar nova Senha
*/	
			
		'recovery.both' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,<br>
Foi solicitado uma recupera��o do numero de sua conta atravez do sistema de Contas Perdidas no Darghos. Abaixo segue o numero de sua conta.
<br>
<br>
Numero da conta: <b>','</b>
<br>
<br>
Para concluir a gera��o de uma nova senha voc� deve acessar o endere�o abaixo informando a sua chave de gera��o de nova senha.
<br>
<br>
Chave de gera��o de nova senha: <b>','</b>
<br>
<a href="http://www.darghos.com/index.php?act=lostInterface&step=confirmKey">http://www.darghos.com/index.php?act=lostInterface&step=confirmKey</a>
<br>
<br>
Procure memorizar o numero de sua conta e senha e por motivos de seguran�a jamais partilhe sua conta.
<br>
<br>
Nos vemos no Darghos!<br>
Equipe UltraxSoft.
</p>'),
			'us' => ''),		

/*
//// Email para envio do nova senha
*/	
			
		'recovery.newpassword' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,<br>
Foi gerada uma nova senha para sua conta com sucesso! Abaixo segue a sua nova senha:
<br>
<br>
Nova Senha: <b>','</b>
<br>
<br>
Procure memorizar o numero de sua conta e senha e por motivos de seguran�a jamais partilhe sua conta.
<br>
<br>
Nos vemos no Darghos!<br>
Equipe UltraxSoft.
</p>'),
			'us' => ''),				

/*
//// Email para comunicado de libera��o de pagamento
*/				
			
'payments.sucesso' => array(
			'br' => '
<html>
<body>		
<p>Prezado jogador,<br>
Primeiramente, obrigado por contribuir com o Darghos!</p>
<p>Gostariamos de comunicar que o seu pagamento para contribui��o efetuado no Darghos j� foi liberado, e voc� est� muito proximo de come�ar a usufruir de todos beneficios de sua contribui��o!</p>

<p>Para voc� visualizar detalhes deste pagamento ou aceita-lo basta voc� acessar sua conta em nosso website.</p>

<p>Para acessar sua conta clique <a href=\"http://www.darghos.com/index.php?act=account.login\"><b>aqui</b></a>.</p>

<p>Nos vemos no Darghos!<br>
Equipe UltraxSoft.</p>
</body>
</html>',
			'us' => ''),					
	);
	
	public function getWarning($warnName)
	{
		$warnTitle = $this->warnings[$warnName][$GLOBALS['g_language']]['title'];
		$warnMsg = $this->warnings[$warnName][$GLOBALS['g_language']]['msg'];
		
		$warn = array(
			'title' => $warnTitle,
			'msg' => $warnMsg
		);
		
		return $warn;
	}
	
	public function getDescription($descName)
	{
		$desc = $this->descriptions[$descName][$GLOBALS['g_language']];
		
		return $desc;
	}	
	
	public function getEmailCount($emailName)
	{
		$email = $this->emailCount[$emailName][$GLOBALS['g_language']];
		
		return $email;
	}	
	
	public function setLanguage()
	{
		$langCookie = $_COOKIE["lang"];
		
		if($langCookie)
			$GLOBALS["g_language"] = $_COOKIE["lang"];
	}
}
?>