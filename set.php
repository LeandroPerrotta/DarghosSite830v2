<?
if ($_SERVER['REQUEST_METHOD'] == "GET")
{
	if($_GET["lang"] != (null or ""))
	{
		setCookie("lang", $_GET["lang"], time() + 60 * 60 * 24);
		$tools->redirect("index.php");
	}
}
?>