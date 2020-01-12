<?php

/**
 _  \_/ |\ | /��\ \  / /\    |��) |_� \  / /��\ |  |   |��|�` | /��\ |\ |5
 �  /�\ | \| \__/  \/ /--\   |��\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core.
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
 
if(php_sapi_name() === 'cli') {
	error_reporting(E_ALL ^ E_NOTICE);
	define('ROOT_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))).'/');
	define('TIMESTAMP',	time());
	ini_set('display_errors', 0);
	ini_set('error_log', ROOT_PATH.'/includes/cli_error.log');
	if(!function_exists('bcadd'))
		require_once(ROOT_PATH . 'includes/bcmath.php');

	require_once(ROOT_PATH . 'includes/config.php');	
	require_once(ROOT_PATH . 'includes/constants.php');
	require_once(ROOT_PATH . 'includes/classes/class.MySQLi.php');
	require_once(ROOT_PATH . 'includes/classes/class.Lang.php');
	require_once(ROOT_PATH . 'includes/GeneralFunctions.php');
	require_once(ROOT_PATH . 'includes/vars.php');
	$db 	= new DB_MySQLi();
	unset($database);
	$LANG	= new Language();
}
function init() {
	global $db;
	
	$db->query("LOCK TABLE ".AKS." WRITE, ".RW." WRITE, ".MESSAGES." WRITE, ".CONFIG." WRITE, ".FLEETS." WRITE, ".PLANETS." WRITE, ".PLANETS." as p WRITE, ".TOPKB." WRITE, ".USERS." WRITE, ".USERS." as u WRITE, ".STATPOINTS." WRITE;");	
	
	$FLEET = $db->query("SELECT * FROM ".FLEETS." WHERE (`fleet_start_time` <= '". TIMESTAMP ."' AND `fleet_mess` = '0') OR (`fleet_end_time` <= '". TIMESTAMP ."' AND `fleet_mess` = '1') OR (`fleet_end_stay` <= '". TIMESTAMP ."' AND `fleet_mess` = '2') ORDER BY `fleet_start_time` ASC;");
	if($db->num_rows($FLEET) > 0)
	{
		require_once(ROOT_PATH . 'includes/classes/class.FlyingFleetHandler.php');
	
		new FlyingFleetHandler($FLEET);
	}
	$db->free_result($FLEET);
	$db->query("UNLOCK TABLES");  
}
init();
if(php_sapi_name() === 'cli') {
	echo 'OK! - '.date(TIMEFORMAT)."\r\n";
}
?>