<?
if($engine->loggedIn())
{
		echo '
		<tr><td class=newbar><center><b>:: Gerar Recovery Key ::</td></tr>
		<tr><td class=newtext><br><center>';	
			
		$query = mysql_query("SELECT * FROM accounts WHERE (id = '".$_SESSION['account']."' AND password = '".$password."')") or die(mysql_error()); 
		$query_sql = mysql_fetch_array($query);
		
		if($query_sql['rk_number'] != 0)
		{
			echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
			echo '<tr><td class=rank2>Erro!</td></tr>';
			echo '</table>';
			echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
			echo '<tr><td class=rank1>
			<br>Esta conta já possui uma recovery key.</b>';
			echo '</table>';
			echo '<br><a href="?page=account.main"><img src="images/back.gif" border="0"></a>';			
		}

		elseif($query_sql['premdays'] == 0)
		{
			echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
			echo '<tr><td class=rank2>Erro!</td></tr>';
			echo '</table>';
			echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
			echo '<tr><td class=rank1>
			<br>Tipo de conta invalida.</b>';
			echo '</table>';
			echo '<br><a href="?page=account.main"><img src="images/back.gif" border="0"></a>';			
		}				

		else

		{
			$email = filtreString($_POST['email'],0);
			$acc = filtreString($_POST['account'],0);
			$pass = md5(filtreString($_POST['pass'],0));
			
			if ($_SERVER['REQUEST_METHOD'] == "POST")
			{								
				if (($query_sql['id'] != $acc) or ($query_sql['password'] != $pass) or ($query_sql['email'] != $email))
				{
					echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
					echo '<tr><td class=rank2>Erro!</td></tr>';
					echo '</table>';
					echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
					echo '<tr><td class=rank1>
					<br>Numero da conta, senha ou email incorretos.
					<br>Por favor, tente novamente.
					<br>Se o problema persistir contate um administrador.';
					echo '</table>';
					echo '<br><a href="?page=account.main"><img src="images/back.gif" border="0"></a>';			
				}							
				
				else
				{
					$acc_number = rand(1,9);
					$rk = my_rand(14);	
					$rkMd5 = md5($rk);
				
					$check_rk = mysql_query("SELECT * FROM accounts WHERE (rk_number = '".$rkMd5."')") or die(mysql_error()); 
				
					if (mysql_num_rows($check_rk) == 0)
					{
						$update_acc = "UPDATE accounts SET rk_number = '".$rkMd5."' WHERE id = '".$account."'";
						mysql_query($update_acc) or die(mysql_error());
						echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
						echo '<tr><td class=rank2>Sua Recovery Key foi gerada com sucesso!</td></tr>';
						echo '</table>';
						echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
						echo '<tr><td class=rank1>
						<br>Sua Recovery Key é: <br><b>'.$rk.'</b>
						<br>Lembre-se que sua recovery key é unica e NÃO sera possivel gerar outra!
						<br>Memorize o numero e bom jogo!';
						echo '</table>';
						echo '<br><a href="?page=account.main"><img src="images/back.gif" border="0"></a>';
					}
					
					else
					{
						echo '<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">';
						echo '<tr><td class=rank2>Erro!</td></tr>';
						echo '</table>';
						echo '<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="2">';
						echo '<tr><td class=rank1>
						<br>Ocorreu um erro ao gerar sua recovery key.
						<br>Por favor, tente novamente.
						<br>Se o problema persistir contate um administrador.';
						echo '</table>';
						echo '<br><a href="?page=account.main"><img src="images/back.gif" border="0"></a>';			
					}
				}				
				
			}
		}	
?>
<center>



<form action="?page=account.getRecoveryKey" method="post">

<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
A recovery key e um sistema avançado de recuperação para sua conta, com ela, você podera rapidamente retomar a posse de sua conta.
Lembre-se que a recovery key só pode ser obtida uma vez e caso você a perda não será possivel gerar outro numero!<br>
</table>

<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
<tr><td class=rank2>Gerar Recovery Key</td></tr>
</table>	
<center><table border="0" width="95%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">
<tr><td width="25%" class=rank1>Email:</td><td width="75%" class=rank1><input name="email" type="text" value="" class="login"/></td></tr>
<tr><td width="25%" class=rank1>Conta:</td><td width="75%" class=rank1><input name="account" type="password" value="" class="login"/></td></tr>
<tr><td width="25%" class=rank1>Senha:</td><td width="75%" class=rank1><input name="pass" type="password" value="" class="login"/></td></tr>
</table>
<br />
<input type="image" value="submit" src="images/submit.gif"/>
</form>
<?
}
?>