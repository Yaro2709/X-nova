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

 class GalaxyRows
{
	
	public function allowMissiles($GalaxyRowPlanet)
	{
	global $USER, $PLANET, $resource;
		if ($PLANET[$resource[503]] == 0 || $GalaxyRowPlanet['galaxy'] != $PLANET['galaxy'] || $PLANET['planet_type'] != 1 || CheckModule(40))
		return false;
	
	$Range = $this->GetMissileRange($USER[$resource[117]]);
	$SystemLimitMin = max($PLANET['system'] - $Range, 1);
	$SystemLimitMax = $PLANET['system'] + $Range;
	return $GalaxyRowPlanet['system'] <= $SystemLimitMax && $GalaxyRowPlanet['system'] >= $SystemLimitMin ? true : false;
	}
	
	public function allowPhalanx($GalaxyRowPlanet)
    {
     global $USER, $PLANET, $resource;
           
     $PhRange                  = $this->GetPhalanxRange($PLANET[$resource[42]]);
     $SystemLimitMin  = max(1, $PLANET['system'] - $PhRange);
     $SystemLimitMax  = $PLANET['system'] + $PhRange;
     return $GalaxyRowPlanet['system'] <= $SystemLimitMax && $GalaxyRowPlanet['system'] >= $SystemLimitMin;
    }
	
	public function GetMissileRange($Level)
	{
		return max(($Level * 5) - 1, 0);
	}

	public function GetPhalanxRange($PhalanxLevel)
	{
		return ($PhalanxLevel == 1) ? 1 : pow($PhalanxLevel, 2) - 1;
	}

	public function GalaxyRowActions($GalaxyRowPlanet)
	{
		global $USER, $PLANET, $resource, $LNG;

		$MissileBtn = $this->allowMissiles($GalaxyRowPlanet);

		$Result = array(
			'esp'		=> (!CheckModule(24) && $USER["settings_esp"] == 1) ? true : false,
			'message'	=> (!CheckModule(16) && $USER["settings_wri"] == 1) ? true : false,
			'buddy'		=> (!CheckModule(6) && $USER["settings_bud"] == 1) ? true : false,
			'missle'	=> ($USER["settings_mis"] == 1 && $MissileBtn == true) ? true : false,
		);

		return $Result;
	}

	public function GalaxyRowAlly($GalaxyRowPlanet)
	{
		global $USER, $LNG, $db;

		$Result = array(
			'id'		=> $GalaxyRowPlanet['allyid'],
			'name'		=> htmlspecialchars($GalaxyRowPlanet['ally_name'],ENT_QUOTES,"UTF-8"),
			'member'	=> sprintf(($GalaxyRowPlanet['ally_members'] == 1)?$LNG['gl_member_add']:$LNG['gl_member'], $GalaxyRowPlanet['ally_members']),
			'web'		=> $GalaxyRowPlanet['ally_web'],
			'inally'	=> ($USER['ally_id'] == $GalaxyRowPlanet['ally_id'])?2:(($USER['ally_id'] == $GalaxyRowPlanet['allyid'])?1:0),
			'tag'		=> $GalaxyRowPlanet['ally_tag'],
			'rank'		=> $GalaxyRowPlanet['ally_rank'],
		);
		
		return $Result;
	}

	public function GalaxyRowDebris($GalaxyRowPlanet)
	{
		global $USER, $PLANET, $LNG, $pricelist, $resource;

		$GRecNeeded = min(ceil(($GalaxyRowPlanet['der_metal'] + $GalaxyRowPlanet['der_crystal']) / $pricelist[219]['capacity']), $PLANET[$resource[219]]);
		$RecNeeded 	= min(ceil(max($GalaxyRowPlanet['der_metal'] + $GalaxyRowPlanet['der_crystal'] - ($GRecNeeded * $pricelist[219]['capacity']), 0) / $pricelist[209]['capacity']), $PLANET[$resource[209]]);

		$Result = array(
			'metal'			=> pretty_number($GalaxyRowPlanet["der_metal"]),
			'crystal'		=> pretty_number($GalaxyRowPlanet["der_crystal"]),
			'RecSended'		=> $RecNeeded,			
			'GRecSended'	=> $GRecNeeded,			
			'recycle'		=> (!CheckModule(32)) ? $LNG['type_mission'][8]:false,
		);

		return $Result;
	}

