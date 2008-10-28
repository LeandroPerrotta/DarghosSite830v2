<?
class Trans
{	

/*
/// CLASSE DE AVISOS
// Esta classe contem os avisos de ação, como ao tentar criar uma conta com um E-mail já existente
// Para usar ultilize a função getWarning('nome.aviso')
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
				'msg' => 'Você não digitou corretamente todos campos necessarios em seu formulario, por favor, tente novamente.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			
	
		'geral.emailInvalido' => array(
			'br' => array(
				'title' => 'E-mail invalido.',
				'msg' => 'Este não é um endereço de e-mail valido ou existente, para criar sua conta é necessario preencher o formulario com um endereço de e-mail valido e existente.'), 		
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
				'msg' => 'A senha informada para confirmação está incorreta, para efetuar esta operação é necessario confirmar a senha por motivos de segurança.'), 		
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
				'msg' => 'A conta e (ou) senha estão incorretas, por favor tente novamente.'), 		
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
				'msg' => 'Este e-mail já existe em outra conta, por favor, tente novamente utilizando outro e-mail.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
	
		'contas.naoExiste' => array(
			'br' => array(
				'title' => 'Conta inexistente!',
				'msg' => 'A conta informada não existe no banco de dados, para efetuar esta operação é necessario entrar com uma conta valida.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
	
		'contas.sucesso' => array(
			'br' => array(
				'title' => 'Conta criada com sucesso!',
				'msg' => array ('Parabens! A sua conta foi criada com sucesso! O numero de sua conta é: <big>','</big>. <br> Foi enviado um email informativo com os dados de acesso de sua conta ao endereço de email <b></b>. <br><br>Tenha um bom jogo!')
			),
			'us' => array(
				'title' => '',
				'msg' => '')		
		),

		/*
		/// AVISOS RECUPERAÇÃO DE CONTA
		// Estes avisos aparecem ao recuperar a conta
		*/			
		
