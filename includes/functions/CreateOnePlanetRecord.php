<?php

/**
 _  \_/ |\ | /��\ \  / /\    |��) |_� \  / /��\ |  |   |��|�` | /��\ |\ |6
 �  /�\ | \| \__/  \/ /--\   |��\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core Redesigned.
 * @author: Copyright (C) 2011 by Brayan Narvaez (Prinick) developer of xNova Revolution
 * @author: Copyright (C) 2017 by Yamil Readigos Hurtado (YamilRH) <ireadigos@gmail.com> Redesigned of xNova Revolution 6.1
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
	global $LNG, $db;

	$CONF	= getConfig($Universe);

	if ($CONF['max_galaxy'] < $Galaxy || 1 > $Galaxy) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}	
	
	if ($CONF['max_system'] < $System || 1 > $System) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}	
	
	if ($CONF['max_planets'] < $Position || 1 > $Position) {
		throw new Exception("Access denied for CreateOnePlanetRecord.php.<br>Try to create a planet at position:".$Galaxy.":".$System.":".$Position);
	}
	
	if (CheckPlanetIfExist($Galaxy, $System, $Position, $Universe)) {
		return false;
	}

	$FieldFactor		= $CONF['planet_factor'];
	require(ROOT_PATH.'includes/PlanetData.php');
	$Pos                = ceil($Position / ($CONF['max_planets'] / count($PlanetData))); 
	$TMax				= $PlanetData[$Pos]['temp'];
	$TMin				= $TMax - 40;
	$Fields				= $PlanetData[$Pos]['fields'] * $CONF['planet_factor'];
	$Types				= array_keys($PlanetData[$Pos]['image']);
	$Type				= $Types[array_rand($Types)];
	$Class				= $Type.'planet'.($PlanetData[$Pos]['image'][$Type] < 10 ? '0' : '').$PlanetData[$Pos]['image'][$Type];

	$SQL  = "INSERT INTO ".PLANETS." SET ";

	if(!empty($PlanetName))
		$SQL .= "`name` = '".$db->sql_escape($PlanetName)."', ";
	
	if($CONF['adm_attack'] == 0)
		$AuthLevel = AUTH_USR;
	
	$SQL .= "`universe` = '".$Universe."', ";
	$SQL .= "`id_owner` = '".$PlanetOwnerID."', ";
	$SQL .= "`galaxy` = '".$Galaxy."', ";
	$SQL .= "`system` = '".$System."', ";
	$SQL .= "`planet` = '".$Position."', ";
	$SQL .= "`last_update` = '".TIMESTAMP."', ";
	$SQL .= "`planet_type` = '1', ";
	$SQL .= "`image` = '".$Class."', ";
	$SQL .= "`diameter` = '".floor(1000 * sqrt($Fields))."', ";
	$SQL .= "`field_max` = '".(($HomeWorld) ? $CONF['initial_fields'] : floor($Fields))."', ";
	$SQL .= "`temp_min` = '".$TMin."', ";
	$SQL .= "`temp_max` = '".$TMax."', ";
	$SQL .= "`metal` = '".$CONF['metal_start']."', ";
	$SQL .= "`metal_perhour` = '".$CONF['metal_basic_income']."', ";
	$SQL .= "`crystal` = '".$CONF['crystal_start']."', ";
	$SQL .= "`crystal_perhour` = '".$CONF['crystal_basic_income']."', ";
	$SQL .= "`deuterium` = '".$CONF['deuterium_start']."', ";
	$SQL .= "`deuterium_perhour` = '".$CONF['deuterium_basic_income']."', ";
	$SQL .= "`norio` = '".$CONF['norio_start']."', ";
	$SQL .= "`norio_perhour` = '".$CONF['norio_basic_income']."'; ";
	
	$db->query($SQL);
	return $db->GetInsertID();
}
?>