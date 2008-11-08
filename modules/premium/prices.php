<?
$content .= '
			'.$eHTML->descriptionTable($lang->getDescription('benefictsStep2')).'
			<table style="margin: 10px 0 0 0;" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table border="0" width="95%" cellpadding="4" cellspacing="1">
							<tr>
								<td class="tableTop" colspan="3">
									<b>'.$trans_subTopicPages['contributions'][$g_language].'</b>
								</td>
							</tr>
							<tr class="tableContLight">
								<td><b>'.$trans_texts['beneficts_Time'][$g_language].'</b></td>
								<td width="45%"><b>PagSeguro</td>
								<td width="25%"><b>PayPal</td>
							</tr>
							
							<tr class="tableContLight">
								<td>30 '.$trans_texts['beneficts_Days'][$g_language].'</td>
								<td width="45%"><del>R$ 19,90</del> <b>R$ 10,90</b> <font size=1>(R$ 0,39/'.$trans_texts['beneficts_Day'][$g_language].')</td>
								<td width="25%">7.90 USD</td>
							</tr>	
							<tr class="tableContLight">
								<td>60 '.$trans_texts['beneficts_Days'][$g_language].' <font size="1" color=green><b>('.$trans_texts['beneficts_New'][$g_language].'!)</b></font></td>
								<td width="45%">R$ 21,80 <font size=1>(R$ 0,39/'.$trans_texts['beneficts_Day'][$g_language].')</td>
								<td width="25%">15.80 USD</td>
							</tr>
							<tr class="tableContLight">
								<td>90 '.$trans_texts['beneficts_Days'][$g_language].'</td>
								<td width="45%">R$ 32,70 <font size=1>(R$ 0,39/'.$trans_texts['beneficts_Day'][$g_language].')</td>
								<td width="25%">23.70 USD</td>
							</tr>	
							<tr class="tableContLight">
								<td>180 '.$trans_texts['beneficts_Days'][$g_language].'</td>
								<td width="45%"><del>R$ 71,90</del> <b>R$ 55,90</b> <font size=1>(R$ 0,31/'.$trans_texts['beneficts_Day'][$g_language].')</td>
								<td width="25%">35.90 USD</td>
							</tr>
							<tr class="tableContLight">
								<td>360 '.$trans_texts['beneficts_Days'][$g_language].' <font size="1" color=green><b>('.$trans_texts['beneficts_New'][$g_language].'!)</b></font></td>
								<td width="45%">R$ 99,90 <font size=1>(R$ 0,27/'.$trans_texts['beneficts_Day'][$g_language].')</td>
								<td width="25%">62.90 USD</td>
							</tr>							
						</table>
						<BR /><BR />
					</td>
				</tr>
				<tr>
					<td>
						'.$trans_texts['beneficts_Methods'][$g_language].'
					</td>
				</tr>
				<tr>
					<td align="center"><BR /><BR />'.$eHTML->simpleButton('Back', '?act=contribute&step=1').'         '.$eHTML->simpleButton('Next', '?act=contribute&step=3').'</td>
				</tr>
			</table>';
?>