<?
echo '<tr><td class=newbar><center><b>:: Cria��o de Conta ::</td></tr>
<tr><td class=newtext>';

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	$success = false;
	$email = $_POST['email'];
	$acceptemail = $_POST['acceptemail'];
	$privacidade = $_POST['privacidade'];

	if($email == null or $email == "")
	{
		$condition['title'] = "Campos vazios!";
		$condition['details'] = "Os campos do formulario est�o vazios, para criar sua conta � necessario preencher todos campos do formulario corretamente.";
	}
	elseif(filtreString($email,1) == 0)
	{
		$condition['title'] = "Caracteres reservados!";
		$condition['details'] = "Este endere�o de e-mail contem caracteres reservados ou proibidos, por favor, tente novamente com outro endere�o e-mail.";
	}	
	else
	{
		$chkEmail = mysql_query("SELECT * FROM `accounts` WHERE (`email` = '".$email."')") or die(mysql_error());
		
		if( !preg_match('/^[a-z][\w\.+-]*[a-z0-9]@[a-z0-9][\w\.+-]*\.[a-z][a-z\.]*[a-z]$/i', $email) )
		{
			$condition['title'] = "E-mail invalido!";
			$condition['details'] = "Este n�o � um endere�o de e-mail valido, por favor, tente novamente com outro endere�o e-mail.";
		}		
		elseif(mysql_num_rows($chkEmail) != 0)		
		{
			$condition['title'] = "E-mail j� em uso!";
			$condition['details'] = "Esteendere�o de e-mail j� est� em uso por outra conta, por favor, tente novamente com outro endere�o e-mail.";		
		}	
		
		elseif(!emailExists($email))
		{
			$condition['title'] = "E-mail invalido!";
			$condition['details'] = "Este endere�o de e-mail n�o existe, por favor, tente novamente com outro endere�o e-mail.";		
		}	

		elseif($privacidade != 1)		
		{
			$condition['title'] = "Termos n�o aceitos!";
			$condition['details'] = "Somente oferecemos o Darghos a quem aceitar e concordar com todos termos e politicas de nosso trabalho.";			
		}			
		
		else 
		{
			$pass = my_rand(6);	
			$passMd5 = md5($pass);
			$date = time();

			$account = $engine->loadClass('Accounts');
			$number = $account->getNumber();

			$account->setData("password", $passMd5);
			$account->setData("email", $email);
			$account->setData("lastday", $date);
			$account->setData("creation", $date);
			
			$body = 
			'Dear  player of Darghos,
Your account has been successfully created!
			
Below follows the details of your account:
Your account is: '.$number.'
Your password is: '.$pass.'
				
To create you character and start the game visit:
http://ot.darghos.com/index.php?page=account.login
			
See you in World of Darghos!
UltraxSoft Team.';
			
			if (!mailex($email, 'Account details!', $body))
			{		
				$condition['title'] = "Falha ao enviar email!";
				$condition['details'] = "Ouve uma falha em nosso servidor de emails que impossibilitou o envio do seu email. A cria��o de sua conta foi anulada. Tente novamente mais tarde.";								
			}				
			else
			{	
				$sucess = true;
				$account->saveNumber();
				
				$condition['title'] = "E-mail enviado com sucesso!";
				$condition['details'] = "Parabens! Sua conta foi criada com sucesso!<br>
				O numero de sua conta �: <font size=6><b>$number</b></font><br>
				<br>
				A senha para acesso de sua conta foi enviada email registrado: <b>$email</b><br>
				Para sua seguran�a jamais entregue os dados de sua conta a ninguem!<br>
				<br>
				Tenha um bom jogo!<br>
				Equipe UltraxSoft.";								
			}				
		}
	}	
	
	echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
	echo '<tr><td class=rank2>'.$condition['title'].'</td></tr>';
	echo '<tr><td class=rank1>'.$condition['details'].'';
	echo '</table><br>';
	
	if($sucess)
		echo '<a href="?page=account.login"><img src="images/login.gif" border="0"></a>';	
	else
		echo '<a href="?page=account.register"><img src="images/back.gif" border="0"></a>';	
}
else 
{
	echo '
	<center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="4">
	Crie agora mesmo sua account e come�e a se divertir no Darghos!</table>

	<br>

	<form action="?page=account.register" method="post">

	<center>
	<table width="90%" BORDER="0" CELLSPACING="1" CELLPADDING="4">
		<tr>
			<td class=rank2>Crie uma conta no Darghos</td>
		</tr>
		<tr class=rank3>
			<td>
				Endere�o de E-mail: <input class="login" name="email" type="text" value="" size="30"/>
			</td>
		</tr>
		<tr class=rank3>
			<td><br>
				<b>Termos de politica de privacidade</b>
		<center><textarea class="login" rows="7" wrap="physical" cols="55" readonly="true">Nosso compromisso em garantir a sua privacidade.

	Nossa pol�tica de privacidade visa assegurar que nenhum dado pessoal dos usu�rios utilizado no registro de contas ser�o publicadas, fornecidas ou comercializadas em qualquer circunst�ncia. O darghos obt�m os dados dos usu�rios atrav�z de tr�s maneiras: Cookies, Sess�es e Registro.

	1. Cookies e Sess�es

	- O Darghos coleta as informa��es atrav�z de cookies ou sess�es (informa��es enviadas de nosso servidor ao computador do usu�rio para identifica-lo), os Cookies e Sess�es s�o utilizados unicamente como um controle de acesso, exceto quando este desrespeita as regras de seguran�a com o fim de prejudicar o bom funcionamento do site ou servidor (hackear o servi�o). A aceita�ao dos cookies pode ser livremente alterada na configura�ao do seu navegador.

	2. Registro

	- Para desfrutar de tudo que o darghos oferece, � nescessario um registro em nosso servidor, criando uma conta, para a partir disso criar um personagem. O registro � feito sob um endere�o de e-mail, onde os dados de sua conta ser�o enviados, e que tamb�m poder� ser utilizado por voc� no futuro, por exemplo, para recuperar sua conta em caso de perda. N�s tamb�m podemos usar seu email para enviar mensagens sobre o Darghos. As contas, assim como todos os dados necess�rios para registro s�o mantidos em um banco de dados protegido e sigiloso em nosso servidor. N�o divulgamos o seu endere�o de email em qualquer circunst�ncia.

	3. Seguran�a das informa��es

	- Todos os dados pessoais informados ao nosso site, s�o armazenados em um banco de dados reservado e com acesso restrito a alguns funcion�rios habilidados, que s�o obrigados, por contrato,  manter confidencial todas as informa��es e n�o utilizadas inadequadamente.

	Assegurar a sua privacidade � mais um compromisso do Darghos com voc�!</textarea></center></td>
		</tr>
		<tr class=rank3>
			<td>
				<input type="checkbox" name="privacidade" value="1"> Eu concordo com os termos da politica de privacidade oferecidos pelo darghos.
			</td>
		</tr>
	</table><br>
	<input type="image" value="Entrar" src="images/newaccount.gif"/>
	<br />
	</form>
	</center>
	</ul>';
}
?>