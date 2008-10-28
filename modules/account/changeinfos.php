<?
if($login->logged())
{
	$account = $engine->loadObject('Account');	
	$account->loadByNumber($_SESSION['account']);
	$account->load();
	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{		
		$realName = $_POST['realName'];
		$location = $_POST['location'];
		$url = $_POST['url'];
		
		if(!$tools->checkString($realName, true) or !$tools->checkString($location, true) or !$tools->checkString($url, true))
		{
			$warn = $lang->getWarning('geral.entradasReservadas');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changeinfos')
			);	
		}
		elseif(strlen($realName) > 25 or strlen($location) > 25 or strlen($url) > 50)
		{
			$warn = $lang->getWarning('containfo.tamanhoInvalido');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changepassword')
			);		
		}		
		else
		{
			$account->setRealName($realName);
			$account->setLocation($location);
			$account->setUrl($url);
			$account->save();
			
			$warn = $lang->getWarning('containfo.sucesso');
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
		'.$eHTML->descriptionTable($lang->getDescription('account.changeinfos')).'
		'.$eHTML->formStart('?act=account.changeinfos').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['personal_information_changer'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td width="25%">'.$trans_texts['real_name'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('realName', 'text', $account->getInfo('realName')).'</td>
						</tr>	
						<tr>
							<td width="25%">'.$trans_texts['location'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('location', 'text', $account->getInfo('location')).'</td>
						</tr>	
						<tr>
							<td width="25%">'.$trans_texts['URL'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('url', 'text', $account->getInfo('url')).'</td>
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
}	
?>