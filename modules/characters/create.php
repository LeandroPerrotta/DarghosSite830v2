<?
if($engine->loggedIn())
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$namein = $_POST['name'];
		$prefixo = $_POST['prefixo'];
		$hidden = $_POST['hidden'];
		$server = 1;
		$group_id = 1;

		if(Account::getType($account) == 4)
			$prefixo = 'GM';
		elseif(Account::getType($account) == 5)
			$prefixo = 'CM';				
		elseif(Account::getType($account) == 6)
			$prefixo = $_POST['prefixo'];		

		if(!isset($_POST['pvp']))
			$pvpmode = 0;
		else
			$pvpmode = $_POST['pvp'];		

		switch($_POST['sex'])
		{	
			case "male";
				$sexin = 1;
			break;
			
			case "female";
				$sexin = 0;
			break;	

			default;
				$sexin = 1;
			break;				
		}	

		$gmType = false;	
		$rookguard = false;

		if(isset($_POST['voc']) and isset($_POST['res']))
		{
			switch($_POST['voc'])
			{	
				case "sorcerer";
					$voc = 1;
				break;
				
				case "druid";
					$voc = 2;
				break;
				
				case "paladin";
					$voc = 3;
				break;	

				case "knight";
					$voc = 4;
				break;	

				default;
					$voc = 1;
				break;	
			}
			
			if(Account::isPremium($account))
			{
				switch($_POST['res'])
				{	
					case "quendor";
						$res = 1;
					break;
					
					case "aracura";
						$res = 2;
					break;
					
					case "thorn";
						$res = 4;
					break;	

					case "salazart";
						$res = 5;
					break;		

					case "norhrend";
						$res = 7;
					break;	

					default;
						$res = 1;
					break;				
				}	
			}
			else	
			{
				switch($_POST['res'])
				{	
					case "quendor";
						$res = 1;
					break;
					
					case "thorn";
						$res = 4;
					break;	

					default;
						$res = 1;
					break;				
				}
			}	
		}
		else
		{
			$res = 3;
			$voc = 0;	
			$rookguard = true;
		}

		$lookbody = 116;
		$lookfeet = 116;
		$lookhead = 116;
		$looklegs = 116;

		if($sexin == 0)
			$looktype = 136;	
		elseif($sexin == 1)
			$looktype = 128;

		if(Account::isGM($account) or Account::isCM($account) or Account::isAdmin($account))
		{
			if($hidden == 1)
				$namein = ''.$prefixo.' '.$namein.'';

			$lookbody = 91;
			$lookfeet = 91;
			$lookhead = 91;
			$looklegs = 91;	
			$gmType = true;	
		}

		if($gmType == true)
		{
			if($prefixo == 'GM')
			{
				$group_id = 4;
				$looktype = 75;
			}	
					
			if($prefixo == 'CM')
			{
				$group_id = 5;		
				$looktype = 266;
			}	
			if($prefixo == 'GOD')
			{
				$group_id = 6;		
				$looktype = 266;
			}			
		}

		$check = mysql_query("SELECT * FROM players WHERE name = '".addslashes($namein)."' LIMIT 1") or die(mysql_error());
		$playerOfAccount = mysql_query("SELECT * FROM players WHERE account_id = '$account'") or die(mysql_error());
		$GMOfAccount = mysql_query("SELECT * FROM players WHERE account_id = '$account' and group_id > '1'") or die(mysql_error());

		$temp = strspn("$namein", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM -");
			echo '<tr><td class=newbar><center><b>:: Make a new Character ::</td></tr>
		<tr><td class=newtext>';

		$button = '<br><a href="?page=character.newForm"><img src="images/back.gif" border="0"></a>';
		if (!preg_match("/^[a-zA-Z][a-zA-Z ]*$/", $namein))  
		{
			$condition = 'Não foi possivel criar seu personagem.';
			$error = 'Este nome contem carateres ilegais.';
		}
		elseif (filtreString($namein,1) == 0)
		{
			$condition = 'Não foi possivel criar seu personagem.';
			$error = 'Este nick contem sintaxes especiais.';	
		}
		elseif ($temp != strlen($namein))
		{
			$condition = 'Incorrect name';
			$error = 'Your character\'s name is not valid. Keep in mind that only letters and blankspaces are permitted. Please choose another one';			
		}
		elseif (strlen($namein) < 3 || strlen($namein) > 29)
		{
			$condition = 'Wrong length';
			$error = 'Your character\'s name is not valid. You must use a name with at least 2 letters and at most 20 letters. Please choose another one.';		
		}	
		elseif ($server == '')
		{
			$condition = 'Game Server';
			$error = 'Please select a Game Server.';	
		}	
		elseif (Account::isPlayer($account) and reservedNames($namein) == 0)
		{
			$condition = 'Não foi possivel criar seu personagem.';
			$error = 'Este nick contem sintaxes reservadas.';		
		}
		elseif(mysql_num_rows($check) == 1) 
		{ 
			$condition = 'Não foi possivel criar seu personagem.';
			$error = 'Este nick já esta em uso no jogo.';	
		}
		elseif(!Account::isAdmin($account) and mysql_num_rows($playerOfAccount) > 10 or Account::isGM($account) and mysql_num_rows($GMOfAccount) > 1 or Account::isCM($account) and mysql_num_rows($GMOfAccount) > 1) 
		{ 
			$condition = 'Não foi possivel criar seu personagem.';
			$error = 'Sua conta já esta com o numero maximo possivel de personagens criados.';	
		}	
		else
		{
			if($rookguard == true)
			{
				$level = 1;
				$experience = 0;
				$magic = 0;
				$health = 150;
				$mana = 0;
				$cap = 400;		
			}
			elseif($gmType == true)
			{
				$level = 20;
				$experience = 0;
				$magic = 0;
				$health = 1;
				$mana = 1;
				$cap = 1;		
			}
			else
			{
				$level = 8;
				$experience = 4200;
				$magic = 0;
				$health = 185;
				$mana = 35;
				$cap = 470;
			}
			
			mysql_query("INSERT INTO players (name, account_id, group_id, sex, vocation, experience, level, maglevel, health, healthmax, mana, manamax, lookbody, lookfeet, lookhead, looklegs, looktype, cap, town_id, server, pvpmode, created) values ('$namein','$account','$group_id','$sexin','$voc','$experience','$level','$magic','$health','$health','$mana','$mana','$lookbody','$lookfeet','$lookhead','$looklegs','$looktype','$cap','$res','$server','$pvpmode', '".time()."')") or die(mysql_error());

			$get_id = mysql_query("SELECT * FROM players WHERE (name = '$namein')") or die(mysql_error());
			$fetch_get_id = mysql_fetch_object($get_id);
			$playerid = $fetch_get_id->id;
			
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','0','10','0')") or die(mysql_error());
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','1','10','0')") or die(mysql_error());
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','2','10','0')") or die(mysql_error());
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','3','10','0')") or die(mysql_error());
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','4','10','0')") or die(mysql_error());
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','5','10','0')") or die(mysql_error());
			mysql_query("INSERT INTO player_skills(player_id, skillid, value, count) values('$playerid','6','10','0')") or die(mysql_error());
			
			if($gmType == true) // GM Char
			{
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','101','3','1988','1','')") or die(mysql_error());
				//backpack inside
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','102','101','2554','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','103','101','2120','1','')") or die(mysql_error());
				//end backpack			
			}			
			elseif($voc == 0)  // No-Voc
			{
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','101','3','1987','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','102','4','2467','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','103','6','2382','1','')") or die(mysql_error());
				//backpack inside
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','104','101','2666','2','')") or die(mysql_error());
				//end backpack			
			}			
			elseif($voc == 1)  // Sorcerer
			{
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','101','1','2480','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','102','3','1988','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','103','4','2464','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','104','5','2530','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','105','6','2190','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','106','7','2468','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','107','8','2643','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','108','10','2120','1','')") or die(mysql_error());
				//backpack inside
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','109','102','2666','2','')") or die(mysql_error());
				//end backpack			
			}	
			elseif($voc == 2) //Druid
			{
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','101','1','2480','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','102','3','1988','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','103','4','2464','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','104','5','2530','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','105','6','2182','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','106','7','2468','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','107','8','2643','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','108','10','2120','1','')") or die(mysql_error());
				//backpack inside
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','109','102','2666','2','')") or die(mysql_error());
				//end backpack	
			}		
			elseif($voc == 3) //Paladin
			{
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','101','1','2480','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','102','3','1988','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','103','4','2464','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','104','5','2530','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','105','6','2389','5','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','106','7','2468','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','107','8','2643','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','108','10','2120','1','')") or die(mysql_error());
				//backpack inside
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','109','102','2666','2','')") or die(mysql_error());
				//end backpack	
			}	
			elseif($voc == 4) //Knight
			{
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','101','1','2480','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','102','3','1988','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','103','4','2464','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','104','5','2530','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','105','6','2412','5','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','106','7','2468','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','107','8','2643','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','108','10','2120','1','')") or die(mysql_error());
				//backpack inside
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','109','102','2666','2','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','110','102','2388','1','')") or die(mysql_error());
				mysql_query("INSERT INTO player_items(player_id, sid, pid, itemtype, count, attributes) values('$playerid','111','102','2398','1','')") or die(mysql_error());
				//end backpack		
			}
			
			$condition = 'Personagem criado com sucesso!';
			$error = '<br>Caso não tenha feito o download do jogo, fassa-o agora clicando <a href="http://www.darghos.com/download/installer.exe">aqui</a>.</b>
		<br>Em seu primeiro login mude o seu outfit para o de sua preferencia.
		<br>Nos vemos no Darghos!';	
			$button = '<br><a href="?page=account.main"><img src="images/back.gif" border="0"></a>';	
		}

		echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2>'.$condition.'</td></tr>';
		echo '</table>';
		echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
		echo '<tr><td class=rank1>'.$error.'';
		echo '</table>';
		echo ''.$button.'';	
	}
}		
?>