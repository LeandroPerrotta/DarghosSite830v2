<?
if($login->logged())
{
	$idEnc = $_GET['id'];

	$player = $engine->loadObject('player');	
	if(is_numeric($idEnc) && $player->loadById($idEnc, $enc = true))
	{
		if($player->getInfo('account_id') == $_SESSION['account'])
		{
			if ($_SERVER['REQUEST_METHOD'] == "POST")
			{
				$comment = $_POST['comment'];
				$hide = $_POST['hide'];			

				if(!$tools->checkString($comment, true))
				{
					$warn = $lang->getWarning('geral.entradasReservadas');
					$condition = array
					(
						"title" => $warn['title'],
						"msg" => $warn['msg'],
						"buttons" => $eHTML->simpleButton('back','?act=character.preferences&id='.$idEnc.'')
					);	
				}	
				else
				{					
					if($hide == 1)
						$player->setHidden(true);
					else
						$player->setHidden(false);
						
					$player->setComment($comment);
					$player->save();	
					
					
					
					$warn = $lang->getWarning('char.preferencias.sucesso');
					$condition = array
					(
						"title" => $warn['title'],
						"msg" => $warn['msg'],
						"buttons" => $eHTML->simpleButton('back','?act=account.main')
					);						
				}	
				
				$content .= $eHTML->conditionTable($condition);
			}
			else
			{
				$content .= '
				'.$eHTML->descriptionTable($lang->getDescription('character.preferences')).'
				'.$eHTML->formStart('?act=character.preferences&id='.$idEnc.'').'
				<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">'.$trans_texts['character_preferences'][$g_language].'</td>
					</tr>
					<tr class="tableContLight">
						<td width="25%">'.$trans_texts['name'][$g_language].':</td>
						<td>'.$player->getInfo('name').'</td>
					</tr>	
					<tr class="tableContLight">
						<td width="25%">'.$trans_texts['comment'][$g_language].':</td>
						<td>'.$eHTML->textArea('comment', $player->getInfo('comment'), 6, 40).'</td>
					</tr>
					<tr class="tableContLight">
						<td width="25%" colspan="2">'.$eHTML->checkBoxInput('hide', 1).' '.$trans_texts['hidden'][$g_language].'</td>
					</tr>						
				</table>	
				<br>
				<center>
				'.$eHTML->simpleButton('back','?act=account.main').'
				'.$eHTML->imageButtonInput('next').'</center>	
				'.$eHTML->formEnd().'		
				';			
			}
		}
	}
}
?>