<?
if($login->logged())
{	
	$account = $engine->loadObject('Account');
	$account->loadByNumber($_SESSION['account']);			
	
	if(!$account->loadQuestions())
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST")
		{			
			if($_POST['terms'] != 1)		
			{
				$warn = $lang->getWarning('contas.termoQuestoes');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);				
			}
			elseif($_POST['first_question'] == null or $_POST['first_question'] == "" OR $_POST['first_answer'] == null OR $_POST['first_answer'] == "")
			{
				$warn = $lang->getWarning('contas.umaPergunta');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);				
			}
			elseif(strlen($_POST['first_question']) < 5 OR strlen($_POST['first_question']) > 35 OR strlen($_POST['first_answer']) < 5 OR strlen($_POST['first_answer']) > 35)
			{
				$warn = $lang->getWarning('contas.caracteresPerguntas');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);				
			}	
			elseif(!$tools->checkString($_POST['first_question']) OR !$tools->checkString($_POST['first_answer']))
			{
				$warn = $lang->getWarning('geral.entradasReservadas');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);	
			}			
			elseif(($_POST['second_question'] != null or $_POST['second_question'] != "" OR $_POST['second_answer'] != null OR $_POST['second_answer'] != "") AND (strlen($_POST['second_question']) < 5 OR strlen($_POST['second_question']) > 35 OR strlen($_POST['second_answer']) < 5 OR strlen($_POST['second_answer']) > 35))
			{
				$warn = $lang->getWarning('contas.caracteresPerguntas');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);	
			}			
			elseif(($_POST['second_question'] != null or $_POST['second_question'] != "" OR $_POST['second_answer'] != null OR $_POST['second_answer'] != "") AND (!$tools->checkString($_POST['second_question']) OR !$tools->checkString($_POST['second_answer'])))
			{
				$warn = $lang->getWarning('geral.entradasReservadas');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);	
			}
			elseif(($_POST['third_question'] != null or $_POST['third_question'] != "" OR $_POST['third_answer'] != null OR $_POST['third_answer'] != "") AND (strlen($_POST['third_question']) < 5 OR strlen($_POST['third_question']) > 35 OR strlen($_POST['third_answer']) < 5 OR strlen($_POST['third_answer']) > 35))
			{
				$warn = $lang->getWarning('contas.caracteresPerguntas');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);	
			}	
			elseif(($_POST['third_question'] != null or $_POST['third_question'] != "" OR $_POST['third_answer'] != null OR $_POST['third_answer'] != "") AND (!$tools->checkString($_POST['third_question']) OR !$tools->checkString($_POST['third_answer'])))
			{
				$warn = $lang->getWarning('geral.entradasReservadas');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);	
			}		
			elseif($_SESSION['password'] != md5($_POST['password']))
			{
				$warn = $lang->getWarning('geral.falhaConfPass');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
					"buttons" => $eHTML->simpleButton('back','?act=account.setQuestions')
				);			
			}
			else
			{					
				$account->addQuestion($_POST['first_question'], $_POST['first_answer']);
				
				if($_POST['second_question'] != null or $_POST['second_question'] != "" OR $_POST['second_answer'] != null OR $_POST['second_answer'] != "")
					$account->addQuestion($_POST['second_question'], $_POST['second_answer']);
					
				if($_POST['third_question'] != null or $_POST['third_question'] != "" OR $_POST['third_answer'] != null OR $_POST['third_answer'] != "")
					$account->addQuestion($_POST['third_question'], $_POST['third_answer']);
			
				$warn = $lang->getWarning('contas.perguntasRespostasSucesso');
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
			'.$eHTML->descriptionTable($lang->getDescription('account.setQuestions')).'
			'.$eHTML->formStart('?act=account.setQuestions').'
			<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_texts['setQuestionsAndAnswer'][$g_language].'</td>
				</tr>
				<tr>
					<td class="tableContLight" colspan="2" width="25%"><b>'.$trans_texts['questionNumberOne'][$g_language].'</td>
				</tr>			
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['question'][$g_language].': </td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('first_question', 'text', null, 45).'</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['answer'][$g_language].':</td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('first_answer', 'text').'</td>
				</tr>		
				<tr>
					<td class="tableContLight" colspan="2" width="25%"><b>'.$trans_texts['questionNumberTwo'][$g_language].'</td>
				</tr>			
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['question'][$g_language].': </td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('second_question', 'text', null, 45).'</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['answer'][$g_language].':</td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('second_answer', 'text').'</td>
				</tr>	
				<tr>
					<td class="tableContLight" colspan="2" width="25%"><b>'.$trans_texts['questionNumberTree'][$g_language].'</td>
				</tr>			
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['question'][$g_language].': </td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('third_question', 'text', null, 45).'</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['answer'][$g_language].':</td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('third_answer', 'text').'</td>
				</tr>				
			</table>
			<br>
			<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_texts['passwordConfirmation'][$g_language].'</td>
				</tr>
				<tr>
					<td class="tableContLight" width="25%">'.$trans_texts['password'][$g_language].':</td>
					<td class="tableContLight" width="75%">'.$eHTML->textBoxInput('password', 'password').'</td>
				</tr>						
			</table>
			<br>			
			<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_texts['questionTerms'][$g_language].'</td>
				</tr>
				<tr>
					<td class="tableContLight" colspan="2" width="25%"><input type="checkbox" name="terms" value="1" class="login">'.$trans_texts['questionTermDetails'][$g_language].'</td>
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
?>	