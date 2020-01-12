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

//SET TIMEZONE (if Server Timezone are not correct)
//date_default_timezone_set('Europe/Berlin');
 
//TEMPLATES DEFAULT SETTINGS
define('DEFAULT_THEME'	 		  , 'gow');

define('PROTOCOL'				  , (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]  == 'on') ? 'https://' : 'http://');
define('HTTP_ROOT'				  , str_replace(basename($_SERVER["PHP_SELF"]), '', $_SERVER["PHP_SELF"]));

define('DEFAULT_LANG'             , "es"); // For Fatal Errors!
define('PHPEXT'                   , "php");

// UNIVERSE DATA, GALAXY, SYSTEMS AND PLANETS || DEFAULT 9-499-15 RESPECTIVELY
define('MAX_GALAXY_IN_WORLD'      ,   9);
define('MAX_SYSTEM_IN_GALAXY'     , 499);
define('MAX_PLANET_IN_SYSTEM'     ,  15);

// FACTOR FOR THE PLANETSIZE
define('PLANET_SIZE_FACTOR'		  , 1.0);

// NUMBER OF COLUMNS FOR SPY REPORTS
define('SPY_REPORT_ROW'           , 2);

// FIELDS FOR EACH LEVEL OF THE LUNAR BASE
define('FIELDS_BY_MOONBASIS_LEVEL', 5);

// FIELDS FOR EACH LEVEL OF THE TERRAFORMER
define('FIELDS_BY_TERRAFORMER'	  , 7);

// NUMBER OF PLANETS THAT MAY HAVE A PLAYER WITHOUT TECHNO
define('STANDART_PLAYER_PLANETS'  , 9);

// MAXIMAL PLANETS ( -1 = unlimited )
define('MAX_PLANETS'              , 10);

// ADDED PLANET PRO 2 TECH LEVELS
define('PLANETS_PER_TECH' 		  , 1);	

// NUMBER OF BUILDINGS THAT CAN GO IN THE CONSTRUCTION QUEUE
define('MAX_BUILDING_QUEUE_SIZE'  , 5);

// NUMBER OF TECHS THAT CAN GO IN THE RESEARCH QUEUE (1 = off)
define('MAX_RESEACH_QUEUE_SIZE'  ,2);

// NUMBER OF SHIPS THAT CAN BUILD FOR ONCE
define('MAX_FLEET_OR_DEFS_PER_ROW', 999999999); 

// NUMBER OF SHIPS THAT CAN BUILD FOR ONCE
define('MAX_FLEET_OR_DEFS_IN_BUILD', 10);

// PRICE OF ONE CLICK ON GALAXY
define('DEUTERIUM_PER_GALAXY_CLICK', 10);

// SUPPORT WILDCAST DOMAINS
define('UNIS_WILDCAST'			  , true);

// SUPPORT OWN vars.php / UNIVERSE | NOTE: make a COPY of vars.php and rename it to vars_uni1.php,  vars_uni2.php, etc...
define('UNIS_MULTIVARS'			  , false);

// PERCENTAGE OF RESOURCES THAT CAN BE OVER STORED
// 1.0 TO 100% - 1.1% FOR 110 AND SO ON
define('MAX_OVERFLOW'             , 1.0);

// The Limit of DM Mission (ID: 11)
define('MAX_DM_MISSIONS'		  , 1);

// Trader Tax
define('DARKMATTER_FOR_TRADER'	  , 750);

// The Faction for the Moon Creation
define('MOON_CHANCE_FACTOR'		  , 1);

// Maximal moon chance
define('MAX_MOON_CHANCE'		 , 20);

// If ture, the calculation for Researchtime is like OGAME, if false its calculation with standart XNova Formula
define('NEW_RESEARCH'			  , true);

// University reduction per level - standard 8% (Info: 1 = 100%)
define('UNIVERISTY_RESEARCH_REDUCTION'	, 0.08);

// IF SET true, the derbis will be delete, when a moon is created.
define('DESTROY_DERBIS_MOON_CREATE', true);

// Factor for Metal/Crystal and Deuterium Storages
define('STORAGE_FACTOR'			  , 1.0);

// Max Amount of Fleets where allow on one ACS
define('MAX_FLEETS_PER_ACS'	  	  , 16);

