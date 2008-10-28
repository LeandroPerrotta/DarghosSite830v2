<?
if($login->logged())
{
	$login->logout();
	header ("Location: index.php");			
}
?>