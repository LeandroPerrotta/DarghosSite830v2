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
		switch($world_id)
		{
			case 0:
				return 'serverI';
			break;	
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
			break;	
			
			case "02";
				$data['mes'] = "Fevereiro";
			break;
			
			case "03";
				$data['mes'] = "Março";
			break;
			
			case "04";
				$data['mes'] = "Abril";
			break;
			
			case "05";
				$data['mes'] = "Maio";
			break;
			
			case "06";
				$data['mes'] = "Junho";
			break;
			
			case "07";
				$data['mes'] = "Julho";
			break;
			
			case "08";
				$data['mes'] = "Agosto";
			break;
			
			case "09";
				$data['mes'] = "Setembro";
			break;
			
			case "10";
				$data['mes'] = "Outubro";
			break;
			
			case "11";
				$data['mes'] = "Novembro";
			break;
			
			case "12";
				$data['mes'] = "Dezembro";
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
			}
		}
		
		return $dataFinal;
	}

	 public static function redirect($url)
	{
        header('Location: ' . $url);
        exit;
	}
	
	public function canUseName($nameString)
	{
		if(trim($nameString) != $nameString)
			return false;	
		
		$palavras = explode(" ", $nameString);
		
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
}
?>