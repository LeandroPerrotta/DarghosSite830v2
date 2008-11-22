<?
/*
$g_world = array(
	array(
		'name' => 'Tenerian',
		'id' => '0',
		'location' => 'BRA',
		'onSince' => 'Fev/2008',
		'population' => 'full',
		'sqlResource' => 'serverI'
	),
	array(
		'name' => 'Uniterian',
		'id' => '1',
		'location' => 'USA',
		'onSince' => 'Set/2008',
		'population' => 'empty',
		'sqlResource' => 'serverII'
	)
);	
*/
$g_world = array(); // To be implemented...

$g_skill = array(
	0 => 'fist',
	1 => 'club',
	2 => 'sword',
	3 => 'axe',
	4 => 'distance',
	5 => 'shield',
	6 => 'fish',
	7 => 'experience',
	8 => 'magic',
);	

$g_vocation = array(
	array(
		'name' => 'begginer',
		'id' => '0',
		'promotion' => false,
	),
	array(
		'name' => 'sorcerer',
		'id' => '1',
		'promotion' => false,
	),
	array(
		'name' => 'druid',
		'id' => '2',
		'promotion' => false,
	),		
	array(
		'name' => 'paladin',
		'id' => '3',
		'promotion' => false,
	),	
	array(
		'name' => 'knight',
		'id' => '4',
		'promotion' => false,
	),		
		array(
		'name' => 'master_sorcerer',
		'id' => '5',
		'promotion' => true,
	),	
		array(
		'name' => 'elder_druid',
		'id' => '6',
		'promotion' => true,
	),		
		array(
		'name' => 'royal_paladin',
		'id' => '7',
		'promotion' => true,
	),
		array(
		'name' => 'elite_knight',
		'id' => '8',
		'promotion' => true,
	),		
);

$g_sex = array(
	array(
		'name' => 'female',
		'id' => '0',
	),
	array(
		'name' => 'male',
		'id' => '1',
	),	
);

$g_city = array(
	1 => array(
		'name' => 'Quendor',
		'isPremium' => false,
	),
	2 => array(
		'name' => 'Aracura',
		'isPremium' => true,
	),	
	3 => array(
		'name' => 'Rookgaard',
		'isPremium' => false,
	),		
	4 => array(
		'name' => 'Thorn',
		'isPremium' => false,
	),		
	5 => array(
		'name' => 'Salazart',
		'isPremium' => true,
	),		
	6 => array(
		'name' => 'Northrend',
		'isPremium' => true,
	),			
);

$g_language = ($_COOKIE['lang'] != '') ? $_COOKIE['lang'] : "br";

$g_linkResource = array(
	'site' => null,
	'serverI' => null,
	'serverII' => null,
	'loginserver' => null,
);

$g_pgtPeriodCost = array(
	0 => array(
		'30' => '10.90',
		'60' => '21.80',
		'90' => '32.70',
		'180' => '55.90',
		'360' => '99.90',
	),
	1 => array(
		'30' => '7.90',
		'60' => '15.80',
		'90' => '23.70',
		'180' => '35.90',
		'360' => '62.90',
	)
);

$g_pgtCoin = array(
	0 => 'R$',
	1 => 'US',
);

$g_pgtMethod = array(
	0 => 'PagSeguro',
	1 => 'Paypal',
);

$g_pgtType = array(
	0 => 'Boleto Bancário',
	1 => 'Pgto. Eletronico',
);

$g_pgtStatus = array(
	0 => 'contribution_toactive',
	1 => 'contribution_actived',
	2 => 'contribution_expired',
	3 => 'contribution_rejected',
);
//Tasks Map
$g_tasksMap = array(
	1 => array(
		'name' => "highscores",
		'eachTime' => 60 * 60 * 24
	), 
	2 => array(
		'name' => "worldsstatus",
		'eachTime' => 60 * 10
	)
);

?>