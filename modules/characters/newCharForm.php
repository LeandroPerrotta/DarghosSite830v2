<?
if($engine->loggedIn())
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if(Account::isGM($account) or Account::isAdmin($account) or Account::isCM($account))
		{
			if(Account::getType($account) == 4)
				$prefixo = '<option value="GM">GM</option>';
			elseif(Account::getType($account) == 5)
				$prefixo = '<option value="CM">CM</option>';				
			elseif(Account::getType($account) == 6)
				$prefixo = '<option value="GM">GM</option><option value="CM">CM</option><option value="GOD">GOD</option>';	
				
			if(Account::getType($account) == 6)
				$hidden = '<option value="1">Nao</option><option value="0">Sim</option>';
			else
				$hidden = '<option value="1">Nao</option>';
						
				
			echo '<tr><td class=newbar><center><b>:: Novo GameMaster ::</td></tr>';
			echo '<tr><td class=newtext>';
			echo '<br><form method="post" action="?page=character.create">';
			echo '<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
			echo '<tr><td class=rank2 colspan=2>Criando personagem</td></tr>';
			echo '<tr><td width="25%" class=rank1>Nome:</td><td width="75%" class=rank1><select name="prefixo">'.$prefixo.'</select><input type=text name=name size ="30" MAXLENGTH="29"></td></tr>';
			echo '<tr><td width="25%" class=rank1>Sex:</td><td width="75%" class=rank1><select name="sex"><option value="male">Male</option><option value="female">Female</option></select></td></tr>';
			echo '<tr><td width="25%" class=rank1>Vocation:</td><td width="75%" class=rank1><select name="voc"><option value="sorcerer">Sorcerer</option><option value="druid">Druid</option><option value="paladin">Paladin</option><option value="knight">Knight</option></select></td></tr>';
			echo '<tr><td width="25%" class=rank1>Cidade:</td><td width="75%" class=rank1><select name="res"><option value="quendor">Quendor</option><option value="thorn">Thorn</option><option value="aracura">Aracura</option></select></td></tr>';
			echo '<tr><td width="25%" class=rank1>Esconder prefixo:</td><td width="75%" class=rank1><select name="hidden">'.$hidden.'</select></td></tr>';
			echo '<tr><td width="25%" class=rank1 colspan="2">
			<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
			<tr class=rank1><td width="50%"><b>Game World</b></td><td width="20%"><b>Online Since</b></td><td width="30%"><b>Additional Information</b></td></tr>
			<tr class=rank1><td><input type="radio" name="serverId" value="1" style="border: 0;" /> Tenerian</td><td>jan/2008</td><td><center><font color="green"><i>new server</i></font></td></tr>
			</table>
			</td></tr>';			
			echo '</table>';
			echo '<br>';
			echo '<input type="image" value="submit" src="images/submit.gif"/> <a href="?page=character.newForm"><img src="images/back.gif" border="0"></a>';
			echo '</form>';	
		}
		else
		{
			if($_POST['mode'] == 2)
			{
				if(Account::isPremium($account))
					$premium_city = '<option value="aracura">Aracura</option><option value="salazart">Salazart</option><option value="northrend">Northrend</option>';

				echo '<tr><td class=newbar><center><b>:: Criar novo personagem ::</td></tr>';
				echo '<tr><td class=newtext>';
				echo '<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">';
				echo 'Por favor entre com o nome e o sexo de seu personagem. Não ultilizem nomes ilegais para seus personagens, para saber qual o tipo de nomes ilegais veja as Regras clicando <a href="?page=support"><font color="blue">aqui</font></a>.<br>';
				echo '</table>';
				echo '<form method="post" action="?page=character.create">';
				echo '<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
				echo '<tr><td class=rank2 colspan=2>Character information</td></tr>';
				echo '<tr><td width="25%" class=rank1>Name:</td><td width="75%" class=rank1><input type=text name=name size ="30" MAXLENGTH="29"></td></tr>';
				echo '<tr><td width="25%" class=rank1>Sex:</td><td width="75%" class=rank1><select name="sex"><option value="male">Male</option><option value="female">Female</option></select></td></tr>';
				echo '<tr><td width="25%" class=rank1>Vocation:</td><td width="75%" class=rank1><select name="voc"><option value="sorcerer">Sorcerer</option><option value="druid">Druid</option><option value="paladin">Paladin</option><option value="knight">Knight</option></select></td></tr>';
				echo '<tr><td width="25%" class=rank1>City:</td><td width="75%" class=rank1><select name="res"><option value="quendor">Quendor</option><option value="thorn">Thorn</option>'.$premium_city.'</select></td></tr>';
				echo '<tr><td width="25%" class=rank1 colspan="2">
				<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
				<tr class=rank1><td width="50%"><b>Game World</b></td><td width="20%"><b>Online Since</b></td><td width="30%"><b>Difficulty</b></td></tr>
				<tr class=rank1><td><input type="radio" name="serverId" value="tenerian" style="border: 0;" /> Tenerian</td><td>mar/2008</td><td><center>x10 (medium)  <br><font color=green><b>new server</td></tr>
				</table>
				</td></tr>';				
				echo '</table>';
				echo '<br>';
				echo '<input type="image" value="submit" src="images/submit.gif"/> <a href="?page=character.newForm"><img src="images/back.gif" border="0"></a>';
				echo '</form>';
			}
			elseif($_POST['mode'] == 1)	
			{
				echo '<tr><td class=newbar><center><b>:: Criar novo personagem ::</td></tr>';
				echo '<tr><td class=newtext>';
				echo '<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">';
				echo 'Por favor entre com o nome e o sexo de seu personagem. Não ultilizem nomes ilegais para seus personagens, para saber qual o tipo de nomes ilegais veja as Regras clicando <a href="?page=support"><font color="blue">aqui</font></a>.<br>';
				echo '</table>';
				echo '<form method="post" action="?page=character.create">';
				echo '<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
				echo '<tr><td class=rank2 colspan=2>Character information</td></tr>';
				echo '<tr><td width="25%" class=rank1>Name:</td><td width="75%" class=rank1><input type=text name=name size ="30" MAXLENGTH="29"></td></tr>';
				echo '<tr><td width="25%" class=rank1>Sex:</td><td width="75%" class=rank1><select name="sex"><option value="male">Male</option><option value="female">Female</option></select></td></tr>';
				echo '<tr><td width="25%" class=rank1 colspan="2">
				<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
				<tr class=rank1><td width="50%"><b>Game World</b></td><td width="20%"><b>Online Since</b></td><td width="30%"><b>Difficuty</b></td></tr>
				<tr class=rank1><td><input type="radio" name="serverId" value="tenerian" style="border: 0;" /> Tenerian</td><td>jan/2008</td><td><center><center>x10 (medium)  <br><font color=green><b>new server</td></tr>
				</table>
				</td></tr>';
				echo '</table>';
				echo '<br>';
				echo '<input type="image" value="submit" src="images/submit.gif"/> <a href="?page.character.newForm"><img src="images/back.gif" border="0"></a>';
				echo '</form>';			
			}
		}
	}
	else
	{
		echo '<tr><td class=newbar><center><b>:: Criar novo personagem ::</td></tr>';
		echo '<tr><td class=newtext>';
		echo '<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">';
		echo 'Selecione a seguir o modo de inicio de sua jornada, selecionando rookguard (recomendavel) você irá começar em uma ilha isolada, que terá como objetivo lhe ensinar melhor como jogar o Darghos. Selecionando Main, você irá "pular" rookguard, iniciando o jogo sem as instruções basicas e um monte de series de coisas que seria importante para sua jornada (ideial para jogadores que não sejam iniciantes).<br><br><font color=red><b>Note que é altamente recomendavel que você inicie sua jornada em rookguard, pois assim você ira passar a main já com alguma experiencia que será algo muito util no restante de sua jornada.<b></font><br>';
		echo '</table>';
		echo '<form method="post" action="?page=character.newForm">';
		echo '<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2 colspan=2>Modo de inicio</td></tr>';
		echo '<tr><td width="25%" class=rank1>Modo de inicio:</td><td width="75%" class=rank1><select name="mode"><option value="1">Rookguard mode</option><option value="2" selected>Main mode</option></select></td></tr>';
		echo '</table>';
		echo '<br>';
		echo '<input type="image" value="submit" src="images/submit.gif"/> <a href="?page=account.main"><img src="images/back.gif" border="0"></a>';
		echo '</form>';	
	}	
}	
?>