<?
if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
{
	$payments = $engine->loadObject('Payments');
	$payments->loadMain();
	
	$content .= '
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$lang->getDescription('admin.payments').'</td>
		</tr>
	</table>	
	<br>';	
	
	//RELATORIOS GERAIS
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="2">Relatorios - Geral</td>
		</tr>
		<tr>
			<td class="tableContLight" width="75%">Total de pagamentos (todo o periodo)</td><td class="tableContLight">'.$payments->getQtdContr().'</td>	
		</tr>					
	</table>
	<br>
	<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td>'.$eHTML->simpleButton("admin.newPayment", "?act=admin.payments.new").'</a></td>
		</tr>
	</table>	
	';
	
/*	$hoje['dia'] = date("d", time());
	$hoje['mes'] = date("m", time());
	
	$hojeUnix = $tools->getTimeOfDay($hoje['dia'], $hoje['mes']);
	$ontemUnix = $tools->getTimeOfDay($hoje['dia'] - 1, $hoje['mes']);
	$doisDiasUnix = $tools->getTimeOfDay($hoje['dia'] - 2, $hoje['mes']);
	
	$payments->loadPaymentsByPeriod($hojeUnix['start'], $hojeUnix['end']);
	
	//ULTIMOS LANÇAMENTOS
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
		<tr>
			<td class="tableTop" colspan="3">Relatorio ultimos 3 dias</td>
		</tr>
		<tr>
			<td class="tableContLight" width="25%"><b>Data</td><td class="tableContLight"><b>Quantidade</td><td class="tableContLight"><b>Receita</td>	
		</tr>			
		<tr>
			<td class="tableContLight">Hoje</td><td class="tableContLight">'.$payments->getQtdContr().'</td><td class="tableContLight">200,00</td>		
		</tr>		
		<tr>
			<td class="tableContLight">Há 1 dia</td><td class="tableContLight">14</td><td class="tableContLight">160,00</td>		
		</tr>		
		<tr>
			<td class="tableContLight">Há 2 dias</td><td class="tableContLight">26</td><td class="tableContLight">370,00</td>		
		</tr>			
	</table>
	<br>';	*/
}
?>