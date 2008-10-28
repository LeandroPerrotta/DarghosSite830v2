<?
if ($_SERVER['REQUEST_METHOD'] == "POST")
{	
	if(!$tools->checkString($_POST["account"]))
	{
		$warn = $lang->getWarning('geral.entradasReservadas');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=account.login')
		);	
	}
	else
	{			
		if($login->make($_POST["account"], $_POST["password"]))
		{
			$_SESSION["account"] = $_POST["account"];
			$_SESSION["password"] = md5($_POST["password"]);
			header ("Location: index.php?act=account.main");
		}
		else
		{
			$warn = $lang->getWarning('login.contaSenhaIncorreta');
			$condition = array
			(			
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.login')
			);
		}		
	}
		
	$content .= $eHTML->conditionTable($condition);
}
else
{	
	$content .= '
	'.$eHTML->descriptionTable($lang->getDescription('account.login')).'
	'.$eHTML->formStart('?act=account.login').'
	<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['login'][$g_language].'</td>
		</tr>
		<tr class="tableContLight">
			<td>
				<table class="tableContLight border="0" width="100%" align="center">
					<tr>
						<td width="25%">'.$trans_texts['account'][$g_language].':</td>
						<td><input class="input" name="account" type="password" size="30"/></td>
					</tr>	
					<tr>
						<td width="25%">'.$trans_texts['password'][$g_language].':</td>
						<td><input class="input" name="password" type="password" size="30"/></td>
					</tr>						
				</table>	
			</td>
		</tr>	
	</table>	
	<br>
	<center>'.$eHTML->imageButtonInput('login').'
	</center>	
	</form>		
	';
}	
?>