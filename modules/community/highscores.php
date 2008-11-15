<?
if(isset($_POST['world']))
{
	if(isset($_POST['skill']))
		$tools->redirect('?act=highscores&world='.$_POST['world'].'&skill='.$_POST['skill'].'');
	else
		$tools->redirect('?act=highscores&world='.$_POST['world'].'');
}

if(isset($_REQUEST['world']))
{		
	$server = $_REQUEST['world'];
	
	if(isset($_REQUEST['skill']))
		$skill = $_REQUEST['skill'];
	else
		$skill = 7;

	foreach($g_world as $world)
	{
		if($world['id'] == $server)
			$worlds[] = array('valueName' => $world['name'], 'valueId' => $world['id'], 'select' => true);
		else
			$worlds[] = array('valueName' => $world['name'], 'valueId' => $world['id']);
	}
	
	foreach($g_skill as $key => $skillName)
	{
		if($key == $skill)
			$skills[] = array('valueName' => $trans_texts[$skillName][$g_language], 'valueId' => $key, 'select' => true);
		else
			$skills[] = array('valueName' => $trans_texts[$skillName][$g_language], 'valueId' => $key);			
	}	
	
	$content .= '
		'.$eHTML->formStart('?act=highscores').'
		'.$eHTML->descriptionTable($lang->getDescription('community.highscores')).'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="4">'.$trans_texts['select_world_skill'][$g_language].'</td>
			</tr>	
			<tr>
				<td class="tableContLight" width="20%">'.$trans_texts['world'][$g_language].'</td><td class="tableContLight">'.$eHTML->selectBoxInput('world', $worlds, true).'</td>
			</tr>			
			<tr>
				<td class="tableContLight" width="20%">'.$trans_texts['skills'][$g_language].'</td><td class="tableContLight">'.$eHTML->selectBoxInput('skill', $skills, true).'</td>
			</tr>				
		</table>
		<br>
		<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td><center>
					'.$eHTML->imageButtonInput('next').'</center>	
				</td>
			</tr>
		</table>
		<br>
		'.$eHTML->formEnd().'				
	';	

	$content .= '<center><big>'.$trans_texts['highscores_skill_in'][$g_language][0].''.$trans_texts[$g_skill[$skill]][$g_language].''.$trans_texts['highscores_skill_in'][$g_language][1].''.$g_world[$server]['name'].'</big></center><br>';
	
	$skillid = $g_skill[$skill];
	
	if($skillid == "experience")
		$DB->query("SELECT name, level, experience FROM high_{$skillid} WHERE world_id = ".$server." ORDER by experience DESC LIMIT 300 ");
	else	
		$DB->query("SELECT name, level FROM high_{$skillid} WHERE world_id = ".$server." ORDER by level DESC LIMIT 300 ");
	
	if($skillid == "experience")
	{
		$content .= '
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" width="5%"></td><td class="tableTop" width="55%"><b>'.$trans_texts['name'][$g_language].'</td><td class="tableTop" width="15%"><b>'.$trans_texts['level'][$g_language].'</td><td class="tableTop"><b>'.$trans_texts['points'][$g_language].'</td>
				</tr>';
	}
	else
	{
		$content .= '
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" width="5%"></td><td class="tableTop" width="75%"><b>'.$trans_texts['name'][$g_language].'</td><td class="tableTop" colspan="2"><b>'.$trans_texts['points'][$g_language].'</td>
				</tr>';	
	}	
	
	while($fetch = $DB->fetch())	
	{
		$count++;
		if($skillid == "experience")
		{
			$content .= '			
				<tr>
					<td class="tableContLight">'.$count.'</td><td class="tableContLight"><a href="?act=character.details&name='.$fetch->name.'">'.$fetch->name.'</a></td><td class="tableContLight">'.$fetch->level.'</td><td class="tableContLight">'.$fetch->experience.'</td>
				</tr>
			';		
		}	
		else
		{
			$content .= '			
				<tr>
					<td class="tableContLight">'.$count.'</td><td class="tableContLight"><a href="?act=character.details&name='.$fetch->name.'">'.$fetch->name.'</a></td><td class="tableContLight" colspan="2">'.$fetch->level.'</td>
				</tr>
			';				
		}
	}
			
	$content .= '			
		</table>	
	';	
}
else
{
	foreach($g_world as $world)
	{
		$worlds[] = array('valueName' => $world['name'], 'valueId' => $world['id']);
	}

	$content .= '
		'.$eHTML->formStart('?act=highscores').'
		'.$eHTML->descriptionTable($lang->getDescription('community.highscores')).'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="4">'.$trans_texts['select_world'][$g_language].'</td>
			</tr>	
			<tr>
				<td class="tableContLight" width="20%">'.$trans_texts['world'][$g_language].'</td><td class="tableContLight">'.$eHTML->selectBoxInput('world', $worlds).'</td>
			</tr>				
		</table>
		<br>
		'.$eHTML->hiddenInput('new', 1).'
		<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td><center>
					'.$eHTML->imageButtonInput('next').'</center>	
				</td>
			</tr>
		</table>
		<br>
		'.$eHTML->formEnd().'				
	';	
}
?>