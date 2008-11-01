<?
if ($_SERVER['REQUEST_METHOD'] == "GET")
{
	if($_GET["lang"] != (null or ""))
	{
		if(!preg_match("/act/", $_GET["redirect"])){
		$_GET["redirect"] = "index.php";
		}
		setCookie("lang", $_GET["lang"], time() + 60 * 60 * 24);
		$tools->redirect($_GET["redirect"]);
	}
}
?>