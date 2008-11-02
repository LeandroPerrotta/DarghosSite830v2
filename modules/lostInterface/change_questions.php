<?
if($_GET["step"] == "5")
{
	$player = $engine->loadObject('player');
	$player->load($_SESSION['lostInterface']['character']);
	
	$account = $engine->loadObject('Account');
	$account->loadByNumber($player->getInfo('account_id'), array("email","questionTries","lastQuestionTries"));
	
	$account->load();
	
	$questions = $account->loadQuestions();
	$i = 0;
	$incorrets = 0;
	
		foreach($questions as $question)
	{
		$i++;
		
		if($question['answer'] != $_POST['answer_'.$i.''])
			$incorrets++;
	}
	
	$questionTries = $account->getInfo('questionTries');	
	$lastQuestionTries = $account->getInfo('lastQuestionTries');	
	
	if($questionTries == 3 AND $account->getInfo('lastQuestionTries') + SUSPEND_QUESTION_TIME < time())
		$questionTries = 0;

	if($questionTries == 3)
	{
		$warn = $lang->getWarning('maxTriesBlocked');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
		);	
	}
	elseif($incorrets != 0 AND $questionTries < 3)
	{
		$questionTries++;
		$lastQuestionTries = time(); 
		$questionSub = USE_QUESTION_TRIES - $questionTries;
		
		if($questionTries == 3)
		{
			$warn = $lang->getWarning('maxTriesBlocked');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
				"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
			);
		}
		else
		{
			$warn = $lang->getWarning('questionIncorrect');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => ''.$warn['msg'].' '.$questionSub.' '.$trans_texts['contVezes'][$g_language].'',
				"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
			);		
		}
	}
	else
	{
		$success = true;
		$questionTries = 0;
		$account->ereaseQuestions();
		
		$warn = $lang->getWarning('questionRemoved');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface')
		);	
	}
	
	$account->setData('lastQuestionTries', $lastQuestionTries);
	$account->setData('questionTries', $questionTries);
	$account->update(array('questionTries','lastQuestionTries'));
	
	$content .= $eHTML->conditionTable($condition);
		
}
elseif($_GET["step"] == "4")
{
	$player = $engine->loadObject('player');
	$player->load($_SESSION['lostInterface']['character']);
	
	$account = $engine->loadObject('Account');
	$account->loadByNumber($player->getInfo('account_id'));
	
	$account->load();
	$success = false;

	$questions = $account->loadQuestions();
	
	if($account->getInfo("id") != $_POST['account'])
	{
		$warn = $lang->getWarning('recovery.contaIncorreta');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
		);
	}
	elseif($account->getInfo("password") != md5($_POST['password']))
	{
		$warn = $lang->getWarning('geral.falhaConfPass');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=lostInterface&step=3')
		);
	}
	elseif(!$questions)
	{
		$warn = $lang->getWarning('questionNonAccept');
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
		$i = 0;
		foreach($questions as $question)
		{
			$i++;
			
			$questionText .= '
			<tr class="tableContLight">
				<td colspan="2" width="25%"><b>'.$trans_texts['aswersNumber'][$g_language].' '.$i.'</td>
			</tr>		
			<tr class="tableContLight">
				<td colspan="2" width="25%">'.$trans_texts['aswers1'][$g_language].': '.$question['question'].'</td>
			</tr>		
			<tr class="tableContLight">
				<td colspan="2" width="25%">'.$trans_texts['aswers2'][$g_language].': '.$eHTML->textBoxInput('answer_'.$i.'', 'text').'</td>
			</tr>';	
		}
		
				$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('lostInterfaceStep3_5')).' '.USE_QUESTION_TRIES.' '.$trans_texts['textCont1'][$g_language].' '.USE_QUESTION_TRIES.' '.$trans_texts['textCont2'][$g_language].''.'
		'.$eHTML->formStart('?act=lostInterface&step=5').'
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_topicPages['lostInterface'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					'.$trans_texts['aswersSecrets'][$g_language].'
				</td>
				</tr>
				'.$questionText.'			
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=lostInterface').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';	
		
	}
}
elseif($_GET["step"] == "3")
{
				$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('lostInterfaceStep3_5')).'
							<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td>
		'.$trans_texts['Importante'][$g_language].': '.USE_QUESTION_TRIES.' '.$trans_texts['textCont1'][$g_language].' '.USE_QUESTION_TRIES.' '.$trans_texts['textCont2'][$g_language].'<BR /><BR />
							</td>
				</tr>
			</table>
		'.$eHTML->formStart('?act=lostInterface&step=4').'
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_topicPages['lostInterface'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td>
					'.$trans_texts['account'][$g_language].':
				</td>
				<td>
				'.$eHTML->textBoxInput('account', 'password').'
				</td>
			</tr>	
			<tr class="tableContLight">
				<td>
					'.$trans_texts['password'][$g_language].':
				</td>
				<td>
				'.$eHTML->textBoxInput('password', 'password').'
				</td>
			</tr>				
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=lostInterface').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';	
}		
?>