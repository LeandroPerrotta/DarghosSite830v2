<?
echo '<tr><td class=newbar><center><b>:: Recuperação de Conta ::</td></tr>
<tr><td class=newtext>';

if($_GET["by"] == "recoveryKey")
{
	echo '
	<br>

	<center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2">
	Bem vindo ao sistema de recuperação de contas avançado.
	Jogadores que obterem uma conta premium ganham uma chave de recuperação para sua conta, garantindo que ela seja SEMPRE sua. Escolha abaixo o metodo de recuperação desejado.<br>
	</table><br>

	<center><table width="65%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
	<tr><td class=rank2>Account Lost por Recovery Key</td></tr>
	</table>	
	<center><table border="0" width="65%" bgcolor="black" CELLSPACING="1" CELLPADDING="4">
	<tr><td width="25%" class=rank1><a href="?page=lost.recoveryKey"><li>Recuperar conta e senha usando minha recovery key</a></li></td></tr>
	<tr><td width="25%" class=rank1><a href="?page=lost.changeEmail"><li>Quero mudar meu email usando minha recovery key</a></li></td></tr>
	</table>
	<br><a href="?page=account.lost"><img src="images/back.gif" border="0"></a>';
}
else
{
	echo '


	<br><center><table border="0" width="95%" CELLSPACING="1" CELLPADDING="2"><font color=black>
	Caso você tenha perdido um ou mais dados de sua conta ainda é possivel recupera-la ultilizando este recurso. 
	Para que você possa recuperar com exito sua account, caso você nao possua uma Recovery Key, é necessario ter acesso ao e-mail na qual sua conta foi registrada, caso contrario será impossivel a recuperação.</a><br>
	</table>

	<br><center><table width="95%" bgcolor="black" BORDER="0" CELLSPACING="1" CELLPADDING="4">
	<tr><td class=rank2>Recuperação de conta</td></tr>
	<tr class=rank1><td width="25%"><a href="?page=lost.account"><li>Quero recuperar o numero de minha conta</a></li></td></tr>
	<tr class=rank1><td width="25%"><a href="?page=lost.password"><li>Quero recuperar minha senha</a></li></td></tr>
	<tr class=rank1><td width="25%"><a href="?page=lost.both"><li>Quero recuperar minha senha e meu numero de conta</a></li></td></tr>
	<tr class=rank1><td width="25%"><a href="?page=account.lost&by=recoveryKey"><li>Quero recuperar minha account ultilizando minha recovery key.</a></li></td></tr>
	</table><br>';
}
?>