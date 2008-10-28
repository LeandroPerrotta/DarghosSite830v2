<?
if($login->logged())
{
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$account = $engine->loadObject('Account');	
		$account->loadByNumber($_SESSION['account']);
		$account->load();
		
		$new_password = md5($_POST['new_password']);
		$conf_password = md5($_POST['conf_password']);
		$old_password = md5($_POST['old_password']);
		
		if(($new_password and $conf_password and $old_password) == (null or ""))
		{
			$warn = $lang->getWarning('geral.camposVazios');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changepassword')
			);	
		}
		elseif($old_password != $account->getPassword())
		{
			$warn = $lang->getWarning('changepass.antigaIncorreta');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changepassword')
			);		
		}
		elseif($new_password != $conf_password)
		{
			$warn = $lang->getWarning('changepass.confFalhou');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changepassword')
			);		
		}	
		elseif($new_password == $old_password)
		{
			$warn = $lang->getWarning('changepass.iguais');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changepassword')
			);		
		}			
		elseif(strlen($_POST['new_password']) < 5 or strlen($_POST['new_password']) > 25)
		{
			$warn = $lang->getWarning('changepass.tamanhoInvalido');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.changepassword')
			);		
		}		
		else
		{
			$account->setPassword($new_password);
			$account->save($loginServer = true, $gameServer = true);
			
			$_SESSION["password"] = $new_password;
			
			$warn = $lang->getWarning('changepass.sucesso');
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
		'.$eHTML->descriptionTable($lang->getDescription('account.changepassword')).'
		'.$eHTML->formStart('?act=account.changepassword').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['change_password'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td width="25%">'.$trans_texts['new_password'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('new_password', 'password').'</td>
						</tr>	
						<tr>
							<td width="25%">'.$trans_texts['confirmation'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('conf_password', 'password').'</td>
						</tr>	
						<tr>
							<td width="25%">'.$trans_texts['old_password'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('old_password', 'password').'</td>
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