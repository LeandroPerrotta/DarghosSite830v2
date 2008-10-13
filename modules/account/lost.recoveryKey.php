<?
echo '<tr><td class=newbar><center><b>:: Login ::</td></tr>
<tr><td class=newtext>';

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	$rk = md5($_POST['recoverykey']);
	$rk_query = mysql_query("SELECT * FROM `accounts` WHERE (`rk_number` = '$rk')");
	$rk_fetch = mysql_fetch_array($rk_query);
	if ($rk == "" or $rk == null)
	{
		echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2>Erro!</td></tr>';
		echo '</table>';
		echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
		echo '<tr><td class=rank1>
		<br>Digite todos campos corretamente.</b>';
		echo '</table>';
		echo '<br><a href="?page=account.lost"><img src="images/back.gif" border="0"></a>';				
	}
	elseif (mysql_num_rows($rk_query) != 0) 
	{
		$account_rec = $rk_fetch['id'];
		$password_rec = new_pass($account_rec);
		echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
		echo '<tr><td class=rank2>Sua conta foi recuperada com sucesso!</td></tr>';
		echo '</table>';
		echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
		echo '<tr><td class=rank1>
		<br>Sua conta é: <b>'.$account_rec.'</b>
		<br>Sua senha é: <b>'.$password_rec.'</b>';
		echo '</table>';
		echo '<br><a href="?page=account.login"><img src="images/back.gif" border="0"></a>';			
		$password_rec = null;
		$account_rec = null;	
	}
	
	else
	{
		echo 'Recovery key não encontrada';
	}
}
else
{
	echo '
<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
Recupere sua conta preenchendo o campo abaixo.<br>
Dica: Memorize sua conta para evitar esse tipo de problema no futuro.
</table>
<center>
<form method="POST" action="?page=lost.recoveryKey">

<center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
<tr><td class=rank2>Recuperação da conta via Recovery Key</td></tr>
</table>	
<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">
<tr><td width="25%" class=rank1>Recovery Key:</td><td width="75%" class=rank1><input name="recoverykey" type="password" value="" class="login"/></td></tr>
</table>
<br />
<input type="image" value="Entrar" src="images/submit.gif"/> <a href="?page=account.lost"><img src="images/back.gif" border="0"></a>

</form>
<br>';
}
?>