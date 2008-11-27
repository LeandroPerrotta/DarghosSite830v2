<?php
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN) {
	if($_GET['s'] == "new") {
		if($_POST['word'] != '' && $tools->checkString($_POST['word'])) {
			$DB->query("INSERT INTO `blacklist_strings`(`string`) VALUES('".$_POST['word']."')");
			$content .= $eHTML->conditionTable(array(
							'title' => "Palavra/expressão adicionada com sucesso", 
							'msg' => 'A palavra/expressão "<b>'.$_POST['word'].'</b>" foi adicionada com sucesso.', 
							'buttons' => $eHTML->simpleButton('back', '?act=admin.blacklist')));
		} else {
			$content .= '
			<br>'.$eHTML->formStart('?act=admin.blacklist&s=new').'
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">Bloquear nova palavra/expressão</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">Palavra/expressão</td>
					<td class="tableContLight">'.$eHTML->textBoxInput('word').'</td>		
				</tr>			
			</table>
			<br><center>'.$eHTML->imageButtonInput('next').'</center>
			'.$eHTML->formEnd().'	
			';
		}
	} elseif($_GET['s'] == "edit" && $_GET['id'] != '' && $tools->checkString($_GET["id"])) {
		if($_POST['word'] != '' && $tools->checkString($_POST['word'])) {
			$DB->query("UPDATE `blacklist_strings` SET `string` = '".$_POST['word']."' WHERE `id` = '".$_GET["id"]."'");
			$content .= $eHTML->conditionTable(array(
							'title' => "Palavra/expressão editada com sucesso", 
							'msg' => 'A palavra/expressão "<b>'.$_POST['word'].'</b>" foi editada com sucesso.', 
							'buttons' => $eHTML->simpleButton('back', '?act=admin.blacklist')));
		} else {
			$DB->query("SELECT * FROM blacklist_strings WHERE id = '".$_GET['id']."'");
			$word = $DB->fetch();
			$content .= '
			<br>'.$eHTML->formStart('?act=admin.blacklist&s=edit&id='.$word->id).'
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">Editar palavra/expressão</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">Palavra/expressão</td>
					<td class="tableContLight">'.$eHTML->textBoxInput('word', 'text', $word->string).'</td>		
				</tr>			
			</table>
			<br><center>'.$eHTML->imageButtonInput('next').'</center>
			'.$eHTML->formEnd().'	
			';
		}
	} elseif($_GET['s'] == "delete" && $_GET['id'] != '' && $tools->checkString($_GET["id"])){
		if($_POST['cert'] == "sim") {
			$DB->query("DELETE FROM `blacklist_strings` WHERE `id` = '".$_GET["id"]."'");
			$content .= $eHTML->conditionTable(array(
							'title' => "Palavra/expressão deletada com sucesso", 
							'msg' => 'A palavra/expressão "<b>'.$_POST['word'].'</b>" foi deletada com sucesso.', 
							'buttons' => $eHTML->simpleButton('back', '?act=admin.blacklist')));
		} elseif($_POST['cert'] == "nao") {
			$tools->redirect('?act=admin.blacklist');
		} else {
			$DB->query("SELECT * FROM blacklist_strings WHERE id = '".$_GET['id']."'");
			$word = $DB->fetch();
			$content .= '
			<br>'.$eHTML->formStart('?act=admin.blacklist&s=delete&id='.$word->id).
			$eHTML->hiddenInput('word', $word->string).'
			<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">Deletar palavra/expressão</td>
				</tr>
				<tr>
					<td class="tableContLight" width="50%">
						Tem certeza de que deseja deletar a palavra/expressão "<b>'.$word->string.'</b>"?
					</td>
					<td class="tableContLight">
						<label>'.$eHTML->radioInput('cert', 'sim', true).' Sim</labe><br />
						<label>'.$eHTML->radioInput('cert', 'nao').' Não</labe>
					</td>		
				</tr>		
			</table><br>
			<center>'.$eHTML->imageButtonInput('next').'</center>
			<br>
			'.$eHTML->formEnd().'	
			';
		}
	} else {
		$DB->query("SELECT * FROM blacklist_strings");
		$words = array();
		while($word = $DB->fetch()) {
			$words[] = array('valueName' => $word->string, 'valueId' => $word->id);
		}
		$action = array(array('valueName' => "Editar", 'valueId' => "edit"),
						array('valueName' => "Deletar", 'valueId' => "delete"));
						
		$content .= '
		<br>'.$eHTML->formStart('', 'GET').$eHTML->hiddenInput('act', $_GET['act']).'
		'.$eHTML->hiddenInput('s', 'new').'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Bloquear nova palavra/expressão</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%"><center>'.$eHTML->imageButtonInput('next').'</center></td>		
			</tr>			
		</table>
		<br>
		'.$eHTML->formEnd().'	
		';	
		$content .= '
		<br>'.$eHTML->formStart('', 'GET').$eHTML->hiddenInput('act', $_GET['act']).'
		<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
			<tr>
				<td class="tableTop" colspan="2">Editar Blacklist</td>
			</tr>
			<tr>
				<td class="tableContLight" width="25%">Palavra/expressão</td>
				<td class="tableContLight">'.$eHTML->selectBoxInput('id', $words, true).'</td>		
			</tr>			
			<tr>
				<td class="tableContLight" width="25%">Ação</td>
				<td class="tableContLight">'.$eHTML->selectBoxInput('s', $action, true).'</td>		
			</tr>			
		</table>
		<br>
		<center>'.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'	
		';	
	}
} else {
	$content = '';
}
?>