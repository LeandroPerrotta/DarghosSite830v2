<?php
include_once("classes/player.php");
if($login->logged()) {
	if($_POST['name'] != '' && $_POST['pass'] != '') {
		$name = $_POST['name'];
		$password = md5($_POST['pass']);
		
		$account = $engine->loadObject('Account');	
		$account->loadByNumber($_SESSION['account']);
		$account->load();
		
		if(!$tools->checkString($name)) {
			$warn = $lang->getWarning('geral.entradasReservadas');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.cancelDeleteChar')
			);	
		} elseif($password != $account->getPassword()) {
			$warn = $lang->getWarning('geral.falhaConfPass');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.cancelDeleteChar')
			);		
		} elseif(!Player::playerExists($name)) {
			$warn = $lang->getWarning('deletechar.charNaoExiste');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.cancelDeleteChar')
			);
		} elseif(!$account->hasThisChar($name)) {
			$warn = $lang->getWarning('deletechar.charNaoPosse');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=account.cancelDeleteChar')
			);
		} else {
			//Deleta!!
			$player = $engine->loadObject('Player');
			$player->load($name);
			$player->cancelDeletion();
			
			$warn = $lang->getWarning('canceldeletechar.sucess');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'][0].DELETE_CHAR_DAYS.$warn['msg'][1],
				"buttons" => $eHTML->simpleButton('back','?act=account.main')
			);
		}
		$content .= $eHTML->conditionTable($condition);
	} else {
		$charDeletionText = $lang->getDescription('account.canceldeletechar');
		$charDeletionText = $charDeletionText[0].DELETE_CHAR_DAYS.$charDeletionText[1].DELETE_CHAR_DAYS.$charDeletionText[2];
		$DB->query("SELECT 
						player.name 
					FROM 
						characterlist as player, 
						chardeletions as del 
					WHERE 
						del.player_id = player.id AND
						del.world_id = player.world_id AND
						player.account_id = '".$_SESSION['account']."'");
		$chars = array();
		while($playerName = $DB->fetch()->name) {
			$chars[] = array('valueName' => $playerName, 'valueId' => $playerName);
		}
		$content .= '
		'.$eHTML->descriptionTable($charDeletionText).'
		'.$eHTML->formStart('?act=account.cancelDeleteChar').'
		<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_subTopicPages['account.cancelDeleteChar'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					<table class="tableContLight border="0" width="100%" align="center">
						<tr>
							<td width="25%">'.$trans_texts['name'][$g_language].':</td>
							<td>'.$eHTML->selectBoxInput('name', $chars, true).'</td>
						</tr>	
						<tr>
							<td width="25%">'.$trans_texts['password'][$g_language].':</td>
							<td>'.$eHTML->textBoxInput('pass', 'password').'</td>
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