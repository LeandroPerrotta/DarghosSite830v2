<?
if($_GET["step"] == "2")
{
	$player = $engine->loadObject('player');

	$success = false;

	if(!$_POST['character'])
	{
		$warn = $lang->getWarning('geral.camposVazios');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
		);
	}
	elseif(!$tools->checkString($_POST['character']))
	{
		$warn = $lang->getWarning('geral.entradasReservadas');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
		);	
		
	}
	elseif(!$player->load($_POST['character']))
	{
		$warn = $lang->getWarning('char.naoExiste');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
		);	
	}
	else
	{
		$success = true;		
	}
	
	if(!$success)
	{
		$content .= $eHTML->conditionTable($condition);
	}
	else
	{	
	$_SESSION['lostInterface']['character'] = $_POST['character'];
	
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('lostInterfaceStep2')).'
		'.$eHTML->formStart('?act=lostInterface&step=3').'
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_texts['account_recovery_option'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					'.$eHTML->radioInput('interface', 'account').' '.$trans_texts['recovery_my_account'][$g_language].'
				</td>
			</tr>	
			<tr class="tableContLight">
				<td>
					'.$eHTML->radioInput('interface', 'password').' '.$trans_texts['recovery_my_password'][$g_language].'
				</td>
			</tr>	
			<tr class="tableContLight">
				<td>
					'.$eHTML->radioInput('interface', 'both').' '.$trans_texts['recovery_my_account_and_password'][$g_language].'
				</td>
			</tr>	
			<tr class="tableContLight">
				<td>
					'.$eHTML->radioInput('interface', 'change_email').' '.$trans_texts['recovery_email_access'][$g_language].'
				</td>
			</tr>	
			<tr class="tableContLight">
				<td>
					'.$eHTML->radioInput('interface', 'change_questions').' '.$trans_texts['change_aswers'][$g_language].'
				</td>
			</tr>				
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=lostInterface').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'		
		';
	}
}elseif($_GET["step"] == "3")
{	
	if($_POST['interface'] != NULL)
	{
	$_SESSION['lostInterface']['interface'] = $_POST['interface'];
	}
	
	switch($_SESSION['lostInterface']['interface'])
	{
		case "account";
			include "modules/lostInterface/account.php";
		break;	
		
		case "password";
			include "modules/lostInterface/password.php";
		break;		

		case "both";
			include "modules/lostInterface/both.php";
		break;		

		case "change_email";
			include "modules/lostInterface/change_email.php";
		break;			

		case "change_questions";
			include "modules/lostInterface/change_questions.php";
		break;		

		default:
			include "modules/lostInterface/account.php";
		break;	
	}
}
elseif($_GET["step"] == "4")
{	
	switch($_SESSION['lostInterface']['interface'])
	{
		case "account";
			include "modules/lostInterface/account.php";
		break;	
		
		case "password";
			include "modules/lostInterface/password.php";
		break;		

		case "both";
			include "modules/lostInterface/both.php";
		break;		

		case "change_email";
			include "modules/lostInterface/change_email.php";
		break;			

		case "change_questions";
			include "modules/lostInterface/change_questions.php";
		break;			
	}
}
elseif($_GET["step"] == "5")
{	
	switch($_SESSION['lostInterface']['interface'])
	{
		case "change_email";
			include "modules/lostInterface/change_email.php";
		break;			

		case "change_questions";
			include "modules/lostInterface/change_questions.php";
		break;			
	}
}
elseif($_GET["step"] == "confirmKey")
{	
	switch($_GET["step"])
	{		
		case "confirmKey";
			include "modules/lostInterface/password.php";
		break;		
		
		default:
			include "modules/lostInterface/password.php";
		break;			
	}
}
else
{
	$content .= '
	'.$eHTML->descriptionTable($lang->getDescription('lostInterface')).'
	'.$eHTML->formStart('?act=lostInterface&step=2').'
	<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">'.$trans_texts['lostSubTitleChara'][$g_language].'</td>
		</tr>
		<tr class="tableContLight">
			<td>
				<table class="tableContLight" border="0" width="100%" align="center">
					<tr>
						<td width="30%">'.$trans_texts['characterToRecover'][$g_language].':</td>
						<td>'.$eHTML->textBoxInput('character', 'text').'</td>
					</tr>						
				</table>	
			</td>
		</tr>	
	</table>	
	<br>
	<center>'.$eHTML->imageButtonInput('next').'</center>	
	'.$eHTML->formEnd().'		
	'; 
}
?>