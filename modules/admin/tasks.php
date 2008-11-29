<?php
if($login->logged() and $login->getAccess() >= ACCESS_ADMIN) {
	$orderBy = ($_GET['orderby'] != '') ? $_GET['orderby'] : 'date';
	$orderVr = ($_GET['ordervr'] != '') ? strtoupper($_GET['ordervr']) : strtoupper('desc');
	$_limit = ($_GET['limit'] != '') ? $_GET['limit'] : '20';
	
	$content .= '<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" width="40%">Task</td>
						<td class="tableTop" width="30%">Executada em</td>
						<td class="tableTop" width="30%">Tempo levado p/ execução</td>
						<td class="tableTop" width="30%">IP</td>
					</tr>';	
	$DB->query("SELECT * FROM taskslogs ORDER BY {$orderBy} {$orderVr} LIMIT {$_limit}");
	while($taskLog = $DB->fetch()) {
		$content .= '<tr>
						<td class="tableContLight">
							'.$taskLog->name.'
						</td>
						<td class="tableContLight">
							'.date('d/m/Y H:i', $taskLog->date).'
						</td>	
						<td class="tableContLight">
							'.$taskLog->execution.'
						</td>
						<td class="tableContLight">
							'.long2ip($taskLog->ip).'
						</td>
					</tr>';
	}
	$content .= '</table><br><br>';
	
	$ordbysel[] = array('valueName' => "Executada em", 'valueId' => "date");
	$ordbysel[] = array('valueName' => "Tempo levado p/ execução", 'valueId' => "execution");
	$ordbysel[] = array('valueName' => "Task", 'valueId' => "task");
	$ordbysel[] = array('valueName' => "IP", 'valueId' => "ip");
	
	$ordodsel[] = array('valueName' => "Descrescente", 'valueId' => "desc");
	$ordodsel[] = array('valueName' => "Ascendente", 'valueId' => "asc");
	
	$limit = array();
	for($i = 0; $i <= 100; $i = $i + 5) {
		$limit[] = array('valueName' => (($i < 1) ? 1 : $i), 'valueId' => (($i < 1) ? 1 : $i));
	}
	
	$content .= '
				'.$eHTML->formStart('', 'GET').$eHTML->hiddenInput('act', $_GET['act']).'
				<table cellspacing="1" cellpadding="0" border="0" width="95%" align="center">
					<tr>
						<td class="tableTop" colspan="2">Preferências de visualização</td>
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Ordernar por</td>
						<td class="tableContLight">'.$eHTML->selectBoxInput('orderby', $ordbysel, true).'</td>		
					</tr>	
					<tr>
						<td class="tableContLight" width="25%">Em ordem</td>
						<td class="tableContLight">'.$eHTML->selectBoxInput('ordervr', $ordodsel, true).'</td>		
					</tr>
					<tr>
						<td class="tableContLight" width="25%">Limite de resultados</td>
						<td class="tableContLight">'.$eHTML->selectBoxInput('limit', $limit, true).'</td>		
					</tr>
				</table>
				<br>
				<center>'.$eHTML->imageButtonInput('next').'</center>	
				'.$eHTML->formEnd().'	
				';
}
?>