<?
class Tools
{
	public function rand($totalContador) 
	{ 
	   $caracteres = 'abcdefghijklmnopqrstuvwxyz01234567890123456789'; 
	   $totalCaracteres = strlen($caracteres); 
	   $contador = 0; 
	   $return = ''; 
	   while ($contador < $totalContador) 
	   { 
		  $numeroRandomico = mt_rand(0,$totalCaracteres - 1); 
		  $return .= $caracteres[$numeroRandomico]; 
		  $contador++; 
	   }    
	   return $return; 
	}

	public function randKey($tamanho, $separadores, $randTypeElement = "default") 
	{ 
		$options['upper'] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$options['lower'] = "abcdefghijklmnopqrstuvwxyz";
		$options['number'] = "01234567890123456789";
			
		if($randTypeElement != "default")
		{
			$randTypeElement = explode("+", $randTypeElement);
			
			foreach($randTypeElement as $value)
			{
				$fullRand .= $options[$value];
			}
		}
		else
			$fullRand = $options['upper'].$options['lower'].$options['number'];
			
		$countChars = strlen($fullRand);
	
		$string = "";
		$part = array();
	
		for($i = 0; $i < $separadores; $i++)
		{
			for($n = 0; $n < $tamanho; $n++)
			{
				$rand = mt_rand(1, $countChars);
				$part[$i] .= $fullRand[$rand];	
			}
			
			if($i == 0)
				$string .= $part[$i];
			else
				$string .= "-".$part[$i];
		}
		
		return $string;
	}	
	
	
	public function getTimeOfDay($dia, $mes)
	{
		$ano = date("Y", time());
		
		$start = mktime(0, 0, 0, $mes, $dia, $ano);
		$end = mktime(23, 59, 59, $mes, $dia, $ano);
		
		$value = array(
			'start' => $start,
			'end' => $end);
			
		return $value;
	}
	
	private function checkSqlInjection($string)
	{
		if(preg_match("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", $string))
			return false;
		else
			return true;	
	}		
	
	public function getWorldResourceById($world_id)
	{
		foreach($GLOBALS['g_world'] as $p => $v) {
			if($GLOBALS['g_world'][$p]['id'] == $world_id) {
				return $GLOBALS['g_world'][$p]['sqlResource'];
			}
		}
	}
	
	public function checkString($post, $canNull = false, $canNumeric = true)
	{		
		if(!$canNull)
		{
			if($post == "" or $post == null)
			{
				return false;
			}
		}	
		
		if(!$canNumeric and is_numeric($post))
		{
			return false;
		}
		
		if(!$this->checkSqlInjection($post))
		{
			return false;		
		}	
		
		return true;	
	}		
	
	public function validEmail($email) 
	{ 
	    $e = explode("@",$email); 
	    if(count($e) <= 1) 
		{ 
	        return false; 
	    } 
		elseif(count($e) == 2) 
		{ 
	        $ip = gethostbyname($e[1]); 
	        if($ip == $e[1]) 
			{ 
	            return false; 
	        } 
			elseif($ip != $e[1]) 
			{ 
	            return true; 
	        } 
	    } 
	}

	public function datePt($date, $formato = null)
	{
		$data = array(
			'diaSemana' => '',
			'diaMes' => '',
			'mes' => '',
			'ano' => ''
		);
		
		$diaSemana = date("w", $date);
		switch($diaSemana)
		{
			case 0;
				$data['diaSemana'] = "Domingo";
			break;

			case 1;
				$data['diaSemana'] = "Segunda-feira";
			break;

			case 2;
				$data['diaSemana'] = "Terça-feira";
			break;		

			case 3;
				$data['diaSemana'] = "Quarta-feira";
			break;	

			case 4;
				$data['diaSemana'] = "Quinta-feira";
			break;

			case 5;
				$data['diaSemana'] = "Sexta-feira";
			break;	

			case 6;
				$data['diaSemana'] = "Sabado";
			break;			
		}

		$diaMes = date("d", $date);
		$data['diaMes'] = $diaMes;

		$mes = date("m", $date);
		switch($mes)
		{
			case "01";
				$data['mes'] = "Janeiro";
				$data['mesAbrev'] = "Jan";
			break;	
			
			case "02";
				$data['mes'] = "Fevereiro";
				$data['mesAbrev'] = "Fev";
			break;
			
			case "03";
				$data['mes'] = "Março";
				$data['mesAbrev'] = "Mar";
			break;
			
			case "04";
				$data['mes'] = "Abril";
				$data['mesAbrev'] = "Abr";
			break;
			
			case "05";
				$data['mes'] = "Maio";
				$data['mesAbrev'] = "Mai";
			break;
			
			case "06";
				$data['mes'] = "Junho";
				$data['mesAbrev'] = "Jun";
			break;
			
			case "07";
				$data['mes'] = "Julho";
				$data['mesAbrev'] = "Jul";
			break;
			
			case "08";
				$data['mes'] = "Agosto";
				$data['mesAbrev'] = "Ago";
			break;
			
			case "09";
				$data['mes'] = "Setembro";
				$data['mesAbrev'] = "Set";
			break;
			
			case "10";
				$data['mes'] = "Outubro";
				$data['mesAbrev'] = "Out";
			break;
			
			case "11";
				$data['mes'] = "Novembro";
				$data['mesAbrev'] = "Nov";
			break;
			
			case "12";
				$data['mes'] = "Dezembro";
				$data['mesAbrev'] = "Dez";
			break;			
		}

		$ano = date("Y", $date);
		$data['ano'] = $ano;
		
		if($formato == ("" or null))
			$dataFinal = ''.$data['diaSemana'].', '.$data['diaMes'].' de '.$data['mes'].' de '.$data['ano'].'';
		else
		{
			switch($formato)
			{
				case "dd, mes, aa":
					$dataFinal = ''.$data['diaMes'].' de '.$data['mes'].' de '.$data['ano'].'';
				break;	
				case "dd m aaaa":
					$dataFinal = ''.$data['diaMes'].' '.$data['mesAbrev'].' '.$data['ano'].'';
				break;
			}
		}
		
		return $dataFinal;
	}

