<?
class elementHTML
{
	public $layoutDir;

	public function radioInput($name, $value, $isSelected = false)
	{
		if(!$isSelected)
			return '<input type="radio" name="'.$name.'" value="'.$value.'">';
		else	
			return '<input type="radio" name="'.$name.'" value="'.$value.'" checked>';
	}
	
	public function hiddenInput($name, $value)
	{
		return '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
	}	
	
	public function checkBoxInput($name, $value)
	{
		return '<input type="checkbox" name="'.$name.'" value="'.$value.'">';
	}	
	
	public function textArea($name, $value, $rows = 2, $cols = 20)
	{
		return '<textarea name="'.$name.'" rows="'.$rows.'" cols="'.$cols.'">'.$value.'</textarea>';
	}		
	
	public function textBoxInput($name, $type = "text", $value = null, $size = 30)
	{
		return '<input class="input" name="'.$name.'" type="'.$type.'" size="'.$size.'" value="'.$value.'"/>';
	}	
	
	public function selectBoxInput($name, $value, $preSelect = false)
	{
		$select = '<select name="'.$name.'">';
			
		if(!$preSelect)	
			$select .= '<option disabled="disabled"></option>';
		
		foreach($value as $p => $v) {
			if($value[$p]['select']) {
				$select .= '<option value="'.$value[$p]['valueId'].'" selected>'.$value[$p]['valueName'].'</option>';
			} else {
				$select .= '<option value="'.$value[$p]['valueId'].'">'.$value[$p]['valueName'].'</option>';
			}
		}

		$select .= '</select>';
		
		return $select;
	}
	
	public function formStart($url, $metod = 'POST')
	{
		return '<form action="'.$url.'" method="'.$metod.'">';
	}	
	
	public function formEnd()
	{
		return '</form>';
	}	

	public function conditionTable($condition)
	{
		if($condition['buttons'] != (null or ""))
			$button = '<center>'.$condition['buttons'].'</center><br>';
			
		return '
			<table cellspacing="2" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td class="tableTop" colspan="2">'.$condition['title'].'</td>
				</tr>
				<tr>
					<td class="tableContLight">
						'.$condition['msg'].'
					</td>
				</tr>	
			</table><br>
			'.$button.'
		';
	}	
	
	public function descriptionTable($description)
	{		
		return '
			<table cellspacing="0" cellpadding="0" border="0" width="95%" align="center">
				<tr>
					<td>
						'.$description.'
					</td>
				</tr>
			</table>	
			<br>
		';
	}		
	
	public function simpleButtonInput($name)
	{
		return '<input class="input" type="submit" name="Submit" value="'.$name.'" />';
	}
	
	public function imageButtonInput($buttonName)
	{
		return '<input type="image" src="'.$this->layoutDir.'/images/buttons/'.$GLOBALS['g_language'].'/but_'.$buttonName.'.png" border="0"/>';
	}	
	
	public function simpleButton($buttonName, $url)
	{
		return '<a class="button" href="'.$url.'"><img src="'.$this->layoutDir.'/images/buttons/'.$GLOBALS['g_language'].'/but_'.$buttonName.'.png"></a>';
	}	
}
?>