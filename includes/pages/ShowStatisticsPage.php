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

function ShowStatisticsPage()
{
	global $USER, $PLANET, $CONF, $dpath, $LNG, $db, $UNI;
	
	$PlanetRess = new ResourceUpdate();
	$PlanetRess->CalcResource();
	$PlanetRess->SavePlanetToDB();
	
	$template	= new template();
	$who   	= request_var('who', 1);
	$type  	= request_var('type', 1);
	$range 	= request_var('range', 1);
	
	switch ($type)
	{
		case 2:
			$Order   = "fleet_rank";
			$Points  = "fleet_points";
			$Counts  = "fleet_count";
			$Rank    = "fleet_rank";
			$OldRank = "fleet_old_rank";
		break;
		case 3:
			$Order   = "tech_rank";
			$Points  = "tech_points";
			$Counts  = "tech_count";
			$Rank    = "tech_rank";
			$OldRank = "tech_old_rank";
		break;
		case 4:
			$Order   = "build_rank";
			$Points  = "build_points";
			$Counts  = "build_count";
			$Rank    = "build_rank";
			$OldRank = "build_old_rank";
		break;
		case 5:
			$Order   = "defs_rank";
			$Points  = "defs_points";
			$Counts  = "defs_count";
			$Rank    = "defs_rank";
			$OldRank = "defs_old_rank";
		break;
		default:
			$Order   = "total_rank";
			$Points  = "total_points";
			$Counts  = "total_count";
			$Rank    = "total_rank";
			$OldRank = "total_old_rank";
		break;
	}
	
	switch($who)
	{
		case 1:
			$MaxUsers 	= $CONF['users_amount'];
			$range		= min($range, $MaxUsers);			
			$LastPage 	= ceil($MaxUsers / 100);
			
			for ($Page = 0; $Page < $LastPage; $Page++)
			{
				$PageValue      				= ($Page * 100) + 1;
				$PageRange      				= $PageValue + 99;
				$Selector['range'][$PageValue] 	= $PageValue."-".$PageRange;
			}

			$start = max(floor(($range - 1) / 100) * 100, 0);

			$stats_sql	=	'SELECT DISTINCT s.*, u.id, u.username, u.ally_id, u.ally_name, u.raza FROM '.STATPOINTS.' as s
			INNER JOIN '.USERS.' as u ON u.id = s.id_owner
			WHERE s.`universe` = '.$UNI.' AND s.`stat_type` = 1 '.(($CONF['stat'] == 2)?'AND u.`authlevel` < '.$CONF['stat_level'].' ':'').'
			ORDER BY `'. $Order .'` ASC LIMIT '. $start .',100;';

			$query = $db->query($stats_sql);
			
			while ($StatRow = $db->fetch_array($query))
			{			
				$RangeList[]	= array(
					'id'		=> $StatRow['id'],
					'name'		=> $StatRow['username'],
					'points'	=> pretty_number($StatRow[$Points]),
					'allyid'	=> $StatRow['ally_id'],
					'rank'		=> $StatRow[$Rank],
					'allyname'	=> $StatRow['ally_name'],
					'ranking'	=> $StatRow[$OldRank] - $StatRow[$Rank],
					'raza'	=> $StatRow['raza'],
				);
			}
			
			$db->free_result($query);
		break;
		case 2:
			$MaxAllys 	= $db->countquery("SELECT COUNT(*) FROM ".ALLIANCE." WHERE `ally_universe` = '".$UNI."';");
			$range		= min($range, $MaxAllys);
			$LastPage 	= ceil($MaxAllys / 100);
			for ($Page = 0; $Page < $LastPage; $Page++)
			{
				$PageValue      				= ($Page * 100) + 1;
				$PageRange      				= $PageValue + 99;
				$Selector['range'][$PageValue] 	= $PageValue."-".$PageRange;
			}

			$start = max(floor(($range - 1) / 100) * 100, 0);

			$stats_sql	=	'SELECT DISTINCT s.*, a.id, a.ally_members, a.ally_image, a.ally_name FROM '.STATPOINTS.' as s
			INNER JOIN '.ALLIANCE.' as a ON a.id = s.id_owner
			WHERE `universe` = '.$UNI.' AND `stat_type` = 2
			ORDER BY `'. $Order .'` ASC LIMIT '. $start .',100;';

			$query = $db->query($stats_sql);

			while ($StatRow = $db->fetch_array($query))
			{
				$RangeList[]	= array(
					'id'		=> $StatRow['id'],
					'name'		=> $StatRow['ally_name'],
					'imagen'	=> $StatRow['ally_image'],
					'members'	=> $StatRow['ally_members'],
					'rank'		=> $StatRow[$Rank],
					'mppoints'	=> pretty_number(floor($StatRow[$Points] / $StatRow['ally_members'])),
					'points'	=> pretty_number($StatRow[$Points]),
					'ranking'	=> $StatRow[$OldRank] - $StatRow[$Rank],
				);
			}
			
			$db->free_result($query);
		break;
	}
	
	$Selector['who'] 	= array(1 => $LNG['st_player'], 2 => $LNG['st_alliance']);
	$Selector['type']	= array(1 => $LNG['st_points'], 2 => $LNG['st_fleets'], 3 => $LNG['st_researh'], 4 => $LNG['st_buildings'], 5 => $LNG['st_defenses']);
	$template->assign_vars(array(	
		'Selectors'				=> $Selector,
		'who'					=> $who,
		'type'					=> $type,
		'range'					=> floor(($range - 1) / 100) * 100 + 1,
		'RangeList'				=> $RangeList,
		'CUser_ally'			=> $USER['ally_id'],
		'CUser_id'				=> $USER['id'],
		'st_members'			=> $LNG['st_members'],
		'st_per_member'			=> $LNG['st_per_member'],
		'st_position'			=> $LNG['st_position'],
		'st_player'				=> $LNG['st_player'],
		'st_alliance'			=> $LNG['st_alliance'],
		'st_write_message'		=> $LNG['st_write_message'],
		'st_points'				=> $LNG['st_points'],
		'st_per'				=> $LNG['st_per'],
		'st_statistics'			=> $LNG['st_statistics'],
		'st_updated'			=> $LNG['st_updated'],
		'escudo'				=> $LNG['st_escudo'],
		'stat_date'				=> date(TDFORMAT, $CONF['stat_last_update']),
		'st_show'				=> $LNG['st_show'],
		'st_in_the_positions'	=> $LNG['st_in_the_positions'],
		'gultra' => $LNG['Raza_0'],
		'voltra' => $LNG['Raza_1'],
		'raza_dif' => $USER['raza'],
	));
	
	$template->show("estadisticas/stat_overview.tpl");
}
?>