<?
echo '<tr><td class=newbar><center><b>:: Recuperação da Account ::</td></tr>
<tr><td class=newtext>';

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$nick = filtreString($_POST['nick'],0);
		$email = filtreString($_POST['email'],0);
		$nickQuery = mysql_query("SELECT * FROM players WHERE name = '$nick'");
		$button = '<a href="?page=lost.both"><img src="images/back.gif" border="0"></a>';
		$nickFetch = mysql_fetch_object($nickQuery);
		$getAccountOfPlayer = $nickFetch->account_id;
		$accountQuery = mysql_query("SELECT * FROM accounts WHERE id = '$getAccountOfPlayer'");
		$accountFetch = mysql_fetch_object($accountQuery);
		$getEmailOfAccount = $accountFetch->email;			
		
		$body = 
		'Dear player of Darghos,
The request for recovery of your account was made successfully!
				
Your account is: '.$accountFetch->id.'
					
To recovery you password visit:
http://ot.darghos.com/index.php?page=account.lost
				
See you in World of Darghos!
UltraxSoft Team.';		

		if(mysql_num_rows($nickQuery) == 0)
		{	
		
			$condition = 'Erro';
			$conteudo = 'Personagem não existe';		
		}	
		elseif($email != $getEmailOfAccount)
		{
			$condition = 'Erro';
			$conteudo = 'Este email está incorreto';
		}
		elseif(!mailex($email, 'Account details!', $body))
		{
			$condition = 'Erro!';
			$conteudo = "<br><center>(fail 345) - This was a fatal error to send your email, if it is first time you read this screen please try again with another email. If it is not the first time, please contact the UltraxSoft Team.</center>";			
		}
		else
		{
			$condition = 'Sucesso!';
			$conteudo = 'Sua conta foi recuperada com sucesso!<br>Foi-lhe enviado um e-mail contendo os dados de sua conta!';
			$button = '<a href="?page=account.login"><img src="images/back.gif" border="0"></a>';	
		}			
		
		echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2>'.$condition.'</td></tr>';
		echo '</table>';
		echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
		echo '<tr><td class=rank1>'.$conteudo.'</td></tr>';
		echo '</table>';
		echo '<br>'.$button.'';	
	}

	echo '<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">';
	echo 'Recupere o numero de sua conta e senha preenchendo o campo abaixo.<br>';
	echo 'Dica: Memorize sua conta para evitar esse tipo de problema no futuro.';
	echo '</table>';
	echo '<center>';
	echo '<form method="POST" action="?page=lost.both">';

	echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">';
	echo '<tr class=rank1><td width="25%">E-mail:</td><td width="75%"><input name="email" type="text" value="" class="login" size="30"/></td></tr>';
	echo '<tr class=rank1><td width="25%">Personagem da conta:</td><td width="75%"><input name="nick" type="text" value="" class="login" size="30"/></td></tr>';
	echo '</table>';
	echo '<br />';
	echo '<input type="image" value="Entrar" src="images/submit.gif"/> <a href="?page=account.lost"><img src="images/back.gif" border="0"></a>';
	echo '</form>';
	echo '<br>';
?>