	public function GalaxyRowMoon($GalaxyRowMoon)
	{
		global $USER, $PLANET, $LNG, $resource;

		$Result = array(
			'name'		=> htmlspecialchars($GalaxyRowMoon['name'], ENT_QUOTES, "UTF-8"),
			'temp_min'	=> number_format($GalaxyRowMoon['temp_min'], 0, '', '.'), 
			'diameter'	=> number_format($GalaxyRowMoon['diameter'], 0, '', '.'),
			'attack'	=> (!CheckModule(1) && $GalaxyRowMoon['id_owner'] != $USER['id']) ? $LNG['type_mission'][1]:false,
			'transport'	=> (!CheckModule(34)) ? $LNG['type_mission'][3]:false,
			'stay'		=> (!CheckModule(36) && $GalaxyRowMoon['id_owner'] == $USER['id'] or  $GalaxyRowMoon['id_owner'] != $USER['id']) ? $LNG['type_mission'][4]:false,
			'stayally'	=> (!CheckModule(33) && $GalaxyRowMoon['id_owner'] != $USER['id']) ? $LNG['type_mission'][5]:false,
			'spionage'	=> (!CheckModule(24) && $GalaxyRowMoon['id_owner'] != $USER['id']) ? $LNG['type_mission'][6]:false,
			'destroy'	=> (!CheckModule(29) && $GalaxyRowMoon['id_owner'] != $USER['id'] && $PLANET[$resource[214]] > 0) ? $LNG['type_mission'][9]:false,
		);

		return $Result;
	}

	/* public function GalaxyRowPlanet($GalaxyRowPlanet)
	{
		global $resource, $USER, $PLANET, $CONF, $LNG;
		
		if($PLANET[$resource[42]] > 0 && $GalaxyRowPlanet['userid'] != $USER['id'] && $GalaxyRowPlanet["galaxy"] == $PLANET['galaxy'] && !CheckModule(19))
		{
			$PhRange 		 = $this->GetPhalanxRange($PLANET[$resource[42]]);
			$SystemLimitMin  = max(1, $PLANET['system'] - $PhRange);
			$SystemLimitMax  = $PLANET['system'] + $PhRange;
			$PhalanxTypeLink = ($GalaxyRowPlanet['system'] <= $SystemLimitMax && $GalaxyRowPlanet['system'] >= $SystemLimitMin) ? $LNG['gl_phalanx']:false;
		} else {
			$PhalanxTypeLink = false;
		}

		if ($PLANET[$resource[503]] > 0 && $GalaxyRowPlanet['userid'] != $USER['id'] && $GalaxyRowPlanet["galaxy"] == $PLANET['galaxy'])
		{
			$MiRange 		= $this->GetMissileRange($USER[$resource[117]]);
			$SystemLimitMin = max(1, $PLANET['system'] - $MiRange);
			$SystemLimitMax = $PLANET['system'] + $MiRange;
			$MissileBtn 	= ($GalaxyRowPlanet['system'] <= $SystemLimitMax && $GalaxyRowPlanet['system'] >= $SystemLimitMin) ? true : false;
		} else {
			$MissileBtn 	= false;
		}
		
		if ($GalaxyRowPlanet['id']) {
		$imagen	= "planeta";
		} else {
		$imagen	= "planeta_o";
		}
		
		$Result = array(
			'id'			=> $GalaxyRowPlanet['id'],
			'name'			=> htmlspecialchars($GalaxyRowPlanet['name'],ENT_QUOTES,"UTF-8"),
			'phalax'		=> $PhalanxTypeLink,
			'image'			=> $GalaxyRowPlanet['image'],
			'imagen'		=> $imagen,
			'transport'		=> (!CheckModule(34)) ? $LNG['type_mission'][3]:false,
			'spionage'		=> (!CheckModule(24) && $GalaxyRowPlanet['userid'] != $USER['id']) ? $LNG['type_mission'][6]:false,
			'attack'		=> (!CheckModule(1) && $GalaxyRowPlanet['userid'] != $USER['id']) ? $LNG['type_mission'][1]:false,
			'missile'		=> (!CheckModule(40) && $USER["settings_mis"] == "1" && $MissileBtn === true && $GalaxyRowPlanet['userid'] != $USER['id']) ? $LNG['gl_missile_attack']:false,
			'stay'			=> (!CheckModule(36) && $GalaxyRowPlanet['userid'] == $USER['id'] or $GalaxyRowPlanet['userid'] != $USER['id']) ? $LNG['type_mission'][4]:false,
			'stayally'		=> (!CheckModule(33) && $GalaxyRowPlanet['userid'] != $USER['id']) ? $LNG['type_mission'][5]:false,
		);
		return $Result;
	} */
	
	public function GalaxyRowPlanet($GalaxyRowPlanet, $IsOwn)
        {
                global $resource, $USER, $PLANET, $CONF, $LNG;
                
                if(!$IsOwn && $GalaxyRowPlanet['galaxy'] == $PLANET['galaxy'])
                {       
                        $PhalanxTypeLink        = $this->allowPhalanx($GalaxyRowPlanet);
                        $MissileBtn             = $this->allowMissiles($GalaxyRowPlanet);
                } else {
                        $PhalanxTypeLink        = false;
                        $MissileBtn                     = false;
                }
                $Result = array(
                        'id'                    => $GalaxyRowPlanet['id'],
                        'name'                  => htmlspecialchars($GalaxyRowPlanet['name'],ENT_QUOTES,"UTF-8"),
                        'image'                 => $GalaxyRowPlanet['image'],
                        'phalax'                => !$PhalanxTypeLink ? false : $LNG['gl_phalanx'],
                        'missile'               => !$MissileBtn ? false : $LNG['gl_missile_attack'],
                        'transport'             => ($IsOwn || CheckModule(34)) ? false : $LNG['type_mission'][3],
                        'spionage'              => ($IsOwn || CheckModule(24)) ? false : $LNG['type_mission'][6],
                        'attack'                => ($IsOwn || CheckModule(1)) ? false : $LNG['type_mission'][1],
                        'stay'                  => (!$IsOwn || CheckModule(36) && $IsOwn) ? false : $LNG['type_mission'][4],
                        'stayally'              => ($IsOwn || CheckModule(33)) ? false : $LNG['type_mission'][5],
                );
                return $Result;
        }


