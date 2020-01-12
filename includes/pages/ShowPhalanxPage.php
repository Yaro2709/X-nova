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
function ShowPhalanxPage()
{
	global $USER, $PLANET, $LNG, $db, $UNI;

	include_once(ROOT_PATH.'includes/classes/class.FlyingFleetsTable.php');
	include_once(ROOT_PATH.'includes/classes/class.GalaxyRows.php');

	$FlyingFleetsTable 	= new FlyingFleetsTable();
	$GalaxyRows 		= new GalaxyRows();

	$template			= new template();
	$template->isPopup(true);
	$template->loadscript('phalanx.js');
	$template->execscript('FleetTime();window.setInterval("FleetTime()", 1000);');
	
	$PhRange 		 	= $GalaxyRows->GetPhalanxRange($PLANET['phalanx']);
	$Galaxy 			= request_var('galaxy', 0);
	$System 			= request_var('system', 0);
	$Planet  			= request_var('planet', 0);
	
	if($Galaxy != $PLANET['galaxy'] || $System > ($PLANET['system'] + $PhRange) || $System < max(1, $PLANET['system'] - $PhRange))
	{
		$template->message($LNG['px_out_of_range'], false, 0, true);
		exit;	
	}
	
	if ($PLANET['deuterium'] < 5000)
	{
		$template->message($LNG['px_no_deuterium'], false, 0, true);
		exit;
	}

	$PLANET['deuterium'] -= 5000;
	$db->query("UPDATE ".PLANETS." SET `deuterium` = `deuterium` - '5000' WHERE `id` = '".$PLANET['id']."';");
	$TargetInfo = $db->uniquequery("SELECT id, name, id_owner FROM ".PLANETS." WHERE`universe` = '".$UNI."' AND `galaxy` = '".$Galaxy."' AND `system` = '".$System."' AND `planet` = '".$Planet."' AND `planet_type` = '1';");
	if(empty($TargetInfo))
	{
		$template->message($LNG['px_out_of_range'], false, 0, true);
		exit;	
	}
	
	# FIX PHALANX 5.7
	$ExcludeMissions	= "";
	if(INV_PHALANX_MISSIONS != "")
		$ExcludeMissions	= " AND fleet_mission NOT IN(".INV_PHALANX_MISSIONS.")";

	$FleetToTarget  = $db->query("SELECT * FROM ".FLEETS." WHERE `fleet_end_type` = '1' AND `fleet_start_id` = '".$TargetInfo['id']."' OR `fleet_end_id` = '".$TargetInfo['id']."' ORDER BY `fleet_start_time`;");
	
	$fpage		= array();
	$FleetData	= array();
	$_SESSION['USER']['spy_tech']	= 8;
	while ($FleetRow = $db->fetch_array($FleetToTarget))
	{
		$Record++;
	
		$IsOwner	= ($FleetRow['fleet_owner'] == $TargetInfo['id_owner']) ? true : false;

		$FleetRow['fleet_resource_metal']     	= 0;
		$FleetRow['fleet_resource_crystal']   	= 0;
		$FleetRow['fleet_resource_deuterium'] 	= 0;
		$FleetRow['fleet_resource_norio'] 	    = 0;
		$FleetRow['fleet_resource_darkmatter'] 	= 0;

		if ($FleetRow['fleet_mess'] == 0 && $FleetRow['fleet_start_time'] > TIMESTAMP) {
			$fpage[$FleetRow['fleet_start_time'].$FleetRow['fleet_id']]	= $FlyingFleetsTable->BuildFleetEventTable($FleetRow, 0, $IsOwner, 'fs', $Record);
			$FleetData[$FleetRow['fleet_start_time'].$FleetRow['fleet_id']]	= $fpage[$FleetRow['fleet_start_time'].$FleetRow['fleet_id']]['fleet_return'];	
		}
		if ($FleetRow['fleet_mission'] == 4)
			continue;
			
		if ($FleetRow['fleet_mess'] != 1 && $FleetRow['fleet_end_stay'] > TIMESTAMP) {
			$fpage[$FleetRow['fleet_end_stay'].$FleetRow['fleet_id']]	= $FlyingFleetsTable->BuildFleetEventTable($FleetRow, 2, $IsOwner, 'ft', $Record);
			$FleetData[$FleetRow['fleet_end_stay'].$FleetRow['fleet_id']]	= $fpage[$FleetRow['fleet_end_stay'].$FleetRow['fleet_id']]['fleet_return'];	
		}

		if ($IsOwner == false)
			continue;
		
		if ($FleetRow['fleet_end_time'] > TIMESTAMP) {
			$fpage[$FleetRow['fleet_end_time'].$FleetRow['fleet_id']]	= $FlyingFleetsTable->BuildFleetEventTable($FleetRow, 1, $IsOwner, 'fe', $Record);
			$FleetData[$FleetRow['fleet_end_time'].$FleetRow['fleet_id']]	= $fpage[$FleetRow['fleet_end_time'].$FleetRow['fleet_id']]['fleet_return'];	
		}
	}
	$_SESSION['USER']['spy_tech']	= $USER['spy_tech'];
	
	$db->free_result($FleetToTarget);
	
	foreach($FleetData as $key => $Val) {
		if(empty($FleetData[$key]['fleet_descr'])) {
			unset($FleetData[$key]);
			unset($fpage[$key]);
		}
	}
	
	if(!empty($fpage))
		ksort($fpage);

	$template->assign_vars(array(
		'phl_pl_galaxy'  	=> $Galaxy,
		'phl_pl_system'  	=> $System,
		'phl_pl_place'   	=> $Planet,
		'phl_pl_name'    	=> $TargetInfo['name'],
		'fleets'		 	=> $fpage,
		'FleetData'		 	=> json_encode($FleetData),
		'px_scan_position'	=> $LNG['px_scan_position'],
		'px_no_fleet'		=> $LNG['px_no_fleet'],
		'px_fleet_movement'	=> $LNG['px_fleet_movement'],
	));
	
	$template->show('phalax_body.tpl');			
}
?>