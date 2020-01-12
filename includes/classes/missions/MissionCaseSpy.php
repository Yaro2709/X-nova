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

class MissionCaseSpy extends MissionFunctions
{
		
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		global $db, $LANG;		
		$CurrentUser         = $db->uniquequery("SELECT `lang`, `spy_tech` FROM ".USERS." WHERE `id` = '".$this->_fleet['fleet_owner']."';");
		$LNG			     = $LANG->GetUserLang($CurrentUser['lang'], array('FLEET', 'TECH'));
		$CurrentUserID       = $this->_fleet['fleet_owner'];
		$TargetPlanet        = $db->uniquequery("SELECT * FROM ".PLANETS." WHERE `id` = ".$this->_fleet['fleet_end_id'].";");
		$TargetUserID        = $TargetPlanet['id_owner'];
		$CurrentPlanet       = $db->uniquequery("SELECT name,system,galaxy,planet FROM ".PLANETS." WHERE `galaxy` = '".$this->_fleet['fleet_start_galaxy']."' AND `system` = '".$this->_fleet['fleet_start_system']."' AND `planet` = '".$this->_fleet['fleet_start_planet']."';");
		if ($CurrentUser['technocratic'] >= 1) {
		$CurrentSpyLvl       = max(($CurrentUser['spy_tech']), 1) + 2;
		} else {
		$CurrentSpyLvl       = max(($CurrentUser['spy_tech']), 1);
		}
		$TargetUser          = $db->uniquequery("SELECT * FROM ".USERS." WHERE `id` = '".$TargetUserID."';");
		$TargetSpyLvl        = max(($TargetUser['spy_tech']), 1);
		$fleet               = explode(";", $this->_fleet['fleet_array']);
			
		require_once(ROOT_PATH.'includes/classes/class.PlanetRessUpdate.php');	
		$PlanetRess = new ResourceUpdate();
		list($TargetUser['factor'], $TargetPlanet['factor'])    = getFactors($USER, $CPLANET);
		list($TargetUser, $TargetPlanet)	= $PlanetRess->CalcResource($TargetUser, $TargetPlanet, true, $this->_fleet['fleet_start_time']);
		foreach ($fleet as $a => $b)
		{
			if (empty($b))
				continue;

			$a = explode(",", $b);
			if ($a[0] != 210)
				continue;

			$LS		= $a[1];
			break;
		}


		$Diffence	 = abs($CurrentSpyLvl - $TargetSpyLvl);
		$MinAmount 	 = ($CurrentSpyLvl > $TargetSpyLvl) ? -1 * pow($Diffence, 2) : pow($Diffence, 2);
		$SpyFleet	 = ($LS >= $MinAmount) ? true : false;
		$SpyDef		 = ($LS >= $MinAmount + 1) ? true : false;
		$SpyBuild	 = ($LS >= $MinAmount + 3) ? true : false;
		$SpyTechno	 = ($LS >= $MinAmount + 5) ? true : false;
		
		$MaterialsInfo    	= $this->SpyTarget($TargetPlanet, 0, $LNG['sys_mess_head'], $LNG);
		$GetSB	    		= $MaterialsInfo['String'];
		$Array				= $MaterialsInfo['Array'];
		$Count				= array();
			
		if($SpyFleet){
			$PlanetFleetInfo  = $this->SpyTarget($TargetPlanet, 1, $LNG['sys_spy_fleet'], $LNG);
			$GetSB     		 .= $PlanetFleetInfo['String'];
			$Count['Fleet']	  = $PlanetFleetInfo['Count'];
			$Array			  = $Array + $PlanetFleetInfo['Array'];
		}
		if($SpyDef){
			$PlanetDefenInfo  = $this->SpyTarget($TargetPlanet, 2, $LNG['sys_spy_defenses'], $LNG);
			$GetSB	    	 .= $PlanetDefenInfo['String'];
			$Count['Def']	  = $PlanetDefenInfo['Count'];
			$Array			  = $Array + $PlanetDefenInfo['Array'];
		}
		if($SpyBuild){
			$PlanetBuildInfo  = $this->SpyTarget($TargetPlanet, 3, $LNG['tech'][0], $LNG);
			$GetSB	    	 .= $PlanetBuildInfo['String'];
		}
		if($SpyTechno){
			$TargetTechnInfo  = $this->SpyTarget($TargetUser, 4, $LNG['tech'][100], $LNG);
			$GetSB		  	 .= $TargetTechnInfo['String'];
			$Array			  = $Array + $TargetTechnInfo['Array'];
		}
		
		foreach($Array as $ID => $Amount)
		{
			$string .= "&amp;im[".$ID."]=".$Amount;
		}
			
		if(array_sum($Count) == 0){
			$TargetChances	= 0;
			$SpyerChances	= 1; 
		} else {
			$TargetChances 	= mt_rand(0, min(($LS/4) * ($TargetSpyLvl / $CurrentSpyLvl), 100));
			$SpyerChances  	= mt_rand(0, 100);
		}
		
