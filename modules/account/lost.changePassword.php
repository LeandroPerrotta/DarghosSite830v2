<?
echo '<tr><td class=newbar><center><b>:: Chave de recuperação ::</td></tr>
<tr><td class=newtext><br>';

$a = filtreString($_POST['account'],0);
$k = filtreString($_POST['key'],0);
$email = Account::getEmail($a);

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(check_passKey($a,$k) == true)
	{
		$newPass = new_pass($a);
		$body = 
		'Dear player of Darghos,
Your new password was generated successfully!
				
Your new password is: '.$newPass.'

Ps: Change your password to one of your preference.
					
To acess you home account visit:
'.GLOBAL_URL.'/?page=account.login
				
See you in World of Darghos!
UltraxSoft Team.';	
		
		if (!mailex($email, 'Account details!', $body))
		{
			echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
			echo '<tr><td class=rank2>Falha ao enviar email</td></tr>';
			echo '</table>';
			echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
			echo '<tr><td class=rank1>Ouve um congestionamento no sistema de envio de emails que impossibilitou o envio do seu email. Tente novamente mais tarde.</td></tr>';
			echo '</table>';
			echo '<br><a href="?page=account.lost"><img src="images/back.gif" border="0"></a>';			
		}				
		else
		{					
			echo '<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
			echo '<tr><td class=rank2>E-mail enviado com exito!</td></tr>';
			echo '<tr><td class=rank1>Foi lhe enviado um email com os dados de sua conta para recuperação!
			<br>Este email tem um prazo de 24 horas para chegar, mas normalmente chega na hora.
			<br><br>
			Aviso: Alguns provedores de email como a Hotmail entre outros, estão redirecionando os nossos emails enviados para a lixeira (ou lixo eletronico).
			<br> Devido a isto, caso seu email não chega na sua caixa de entrada, verifique nas pastas de lixo eletronico.
			<br>
			<br>Atenciosamente,
			<br>Darghos Team.</td></tr>';
			echo '</table>';
			echo '<br><a href="?page=account.login"><img src="images/login.gif" border="0"></a>';
		}
	}
	else
	{
		echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2>Erro!</td></tr>';
		echo '</table>';
		echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
		echo '<tr><td class=rank1>
		<br>Não foi possivel gerar sua nova senha.</b>
		<br>Numero de conta ou chave invalidas.';
		echo '</table>';
		echo '<br><a href="?page=lost.changePassword"><img src="images/back.gif" border="0"></a>';		
	}
	
}
else
{
	echo '<center>';
	echo '<form method="POST" action="?page=lost.changePassword">';
	echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">';
	echo '<tr class=rank1><td width="25%">Conta:</td><td width="75%"><input name="account" type="password" value="" class="login"/></td></tr>';
	echo '<tr class=rank1><td width="25%">Chave de recuperação:</td><td width="75%"><input name="key" type="text" value="" class="login"/></td></tr>';
	echo '</table>';
	echo '<br />';
	echo '<input type="image" value="Entrar" src="images/submit.gif"/> <a href="?page=account.lost"><img src="images/back.gif" border="0"></a>';
	echo '</form>';	
	echo '<br>';	
}
?>