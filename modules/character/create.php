<?
if($login->logged())
{
	if($_REQUEST['step'] == 1)
	{		
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('character.create')).'
		'.$eHTML->formStart('?act=character.create&step=2').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['start_mode'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td>
								'.$eHTML->radioInput('start_mode', 0, true).' Rookgaard<br>
								'.$eHTML->radioInput('start_mode', 1).' Main Land
							</td>
						</tr>
						
					</table>
				</td>
			</tr>	
		</table>	
		<br>
		<center>
		'.$eHTML->simpleButton('back','?act=account.main').'
		'.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';
	}
	elseif($_REQUEST['step'] == 2)
	{
		if($_POST['start_mode'] == 1)
		{
			$account = $engine->loadObject('Account');
			$account->loadByNumber($_SESSION['account']);	
		
			$account->load();	
		
			if($account->getInfo('premdays') != 0)
			{
				foreach($g_city as $key => $city)
				{
					if($city['name'] != "Rookgaard")
						$citys[] = array('valueName' => $city['name'], 'valueId' => $key);
				}
			
				$citysSelect = $eHTML->selectBoxInput('city', $citys);
			}
			else
			{
				foreach($g_city as $key => $city)
				{
					if($city['name'] != "Rookgaard")
						if(!$city['isPremium'])
							$citys[] = array('valueName' => $city['name'], 'valueId' => $key);
				}
								
				$citysSelect = $eHTML->selectBoxInput('city', $citys);	
			}	
		
			foreach($g_vocation as $vocation)
			{
				if(!$vocation['promotion'] and $vocation['name'] != "begginer")
					$vocations[] = array('valueName' => $trans_texts[$vocation['name']][$g_language], 'valueId' => $vocation['id']);
			}
					
			$vocationsSelect = $eHTML->selectBoxInput('vocation', $vocations);		
		}
		else
		{
			foreach($g_city as $key => $city)
			{
				if($city['name'] == "Rookgaard")
					$citys[] = array('valueName' => $city['name'], 'valueId' => $key);
			}	
	
			foreach($g_vocation as $vocation)
			{
				if($vocation['name'] == "begginer")
					$vocations[] = array('valueName' => $trans_texts[$vocation['name']][$g_language], 'valueId' => $vocation['id']);
			}
			
			$citysSelect = $eHTML->selectBoxInput('city', $citys, true);
			$vocationsSelect = $eHTML->selectBoxInput('vocation', $vocations, true);				
		}		
		
		foreach($g_sex as $sex)
		{
				$sexs[] = array('valueName' => $trans_texts[$sex['name']][$g_language], 'valueId' => $sex['id']);
		}			
		
		
		foreach($g_world as $world)
		{
				if($world['population'] == 'empty')
					$population = "<font color='green'><b>".$trans_texts['empty'][$g_language]."</b></font>";
				if($world['population'] == 'normal')
					$population = "<b>".$trans_texts['normal'][$g_language]."</b>";					
				else
					$population = "<font color='red'><b>".$trans_texts['full'][$g_language]."</b></font>";
		
				$worlds[] = array('valueName' => $world['name'], 'valueId' => $world['id'], 'onSince' => $world['onSince'], 'population' => $population, 'location' => $world['location']);
		}		
			
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('character.description')).'
		'.$eHTML->formStart('?act=character.create&step=3').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['character_features'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td>'.$trans_texts['name'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('char_name', 'text').'</td>
						</tr>
						<tr>
							<td>'.$trans_texts['sex'][$g_language].':</td>
							<td>'.$eHTML->selectBoxInput('sex', $sexs).'</td>
						</tr>	
						<tr>
							<td>'.$trans_texts['vocation'][$g_language].':</td>
							<td>'.$vocationsSelect.'</td>
						</tr>	
						<tr>
							<td>'.$trans_texts['residence'][$g_language].':</td>
							<td>'.$citysSelect.'</td>
						</tr>						
					</table>	
				</td>
			</tr>	
		</table>
		<br>
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="4">'.$trans_texts['worldToCharacter'][$g_language].'</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%"><b>'.$trans_texts['name'][$g_language].'</td><td class="tableContLight"><b>'.$trans_texts['online_since'][$g_language].'</td><td class="tableContLight"><b>'.$trans_texts['population'][$g_language].'</td><td class="tableContLight"><b>'.$trans_texts['server_location'][$g_language].'</td>		
			</tr>';				
			
		$first = true;	
		foreach($worlds as $world)	
		{			
			$radio = $eHTML->radioInput('world_id', $world['valueId'], $first);
		
			$content .= '
			<tr class="tableContLight">	
				<td>'.$radio.' '.$world['valueName'].'</td><td>'.$world['onSince'].'</td><td>'.$world['population'].'</td><td>'.$world['location'].'</td>
			</tr>';		
				
			$first = false;	
		}
					
		$content .= '</table>		
		<br>
		<center>
		'.$eHTML->simpleButton('back','?act=character.create&step=1').'
		'.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';
	}	
	elseif($_REQUEST['step'] == 3)
	{	
		$nameString = $_POST['char_name'];
		
		$player = $engine->loadObject('player');	
		$player->setName($nameString);

		if($_POST['char_name'] == "" OR $_POST['char_name'] == null OR $_POST['sex'] == "" OR $_POST['sex'] == null OR $_POST['city'] == "" OR $_POST['city'] == null OR $_POST['vocation'] == "" OR $_POST['vocation'] == null)
		{
			$warn = $lang->getWarning('geral.camposVazios');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],	
				"buttons" => $eHTML->simpleButton('back','?act=character.create&step=1')
			);	
		}	
		elseif(!$tools->canUseName($nameString) OR !$tools->checkString($nameString) OR !$tools->checkString($_POST['sex']) OR !$tools->checkString($_POST['city']) OR !$tools->checkString($_POST['vocation']))
		{
			$warn = $lang->getWarning('char.nomeInvalido');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=character.create&step=1')
			);	
		}
		elseif($player->exists())
		{
			$warn = $lang->getWarning('char.nomeExistente');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=character.create&step=2')
			);		
		}
		else
		{
			if($_POST['vocation'] == VOC_NOVOC)
			{
				$statusChar = array(
					'level' => 1, 
					'experience' => 0,
					'cap' => 400,
					'health' => 150,
					'mana' => 0,
				);
				
				$itemsChar = array(
					//Inventario
					array(SLOT_BACKPACK, 101, 1987, 1),
					array(SLOT_ARMOR, 102, 2467, 1),
					array(SLOT_LEFTHAND, 103, 2382, 1),
					
					//backpack
					array(101, 102, 2666, 2),
				);
			}
			else
			{
				if($_POST['vocation'] == VOC_SORCERER)
				{
					$itemsChar = array(
						//Inventario
						array(SLOT_HEAD, 101, 2480, 1),
						array(SLOT_BACKPACK, 102, 1988, 1),
						array(SLOT_ARMOR, 103, 2464, 1),
						array(SLOT_RIGHTHAND, 104, 2530, 1),
						array(SLOT_LEFTHAND, 105, 2190, 1),
						array(SLOT_LEGS, 106, 2468, 1),
						array(SLOT_FEET, 107, 2643, 1),
						array(SLOT_AMMO, 108, 2120, 1),
						
						//backpack
						array(102, 109, 2666, 2),
					);				
				}
				elseif($_POST['vocation'] == VOC_DRUID)
				{
					$itemsChar = array(
						//Inventario
						array(SLOT_HEAD, 101, 2480, 1),
						array(SLOT_BACKPACK, 102, 1988, 1),
						array(SLOT_ARMOR, 103, 2464, 1),
						array(SLOT_RIGHTHAND, 104, 2530, 1),
						array(SLOT_LEFTHAND, 105, 2182, 1),
						array(SLOT_LEGS, 106, 2468, 1),
						array(SLOT_FEET, 107, 2643, 1),
						array(SLOT_AMMO, 108, 2120, 1),
						
						//backpack
						array(102, 109, 2666, 2),
					);						
				}
				elseif($_POST['vocation'] == VOC_PALADIN)
				{
					$itemsChar = array(
						//Inventario
						array(SLOT_HEAD, 101, 2480, 1),
						array(SLOT_BACKPACK, 102, 1988, 1),
						array(SLOT_ARMOR, 103, 2464, 1),
						array(SLOT_RIGHTHAND, 104, 2530, 1),
						array(SLOT_LEFTHAND, 105, 2389, 5),
						array(SLOT_LEGS, 106, 2468, 1),
						array(SLOT_FEET, 107, 2643, 1),
						array(SLOT_AMMO, 108, 2120, 1),
						
						//backpack
						array(102, 109, 2666, 2),
					);						
				}
				elseif($_POST['vocation'] == VOC_KNIGHT)
				{
					$itemsChar = array(
						//Inventario
						array(SLOT_HEAD, 101, 2480, 1),
						array(SLOT_BACKPACK, 102, 1988, 1),
						array(SLOT_ARMOR, 103, 2464, 1),
						array(SLOT_RIGHTHAND, 104, 2530, 1),
						array(SLOT_LEFTHAND, 105, 2412, 1),
						array(SLOT_LEGS, 106, 2468, 1),
						array(SLOT_FEET, 107, 2643, 1),
						array(SLOT_AMMO, 108, 2120, 1),
						
						//backpack
						array(102, 109, 2666, 2),
						array(102, 110, 2388, 1),
						array(102, 111, 2398, 1),
					);					
				}				
				
				$statusChar = array(
					'level' => 8, 
					'experience' => 4200,
					'cap' => 470,
					'health' => 185,
					'mana' => 35,
				);
				
				
			}
			
			switch($_POST['city'])
			{
				case CITY_QUENDOR:
					$direction = DIR_NORTH;
				break;	
				
				case CITY_ARACURA:
					$direction = DIR_WEST;
				break;	

				case CITY_THORN:
					$direction = DIR_SOUTH;
				break;	

				case CITY_ROOKGAARD:
					$direction = DIR_NORTH;
				break;	

				case CITY_ROOKGAARD:
					$direction = DIR_SOUTH;
				break;				
			}
			
			$player->setAccount($_SESSION['account']);
			$player->setSex($_POST['sex']);
			$player->setVocation($_POST['vocation']);
			$player->setExperience($statusChar['experience']);
			$player->setLevel($statusChar['level']);
			$player->setHealth($statusChar['health']);
			$player->setMana($statusChar['mana']);	
			$player->setDirection($direction);		
			$player->setLook("DEFAULT");
			$player->setCap($statusChar['cap']);
			$player->setTownId($_POST['city']);	
			$player->setCreation();		
			$player->setWorld($_POST['world_id']);
			
			$player->saveNew();

			$player->getIdOnServer();
		
			foreach($itemsChar as $item)
			{
				$player->addItem($item[0], $item[1], $item[2], $item[3]);
			}
		
			$warn = $lang->getWarning('char.sucesso');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.main')
			);	
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
}	
?>