	public function GalaxyRowPlanetName($GalaxyRowPlanet)
	{
		global $USER, $LNG;

		$Onlinetime			= floor((TIMESTAMP - $GalaxyRowPlanet['last_update']) / 60);
		
		if ($Onlinetime < 4)
			$Activity	= $LNG['gl_activity'];
		elseif($Onlinetime < 15)
			$Activity	= sprintf($LNG['gl_activity_inactive'], $Onlinetime);	
		else		
			$Activity	= '';
				
		$Result = array(
			'name'			=> htmlspecialchars($GalaxyRowPlanet['name'],ENT_QUOTES,"UTF-8"),
			'activity'		=> $Activity,
		);
		
		return $Result;
	}

	public function GalaxyRowUser($GalaxyRowPlanet)
	{
		global $CONF, $USER, $LNG, $db;

		$protection      	= $CONF['noobprotection'];
		$protectiontime  	= $CONF['noobprotectiontime'];
		$protectionmulti 	= $CONF['noobprotectionmulti'];
		$CurrentPoints 		= $USER['total_points'];
		$RowUserPoints 		= $GalaxyRowPlanet['total_points'];
		$IsNoobProtec		= CheckNoobProtec($USER, $GalaxyRowPlanet, $GalaxyRowPlanet);
		
		if ($GalaxyRowPlanet['banaday'] > TIMESTAMP && $GalaxyRowPlanet['urlaubs_modus'] == 1)
		{
			$Systemtatus2 	= $LNG['gl_v']." <a href=\"game.php?page=banned\"><span class=\"banned\">".$LNG['gl_b']."</span></a>";
			$Systemtatus 	= "<span class=\"vacation\">";
		}
		elseif ($GalaxyRowPlanet['banaday'] > TIMESTAMP)
		{
			$Systemtatus2 	= "<span class=\"banned\">".$LNG['gl_b']."</span>";
			$Systemtatus 	= "";
		}
		elseif ($GalaxyRowPlanet['urlaubs_modus'] == 1)
		{
			$Systemtatus2 	= "<span class=\"vacation\">".$LNG['gl_v']."</span>";
			$Systemtatus 	= "<span class=\"vacation\">";
		}
		elseif ($GalaxyRowPlanet['onlinetime'] < (TIMESTAMP-60 * 60 * 24 * 7) && $GalaxyRowPlanet['onlinetime'] > (TIMESTAMP-60 * 60 * 24 * 28))
		{
			$Systemtatus2 	= "<span class=\"inactive\">".$LNG['gl_i']."</span>";
			$Systemtatus 	= "<span class=\"inactive\">";
		}
		elseif ($GalaxyRowPlanet['onlinetime'] < (TIMESTAMP-60 * 60 * 24 * 28))
		{
			$Systemtatus2 	= "<span class=\"inactive\">".$LNG['gl_i']."</span><span class=\"longinactive\">".$LNG['gl_I']."</span>";
			$Systemtatus 	= "<span class=\"longinactive\">";
		}
		elseif ($IsNoobProtec['NoobPlayer'])
		{
			$Systemtatus2 	= "<span class=\"noob\">".$LNG['gl_w']."</span>";
			$Systemtatus 	= "<span class=\"noob\">";
		}
		elseif ($IsNoobProtec['StrongPlayer'])
		{
			$Systemtatus2 	= $LNG['gl_s'];
			$Systemtatus 	= "<span class=\"strong\">";
		}
		else
		{
			$Systemtatus2 	= "";
			$Systemtatus 	= "";
		}

		if (!empty($Systemtatus2))
		{
			$Systemtatus2 	= "<span style=\"color:white\">(</span>".$Systemtatus2."<span style=\"color:white\">)</span>";
		}

		$Result	= array(
			'id'			=> $GalaxyRowPlanet['userid'],
			'username'		=> htmlspecialchars($GalaxyRowPlanet['username'],ENT_QUOTES,"UTF-8"),
			'rank'			=> $GalaxyRowPlanet['total_rank'],
			'points'		=> pretty_number($GalaxyRowPlanet['total_points']),
			'playerrank'	=> sprintf($LNG['gl_in_the_rank'], htmlspecialchars($GalaxyRowPlanet['username'],ENT_QUOTES,"UTF-8"), $GalaxyRowPlanet['total_rank']),
			'Systemtatus'	=> $Systemtatus,
			'Systemtatus2'	=> $Systemtatus2,
			'isown'			=> ($GalaxyRowPlanet['userid'] != $USER['id']) ? true : false,
		);
		return $Result;
	}
}
?>