// How much IP Block ll be checked
// 1 = (AAA); 2 = (AAA.BBB); 3 = (AAA.BBB.CCC)
define('COMPARE_IP_BLOCKS'	  	  , 2);

// DEBUG LOG
define('DEBUG_EXTRA'	  	 	 , false);

// INITIAL RESOURCE OF NEW PLANETS
define('BUILD_METAL'              , 1500);
define('BUILD_CRISTAL'            , 1500);
define('BUILD_DEUTERIUM'          , 0);
define('BUILD_NORIO'          , 0);

// INITIAL RESOURCE OF NEW PLAYER (2nd const. for Facebook Users)
define('BUILD_DARKMATTER'         , 0);
define('BUILD_FB_DARKMATTER'      , 0);

// Invisible Missions for Phalanx
// Exsample: '1','4','7','10'
define('INV_PHALANX_MISSIONS' 	  , '');
	

// Max Round on Combats
define('MAX_ATTACK_ROUNDS'		  , 6);

// Min Time for VMod in Seconds!
define('VACATION_MIN_TIME'		  , 259200);	

// Enable the one-Click SImulation on Spy-Raports
define('ENABLE_SIMULATOR_LINK'    , true);

// Max. User Session in Seconds
define('SESSION_LIFETIME'		  , 43200);

// Max. User Session in Seconds
define('TIMEFORMAT'				  , 'H:i:s');
define('DATEFORMAT'				  , 'd. M Y');
define('TDFORMAT'				  , 'd. M Y, H:i:s');

// DISCLAMER INFOS
define('DICLAMER_NAME'            , "Edit constans.php!");
define('DICLAMER_ADRESS1'         , "Edit constans.php!");
define('DICLAMER_ADRESS2'         , "Edit constans.php!");
define('DICLAMER_TEL'     		  , "Edit constans.php!");
define('DICLAMER_EMAIL'    		  , "Edit constans.php!");

// Time betwin Jumps for Jumpgates
define('JUMPGATE_WAIT_TIME', 3600); // Tiempo de espera entre saltos.
define('JUMPGATE_REDUCTION_PER_LEVEL', 120); // Tiempo de reduccion entre saltos por nivel del Salto Cuantico.
define('JUMPGATE_MAX_REDUCTION', 1200); // Maximo tiempo a reducir.

// UTF-8 Support for Names 
define('UTF8_SUPPORT'          	  , true);	

// Root IDs
define('ROOT_UNI'        	  	  , 1);
define('ROOT_USER'          	  , 1);

// AdminAuthlevels
define('AUTH_ADM'                 , 3);
define('AUTH_OPS'                 , 2);
define('AUTH_MOD'                 , 1);
define('AUTH_USR'                 , 0);

// Data Tabells
define('DB_NAME'				  , $database["databasename"]);
define('DB_PREFIX'			  	  , $database["tableprefix"]);

define('AKS'				  	  , $database["tableprefix"]."aks");
define('ALLIANCE'			  	  , $database["tableprefix"]."alliance");
define('BANNED'				  	  , $database["tableprefix"]."banned");
define('BUDDY'				  	  , $database["tableprefix"]."buddy");
define('CHAT'				  	  , $database["tableprefix"]."chat");
define('CONFIG'				  	  , $database["tableprefix"]."config");
define('DIPLO'				  	  , $database["tableprefix"]."diplo");
define('FLEETS'				  	  , $database["tableprefix"]."fleets");
define('FLEETTRADES'       , $database["tableprefix"]."fleettrades");
define('NEWS'				  	  , $database["tableprefix"]."news");
define('NOTES'				  	  , $database["tableprefix"]."notes");
define('MESSAGES'			  	  , $database["tableprefix"]."messages");
define('PLANETS'	              , $database["tableprefix"]."planets");
define('RW'			              , $database["tableprefix"]."rw");
define('SESSION'				  , $database["tableprefix"]."session");
define('STATPOINTS'				  , $database["tableprefix"]."statpoints");
define('SUPP'					  , $database["tableprefix"]."supp");
define('TOPKB'					  , $database["tableprefix"]."topkb");
define('USERS'				  	  , $database["tableprefix"]."users");
define('USERS_VALID'		  	  , $database["tableprefix"]."users_valid");

// MOD-TABLES

?>