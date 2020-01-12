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

function ShowImperiumPage()
{
	global $LNG, $USER, $PLANET, $resource, $reslist, $db;
	
	if($USER['commander'] <= 0 ) 
      die(message("No tienes permisos","game.php?page=oficiales"));  

	$PlanetRess = new ResourceUpdate();
	list($USER['factor'], $CPLANET['factor'])    = getFactors($USER, $CPLANET);
	$PlanetRess->CalcResource();
	$PlanetRess->SavePlanetToDB();
	
	$template	= new template();
	$template->loadscript("trader.js");
	
	$SQLArray 	= array_merge($reslist['build'], $reslist['fleet'], $reslist['defense']);
	$Query		= "";
	
	foreach($SQLArray as $id => $gid){
		$Query .= ",`".$resource[$gid]."`";
	}
		
	if($USER['planet_sort'] == 0)
		$Order	= "`id` ";
	elseif($USER['planet_sort'] == 1)
		$Order	= "`galaxy`, `system`, `planet`, `planet_type` ";
	elseif ($USER['planet_sort'] == 2)
		$Order	= "`name` ";	
	
	$Order .= ($USER['planet_sort_order'] == 1) ? "DESC" : "ASC" ;

	$PlanetsRAW = $db->query("
	SELECT `id`,`name`,`galaxy`,`system`,`planet`,`planet_type`, `image`,`field_current`,`field_max`,`metal`,`crystal`,`deuterium`, `norio`, `energy_used`,`energy_max` ".$Query." FROM ".PLANETS." WHERE `id_owner` = '" . $USER['id'] . "' AND `destruyed` = '0' ORDER BY ".$Order.";");

	while ($Planet = $db->fetch_array($PlanetsRAW))
	{
		$InfoList	= array(
			'id'			=> $Planet['id'],
			'name'			=> $Planet['name'],
			'image'			=> $Planet['image'],
			'galaxy'		=> $Planet['galaxy'],
			'system'		=> $Planet['system'],
			'planet'		=> $Planet['planet'],
			'field_current'	=> $Planet['field_current'],
			'field_max'		=> CalculateMaxPlanetFields($Planet),
			'metal'			=> pretty_number($Planet['metal']),
			'crystal'		=> pretty_number($Planet['crystal']),
			'deuterium'		=> pretty_number($Planet['deuterium']),
			'norio'		    => pretty_number($Planet['norio']),
			'energy_used'	=> pretty_number($Planet['energy_max'] + $Planet['energy_used']),
			'energy_max'	=> pretty_number($Planet['energy_max']),

		);
						
		foreach($reslist['build'] as $gid){
			$BuildsList[$gid] = pretty_number($Planet[$resource[$gid]]);
		}
		
		foreach($reslist['fleet'] as $gid){
			$FleetsList[$gid] = pretty_number($Planet[$resource[$gid]]);
		}
		
		foreach($reslist['defense'] as $gid){
			$DefensesList[$gid] = pretty_number($Planet[$resource[$gid]]);
		}

		$PlanetsList[]	= array(
			'InfoList'		=> $InfoList,
			'BuildsList'	=> $BuildsList,
			'FleetsList'	=> $FleetsList,
			'DefensesList'	=> $DefensesList,
		);
	}

	foreach($reslist['tech'] as $gid){
		$ResearchList[$gid] = pretty_number($USER[$resource[$gid]]);
	}
	$template->assign_vars(array(
		'colspan'			=> count($PlanetsList) + 1,
		'PlanetsList'		=> $PlanetsList,
		'ResearchList'		=> $ResearchList,
		'iv_imperium_title'	=> $LNG['iv_imperium_title'],
		'iv_planet'			=> $LNG['iv_planet'],
		'iv_name'			=> $LNG['iv_name'],
		'iv_coords'			=> $LNG['iv_coords'],
		'iv_fields'			=> $LNG['iv_fields'],
		'iv_resources'		=> $LNG['iv_resources'],
		'Metal'				=> $LNG['Metal'],
		'Crystal'			=> $LNG['Crystal'],
		'Deuterium'			=> $LNG['Deuterium'],
		'Norio'			    => $LNG['Norio'],		
		'Energy'			=> $LNG['Energy'],
		'iv_buildings'		=> $LNG['iv_buildings'],
		'iv_technology'		=> $LNG['iv_technology'],
		'iv_ships'			=> $LNG['iv_ships'],
		'iv_defenses'		=> $LNG['iv_defenses'],
		'tech'				=> $LNG['tech'],
		'build'				=> $reslist['build'], 
		'fleet'				=> $reslist['fleet'], 
		'defense'			=> $reslist['defense'],
		'research'			=> $reslist['tech'],
	));
	
	$template->show("imperio/empire_overview.tpl");
}
?>