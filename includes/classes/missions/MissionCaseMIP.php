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

class MissionCaseMIP extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		global $db, $resource, $reslist, $LANG;
		$SQL = "";
		foreach($reslist['defense'] as $Element)
		{
			$SQL	.= PLANETS.".".$resource[$Element].", ";
		}
			
		$QryTarget		 	= "SELECT ".USERS.".lang, ".USERS.".defence_tech, ".PLANETS.".id, ".PLANETS.".id_owner, ".substr($SQL, 0, -2)."
							   FROM ".PLANETS.", ".USERS."
							   WHERE ".PLANETS.".`id` = '".$this->_fleet['fleet_end_id']."' AND 
							   ".PLANETS.".id_owner = ".USERS.".id;";
								   
		$TargetInfo			= $db->uniquequery($QryTarget);		
		
		if($this->_fleet['fleet_end_type'] == 3)	{
		$TargetInfo[$resource[502]]	= $db->countquery("SELECT ".$resource[502]." FROM ".PLANETS." WHERE id_luna = ".$this->_fleet['fleet_end_id'].";");
		}
		
		$OwnerInfo			= $db->uniquequery("SELECT `lang`, `military_tech` FROM ".USERS." WHERE `id` = '".$this->_fleet['fleet_owner']."';");					   
		$Target				= (!in_array($this->_fleet['fleet_target_obj'], $reslist['defense']) || $this->_fleet['fleet_target_obj'] == 502 || $this->_fleet['fleet_target_obj'] == 0) ? 401 : $this->_fleet['fleet_target_obj'];

		foreach($reslist['defense'] as $Element)		
		{
			$TargetDefensive[$Element]	= $TargetInfo[$resource[$Element]];
		}

		$message 			= "";
		$SQL 				= "";
			
		$LNG				= $LANG->GetUserLang($CONFIG[$this->_fleet['fleet_universe']]['lang'], array('FLEET', 'TECH'));
				
		require_once('calculateMIPAttack.php');	
		if ($TargetInfo[$resource[502]] >= $this->_fleet['fleet_amount'])
		{
			$message 	= $LNG['sys_irak_no_att'];
			if($this->_fleet['fleet_end_type'] == 3)
			$SQL .= "UPDATE ".PLANETS." SET ".$resource[502]." = ".$resource[502]." - ".$this->_fleet['fleet_amount']." WHERE id_luna = ".$TargetInfo['id'].";";
			else
			$SQL .= "UPDATE ".PLANETS." SET ".$resource[502]." = ".$resource[502]." - ".$this->_fleet['fleet_amount']." WHERE id = ".$TargetInfo['id'].";";
		}
		else
		{
			if ($TargetInfo[$resource[502]] > 0)
			{
				if($this->_fleet['fleet_end_type'] == 3)
				$db->query("UPDATE ".PLANETS." SET ".$resource[502]." = 0 WHERE id_luna = " . $TargetInfo['id'].";");
				else
				$db->query("UPDATE ".PLANETS." SET ".$resource[502]." = 0 WHERE id = " . $TargetInfo['id'].";");
				$message .= sprintf($LNG['sys_irak_def'], $TargetInfo[$resource[502]]);
			}
			
			$irak 	= calculateMIPAttack($TargetInfo["defence_tech"], $OwnerInfo["military_tech"], $this->_fleet['fleet_amount'], $TargetDefensive, $Target, $TargetInfo[$resource[502]]);
			ksort($irak, SORT_NUMERIC);
			$Count = 0;
			foreach ($irak as $Element => $destroy)
			{
				if(empty($Element))
					continue;

				if ($id != 502)
					$message .= $LNG['tech'][$Element]." (- ".$destroy.")<br>";
				
				if ($destroy == 0)
					continue;
				
				#$SQL .= in_array($Element, $reslist['one']) ? "UPDATE ".PLANETS." SET `".$resource[$Element]."` = '0' WHERE id = ".$TargetInfo['id'].";" : "UPDATE ".PLANETS." SET `".$resource[$Element]."` = `".$resource[$Element]."` - '".$destroy."' WHERE id = ".$TargetInfo['id'].";";
			
				if($this->_fleet['fleet_end_type'] == 3 && $Element == 502)
				$SQL .= "UPDATE ".PLANETS." SET `".$resource[$Element]."` = `".$resource[$Element]."` - '".$destroy."' WHERE id_luna = ".$TargetInfo['id'].";"; 
				elseif(in_array($Element, $reslist['one']))
				$SQL .= "UPDATE ".PLANETS." SET `".$resource[$Element]."` = '0' WHERE id = ".$TargetInfo['id'].";";
				else
				$SQL .= "UPDATE ".PLANETS." SET `".$resource[$Element]."` = `".$resource[$Element]."` - '".$destroy."' WHERE id = ".$TargetInfo['id'].";";
			}
		}
				
		$UserPlanet 		= $db->uniquequery("SELECT name FROM ".PLANETS." WHERE id = '" . $this->_fleet['fleet_owner'] . "';");
		$OwnerLink			= $UserPlanet['name']."[".$this->_fleet['fleet_start_galaxy'].":".$this->_fleet['fleet_start_system'].":".$this->_fleet['fleet_start_planet']."]";
		$TargetLink 		= $TargetInfo['name']."[".$this->_fleet['fleet_end_galaxy'].":".$this->_fleet['fleet_end_system'].":".$this->_fleet['fleet_end_planet']."]";;
		$Message			= sprintf($LNG['sys_irak_mess'], $this->_fleet['fleet_amount'], $OwnerLink, $TargetLink).(empty($message) ? $LNG['sys_irak_no_def'] : $message);
	
		SendSimpleMessage($this->_fleet['fleet_owner'], 0, $this->_fleet['fleet_start_time'], 3, $LNG['sys_mess_tower'], $LNG['sys_irak_subject'] , $Message);
		SendSimpleMessage($this->_fleet['fleet_target_owner'], 0, $this->_fleet['fleet_start_time'], 3, $LNG['sys_mess_tower'], $LNG['sys_irak_subject'] , $Message);
		$SQL				.= "DELETE FROM ".FLEETS." WHERE fleet_id = '" . $this->_fleet['fleet_id'] . "';";
		$db->multi_query($SQL);
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{
		return;
	}
}

?>