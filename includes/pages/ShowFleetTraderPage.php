<?php
/**
 _  \_/ |\ | /¯¯\ \  / /\    |¯¯) |_¯ \  / /¯¯\ |  |   |´¯|¯` | /¯¯\ |\ |6
 ¯  /¯\ | \| \__/  \/ /--\   |¯¯\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core Redesigned.
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


function ShowFleetTraderPage()
{
	global $USER, $PLANET, $LNG, $CONF, $pricelist, $resource, $reslist, $db;
	$PlanetRess = new ResourceUpdate();
	$PlanetRess->CalcResource();
	$CONF['trade_allowed_ships']	= explode(',', $CONF['trade_allowed_ships']);
	$ID								= request_var('id', 0);
	
	if(!empty($ID) && in_array($ID, $CONF['trade_allowed_ships'])) {
		$Count						= min(request_outofint('count'), $PLANET[$resource[$ID]]);
		$metal_total 				=  $Count * $pricelist[$ID]['metal'] * (1 - ($CONF['trade_charge'] / 100));
		$PLANET['metal']   += $metal_total;
		$crystal_total 				=  $Count * $pricelist[$ID]['crystal'] * (1 - ($CONF['trade_charge'] / 100));
		$PLANET['crystal']			+= $crystal_total;
		$deuterium_total 			=  $Count * $pricelist[$ID]['deuterium'] * (1 - ($CONF['trade_charge'] / 100));
		$PLANET['deuterium']		+= $deuterium_total ;
		$norio_total		    	+= $Count * $pricelist[$ID]['norio'] * (1 - ($CONF['trade_charge'] / 100));	
		$PLANET['norio']		    += $norio_total;
		$darkmatter_total 			+= $Count * $pricelist[$ID]['darkmatter'] * (1 - ($CONF['trade_charge'] / 100));
		$USER['darkmatter']			+= $darkmatter_total;				
		$PLANET[$resource[$ID]]		-= $Count;
		$PlanetRess->Builded[$ID]	-= $Count;
	}
	//if ($Count > 0) {
		//$SQL = "INSERT INTO uni1_fleettrades SET ";
		//$SQL .= "`trader_id` = '".$USER[id] . "', ";
		//$SQL .= "`planet_id` = '".$PLANET[id] . "', ";
		//$SQL .= "`fleettrade_date` = '".TIMESTAMP."', ";
		//$SQL .= "`ship_id` = '".$ID."', ";
		//$SQL .= "`ship_ammount` = '".$Count."', ";
		//$SQL .= "`metal_total` = '".$metal_total."', ";
		//$SQL .= "`crystal_total` = '".$crystal_total."', ";
		//$SQL .= "`deuterium_total` = '".$deuterium_total."', ";
		//$SQL .= "`norio_total` = '".$norio_total."',";
		//$SQL .= "`darkmatter_total` = '".$darkmatter_total."'";
		//$db->query($SQL);
		$PlanetRess->SavePlanetToDB(); 
	//}

	$template	= new template();
	$template->loadscript('fleettrader.js');
	$template->execscript('updateVars();');
	$Cost	= array();
	foreach($CONF['trade_allowed_ships'] as $ID)
	{
		if(in_array($ID, $reslist['fleet']))
			$Cost[$ID]	= array($PLANET[$resource[$ID]], $pricelist[$ID]['metal'], $pricelist[$ID]['crystal'], $pricelist[$ID]['deuterium'], $pricelist[$ID]['darkmatter'], $pricelist[$ID]['norio']);
	}
	
	if(empty($Cost)) {
		$template->message($LNG['ft_empty']);
		exit;
	}
	$template->assign_vars(array(	
		'ft_selecciona'				=> $LNG['ft_selecciona'],
		'ft_uniselec'				=> $LNG['ft_uniselec'],
		'tech'						=> $LNG['tech'],
		'ft_unidad'					=> $LNG['ft_unidad'],
		'ft_max'					=> $LNG['ft_max'],
		'ft_total'					=> $LNG['ft_total'],
		'ft_coste'					=> $LNG['ft_coste'],		
		'ft_cantidad'				=> $LNG['ft_cantidad'],
		'ft_absenden'				=> $LNG['ft_absenden'],
		'ft_cau'					=> $LNG['ft_cau'],
		'ft_cau_2'					=> $LNG['ft_cau_2'],
		'trade_allowed_ships'		=> $CONF['trade_allowed_ships'],
		'CostInfos'					=> json_encode($Cost),
		'Charge'					=> $CONF['trade_charge'],
		'ft_charge'					=> $LNG['ft_charge'],
	));
	
	$template->show("fleettrader_overview.tpl");
}
?>