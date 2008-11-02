<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Darghos Alternative Server - <? echo "$topic"; ?></title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="verify-v1" content="uThQU4N3a3z16281fWAYyDbkuf3XhfCdHhpDOulk5gE=">
<link rel="shortcut icon" href="<? echo "$layoutDir"; ?>/images/darghos.ico" type="image/x-icon">
<?
if(ereg("MSIE", $_SERVER["HTTP_USER_AGENT"])) {
	echo '<link href="'.$layoutDir.'/style_ie.css" rel="stylesheet" type="text/css">';
}
else
{
	echo '<link href="'.$layoutDir.'/style_ff.css" rel="stylesheet" type="text/css">';
}
?>

<script language="JavaScript" type="text/javascript" src="functions.js"></script>
</head>
<body>
<div id="background" style="background-image:url(<? echo "$layoutDir"; ?>/images/background/background.png);">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="950px">
		<tr>
			<td class="logotype">
				<div id="langSelectUs">
					<a href="?act=set&lang=us&redirect=<? $ex = explode("?", $_SERVER['REQUEST_URI']); echo '?'.$ex[1]; ?>"><img src="<? echo "$layoutDir"; ?>/images/general/us.png"></a>
					<a href="?act=set&lang=br&redirect=<? $ex = explode("?", $_SERVER['REQUEST_URI']); echo '?'.$ex[1]; ?>"><img src="<? echo "$layoutDir"; ?>/images/general/br.png"></a>
				</div>
			</td>
		</tr>
		<tr>
			<td class="menuTopBackground">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="582px">
					<tr>
						<td>
							<a href="index.php" onMouseOver="ShowImage('index','','<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_bindex.png',1)" onMouseOut="ImageRestore()"><img name="index" class="topButtons" src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_index.png"></a>
						</td>
						<td>
							<a href="?act=about" onMouseOver="ShowImage('about','','<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_binfos.png',1)" onMouseOut="ImageRestore()"><img name="about" class="topButtons" src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_infos.png"></a>
						</td>
						<td>
							<a href="?act=faq" onMouseOver="ShowImage('faq','','<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_bfaq.png',1)" onMouseOut="ImageRestore()"><img name="faq" class="topButtons" src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_faq.png"></a>
						</td>
						<td>
							<a href="?act=contribute" onMouseOver="ShowImage('contribute','','<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_bcontribute.png',1)" onMouseOut="ImageRestore()"><img name="contribute" class="topButtons" src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_contribute.png"></a>
						</td>
						<td>
							<a href="?act=downloads" onMouseOver="ShowImage('downloads','','<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_bdownloads.png',1)" onMouseOut="ImageRestore()"><img name="downloads" class="topButtons" src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_downloads.png"></a>
						</td>		
						<td>
							<a href="?act=contact" onMouseOver="ShowImage('contact','','<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_bcontact.png',1)" onMouseOut="ImageRestore()"><img name="contact" class="topButtons" src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/labelBar_contact.png"></a>
						</td>							
					</tr>				
				</table>
			</td>
		</tr>	
		<tr>
			<td class="contBackground">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" valign="top" width="200px">
							<table style="margin: 10px 0 0 0;" border="0" cellpadding="0" cellspacing="0">
								<tr style="background: url(<? echo $layoutDir; ?>/images/menu/box_left.png) no-repeat top;">
									<td class="leftMenuTitle" style="background: url(<? echo $layoutDir; ?>/images/menu/<? echo $g_language; ?>/box_news.png) no-repeat top;">
									</td>
								</tr>	
								<tr>
									<td class="leftMenuCont" onMouseOver="LoadBG(this,'leftMenuCont2')" onMouseOut="LoadBG(this,'leftMenuCont')">
										<a href="?act=lastnews"><img src="<? echo $layoutDir; ?>/images/menu/<? echo $g_language; ?>/label_lastnews.png"></a>
									</td>	
								</tr>
								<tr>
									<td class="leftMenuCont" onMouseOver="LoadBG(this,'leftMenuCont2')" onMouseOut="LoadBG(this,'leftMenuCont')">
										<a href="?act=newfiles"><img src="<? echo $layoutDir; ?>/images/menu/<? echo $g_language; ?>/label_newfiles.png"></a>
									</td>
								</tr>
								<tr class="leftMenuDown">
									<td>
									</td>
								</tr>									
							</table>	
							<table border="0" cellpadding="0" cellspacing="0">
								<tr style="background: url(<? echo $layoutDir; ?>/images/menu/box_left.png) no-repeat top;">
									<td class="leftMenuTitle" style="background: url(<? echo $layoutDir; ?>/images/menu/<? echo $g_language; ?>/box_community.png) no-repeat top;">
									</td>
								</tr>	
								<tr>
									<td class="leftMenuCont" onMouseOver="LoadBG(this,'leftMenuCont2')" onMouseOut="LoadBG(this,'leftMenuCont')">
										<a href="?act=character.details"><img src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/label_characters.png"></a>
									</td>
								</tr>
								<tr>
									<td class="leftMenuCont" onMouseOver="LoadBG(this,'leftMenuCont2')" onMouseOut="LoadBG(this,'leftMenuCont')">
									<a href="?act=highscores"><img src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/label_highscores.png"></a>
									</td>
								</tr>
								<tr class="leftSimpleMenuDown">
									<td>
									</td>
								</tr>									
							</table>								
						</td>
						<td>
							<table style="margin: 10px 0 0 0;" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td class="contTop">
										<center><div id="titlePage"><? echo "$subtopic"; ?></div></center>
									</td>
								</tr>	
								<tr>
									<td class="cont">
										<? echo "$content"; ?>	
									</td>
								</tr>	
								<tr>
									<td class="contBottom">
									</td>
								</tr>									
							</table>
						</td>
						<td valign="top" width="200px">
							<table style="margin: 10px 0 0 0;" border="0" cellpadding="0" cellspacing="0">
								<tr style="background: url(<? echo $layoutDir; ?>/images/menu/box_right.png) no-repeat 22px top;">
									<? 
									if(!$login->logged())
									
										echo '<td class="rightMenuTitle" style="background: url('.$layoutDir.'/images/menu/'.$g_language.'/box_accounts.png) no-repeat 22px top;">';
									else
										echo '<td class="rightMenuTitle" style="background: url('.$layoutDir.'/images/menu/'.$g_language.'/box_myaccount.png) no-repeat 22px top;">';
									?>														
									</td>
								</tr>								
									<? 
									if(!$login->logged())
									{
										echo '
										<tr>
											<td class="rightMenuCont" onMouseOver="LoadBG(this,\'rightMenuCont2\')" onMouseOut="LoadBG(this,\'rightMenuCont\')">
												<a href="?act=account.register"><img src="'.$layoutDir.'/images/menu/'.$g_language.'/label_register.png"></a>
											</td>
										</tr>
										<tr>
											<td class="rightMenuCont" onMouseOver="LoadBG(this,\'rightMenuCont2\')" onMouseOut="LoadBG(this,\'rightMenuCont\')">
												<a href="?act=account.login"><img src="'.$layoutDir.'/images/menu/'.$g_language.'/label_login.png"></a>
											</td>
										</tr>
										<tr>
											<td class="rightMenuCont" onMouseOver="LoadBG(this,\'rightMenuCont2\')" onMouseOut="LoadBG(this,\'rightMenuCont\')">
												<a href="?act=lostInterface"><img src="'.$layoutDir.'/images/menu/'.$g_language.'/label_lostaccount.png"></a>
											</td>
										</tr>';
									}
									else
									{
										echo '
										<tr>
											<td class="rightMenuCont" onMouseOver="LoadBG(this,\'rightMenuCont2\')" onMouseOut="LoadBG(this,\'rightMenuCont\')">
												<a href="?act=account.main"><img src="'.$layoutDir.'/images/menu/'.$g_language.'/label_accountMain.png"></a>						
											</td>
										</tr>
										<tr>
											<td class="rightMenuCont" onMouseOver="LoadBG(this,\'rightMenuCont2\')" onMouseOut="LoadBG(this,\'rightMenuCont\')">
												<a href="?act=account.logout"><img src="'.$layoutDir.'/images/menu/'.$g_language.'/label_logout.png"></a>
											</td>
										</tr>';						
									}
									?>
											
								<tr class="rightMenuDown">
									<td>
									</td>
								</tr>										
							</table>
							<? 
							if($login->logged() and $login->getAccess() == ACCESS_ADMIN)
							{
							?>									
								<table style="margin: 0 0 0 0;" border="0" cellpadding="0" cellspacing="0">
								<tr style="background: url(<? echo $layoutDir; ?>/images/menu/box_right.png) no-repeat 22px top;">
									<td class="rightMenuTitle" style="background: url(<? echo $layoutDir; ?>/images/menu/<? echo $g_language; ?>/box_admin.png) no-repeat 22px top;">';

									</td>
								</tr>		
									<tr class="rightMenuCont" onMouseOver="LoadBG(this,'rightMenuCont2')" onMouseOut="LoadBG(this,'rightMenuCont')">
										<td>
											<a href="?act=admin.news"><img src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/label_newsadmin.png"></a>
										</td>
									</tr>
									<tr>
										<td class="rightMenuCont" onMouseOver="LoadBG(this,'rightMenuCont2')" onMouseOut="LoadBG(this,'rightMenuCont')">
											<a href="?act=admin.payments"><img src="<? echo "$layoutDir"; ?>/images/menu/<? echo $g_language; ?>/label_paymentsadmin.png"></a>							
										</td>
									</tr>	
								<tr class="rightSimpleMenuDown">
									<td>
									</td>
								</tr>										
								</table>
							<? 
							}
							?>								
						</td>							
					</tr>				
				</table><br>			
			</td>
		</tr>	
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="borderBottom">
						</td>
					</tr>					
				</table>
			</td>
		</tr>			
	</table>
</div><br>
<div id="copyrights">Desenvolvido por UltraxSoft (2005-2008) - Todos direitos Reservados.</div>
</body>
</html>