		$DestProba = $TargetChances >= $SpyerChances ? $LNG['sys_mess_spy_destroyed'] : sprintf( $LNG['sys_mess_spy_lostproba'], $TargetChances);

		$AttackLink  = "<center>";
		$AttackLink .= "<a href=\"game.php?page=fleet&amp;galaxy=". $this->_fleet['fleet_end_galaxy'] ."&amp;system=". $this->_fleet['fleet_end_system'] ."";
		$AttackLink .= "&amp;planet=".$this->_fleet['fleet_end_planet']."&amp;planettype=".$this->_fleet['fleet_end_type']."";
		$AttackLink .= "&amp;target_mission=1";
		$AttackLink .= " \">". $LNG['type_mission'][1];
		$AttackLink .= "</a></center>";
		$MessageEnd  = "<center>".$DestProba."<br>".((ENABLE_SIMULATOR_LINK == true && !CheckModule(39)) ? "<a href=\"game.php?page=battlesim".$string."\">".$LNG['fl_simulate']."</a>":"")."</center>";
			
		$SpyMessage = "<br>".$GetSB."<br>".$AttackLink.$MessageEnd;
		SendSimpleMessage($CurrentUserID, 0, $this->_fleet['fleet_start_time'], 0, $LNG['sys_mess_qg'], $LNG['sys_mess_spy_report'], $SpyMessage);
		
		$LNG		    = $LANG->GetUserLang($TargetUser['lang']);
		$TargetMessage  = $LNG['sys_mess_spy_ennemyfleet'] ." ". $CurrentPlanet['name'];

		if($this->_fleet['fleet_start_type'] == 3)
			$TargetMessage .= $LNG['sys_mess_spy_report_moon'].' ';

		$TargetMessage .= "<a href=\"game.php?page=galaxy&mode=3&galaxy=". $CurrentPlanet["galaxy"] ."&system=". $CurrentPlanet["system"] ."\">";
		$TargetMessage .= "[". $CurrentPlanet["galaxy"] .":". $CurrentPlanet["system"] .":". $CurrentPlanet["planet"] ."]</a> ";
		$TargetMessage .= $LNG['sys_mess_spy_seen_at'] ." ". $TargetPlanet['name'];
		$TargetMessage .= " [". $TargetPlanet["galaxy"] .":". $TargetPlanet["system"] .":". $TargetPlanet["planet"] ."] ". $LNG['sys_mess_spy_seen_at2'] .".";

		SendSimpleMessage($TargetUserID, 0, $this->_fleet['fleet_start_time'], 0, $LNG['sys_mess_spy_control'], $LNG['sys_mess_spy_activity'], $TargetMessage);

