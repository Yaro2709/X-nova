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

function DeleteSelectedUser($UserID)
{
	global $db ,$CONF;
	
	if(ROOT_USER == $UserId)
			return false;
	
	$TheUser = $db->uniquequery("SELECT universe, ally_id FROM ".USERS." WHERE `id` = '".$UserID."';");
	$SQL 	 = "";
	
	if ($TheUser['ally_id'] != 0 )
	{
		$TheAlly =  $db->uniquequery("SELECT ally_members FROM ".ALLIANCE." WHERE `id` = '".$TheUser['ally_id']."';");
		$TheAlly['ally_members'] -= 1;

		if ($TheAlly['ally_members'] > 0)
		{
			$SQL .= "UPDATE ".ALLIANCE." SET `ally_members` = '".$TheAlly['ally_members']."' WHERE `id` = '".$TheUser['ally_id']."';";
		}
		else
		{
			$SQL .= "DELETE FROM ".ALLIANCE." WHERE `id` = '" . $TheUser['ally_id'] . "';";
			$SQL .= "DELETE FROM ".STATPOINTS." WHERE `stat_type` = '2' AND `id_owner` = '".$TheUser['ally_id']."';";
		}
	}

	$SQL .= "DELETE FROM ".BUDDY." WHERE `owner` = '".$UserID."' OR `sender` = '".$UserID."';";
	$SQL .= "DELETE FROM ".FLEETS." WHERE `fleet_owner` = '".$UserID."';";
	$SQL .= "DELETE FROM ".MESSAGES." WHERE `message_owner` = '".$UserID."' OR `message_sender` = '".$UserID."';";
	$SQL .= "DELETE FROM ".NOTES." WHERE `owner` = '".$UserID."';";
	$SQL .= "DELETE FROM ".PLANETS." WHERE `id_owner` = '".$UserID."';";
	$SQL .= "DELETE FROM ".USERS." WHERE `id` = '".$UserID."';";
	$SQL .= "DELETE FROM ".STATPOINTS." WHERE `stat_type` = '1' AND `id_owner` = '".$UserID."';";
	$db->multi_query($SQL);
	
	$SQL	= $db->query("SELECT fleet_id FROM ".FLEETS." WHERE `fleet_target_owner` = '".$UserID."';");
	while($FleetID = $db->fetch_array($SQL)) {
		SendFleetBack($UserID, $FleetID);
	}
	update_config(array('users_amount' => $CONF['users_amount'] - 1), $TheUser['universe']);
}

function SendFleetBack($CurrentUser, $FleetID)
{
	global $db;	

	$FleetRow = $db->uniquequery("SELECT `start_time`, `fleet_mission`, `fleet_group`, `fleet_owner`, `fleet_mess` FROM ".FLEETS." WHERE `fleet_id` = '". $FleetID ."';");
	if ($FleetRow['fleet_owner'] != $CurrentUser || $FleetRow['fleet_mess'] == 1)
		return;
		
	$where		= 'fleet_id';

	if($FleetRow['fleet_mission'] == 1 && $FleetRow['fleet_group'] > 0)
	{
		$Aks = $db->uniquequery("SELECT teilnehmer FROM ".AKS." WHERE id = '". $FleetRow['fleet_group'] ."';");

		if($Aks['teilnehmer'] == $FleetRow['fleet_owner'])
		{
			$db->query("DELETE FROM ".AKS." WHERE id ='". $FleetRow['fleet_group'] ."';");
			$FleetID	= $FleetRow['fleet_group'];
			$where		= 'fleet_group';
		}
	}
	
	$db->query("UPDATE ".FLEETS." SET `fleet_group` = '0', `start_time` = '".TIMESTAMP."', `fleet_end_stay` = '".TIMESTAMP."', `fleet_end_time` = '".((TIMESTAMP - $FleetRow['start_time']) + TIMESTAMP)."', `fleet_mess` = '1' WHERE `".$where."` = '".$FleetID."';");
}

function DeleteSelectedPlanet ($ID)
{
	global $db;

	$QueryPlanet = $db->uniquequery("SELECT universe,galaxy,planet,system,planet_type FROM ".PLANETS." WHERE id = '".$ID."';");

	if ($QueryPlanet['planet_type'] == '3')
		$db->multi_query("DELETE FROM ".PLANETS." WHERE id = '".$ID."';UPDATE ".PLANETS." SET id_luna = '0' WHERE id_luna = '".$ID."';");
	else
		$db->query("DELETE FROM ".PLANETS." WHERE universe = '".$QueryPlanet['universe']."' AND galaxy = '".$QueryPlanet['galaxy']."' AND system = '".$QueryPlanet['system']."' AND planet = '".$QueryPlanet['planet']."';");
}

?>