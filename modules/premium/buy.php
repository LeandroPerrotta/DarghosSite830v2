<?
if($login->logged())
{
	if($_GET['mod'] == 4)
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$account = $engine->loadObject('Account');
			$account->loadByNumber($_SESSION['account']);
			$error = 0;
			
			if($_SESSION['destiny'] == "me")
			{					
				if($tools->checkString(md5($_POST['pass']),1) == 0)
					{
						$warn = $lang->getWarning('beneficts_characterError');
						$condition = array
						(
							"title" => $warn['title'],
							"msg" => $warn['msg'],
							"buttons" => $eHTML->simpleButton('back','?act=contribute&step=3')
						);	
						$error++;
					}			
					elseif($_SESSION['password'] != md5($_POST['pass']))
					{
						$warn = $lang->getWarning('geral.falhaConfPass');
						$condition = array
						(
							"title" => $warn['title'],
							"msg" => $warn['msg'],
							"buttons" => $eHTML->simpleButton('back','?act=contribute&step=3')
						);	
						$error++;
					}	
					
					$destiny = $trans_texts['beneficts_forMyAccount'][$g_language];
			}
			else
			{
			
				$player = $engine->loadObject('player');
				$player->load($_POST['name']);
				
					if($tools->checkString($_POST['name'],1) == 0 or $tools->checkString($_POST['rl_name'],1) == 0 or $tools->checkString($_POST['comment'],1) == 0)
					{
						$warn = $lang->getWarning('beneficts_characterError');
						$condition = array
						(
							"title" => $warn['title'],
							"msg" => $warn['msg'],
							"buttons" => $eHTML->simpleButton('back','?act=contribute&step=3')
						);	
						$error++;
					}					
					elseif(!$player->load($_POST['name']))
					{
						$warn = $lang->getWarning('char.naoExiste');
						$condition = array
						(
							"title" => $warn['title'],
							"msg" => $warn['msg'],
							"buttons" => $eHTML->simpleButton('back','?act=contribute&step=3')
						);	
						$error++;			
					}
					elseif($_POST['rl_name'] == "" or $_POST['comment'] == "")
					{
						$warn = $lang->getWarning('geral.camposVazios');
						$condition = array
						(
							"title" => $warn['title'],
							"msg" => $warn['msg'],
							"buttons" => $eHTML->simpleButton('back','?act=contribute&step=3')
						);	
						$error++;					
					}
					
					$destiny = $trans_texts['beneficts_forOtherAccount'][$g_language].' '.$_POST['name'];
			}				
				if($error == 0)
				{
					if($_SESSION['form'] == "pagseguro")
					{				
						if($_POST['duration'] == 30)
						{
							$duration = '1 mes (30 dias)';
							$price = 'R$ 10,90';
							$priceValue = 1090;
						}	
						elseif($_POST['duration'] == 60)
						{
							$duration = '2 meses (60 dias)';
							$price = 'R$ 21,80';
							$priceValue = 2180;
						}					
						elseif($_POST['duration'] == 90)
						{
							$duration = '3 meses (90 dias)';
							$price = 'R$ 32,70';
							$priceValue = 3270;
						}	
						elseif($_POST['duration'] == 180)
						{
							$duration = '6 meses (180 dias)';
							$price = 'R$ 55,90';
							$priceValue = 5590;
						}		
						elseif($_POST['duration'] == 360)
						{
							$duration = '1 ano (360 dias)';
							$price = 'R$ 99,90';
							$priceValue = 9990;
						}						
					}
					elseif($_SESSION['form'] == "paypal")
					{
						if($_POST['duration'] == 30)
						{
							$duration = '1 month (30 days)';
							$price = '7.90 USD';
							$priceValue = "7.90";
						}	
						elseif($_POST['duration'] == 60)
						{
							$duration = '2 months (60 days)';
							$price = '14.80 USD';
							$priceValue = "14.80";
						}						
						elseif($_POST['duration'] == 90)
						{
							$duration = '3 months (90 days)';
							$price = '21.70 USD';
							$priceValue = "21.70";
						}	
						elseif($_POST['duration'] == 180)
						{
							$duration = '6 months (180 days)';
							$price = '35.90 USD';
							$priceValue = "35.90";
						}		
						elseif($_POST['duration'] == 360)
						{
							$duration = '1 year (360 days)';
							$price = '62.90 USD';
							$priceValue = "62.90";
						}						
					}				
					
					if($_POST['activation'] == 0 or $_POST['activation'] == null or $_POST['activation'] == "")
						$activation = 'Normal';
					else
						$activation = 'Instantânea';

					$content .= '
					'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod3_2')).'
					<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
						<tr>
							<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_infoContrib'][$g_language].'</td>
						</tr>
						<tr class="tableContLight">
							<td>
								'.$trans_texts['beneficts_destiny'][$g_language].': <b>'.$destiny.'</b>
							</td>
						</tr>	
						<tr class="tableContLight">
							<td>
								'.$trans_texts['beneficts_activationType'][$g_language].': <b>'.$activation.'</b>
							</td>
						</tr>	
						<tr class="tableContLight">
							<td>
								'.$trans_texts['beneficts_priceTotal'][$g_language].': <b>'.$price.'</b>
							</td>
						</tr>							
					</table>
					';	
					
					if($_SESSION['form'] == "paypal")
					{
						$content .= '
						'.$eHTML->formStart('https://www.paypal.com/cgi-bin/webscr').'
						'.$eHTML->hiddenInput('cmd', 'x_click').'
						'.$eHTML->hiddenInput('business', 'premium@darghos.com').'
						'.$eHTML->hiddenInput('no_shipping', '0').'
						'.$eHTML->hiddenInput('no_note', '1').'
						'.$eHTML->hiddenInput('currency_code', 'USD').'
						'.$eHTML->hiddenInput('item_name', $duration).'
						'.$eHTML->hiddenInput('amount', $priceValue).'';
						if($_SESSION['destiny'] == "me")
						{
							$content .= $eHTML->hiddenInput('on0', 'Por: '.$_SESSION['account'].'');
						}
						else
						{
							$content .= $eHTML->hiddenInput('on0', 'Por: '.$_SESSION['account'].' para '.$_POST['name'].'');
						}
						
						$content .= '<BR /><center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
						'.$eHTML->formEnd().'';
					}
					elseif($_SESSION['form'] == "pagseguro")
					{
						$content .= '
						'.$eHTML->formStart('https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx').'
						'.$eHTML->hiddenInput('email_cobranca', 'premium@darghos.com').'
						'.$eHTML->hiddenInput('tipo', 'CP').'
						'.$eHTML->hiddenInput('moeda', 'BRL').'
						'.$eHTML->hiddenInput('item_id_1', '1').'
						'.$eHTML->hiddenInput('item_descr_1', $duration).'
						'.$eHTML->hiddenInput('item_quant_1', '1').'
						'.$eHTML->hiddenInput('item_valor_1', $priceValue).'
						'.$eHTML->hiddenInput('item_frete_1', '000').'
						';
						
						if($_SESSION['destiny'] == "me")
						{
							$content .= $eHTML->hiddenInput('ref_transacao', 'Por: '.$_SESSION['account'].'');
						}
						else
						{
							$content .= $eHTML->hiddenInput('ref_transacao', 'Por: '.$_SESSION['account'].' para '.$_POST['name'].'');
						}
						$content .= '<BR /><center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
						'.$eHTML->formEnd().'';					
					}
				}
				else
				{
					$content .= $eHTML->conditionTable($condition);
				}
		}
	}
	elseif($_GET['mod'] == 2)
	{
	$_SESSION['destiny'] = $_POST['destiny'];
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod2')).'
		'.$eHTML->formStart('?act=contribute&step=3&mod=3').'
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_paymentForm'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td width="20%">
					<b>'.$trans_texts['beneficts_form'][$g_language].':</b>
				</td>
				<td>
				'.$eHTML->radioInput('form', 'pagseguro', true).' PagSeguro<BR />
				'.$eHTML->radioInput('form', 'paypal').' Paypal
				</td>
			</tr>					
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';	
	}
	elseif($_GET['mod'] == 3 and $_SESSION['destiny'] == "me")
	{
		if($_POST['form'] == "pagseguro")
		{
			$_SESSION['form'] = $_POST['form'];
			$normal[] = array('valueName' => 'Normal', 'valueId' => '0');
			$content .= '
			'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod3')).'
			'.$eHTML->formStart('?act=contribute&step=3&mod=4').'
			<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_infoContrib'][$g_language].'</td>
				</tr>
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['password'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('pass', 'password', '', 20).'
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['beneficts_Activation'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->selectBoxInput('activation', $normal, true).'
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['beneficts_Time'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->radioInput('duration', '30', true).' <b>R$ 10,90</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribmonth'][$g_language].' (30 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '60').' <b>R$ 21,80</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 2 '.$trans_texts['beneficts_contribmonths'][$g_language].' (60 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '90').' <b>R$ 32,70</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 3 '.$trans_texts['beneficts_contribmonths'][$g_language].' (90 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '180').' <b>R$ 55,90</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 6 '.$trans_texts['beneficts_contribmonths'][$g_language].' (180 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '360').' <b>R$ 99,90</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribyear'][$g_language].' (360 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					</td>
				</tr>				
			</table>
			<br>
			<center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
			'.$eHTML->formEnd().'
			';		
		}
		elseif($_POST['form'] == "paypal")
		{
			$_SESSION['form'] = $_POST['form'];
			$normal[] = array('valueName' => 'Normal', 'valueId' => '0');
			$content .= '
			'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod3')).'
			'.$eHTML->formStart('?act=contribute&step=3&mod=4').'
			<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_infoContrib'][$g_language].'</td>
				</tr>
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['password'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('pass', 'password', '', 20).'
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['beneficts_Activation'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->selectBoxInput('activation', $normal, true).'
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['beneficts_Time'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->radioInput('duration', '30', true).' <b>7.90 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribmonth'][$g_language].' (30 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '60').' <b>15.80 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 2 '.$trans_texts['beneficts_contribmonths'][$g_language].' (60 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '90').' <b>23,70 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 3 '.$trans_texts['beneficts_contribmonths'][$g_language].' (90 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '180').' <b>35,90 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 6 '.$trans_texts['beneficts_contribmonths'][$g_language].' (180 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '360').' <b>62,90 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribyear'][$g_language].' (360 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					</td>
				</tr>				
			</table>
			<br>
			<center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
			'.$eHTML->formEnd().'
			';			
		}
	}
	elseif($_GET['mod'] == 3 and $_SESSION['destiny'] == "other")
	{
		if($_POST['form'] == "pagseguro")
		{
			$_SESSION['form'] = $_POST['form'];
				$content .= '
			'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod3_1')).'
			'.$eHTML->formStart('?act=contribute&step=3&mod=4').'
			<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_infoContrib'][$g_language].'</td>
				</tr>
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['real_name'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('rl_name', 'text', '', 30).'<BR />
					<font size="1">('.$trans_texts['beneficts_yourNameReal'][$g_language].')</font>
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['comment'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('comment', 'text', '', 30).'<BR />
					<font size="1">('.$trans_texts['beneficts_writeYourComment'][$g_language].')</font>
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['characterToRecover'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('name', 'text', '', 30).'<BR />
					<font size="1">('.$trans_texts['beneficts_nameReceive'][$g_language].')</font>
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['beneficts_Time'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->radioInput('duration', '30', true).' <b>R$ 10,90</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribmonth'][$g_language].' (30 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '60').' <b>R$ 21,80</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 2 '.$trans_texts['beneficts_contribmonths'][$g_language].' (60 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '90').' <b>R$ 32,70</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 3 '.$trans_texts['beneficts_contribmonths'][$g_language].' (90 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '180').' <b>R$ 55,90</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 6 '.$trans_texts['beneficts_contribmonths'][$g_language].' (180 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '360').' <b>R$ 99,90</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribyear'][$g_language].' (360 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					</td>
				</tr>				
			</table>
			<br>
			<center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
			'.$eHTML->formEnd().'
			';		
		}	
		elseif($_POST['form'] == "paypal")
		{
			$_SESSION['form'] = $_POST['form'];
				$content .= '
			'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod3_1')).'
			'.$eHTML->formStart('?act=contribute&step=3&mod=4').'
			<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
				<tr>
					<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_infoContrib'][$g_language].'</td>
				</tr>
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['real_name'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('rl_name', 'text', '', 30).'<BR />
					<font size="1">('.$trans_texts['beneficts_yourNameReal'][$g_language].')</font>
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['comment'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('comment', 'text', '', 30).'<BR />
					<font size="1">('.$trans_texts['beneficts_writeYourComment'][$g_language].')</font>
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['characterToRecover'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->textBoxInput('name', 'text', '', 30).'<BR />
					<font size="1">('.$trans_texts['beneficts_nameReceive'][$g_language].')</font>
					</td>
				</tr>	
				<tr class="tableContLight">
					<td width="20%">
						<b>'.$trans_texts['beneficts_Time'][$g_language].':</b>
					</td>
					<td>
					'.$eHTML->radioInput('duration', '30', true).' <b>7.90 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribmonth'][$g_language].' (30 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '60').' <b>15.80 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 2 '.$trans_texts['beneficts_contribmonths'][$g_language].' (60 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '90').' <b>23,70 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 3 '.$trans_texts['beneficts_contribmonths'][$g_language].' (90 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '180').' <b>35,90 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 6 '.$trans_texts['beneficts_contribmonths'][$g_language].' (180 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					'.$eHTML->radioInput('duration', '360').' <b>62,90 USD</b> '.$trans_texts['beneficts_contribfor'][$g_language].' 1 '.$trans_texts['beneficts_contribyear'][$g_language].' (360 '.$trans_texts['beneficts_Days'][$g_language].')<BR />
					</td>
				</tr>				
			</table>
			<br>
			<center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
			'.$eHTML->formEnd().'
			';
		}
	}
	elseif($_GET['mod'] == 1 and $_POST['contract'] == "agree")
	{
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('beneficts_Step3Mod1')).'
		'.$eHTML->formStart('?act=contribute&step=3&mod=2').'
		<table style="margin: 10px 0 0 0;" border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop" colspan="2">'.$trans_subTopicPages['beneficts_accountReceived'][$g_language].'</td>
			</tr>
			<tr class="tableContLight">
				<td width="20%">
					<b>'.$trans_texts['beneficts_destiny'][$g_language].':</b>
				</td>
				<td>
				'.$eHTML->radioInput('destiny', 'me', true).' '.$trans_texts['beneficts_me'][$g_language].'<BR />
				'.$eHTML->radioInput('destiny', 'other').' '.$trans_texts['beneficts_other'][$g_language].'
				</td>
			</tr>					
		</table>
		<br>
		<center>'.$eHTML->simpleButton('Back', '?act=contribute&step=3').'    '.$eHTML->imageButtonInput('next').'</center>	
		'.$eHTML->formEnd().'
		';	
	
	}
	elseif($_GET['mod'] == 1 and $_POST['contract'] != "agree")
	{
		$warn = $lang->getWarning('beneficts_errorAgree');
		$condition = array
		(
			"title" => $warn['title'],
			"msg" => $warn['msg'],
			"buttons" => $eHTML->simpleButton('back','?act=contribute&step=3')
		);	
	
	$content .= $eHTML->conditionTable($condition);	
	}
	else
	{
		$content .= '
		'.$eHTML->descriptionTable($lang->getDescription('benefictsStep3_1')).'
		'.$eHTML->formStart('?act=contribute&step=3&mod=1').'
		<table style="margin: 10px 0 0 0;" border="0" width="100%" CELLSPACING="1" CELLPADDING="2">
			<tr>
				<td class="tableTop"><b>'.$trans_texts['beneficts_Clausulas'][$g_language].'</b></td>
			</tr>
			<tr class="tableContLight">
				<td align="center">
					<b>'.$trans_texts['beneficts_acceptClausulas'][$g_language].':</b><BR />
					<textarea rows="10" wrap="physical" cols="55" readonly="true">'.$trans_texts['beneficts_Rules'][$g_language].'</textarea>
					<BR />
					'.$eHTML->checkBoxInput('contract', 'agree').' '.$trans_texts['beneficts_readAndAccept'][$g_language].'
				</td>
			</tr>
			</tr>
		</table>
			<br>
			<center>'.$eHTML->simpleButton('Back', '?act=contribute').'    '.$eHTML->imageButtonInput('next').'</center>	
			'.$eHTML->formEnd().'
			';	
	}
}
?>