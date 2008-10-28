<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{
	$content .= '
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$lang->getDescription('admin.payments.new').'</td>
		</tr>
	</table>	
	<br>';	

	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$accObj = $engine->loadObject('Account');
		
		$accObj->loadByNumber($_POST['account']);
		
		if(($_POST['account'] and $_POST['auth']) == ("" or null))
		{
			$warn = $lang->getWarning('geral.camposVazios');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
			);			
		}
		elseif(!$accObj->exists())
		{
			$warn = $lang->getWarning('contas.naoExiste');
			$condition = array
			(
				"title" => $warn['title'],
				"msg" => $warn['msg'],
			);		
		}
		else
		{			
			$payments = $engine->loadObject('Payments');
			
			$payments->setAccountId($_POST['account']);
			$payments->setPeriod($_POST['period']);
			$payments->setActivation(time());
			$payments->setType($_POST['type']);
			$payments->setMethod($_POST['method']);
			$payments->setAuth($_POST['auth']);
			$payments->setCost();
			
			$accObj->load();
			$accMail = $accObj->getEmail();
			
			$emailCont = $lang->getEmailCount('payments.sucesso');				
			
			if($engine->sendMail($accMail, $emailCont, "Contribuição Liberada"))
			{
				$payments->savePayment();
				
				$warn = $lang->getWarning('payments.activationSuccess');
				$condition = array
				(
					"title" => $warn['title'],
					"msg" => $warn['msg'],
				);					
			}
			else
			{
				$warn = $lang->getWarning('geral.emailFalhou');
				$condition = array
				(	
					"title" => $warn['title'],
					"msg" => $warn['msg'],					
				);		
			}			
		}
		
		$content .= $eHTML->conditionTable($condition);
	}
	
	$method = array
	(
		0 => array 
		(
			'valueName' => 'PagSeguro', 
			'valueId' => PGT_MET_PAGSEGURO
		),	

		1 => array 
		(
			'valueName' => 'PayPal', 
			'valueId' => PGT_MET_PAYPAL
		),				
	);		
	
	$tipoPgto = array
	(
		0 => array 
		(
			'valueName' => 'Boleto', 
			'valueId' => PGT_TIP_BOLETO
		),	

		1 => array 
		(
			'valueName' => 'Pgto. Online', 
			'valueId' => PGT_TIP_ONLINE
		),				
	);	

	$periodo = array
	(
		0 => array 
		(
			'valueName' => '30 Dias', 
			'valueId' => 30
		),	

		1 => array 
		(
			'valueName' => '60 Dias', 
			'valueId' => 60
		),
		
		2 => array 
		(
			'valueName' => '90 Dias', 
			'valueId' => 90
		),	

		3 => array 
		(
			'valueName' => '180 Dias', 
			'valueId' => 180
		),		

		4 => array 
		(
			'valueName' => '380 Dias', 
			'valueId' => 360
		),			
	);	
	
	$content .= '
	'.$eHTML->formStart('?act=admin.payments.new').'
	<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="4">Ativar novo Pagamento</td>
		</tr>
		<tr>
			<td class="tableContLight" width="20%">Metodo</td><td class="tableContLight">'.$eHTML->selectBoxInput('method', $method).'</td><td class="tableContLight" width="20%">Tipo</td><td class="tableContLight">'.$eHTML->selectBoxInput('type', $tipoPgto).'</td>	
		</tr>		
		<tr>
			<td class="tableContLight">Periodo</td><td class="tableContLight">'.$eHTML->selectBoxInput('period', $periodo).'</td>	<td class="tableContLight">Jogador</td><td class="tableContLight">'.$eHTML->textBoxInput('account', 'text', null, 15).'</td>	
		</tr>	
		<tr>
			<td class="tableContLight" colspan="4"><center>Identificador: '.$eHTML->textBoxInput('auth', 'text').'</td>	
		</tr>			
	</table>
	<br>
	<center>
	'.$eHTML->simpleButton('back','?act=admin.payments').'
	'.$eHTML->imageButtonInput('next').'</center>	
	'.$eHTML->formEnd().'
	';
}
?>