		if ($TargetChances >= $SpyerChances)
		{
			$Qry  = "UPDATE ".PLANETS." SET ";
			$Qry .= "`der_crystal` = `der_crystal` + '".($LS * 300)."' ";
			$Qry .= "WHERE `galaxy` = '". $TargetPlanet['galaxy'] ."' AND ";
			$Qry .= "`system` = '". $TargetPlanet['system'] ."' AND ";
			$Qry .= "`planet` = '". $TargetPlanet['planet'] ."' AND ";
			$Qry .= "`planet_type` = '1';";
			
			$db->query($Qry);
			$this->KillFleet();
		}
		else
		{
			$this->UpdateFleet('fleet_mess', 1);
			$this->SaveFleet();
		}
	}
	
	function EndStayEvent()
	{
		return;
	}
	
	function ReturnEvent()
	{	
		$this->RestoreFleet();
	}
	
	private function SpyTarget($TargetPlanet, $Mode, $TitleString, $LNG)
	{
		global $resource, $db;

		if($USER['raza'] == 0) {
                        $raza_tipo = $LNG['Raza_0'];
						$skin_raza = "gultra";
                } elseif ($USER['raza'] == 1) {
                        $raza_tipo = $LNG['Raza_1'];
						$skin_raza = "voltra";
                }
		
		$LookAtLoop = true;
		if ($Mode == 0)
		{
				$String  = '
				<table style="width:100%;"><tr><th colspan="5">
				<a href="game.php?page=galaxy&mode=3&galaxy='. $TargetPlanet['galaxy'] .'&system='. $TargetPlanet['system']. '">
				'.sprintf($TitleString, $TargetPlanet['name'], $TargetPlanet['galaxy'], $TargetPlanet['system'], $TargetPlanet['planet'], date(TDFORMAT, $this->_fleet['fleet_end_time'])) .'</th>
                </tr><tr>
                <td style="width:25%;" class="left transparent"><img src="styles/theme/' . $skin_raza .'/images/metal.jpg" class="tooltip" name="'. $LNG['Metal'] .'" /></td><td style="width:25%;" class="left transparent">'. pretty_number($TargetPlanet['metal']) .'</td><td class="transparent">&nbsp;</td>
                <td style="width:25%;" class="left transparent"><img src="styles/theme/' . $skin_raza .'/images/cristal.jpg" class="tooltip" name="'. $LNG['Crystal']   .'" /></td><td style="width:25%;" class="left transparent">'. pretty_number($TargetPlanet['crystal'])    .'</td>
                </tr><tr>
                <td style="width:25%;" class="left transparent"><img src="styles/theme/' . $skin_raza .'/images/deuterio.jpg" class="tooltip" name="'. $LNG['Deuterium'] .'" /></td><td style="width:25%;" class="left transparent">'. pretty_number($TargetPlanet['deuterium'])  .'</td><td class="transparent">&nbsp;</td>
                <td style="width:25%;" class="left transparent"><img src="styles/theme/' . $skin_raza .'/images/energia.jpg" class="tooltip" name="'. $LNG['Energy']    .'" /></td><td style="width:25%;" class="left transparent">'. pretty_number($TargetPlanet['energy_max']) .'</td>
                </tr><tr>
				  <td style="width:25%;" class="left transparent"><img src="styles/theme/' . $skin_raza .'/images/norio.jpg" class="tooltip" name="'. $LNG['Norio'] .'" /></td><td style="width:25%;" class="left transparent">'. pretty_number($TargetPlanet['norio']) .'</td>
				</tr><tr>
				';
						
                $Array[1]       = $TargetPlanet['metal'];
                $Array[2]       = $TargetPlanet['crystal'];
                $Array[3]       = $TargetPlanet['deuterium'];
				$Array[4]       = $TargetPlanet['norio'];
			
			$LookAtLoop = false;
		}
		elseif ($Mode == 1)
		{
			$ResFrom[0] = 200;
			$ResTo[0]   = 299;
			$Loops      = 1;
		}
		elseif ($Mode == 2)
		{
			$ResFrom[0] = 400;
			$ResTo[0]   = 499;
			$ResFrom[1] = 500;
			$ResTo[1]   = 599;
			$Loops      = 2;
		}
		elseif ($Mode == 3)
		{
			$ResFrom[0] = 1;
			$ResTo[0]   = 99;
			$Loops      = 1;
		}
		elseif ($Mode == 4)
		{
			$ResFrom[0] = 100;
			$ResTo[0]   = 199;
			$Loops      = 1;
		}
	
		if ($Mode == 1)
		{
			$def = $db->query('SELECT * FROM '.FLEETS.' WHERE `fleet_mission` = 5 AND `fleet_end_id` = '. $this->_fleet['fleet_end_id'].' AND fleet_start_time<'.TIMESTAMP.' AND fleet_end_stay>='.TIMESTAMP.';');
			while ($defRow = $db->fetch_array($def))
			{
				$defRowDef = explode(';', $defRow['fleet_array']);
				foreach ($defRowDef as $Element)
				{
					$Element = explode(',', $Element);

					if ($Element[0] < 100) continue;

					if (!isset($TargetPlanet[$resource[$Element[0]]]))
						$TargetPlanet[$resource[$Element[0]]] = 0;

					$TargetPlanet[$resource[$Element[0]]] += $Element[1];
				}
			}
		}
		
		if ($LookAtLoop == true)
		{
			$String  	 = '<table style="width:100%;"><tr><th colspan="'. ((2 * SPY_REPORT_ROW) + (SPY_REPORT_ROW - 1)).'">'. $TitleString .'</th></tr>';
			$Count       = 0;
			$CurrentLook = 0;
			while ($CurrentLook < $Loops)
			{
				$row     = 0;
				for ($Item = $ResFrom[$CurrentLook]; $Item <= $ResTo[$CurrentLook]; $Item++)
				{
					if ($TargetPlanet[$resource[$Item]] <= 0)
						continue;

					if ($row == 0)
						$String  .= "<tr>";

					$String  .= '<td style="width:25%;" class="left transparent"><img src="styles/theme/' . $skin_raza .'/gebaeude/' .$Item .'.png" width="50" height="50" class="tooltip" name="'.$LNG['tech'][$Item].'" /></td><td style="width:25%;" class="left transparent">'.pretty_number($TargetPlanet[$resource[$Item]]).'</td>';
						
					$Array[$Item]	=  $TargetPlanet[$resource[$Item]];
					$Count			+=  $TargetPlanet[$resource[$Item]];
					$row++;
					if ($row == SPY_REPORT_ROW)
					{
						$String  .= '</tr>';
						$row      = 0;
					} else {
						$String  .= '<td class="transparent">&nbsp;</td>';
					}
				}

				while ($row != 0)
				{
					$String  	.= '<td class="transparent">&nbsp;</td><td class="transparent">&nbsp;</td>';
					$row++;
					if ($row == SPY_REPORT_ROW)
					{
						$String  .= '</tr>';
						$row      = 0;
					}
				}
				$CurrentLook++;
			}
		}
		
		$String .= '</table>';

		$return['String'] = $String;
		$return['Array']  = (is_array($Array) ? $Array : array());
		$return['Count']  = $Count;

		return $return;
	}
}

?>