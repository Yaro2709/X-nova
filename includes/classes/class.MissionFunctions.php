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

if (!defined('INSIDE')) exit;

class MissionFunctions
{	
	function __construct()
	{
		$this->kill	= 0;
	}

	function UpdateFleet($Option, $Value)
	{
		$this->_fleet[$Option] = $Value;
		$this->_upd[$Option] = $Value;
	}
	
	function SaveFleet()
	{
		global $db;
		if($this->kill == 1)
			return;
			
		foreach($this->_upd as $Opt => $Val)
		{
			$Qry[]	= "`".$Opt."` = '".$Val."'";
		}
		
		$db->query("UPDATE ".FLEETS." SET ".implode(', ',$Qry)." WHERE `fleet_id` = '".$this->_fleet['fleet_id']."';");
	}
		
	function RestoreFleet($Start = true)
	{
		global $resource, $db;

		$FleetRecord         = explode(';', $this->_fleet['fleet_array']);
		$QryUpdFleet         = '';
		foreach ($FleetRecord as $Item => $Group)
		{
			if (empty($Group)) continue;

			$Class			= explode(',', $Group);
			$QryUpdFleet	.= "p.`".$resource[$Class[0]]."` = p.`".$resource[$Class[0]]."` + '".floattostring($Class[1])."', ";
		}

		$Qry   = "UPDATE ".PLANETS." as p, ".USERS." as u SET ";
		if (!empty($QryUpdFleet))
			$Qry  .= $QryUpdFleet;

		$Qry  .= "p.`metal` = p.`metal` + '".floattostring($this->_fleet['fleet_resource_metal'])."', ";
		$Qry  .= "p.`crystal` = p.`crystal` + '".floattostring($this->_fleet['fleet_resource_crystal'])."', ";
		$Qry  .= "p.`deuterium` = p.`deuterium` + '".floattostring($this->_fleet['fleet_resource_deuterium'])."', ";
		$Qry  .= "u.`darkmatter` = u.`darkmatter` + '".floattostring($this->_fleet['fleet_resource_darkmatter'])."', ";
	    $Qry  .= "p.`norio` = p.`norio` + '".floattostring($this->_fleet['fleet_resource_norio'])."' ";
		$Qry  .= "WHERE ";
		$Qry  .= "p.`id` = '".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id'])."' ";
		$Qry  .= "AND u.id = p.id_owner;";
		$Qry  .= "DELETE FROM ".FLEETS." WHERE `fleet_id` = '".$this->_fleet['fleet_id']."';";
		$db->multi_query($Qry);
	}
	
	function StoreGoodsToPlanet($Start = false)
	{
		global $db;
		$Qry   = "UPDATE ".PLANETS." SET ";
		$Qry  .= "`metal` = `metal` + '".floattostring($this->_fleet['fleet_resource_metal'])."', ";
		$Qry  .= "`crystal` = `crystal` + '".floattostring($this->_fleet['fleet_resource_crystal'])."', ";
		$Qry  .= "`deuterium` = `deuterium` + '".floattostring($this->_fleet['fleet_resource_deuterium'])."', ";
		$Qry  .= "`norio` = `norio` + '".floattostring($this->_fleet['fleet_resource_norio'])."' ";
		$Qry  .= "WHERE ";
		$Qry  .= "`id` = '".($Start == true ? $this->_fleet['fleet_start_id'] : $this->_fleet['fleet_end_id'])."';";
		$db->query($Qry);
		
		$this->UpdateFleet('fleet_resource_metal', '0');
		$this->UpdateFleet('fleet_resource_crystal', '0');
		$this->UpdateFleet('fleet_resource_deuterium', '0');
		$this->UpdateFleet('fleet_resource_norio', '0');
	}
	
	function KillFleet()
	{
		global $db;
		$this->kill	= 1;
		$db->query("DELETE FROM ".FLEETS." WHERE `fleet_id` = '".$this->_fleet['fleet_id']."';");
	}	
}
?>