		'recovery.contaIncorreta' => array(
			'br' => array(
				'title' => 'Conta incorreta',
				'msg' => 'O numero de conta informado não corresponde ao numero de conta deste personagem.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'recovery.senhaIncorreta' => array(
			'br' => array(
				'title' => 'Senha incorreta',
				'msg' => 'A senha informado não corresponde a senha da conta deste personagem.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			

		'recovery.emailIncorreto' => array(
			'br' => array(
				'title' => 'E-mail incorreto',
				'msg' => 'O endereço de e-mail informado nao corresponde ao endereço de e-mail criado para esta conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'recovery.keyErro' => array(
			'br' => array(
				'title' => 'Chave invalida',
				'msg' => 'A chave de geração de nova senha digitada para esta conta está incorreta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		

		'recovery.AccDontHaveKey' => array(
			'br' => array(
				'title' => 'Chave invalida',
				'msg' => 'Não existe uma chave de recuperação para esta conta.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),				

		'recovery.passwordSucesso' => array(
			'br' => array(
				'title' => 'Senha recuperada com sucesso!',
				'msg' => 'Foi enviado uma mensagem ao e-mail cadastrado em sua conta contendo as informações necessarias para gerar uma nova senha.'), 		
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

		'recovery.bothSucesso' => array(
			'br' => array(
				'title' => 'Conta recuperada com sucesso!',
				'msg' => 'Foi enviado um lembrete do numero de sua conta e um link para gerar uma nova senha ao e-mail cadastrado em sua conta.'), 		
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
				'msg' => 'O nome escolhido para seu personagem possui um modelo de formatação não permitida, tente novamente seguindo estas regras:<br><br> 
						<li>Seu nome não pode começar ou terminar com um \'espaço\'.</li>
						<li>Não use mais de um \'espaços\' entre as palavras.</li>
						<li>Não é permitido mais que três palavras em seu nome.</li>
						<li>Somente são permitidos os caracteres: a-z, A-Z, espaço, hifen (-) e aspas simples.</li>
						<li>O seu nome não deve possuir mais que 30 caracteres.</li>
						<li>O seu nome não deve possuir menos que 3 caracteres.</li>
						<li>A terceira palavra de seu nome não deve possuir menos que 3 caracteres.</li>
						<li>A primeira letra da primeira palavra de seu nome deve ser maiuscula.</li>
						<li>A primeira letra da terceira palavra de seu nome deve ser maiuscula.</li>'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			

		'char.nomeExistente' => array(
			'br' => array(
				'title' => 'Nome já utilizado!',
				'msg' => 'O nome escolhido para seu personagem já está em uso em nosso banco de dados por outro jogador, por favor, tente outro nome.!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'char.erroDesconhecido' => array(
			'br' => array(
				'title' => 'Falha ao criar o personagem!',
				'msg' => 'Devido a uma falha critica não foi pessivel criar seu personagem, um relatorio do erro foi enviado a equipe, tente novamente mais tarde.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			
		
		'char.sucesso' => array(
			'br' => array(
				'title' => 'Personagem criado com sucesso!',
				'msg' => 'O seu personagem foi criado com sucesso! <br><br> Você já pode começar a se divertir conosco, para jogar basta fazer o login no jogo, nosso IP é: <b>login.darghos.com</b>!<br><br>Desejamos uma boa diversão!<br>Equipe UltraxSoft.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'char.preferencias.sucesso' => array(
			'br' => array(
				'title' => 'Preferências modificadas com sucesso!',
				'msg' => 'As prefêrencias de seu personagem foram modificadas com sucesso!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		

		'char.naoExiste' => array(
			'br' => array(
				'title' => 'Personagem não encontrado',
				'msg' => 'Não foi encontrado nenhum personagem com o nome informado em nosso banco de dados. Note que o nome do personagem precisa ser digitado corretamente para ser encontrado.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),				
		
		/*
		/// AVISOS MUDANÇA DE SENHA
		// Estes avisos aparecem ao mudar senha
		*/			
		'changepass.antigaIncorreta' => array(
			'br' => array(
				'title' => 'Antiga senha incorreta!',
				'msg' => 'A confirmação da antiga senha falhou, para modificar sua senha é necessario confirmar a antiga senha.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'changepass.confFalhou' => array(
			'br' => array(
				'title' => 'Confirmação falhou!',
				'msg' => 'A confirmação da nova senha falhou, por motivos de segurança é necessario confirmar a nova senha para efetuar a mudança.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	
		
		'changepass.iguais' => array(
			'br' => array(
				'title' => 'Senhas identicas!',
				'msg' => 'A sua nova senha é identica a antiga senha, para modificar sua senha é necessario que a nova senha seja diferente da antiga senha.'), 		
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
				'msg' => 'Sua senha foi modificada com sucesso! É recomendavel você sair e entrar novamente em sua conta para que ela seja atualizada com sucesso.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		/*
		/// AVISOS INFORMAÇÕES PESSOAIS
		// Estes avisos aparecem ao editar as informações pessoais da conta.
		*/			
		'containfo.tamanhoInvalido' => array(
			'br' => array(
				'title' => 'Tamanho das informações invalidos!',
				'msg' => 'As informações pessoais de sua conta devem conter no maximo 25 caracteres para nome real e localização e 50 caracteres para url.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		'containfo.sucesso' => array(
			'br' => array(
				'title' => 'Informações pessoais modificadas com sucesso!',
				'msg' => 'A mudança das informações pessoais desta conta foram efetuadas com sucesso!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		/*
		/// AVISOS MUDANÇA DE EMAIL
		// Estes avisos aparecem ao mudar o e-mail da conta
		*/			
		'changeemail.identico' => array(
			'br' => array(
				'title' => 'E-mails identicos!',
				'msg' => 'O novo e-mail é identico ao e-mail já utilizado nesta conta, para que a mudança seja feita é necessario que o novo email seja diferente do atual.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),
		
		'changeemail.emailInvalido' => array(
			'br' => array(
				'title' => 'E-mail invalido!',
				'msg' => 'O novo e-mail não é um endereço valido, esta mudança requer que o novo e-mail seja valido.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'changeemail.sucesso' => array(
			'br' => array(
				'title' => 'Modificação agendada com sucesso!',
				'msg' => 'A mudança de seu email foi agendada com sucesso!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),			
		
		'changeemail.cancelSucesso' => array(
			'br' => array(
				'title' => 'Modificação de E-mail cancelada!',
				'msg' => 'A mudança de e-mail solicitada para sua conta foi cancelada com sucesso, agora não haverá mais nenhuma mudança.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),	

		/*
		/// AVISOS DE PAGAMENTOS
		// Estes avisos aparecem nos modulos sobre Pagamentos
		*/			
		'payments.activationSuccess' => array(
			'br' => array(
				'title' => 'Pagamento Ativado!',
				'msg' => 'O pagamento foi ativado com sucesso! Foi enviado um e-mail para o jogador contendo as informações para ativação.'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
		
		'payments.accepted' => array(
			'br' => array(
				'title' => 'Contribuição confirmada!',
				'msg' => 'Parabens! Agora com sua contribuição confirmada você pode já desfrutar de todos beneficios disponiveis! Obrigado por contribuir e tenha um bom jogo!'), 		
			'us' => array(
				'title' => '',
				'msg' => '')		
		),		
	);		

/*
/// CLASSE DE DESCRIÇÕES
// Está classe é destinada a exibição de descrições de paginas, como a descrição na pagina de criação de contas
// Para usar ultilize a função getDescription('nome.descrição')
*/
	
	private $descriptions = array
	(
		//DESCRIÇÃO DE PAGINAS ACCOUNT
		'account.register' => array(
			'br' => 'Crie sua conta agora mesmo e começe a se divertir no Darghos! Para criar sua conta é apenas necessario ter um e-mail disponivel, pois as informações de sua conta serão enviadas a ele.',
			'us' => 'Create now your account and start fun in Darghos! To create a new account only is necessary have an e-mail disponible, because your account informations has sended to his.'),	
		
		'account.changepassword' => array(
			'br' => 'Atravez deste recurso você pode modificar a senha de sua conta sempre que achar necessario. Nós recomendamos que você modifique sua senha a cada 15 dias para maior segurança.',
			'us' => ''),	
			
		'account.login' => array(
			'br' => 'Efetue o login em sua conta e você podera trocar sua senha, trocar seu endereço de email, criar um personagem, efetuar uma contribuição entre outros recursos de manuseio de sua conta. Não tem uma conta ainda? Clique <a href="?act=account.register">aqui</a> e crie a sua agora mesmo.',
			'us' => ''),		
			
		'account.main' => array(
			'br' => '<center><b>Bem vindo ao painel de administração e manuseio de sua conta.</b></center>',
			'us' => '<center><b>Welcome to management panel of your account.</b></center>'),				
	
		'account.changeinfos' => array(
			'br' => 'Modifique as informações pessoais de sua conta, essas informações estarão visiveis a outros jogadores que acessarem a pagina de qualquer personagem desta conta. Para ocultar as informações pessoais apenas deixe os campos abaixo em branco.',
			'us' => ''),		
			
		'account.changeemail' => array(
			'br' => 'Você pode efetuar uma troca de e-mail registrado em sua conta, isto é importante em casos de perda de acesso a conta de e-mail. Por motivos de segurança esta mudança leva 15 dias para ser completada. É importante lembrar que você poderá cancelar a mudança a qualquer momento antes dos 15 dias pela pagina principal de administração de sua conta. Preencha os dados abaixo para solicitar uma mudança de e-mail registrada em sua conta.',
			'us' => ''),		
			
		'account.cancelchangeemail' => array(
			'br' => 'Atravez deste recurso você pode cancelar uma mudança de e-mail em até 15 dias antes da concretização da mudança. Note este cancelamento só estará disponivel até a concretização da mudança, e após concretizada a mudança é irreversivel.',
			'us' => ''),		
			
		'account.registration' => array(
			'br' => 'Atravez desta pagina você irá efetuar um registro em sua conta com todas as suas informações pessoais. Este registro é muito importante pois ele permite que você obtenha uma chave de recuperação para sua conta, que é o metodo mais eficaz de recuperação para casos de perda de acesso da conta no futuro (esquecimento, hacking, etc.).
			<br>
			<br>
			Com o registro de conta você ainda poderá solicitar uma nova chave de recuperação, caso você perca a primeira. Este é um processo ainda em desenvolvimento (não está disponivel) pois para garantir a segurança da conta a nova chave será enviada atravez de uma carta ao endereço fornecido neste registro.
			<br>
			<br>
			Preencha todos os campos abaixo corretamente e lembre-se de sempre manter esses dados atualizados mesmo após o registro.
			<br>
			<br>
			<i>Todas informações fornecidas neste formulario são expressamente confidenciais e reservadas apénas a um restrito grupo de administradores do Darghos responsaveis por este setor. Por favor leiam abaixo a nossa politica de compromisso com a privacidade de seus dados.*</i>',
			'us' => ''),				
			
		'account.lost' => array(
			'br' => 'Caso você tenha perdido ou esquecido os dados de sua conta ou ainda se tiver sido "hackeado" você pode recuperar os dados de sua conta atravez deste recurso. Selecione a baixo qual o dado (conta ou senha) perdido para que o sistema o auxilie na recuperação dos dados de sua conta.
			<br>
			<br>
			Lembrando que o sistema irá recuperar os dados de sua conta atraves do endereço de e-mail registrado nela, portanto para recuperar a conta é necessario alem de saber o endereço de email que está registrado ter acesso ao mesmo.',
			'us' => ''),			
			
		'recovery.password' => array(
			'br' => 'Preencha os campos abaixa para iniciar o processo que irá gerar uma nova senha para sua conta. Lembrando que você precisará ter acesso a conta de e-mail registrada em sua conta.',
			'us' => ''),			

		'recovery.account' => array(
			'br' => 'Preencha os campos abaixa para iniciar o processo que irá recuperar o numero de sua conta. Lembrando que você precisará ter acesso a conta de e-mail registrada em sua conta.',
			'us' => ''),			

		'recovery.both' => array(
			'br' => 'Preencha os campos abaixa para iniciar o processo que irá recuperar o numero e gerar uma nova senha para sua conta. Lembrando que você precisará ter acesso a conta de e-mail registrada em sua conta.',
			'us' => ''),	

		'recovery.newpassword' => array(
			'br' => 'Preencha os campos abaixo para que o sistema confirme a chave de recuperação de senha e gerar uma nova senha para sua conta. A nova senha será enviada ao email cadastrado em sua conta.',
			'us' => ''),				

		//DESCRIÇÃO DE PAGINAS CHARACTER
		'character.create' => array(
			'br' => 'Bem vindo ao criador de novos personagens, aqui você irá escolher as suas preferencias para o seu novo personagem como nome, sexo, vocação e cidade entre outros.
					 <br>
					 <br>
					 Este é o primeiro passo e você terá de escolher o modo de inicio de seu personagem. Você pode optar por iniciar em rookgaard, que é uma ilha isolada aonde você terá os primeiros contatos com o jogo, muito recomendada a jogadores iniciantes. Ou poderá optar por iniciar sua jornada em Main Land, que é já o palco principal do jogo, opção recomendada a jogadores que já possuem os conhecimentos basicos do jogo.',
			'us' => ''),

		'character.description' => array(
			'br' => 'Atravez desta pagina você irá montar as caracteristicas de seu novo personagem, como o seu nome (apelido), sexo, vocação, residencia alem de selecionar o mundo na qual seu personagem será criado. Lembrando que é recomendado que crie personagens em mundos com população vazia ou mediana alem de que para melhor desempenho durante o jogo é tambem recomendavel que selecione um mundo em que o servidor fique o mais proximo possivel de seu país.',
			'us' => ''),	

		'character.preferences' => array(
			'br' => 'Atravez desta pagina você pode escrever um comentario que será exibido quando alguem acessar o perfil de seu personagem. Você tambem pode optar por tornar este personagem oculto em sua conta.',
			'us' => ''),				

		'character.details' => array(
			'br' => 'Preencha os campos abaixo para obter informações detalhadas sobre qualquer personagem do jogo.',
			'us' => ''),					
			
		//DESCRIÇÃO DE PAGINAS ADMIN	
		'admin.payments' => array(
			'br' => '<center><b>Bem vindo ao gerenciador financeiro do Darghos.</b></center>',
			'us' => ''),

		'admin.payments.new' => array(
			'br' => 'Efetue lançamento de novos pagamentos atravez deste recurso, lembrando que o campo Jogador é referente ao numero de conta do jogador e Identificação é referente ao numero de autenticação fornecido pelo orgão/metodo escolhido pelo jogador. Após o pagamento ter sido lançado o jogador receberá um e-mail de comunicação e deverá aceitar o pagamento acessando sua conta.',
			'us' => ''),	

		//DESCRIÇÃO DE PAGINAS PAGAMENTOS	
		'payments.detail' => array(
			'br' => 'Atravez desta pagina você pode visualizar detalhes de um pagamento efetuado, alem de efetuar ações se necessario, como por exemplo, aceitar um pagamento. Veja abaixo os detalhes de seu pagamento.',
			'us' => ''),	

		'payments.accept' => array(
			'br' => 'Atravez desta pagina você pode aceitar um pagamento efetuado e assim começar a desfrutar dos beneficios de sua contribuição, leia atentamente todas clausulas abaixo antes de aceitar o pagamento.',
			'us' => ''),	

		//DESCRIÇÃO DE PAGINAS COMUNIDADE			
	
		'community.highscores' => array(
			'br' => 'Visualize os maiores pontuadores em qualquer uma das habilidades dos personagens. Selecione abaixo o mundo na qual você deseja visualizar os maiores pontuadores.',
			'us' => ''),	
	
	);	

/*
/// CLASSE DE MODELOS DE EMAILS
// Esta classe contem os modelos de emails para envio, como o email enviado ao criar uma conta.
// Cuidado ao alterar os valores pois contem separadores de arrays para inserção dos dados de saida
// Para usar ultilize a função getEmailCount('nome.email')
*/
	
	private $emailCount = array
	(
/*
//// Email de criação de nova conta
*/
		'account.register' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,</p>
<p>Este é um email informativo contendo as informações de acesso para sua conta criada no <a href=\"http://ot.darghos.com\"><b>Darghos</b></a>.</p>

<p>Conta: <b>','</b><br>
Senha: <b>','$password</b></p>

<p>Você precisará destes dados para efetuar o login em nosso website e acessar a administração de sua conta e mudar para uma senha de sua preferencia alem de criar seu personagem e começar a se divertir alem de muitas outras ultilidades!</p>

<p>Para efetuar o login em sua conta clique <a href=\"http://ot.darghos.com/index.php?act=account.login\"><b>aqui</b></a>.</p>

<p>Lembrando que é altamente recomendavel que você memorize as informações de acesso de sua conta para uma maior segurança.</p>

<p>Nos vemos no Darghos!<br>
Equipe UltraxSoft.</p>
</body>
</html>'),
			'us' => ''),		
/*
//// Email para comunicado de solicitação de mudança de email.
*/	
		'account.changeemail' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,</p>
<p>Este é um email informativo de uma solicitação para mudança do e-mail registrado em sua conta no Darghos. Abaixo segue o novo email como informado em nosso website:</p>

<p>Novo e-mail: <b>','</b></p>

<p>Por motivos de segurança está mudança necessita de uma espera de 15 dias para que seja concluida. Você pode cancelar esta mudança a qualquer momento dentro do prazo especificado acessando sua conta no Darghos e seguindo as instruções da pagina principal.</p>

<p>Para acessar sua conta clique <a href=\"http://ot.darghos.com/index.php?act=account.login\"><b>aqui</b></a>.</p>

<p>Lembrando que é impossivel cancelar esta mudança após o prazo de espera de 15 dias.</p>

<p>Nos vemos no Darghos!<br>
Equipe UltraxSoft.</p>
</body>
</html>'),
			'us' => ''),		

/*
//// Email para envio da chave de geração de nova senha para conta
*/	
			
		'recovery.password' => array(
			'br' => array('
<html>
<body>		
<p>Prezado jogador,<br>
Foi solicitado uma nova senha para sua conta pelo sistema de Contas Perdidas no Darghos. Para concluir a geração de uma nova senha você deve acessar o endereço abaixo informando a sua chave de geração de nova senha.
<br>
<br>
Chave de geração de nova senha: <b>','</b>
<br>
<a href="http://ot.darghos.com/index.php?act=recovery.newpassword">http://ot.darghos.com/index.php?act=recovery.newpassword</a>
<br>
<br>
Caso você não tenha solicitado uma nova senha apenas ignore esta mensagem.
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
Foi solicitado uma recuperação do numero de sua conta atravez do sistema de Contas Perdidas no Darghos. Abaixo segue o numero de sua conta.
<br>
<br>
Numero da conta: <b>','</b>
<br>
<br>
Procure memorizar o numero de sua conta e por motivos de segurança jamais partilhe sua conta.
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
Foi solicitado uma recuperação do numero de sua conta atravez do sistema de Contas Perdidas no Darghos. Abaixo segue o numero de sua conta.
<br>
<br>
Numero da conta: <b>','</b>
<br>
<br>
Para concluir a geração de uma nova senha você deve acessar o endereço abaixo informando a sua chave de geração de nova senha.
<br>
<br>
Chave de geração de nova senha: <b>','</b>
<br>
<a href="http://ot.darghos.com/index.php?act=recovery.newpassword">http://ot.darghos.com/index.php?act=recovery.newpassword</a>
<br>
<br>
Procure memorizar o numero de sua conta e senha e por motivos de segurança jamais partilhe sua conta.
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
Procure memorizar o numero de sua conta e senha e por motivos de segurança jamais partilhe sua conta.
<br>
<br>
Nos vemos no Darghos!<br>
Equipe UltraxSoft.
</p>'),
			'us' => ''),				

/*
//// Email para comunicado de liberação de pagamento
*/				
			
'payments.sucesso' => array(
			'br' => '
<html>
<body>		
<p>Prezado jogador,<br>
Primeiramente, obrigado por contribuir com o Darghos!</p>
<p>Gostariamos de comunicar que o seu pagamento para contribuição efetuado no Darghos já foi liberado, e você está muito proximo de começar a usufruir de todos beneficios de sua contribuição!</p>

<p>Para você visualizar detalhes deste pagamento ou aceita-lo basta você acessar sua conta em nosso website.</p>

<p>Para acessar sua conta clique <a href=\"http://ot.darghos.com/index.php?act=account.login\"><b>aqui</b></a>.</p>

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
		
		if($langCookie != (null or ""))
		{
			$GLOBALS["g_language"] = $_COOKIE["lang"];
		}
		else
			$GLOBALS["g_language"] = "us";
	}
}
?>