	 public static function redirect($url)
	{
        header('Location: ' . $url);
        exit;
	}
	
	public function canUseName($nameString, $checkBlackList = true)
	{
		if(trim($nameString) != $nameString)
			return false;	
		
		$palavras = explode(" ", $nameString);
		
		if($checkBlackList && $this->checkBlackList($nameString))
			return false;
		
		if(count($palavras) > 3)
			return false;
		
		if(ucfirst($palavras[0]) != $palavras[0])
			return false;
			
		if(ucfirst($palavras[2]) != $palavras[2])
			return false;			
			
		if(count($palavras) == 3)
		{
			if(strlen($palavras[0]) < 3)
				return false;	
				
			if(strlen($palavras[2]) < 3)
				return false;	
		}
		elseif(count($palavras) == 2)	
		{
			if(strlen($palavras[0]) < 3)
				return false;	
				
			if(strlen($palavras[1]) < 3)
				return false;			
		}
		elseif(count($palavras) == 1)	
		{
			if(strlen($palavras[0]) < 3)
				return false;			
		}		
	
		for($a = 0; $a != count($palavras); $a++)
		{	
			foreach(count_chars($palavras[$a], 1) as $letra => $quantidade)
			{
				if($quantidade > 4)
					return false;				
			}
		}
			
		if(strlen($nameString) > 30)	
			return false;
			
		$letras = str_split($nameString);	
		$space = array();
		
		for($a = 0; $a != count($letras); $a++)
		{
			if($letras[$a] == " ")
			{
				if(count($space) != 0 and ($space[0] + 1) == $a)
					return false;

				$space[] = $a;
			}				
		}
		
		$temp = strspn("$nameString", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM '-");
		
		if($temp != strlen($nameString))
			return false;
		
		return true;
	}	
	
	public function checkBlackList($string) {
		$this->DB->query("SELECT * FROM blacklist_string");
		
		$isInBlackList = 0;
		
		while($fetch = $this->DB->fetch())
		{
			if(eregi($fetch->string, $string))
				$isInBlackList++;
		}
		
		if($isInBlackList == 0)
			return false;
		else
			return true;		
	}
	
	public function htmlUncrypt($string) {
		$trans_tbl1 = get_html_translation_table(HTML_ENTITIES);
		foreach($trans_tbl1 as $ascii => $htmlentitie) {
			$trans_tbl2[$ascii] = '&#'.ord($ascii).';';
		}
		$trans_tbl1 = array_flip($trans_tbl1);
		$trans_tbl2 = array_flip($trans_tbl2);
		return strtr(strtr($string, $trans_tbl1), $trans_tbl2);
	}
	
	public function htmlCrypt($string) {
		return htmlentities($string, ENT_QUOTES);
	}

	public function getText($id) {
		$db = DB::getInstance();
		$db->query("SELECT * FROM texts WHERE id = '{$id}'");
		if($db->num_rows() > 0) {
			if($GLOBALS['g_language'] == "br" OR $GLOBALS['g_language'] == "pt") {
				return $this->htmlUncrypt($db->fetch()->pt);
			} else {
				return $this->htmlUncrypt($db->fetch()->us);
			}
		} else {
			return false;
		}
	}
	
	public function getFormatNews($newsText) {
		global $layoutDir;
		
		$string = str_split($newsText);
		$firstChar = $string[3];
		
		if(is_numeric($firstChar)) {
			return $newsText;
		}
		$imgSrc = "{$layoutDir}/images/fonts/{$firstChar}.png";
		$rest = substr($newsText, 4);
		return '<img src="'.$imgSrc.'" alt="'.$firstChar.'" />'.$rest.'';
	}
}
?>