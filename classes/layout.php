<?
class Layout
{
	public function loadLayout($layout)
	{
		switch($layout)
		{
			case "default";
				include "layout/layout.php";
				break;
		}
	}
}
?>