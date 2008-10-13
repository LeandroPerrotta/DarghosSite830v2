<?
$a = md5(filtreString($_POST['pass'],0));
$e = filtreString($_POST['email'],0);

echo '<tr><td class=newbar><center><b>:: Recuperação da Account ::</td></tr>
<tr><td class=newtext>';

	if($a != NULL && $e != NULL)
	{
		$pattern = "([A-Z_a-z_0-9])+@([a-zA-Z_0-9]).([A-Z_a-z_0-9])+";
		if(ereg($pattern,$e) == false)
		{
			$tipo = 2;
			$causa2 = '<font color=red>Você precisa colocar um e-mail válido.</font>';
			$erro = 1;
		}
			$query = mysql_query("SELECT * FROM `accounts` WHERE (`password` = '$a' AND `email` = '$e')");
			if(mysql_num_rows($query) == 1)
			{
				while($row = mysql_fetch_object($query))
				{
				
					$body = 
					'Dear player of Darghos,
The request for recovery of your password was made successfully!
				
Your account is: '.$row->id.'
					
To access your home account visit:
http://ot.darghos.com/index.php?page=account.login
				
See you in World of Darghos!
UltraxSoft Team.';	
				
					if (!mailex($e, 'Account details', $body))
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
						echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
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
						echo '<br><a href="?page=account.lost"><img src="images/login.gif" border="0"></a>';
					}				
				}
			}
			else
			{
				echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
				echo '<tr><td class=rank2>Erro!</td></tr>';
				echo '</table>';
				echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
				echo '<tr><td class=rank1>
				<br>Não foi possivel recuperar sua conta.</b>
				<br>Confime a sua senha e seu e-mail e tente novamente. ';
				echo '</table>';
				echo '<br><a href="?page=lost.account"><img src="images/back.gif" border="0"></a>';			
			}
	}
?>
<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
Recupere o numero de sua conta preenchendo o campo abaixo.<br>
Dica: Memorize sua conta para evitar esse tipo de problema no futuro.
</table>
<center>
<form method="POST" action="?page=lost.account">

<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">
<tr class=rank1><td width="25%">E-mail:</td><td width="75%"><input name="email" type="text" value="" class="login" size="30"/></td></tr>
<tr class=rank1><td width="25%">Senha:</td><td width="75%"><input name="pass" type="password" value="" class="login"/></td></tr>
</table>
<br />
<input type="image" value="Entrar" src="images/submit.gif"/> <a href="?page=account.lost" img src="images/back.gif" border="0"></a>
</form>
<br>