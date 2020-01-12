<?php

/**
 _  \_/ |\ | /¯¯\ \  / /\    |¯¯) |_¯ \  / /¯¯\ |  |   |´¯|¯` | /¯¯\ |\ |5
 ¯  /¯\ | \| \__/  \/ /--\   |¯¯\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core.
 * @author: Copyright (C) 2011 by Brayan Narvaez (Prinick) developer of xNova Revolution
 * @author web: http://www.bnarvaez.com
 * @link: http://www.xnovarev.com

 * @package 2Moons
 * @author Slaver <slaver7@gmail.com>
 * @copyright 2009 Lucky <douglas@crockford.com> (XGProyecto)
 * @copyright 2011 Slaver <slaver7@gmail.com> (Fork/2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.3 (2011-01-21)
 * @link http://code.google.com/p/2moons/

 * Please do not remove the credits
*/

function CreateOnePlanetRecord($Galaxy, $System, $Position, $Universe, $PlanetOwnerID, $PlanetName = '', $HomeWorld = false, $AuthLevel = 0)
{
	global $LNG, $db, $CONFIG;

	if (MAX_GALAXY_IN_WORLD < $Galaxy || 1 > $Galaxy) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}	
	
	if (MAX_SYSTEM_IN_GALAXY < $System || 1 > $System) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}	
	
	if (MAX_PLANET_IN_SYSTEM < $Position || 1 > $Position) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}
	
	if (CheckPlanetIfExist($Galaxy, $System, $Position, $Universe)) {
		return false;
	}

	$FieldFactor		= ($CONFIG[$Universe]['initial_fields'] / 250) * PLANET_SIZE_FACTOR;
	$Position			= ($Position > 15) ? mt_rand(1,15) : $Position;

	switch($Position) {
		case 1:
			$PlanetType         = array('trocken', 'wuesten');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('trocken' => rand(1,10), 'wuesten' => rand(1,4));
			$TMax				= rand(220, 260);
			$TMin				= $TMax - 40;
			$Fields				= rand(195,208) * $FieldFactor;					
		break;
		case 2:
			$PlanetType         = array('trocken', 'wuesten');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('trocken' => rand(1,10), 'wuesten' => rand(1,4));
			$TMax				= rand(170, 210);
			$TMin				= $TMax - 40;
			$Fields				= rand(197,210) * $FieldFactor;					
		break;
		case 3:
			$PlanetType         = array('trocken', 'wuesten');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('trocken' => rand(1,10), 'wuesten' => rand(1,4));
			$TMax				= rand(120, 160);
			$TMin				= $TMax - 40;
			$Fields				= rand(198, 237) * $FieldFactor;					
		break;
		case 4:
			$PlanetType         = array('dschjungel');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('dschjungel' => rand(1,10));
			$TMax				= rand(70, 110);
			$TMin				= $TMax - 40;
			$Fields				= rand(223, 303) * $FieldFactor;					
		break;
		case 5:
			$PlanetType         = array('dschjungel');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('dschjungel' => rand(1,10));
			$TMax				= rand(60, 100);
			$TMin				= $TMax - 40;
			$Fields				= rand(248, 310) * $FieldFactor;				
		break;
		case 6:
			$PlanetType         = array('dschjungel');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('dschjungel' => rand(1,10));
			$TMax				= rand(50, 90);
			$TMin				= $TMax - 40;
			$Fields				= rand(248, 326) * $FieldFactor;						
		break;
		case 7:
			$PlanetType         = array('normaltemp');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('normaltemp' => rand(1,7));
			$TMax				= rand(40, 80);
			$TMin				= $TMax - 40;
			$Fields				= rand(241, 373) * $FieldFactor;						
		break;
		case 8:
			$PlanetType         = array('normaltemp');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('normaltemp' => rand(1,7));
			$TMax				= rand(30, 70);
			$TMin				= $TMax - 40;
			$Fields				= rand(269, 346) * $FieldFactor;						
		break;
		case 9:
			$PlanetType         = array('normaltemp', 'wasser');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('normaltemp' => rand(1,7), 'wasser' => rand(1,9));
			$TMax				= rand(20, 60);
			$TMin				= $TMax - 40;
			$Fields				= rand(261, 338) * $FieldFactor;						
		break;
		case 10:
			$PlanetType         = array('wasser');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('wasser' => rand(1,9));
			$TMax				= rand(10, 50);
			$TMin				= $TMax - 40;
			$Fields				= rand(254, 324) * $FieldFactor;						
		break;
		case 11:
			$PlanetType         = array('wasser');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('wasser' => rand(1,9));
			$TMax				= rand(0, 40);
			$TMin				= $TMax - 40;
			$Fields				= rand(248, 304) * $FieldFactor;						
		break;
		case 12:
			$PlanetType         = array('wasser');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('wasser' => rand(1,9));
			$TMax				= rand(-10, 30);
			$TMin				= $TMax - 40;
			$Fields				= rand(136, 471) * $FieldFactor;						
		break;
		case 13:
			$PlanetType         = array('eis');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('eis' => rand(1,10));
			$TMax				= rand(-50, -10);
			$TMin				= $TMax - 40;
			$Fields				= rand(209, 221) * $FieldFactor;						
		break;
		case 14:
			$PlanetType         = array('eis', 'gas');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('eis' => rand(1,10), 'gas' => rand(1,8));
			$TMax				= rand(-90, -50);
			$TMin				= $TMax - 40;
			$Fields				= rand(181, 193) * $FieldFactor;						
		break;
		case 15:
			$PlanetType         = array('eis', 'gas');
			$PlanetClass        = array('planet');
			$PlanetDesign       = array('eis' => rand(1,10), 'gas' => rand(1,8));
			$TMax				= rand(-130, -90);
			$TMin				= $TMax - 40;
			$Fields				= rand(165, 274) * $FieldFactor;				
		break;
	}
	
	$Type					= $PlanetType[array_rand($PlanetType)];
	$Class					= $PlanetClass[array_rand($PlanetClass)];
	
	$SQL  = "INSERT INTO ".PLANETS." SET ";

	if(!empty($PlanetName))
		#$SQL .= "`name` = '".$PlanetName."', ";
		$SQL .= "`name` = '".$db->sql_escape($PlanetName)."', ";
	
	if($CONFIG[$Universe]['adm_attack'] == 0)
		$AuthLevel = AUTH_USR;
	
	$SQL .= "`universe` = '".$Universe."', ";
	$SQL .= "`id_owner` = '".$PlanetOwnerID."', ";
	$SQL .= "`galaxy` = '".$Galaxy."', ";
	$SQL .= "`system` = '".$System."', ";
	$SQL .= "`planet` = '".$Position."', ";
	$SQL .= "`last_update` = '".TIMESTAMP."', ";
	$SQL .= "`planet_type` = '1', ";
	$SQL .= "`image` = '".($Type.$Class.(($PlanetDesign[$Type] <= 9)?'0':'').$PlanetDesign[$Type])."', ";
	$SQL .= "`diameter` = '".floor(1000 * sqrt($Fields))."', ";
	$SQL .= "`field_max` = '".(($HomeWorld) ? $CONFIG[$Universe]['initial_fields'] : floor($Fields))."', ";
	$SQL .= "`temp_min` = '".$TMin."', ";
	$SQL .= "`temp_max` = '".$TMax."', ";
	$SQL .= "`metal` = '".BUILD_METAL."', ";
	$SQL .= "`metal_perhour` = '".$CONFIG[$Universe]['metal_basic_income']."', ";
	$SQL .= "`crystal` = '".BUILD_CRISTAL."', ";
	$SQL .= "`crystal_perhour` = '".$CONFIG[$Universe]['crystal_basic_income']."', ";
	$SQL .= "`deuterium` = '".BUILD_DEUTERIUM."', ";
	$SQL .= "`deuterium_perhour` = '".$CONFIG[$Universe]['deuterium_basic_income']."', ";
	$SQL .= "`norio` = '".BUILD_NORIO."', ";
	$SQL .= "`norio_perhour` = '".$CONFIG[$Universe]['norio_basic_income']."';";
	
	$db->query($SQL);
	return $db->GetInsertID();
}
?>