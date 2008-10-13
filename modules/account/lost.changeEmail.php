<?
echo '<tr><td class=newbar><center><b>:: Login ::</td></tr>
<tr><td class=newtext>';

if ($_SERVER['REQUEST_METHOD'] == "POST")
	{

	$rk = md5(filtreString($_POST['recoverykey'],0));
	$newemail = filtreString($_POST['newemail'],0);
	$email_check = mysql_query("SELECT * FROM `accounts` WHERE (`email` = '$newemail')");
	$rk_query = mysql_query("SELECT * FROM `accounts` WHERE (`rk_number` = '$rk')");
	$rk_fetch = mysql_fetch_array($rk_query);
			
	if (mysql_num_rows($rk_query) != 0)
	{
		if (($newemail == '') or ($newemail == null) or $rk == null or $rk == "")
		{
				echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
				echo '<tr><td class=rank2>Erro!</td></tr>';
				echo '</table>';
				echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
				echo '<tr><td class=rank1>
				<br>Digite todos campos corretamente.</b>';
				echo '</table>';
				echo '<br><a href="?page=lost.changeEmail"><img src="images/back.gif" border="0"></a>';			
		}		

		elseif (mysql_num_rows($email_check) != 0)	
		{
				echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
				echo '<tr><td class=rank2>Erro!</td></tr>';
				echo '</table>';
				echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
				echo '<tr><td class=rank1>
				<br>Este e-mail já esta em uso em nosso banco de dados.</b>';
				echo '</table>';
				echo '<br><a href="?page=lost.changeEmail"><img src="images/back.gif" border="0"></a>';			
		}
							
		else
		{
			$update_email = "UPDATE accounts SET email = '".$newemail."' WHERE rk_number = '".$rk ."'";
			mysql_query($update_email) or die(mysql_error());			
			echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
			echo '<tr><td class=rank2>E-mail modificado com sucesso!</td></tr>';
			echo '</table>';
			echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
			echo '<tr><td class=rank1>
			<br>Seu e-mail foi modificado com sucesso!</b>';
			echo '</table>';
			echo '<br><a href="?page=account.login"><img src="images/back.gif" border="0"></a>';						
		}
	}

	else
	{
		echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2>Erro!</td></tr>';
		echo '</table>';
		echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
		echo '<tr><td class=rank1>
		<br>Esta recovery key não existe.</b>';
		echo '</table>';
		echo '<br><a href="?page=lost.changeEmail"><img src="images/back.gif" border="0"></a>';			
	}
}
else
{	

echo '

<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
Modifique seu e-mail instantaneamente ultilizando sua recovery key!<br>
Não compartilhe os dados da sua conta com ninguem e lembre-se, nenhum membro do Darghos nunca pedira seus dados.
</table>
<center>
<form method="POST" action="?page=lost.changeEmail">

<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
<tr><td class=rank2>Mudar E-Mail com a Recovery Key</td></tr>
</table>	
<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">
<tr><td width="25%" class=rank1>Recovery Key:</td><td width="75%" class=rank1><input name="recoverykey" type="password" value="" class="login"/></td></tr>
<tr><td width="25%" class=rank1>Novo E-mail:</td><td width="75%" class=rank1><input name="newemail" type="text" value="" class="login" MAXLENGTH="35"/></td></tr>
</table>
<br />
<input type="image" value="Entrar" src="images/submit.gif"/> <a href="?page=account.lost"><img src="images/back.gif" border="0"></a>

</form>
<br>';

}
?>