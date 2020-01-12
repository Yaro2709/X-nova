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

class MissionCaseExpedition extends MissionFunctions
{
	function __construct($Fleet)
	{
		$this->_fleet	= $Fleet;
	}
	
	function TargetEvent()
	{
		$this->UpdateFleet('fleet_mess', 2);
		$this->SaveFleet();
	}
	
	function EndStayEvent()
	{
		global $pricelist, $db, $reslist, $LANG, $CONFIG; 
		$LNG			= $LANG->GetUserLang($this->_fleet['fleet_owner']);
		foreach($reslist['fleet'] as $ID)
		{
			$Expowert[$ID]	= ($pricelist[$ID]['metal'] + $pricelist[$ID]['crystal'] + $pricelist[$ID]['norio']) / 1000;
		}
		
		$Expowert[202] = 12;
		$Expowert[203] = 47;
		$Expowert[204] = 12;
		$Expowert[205] = 110;
		$Expowert[206] = 47;
		$Expowert[207] = 160;
			
		$farray 			= explode(";", $this->_fleet['fleet_array']);
		$FleetPoints 		= 0;
		$FleetCapacity		= 0;
			
		foreach ($farray as $Item => $Group)
		{
			if (empty($Group)) continue;
		
			$Class 						= explode (",", $Group);
			$FleetCount[$Class[0]]		= $Class[1];
			$FleetCapacity 			   += $Class[1] * $pricelist[$Class[0]]['capacity'];
			$FleetPoints   			   += $Class[1] * $Expowert[$Class[0]];			
		}
			
		$FleetCapacity		-= $this->_fleet['fleet_resource_metal'] + $this->_fleet['fleet_resource_crystal'] + $this->_fleet['fleet_resource_deuterium'] + $this->_fleet['fleet_resource_darkmatter'] + $this->_fleet['fleet_resource_norio'];
					
		$GetEvent			= mt_rand(1, 9);
			
		switch($GetEvent)
		{
			case 1:
				$WitchFound	= mt_rand(1,3);
				$FindSize = mt_rand(0, 100);
				if(10 < $FindSize) {
					$WitchSize	= 1;
					$Factor 	= (mt_rand(10, 50) / $WitchFound) * $CONFIG[$this->_fleet['fleet_universe']]['resource_multiplier'];
					$Message	= $LNG['sys_expe_found_ress_1_'.mt_rand(1,4)];
				} elseif(0 < $FindSize && 10 >= $FindSize) {
					$WitchSize	= 2;
					$Factor 	= (mt_rand(52, 100) / $WitchFound) * $CONFIG[$this->_fleet['fleet_universe']]['resource_multiplier'];
					$Message	= $LNG['sys_expe_found_ress_2_'.mt_rand(1,3)];
				} elseif(0 == $FindSize) {
					$WitchSize	= 3;
					$Factor 	= (mt_rand(102, 200) / $WitchFound) * $CONFIG[$this->_fleet['fleet_universe']]['resource_multiplier'];
					$Message	= $LNG['sys_expe_found_ress_3_'.mt_rand(1,2)];
				}	
		
				$StatFactor = $db->uniquequery("SELECT MAX(total_points) as total FROM `".STATPOINTS."` WHERE `stat_type` = 1 AND `universe` = '".$this->_fleet['fleet_universe']."';");
						
				$MaxPoints	= ($StatFactor['total'] < 5000000) ? 9000 : 12000;
				$Size		= min($Factor * MAX(MIN($FleetPoints / 1000, $MaxPoints), 200), $FleetCapacity);
						
				switch($WitchFound)
				{
					case 1:
						$this->UpdateFleet('fleet_resource_metal', $this->_fleet['fleet_resource_metal'] + $Size);
					break;
					case 2:
						$this->UpdateFleet('fleet_resource_crystal', $this->_fleet['fleet_resource_crystal'] + $Size);
					break;
					case 3:
						$this->UpdateFleet('fleet_resource_deuterium', $this->_fleet['fleet_resource_deuterium'] + $Size);
					break;
					case 4:
						$this->UpdateFleet('fleet_resource_norio', $this->_fleet['fleet_resource_norio'] + $Size);
					break;
				}

			break;
			case 2:
				$FindSize = mt_rand(0, 100);
				if(10 < $FindSize) {
					$Size		= mt_rand(100, 300);
					$Message	= $LNG['sys_expe_found_dm_1_'.mt_rand(1,5)];
				} elseif(0 < $FindSize && 10 >= $FindSize) {
					$Size		= mt_rand(301, 600);
					$Message	= $LNG['sys_expe_found_dm_2_'.mt_rand(1,4)];
				} elseif(0 == $FindSize) {
					$Size	 	= mt_rand(601, 3000);
					$Message	= $LNG['sys_expe_found_dm_3_'.mt_rand(1,2)];
				}
					
				$this->UpdateFleet('fleet_resource_darkmatter', $this->_fleet['fleet_resource_darkmatter'] + $Size);
			break;
			case 3:
			default:
				$FindSize = mt_rand(0, 100);
				if(10 < $FindSize) {
					$Size		= mt_rand(10, 50);
					$Message	= $LNG['sys_expe_found_ships_1_'.mt_rand(1,4)];
					$MaxFound	= 300000;
				} elseif(0 < $FindSize && 10 >= $FindSize) {
					$Size		= mt_rand(52, 100);
					$Message	= $LNG['sys_expe_found_ships_2_'.mt_rand(1,2)];
					$MaxFound	= 600000;
				} elseif(0 == $FindSize) {
					$Size	 	= mt_rand(102, 200);
					$Message	= $LNG['sys_expe_found_ships_3_'.mt_rand(1,2)];
					$MaxFound	= 1200000;
				}
					
				$StatFactor 	= $db->countquery("SELECT MAX(total_points) FROM `".STATPOINTS."` WHERE `stat_type` = 1 AND `universe` = '".$this->_fleet['fleet_universe']."';");
					
				$MaxPoints 		= ($StatFactor < 5000000) ? 4500 : 6000;
					
				$FoundShips		= max(round($Size * min($FleetPoints, $MaxPoints)), 10000);
			
				$FoundShipMess	= "";	
				$NewFleetArray 	= "";

				$LNG			+= $LANG->GetUserLang($this->_fleet['fleet_owner'], array('TECH'));
				$Found			= array();
				foreach($reslist['fleet'] as $ID) 
				{
					if(!isset($FleetCount[$ID]) || $ID == 208 || $ID == 209 || $ID == 214)
						continue;
					
					$MaxFound			= floor($FoundShips / ($pricelist[$ID]['metal'] + $pricelist[$ID]['crystal'] + $pricelist[$ID]['norio']));
					
					if($MaxFound <= 0)
							continue;
					
					$Count				= mt_rand(0, $MaxFound);
					if($Count <= 0)
					#if($MaxFound <= 0) 
						continue;
					
					$Found[$ID]			+= $Count;
					$FoundShips	 		-= $Count * ($pricelist[$ID]['metal'] + $pricelist[$ID]['crystal'] + $pricelist[$ID]['norio']);
					$FoundShipMess   	.= '<br>'.$LNG['tech'][$ID].': '.pretty_number($Count);
					if($FoundShips <= 0)
						break;
				}
				
				foreach($FleetCount as $ID => $Count)
					$NewFleetArray  	.= $ID.",".floattostring($Count + $Found[$ID]).";";
					
				$Message	.= $FoundShipMess;
							
				$this->UpdateFleet('fleet_array', $NewFleetArray);
				$this->UpdateFleet('fleet_amount', array_sum($FleetCount));
			break;
			case 4:
			$Chance	= mt_rand(1,2);
				if($Chance == 1) {
					$Points	= array(-3,-5,-8);
					$Which	= 1;
					$Def	= -3;
					$Name	= $LNG['sys_expe_attackname_1'];
					$Add	= 0;
					$Rand	= array(5,3,2);	
					$DefenderFleetArray	= "204,5;206,3;207,2;";								
				} else { 
					$Points	= array(-4,-6,-9);
					$Which	= 2;
					$Def	= 3;
					$Name	= $LNG['sys_expe_attackname_2'];
					$Add	= 0.1;
					$Rand	= array(4,3,2);
					$DefenderFleetArray	= "205,5;215,3;213,2;";
				}
				
				$LNG			+= $LANG->GetUserLang($this->_fleet['fleet_owner']);
					
				$FindSize = mt_rand(0, 100);
				if(10 < $FindSize) {
					$Message			= $LNG['sys_expe_attack_'.$Which.'_1_'.$Rand[0]];
					$MaxAttackerPoints	= 0.3 + $Add + (mt_rand($Points[0], abs($Points[0])) * 0.01);
				} elseif(0 < $FindSize && 10 >= $FindSize) {
					$Message			= $LNG['sys_expe_attack_'.$Which.'_2_'.$Rand[1]];
					$MaxAttackerPoints	= 0.3 + $Add + (mt_rand($Points[1], abs($Points[1])) * 0.01);
				} elseif(0 == $FindSize) {
					$Message			= $LNG['sys_expe_attack_'.$Which.'_3_'.$Rand[2]];
					$MaxAttackerPoints	= 0.3 + $Add + (mt_rand($Points[2], abs($Points[2])) * 0.01);
				}
					
				foreach($FleetCount as $ID => $count)
				{
					$DefenderFleetArray	.= $ID.",".round($count * $MaxAttackerPoints).";";
				}

				$AttackerTechno	= $db->uniquequery('SELECT id,username,military_tech,defence_tech,shield_tech FROM '.USERS.' WHERE id='.$this->_fleet['fleet_owner'].";");
				$DefenderTechno	= array('id' => 0, 'username' => $Name, 'military_tech' => (min($AttackerTechno['military_tech'] + $Def,0)), 'defence_tech' => (min($AttackerTechno['defence_tech'] + $Def,0)), 'shield_tech' => (min($AttackerTechno['shield_tech'] + $Def,0)));
				
				$attackFleets[$this->_fleet['fleet_id']]['fleet'] = $this->_fleet;
				$attackFleets[$this->_fleet['fleet_id']]['user'] = $AttackerTechno;
				$attackFleets[$this->_fleet['fleet_id']]['user']['factor'] = getFactors($attackFleets[$this->_fleet['fleet_id']]['user'], 'attack', $this->_fleet['fleet_start_time']);
				$attackFleets[$this->_fleet['fleet_id']]['detail'] = array();
				$temp = explode(';', $this->_fleet['fleet_array']);
				foreach ($temp as $temp2)
				{
					$temp2 = explode(',', $temp2);
					if ($temp2[0] < 100) continue;
					if (!isset($attackFleets[$this->_fleet['fleet_id']]['detail'][$temp2[0]]))
						$attackFleets[$this->_fleet['fleet_id']]['detail'][$temp2[0]] = 0;

					$attackFleets[$this->_fleet['fleet_id']]['detail'][$temp2[0]] += $temp2[1];
				}
				$defense = array();

				$defRowDef = explode(';', $DefenderFleetArray);
				foreach ($defRowDef as $Element)
				{
					$Element = explode(',', $Element);

					if ($Element[0] < 100) continue;
					if (!isset($defense[$defRow['fleet_id']]['def'][$Element[0]]))
					$defense[0][$Element[0]] = 0;

					$defense[0]['def'][$Element[0]] += $Element[1];
				}
				$defense[0]['user'] = $DefenderTechno;
				$defense[0]['user']['factor']	= 0;

				require_once('calculateAttack.php');

				$start 		= microtime(true);
				$result 	= calculateAttack($attackFleets, $defense, $CONFIG[$this->_fleet['fleet_universe']]['Fleet_Cdr'], $CONFIG[$this->_fleet['fleet_universe']]['Defs_Cdr']);
				$totaltime 	= microtime(true) - $start;

				foreach ($attackFleets as $fleetID => $attacker)
				{
					$fleetArray = '';
					$totalCount = 0;
					foreach ($attacker['detail'] as $element => $amount)
					{
						if ($amount)
							$fleetArray .= $element.','.$amount.';';

						$totalCount += $amount;
					}

					if ($totalCount <= 0)
						$this->KillFleet();
					else
					{
						$this->UpdateFleet('fleet_array', substr($fleetArray, 0, -1));
						$this->UpdateFleet('fleet_amount', $totalCount);
					}
				}

				require_once('GenerateReport.php');
				$raport		= GenerateReport($result, $INFO);
				$rid		= md5(microtime(true).mt_rand(1,100));
			
				file_put_contents(ROOT_PATH.'raports/raport_'.$rid.'.php', '<?php'."\n".'$raport = '.$raport.';'."\n".'?>');
					
				$SQLQuery  = "INSERT INTO ".RW." SET `time` = '".TIMESTAMP."', `owners` = '".$this->_fleet['fleet_owner'].",0', `rid` = '". $rid ."';";	
				$db->query($SQLQuery);
				switch($result['won'])
				{
					case "r":
						$ColorAtt = "red";
						$ColorDef = "green";
					break;
					case "w":
						$ColorAtt = "orange";
						$ColorDef = "orange";	
					case "a":
						$ColorAtt = "green";
						$ColorDef = "red";
					break;
				}
				$MessageAtt = sprintf('<a href="CombatReport.php?raport=%s" onclick="OpenPopup(\'CombatReport.php?raport=%s\', \'combat\', screen.width, screen.height);return false" target="combat"><center><font color="%s">%s %s</font></a><br><br><font color="%s">%s: %s</font> <font color="%s">%s: %s</font><br>%s %s:<font color="#adaead">%s</font> %s:<font color="#ef51ef">%s</font> %s:<font color="#f77542">%s</font><br>%s %s:<font color="#adaead">%s</font> %s:<font color="#ef51ef">%s</font><br></center>', $rid, $rid, $ColorAtt, $LNG['sys_mess_attack_report'], sprintf($LNG['sys_adress_planet'], $this->_fleet['fleet_end_galaxy'], $this->_fleet['fleet_end_system'], $this->_fleet['fleet_end_planet']), $ColorAtt, $LNG['sys_perte_attaquant'], pretty_number($result['lost']['att']), $ColorDef, $LNG['sys_perte_defenseur'], pretty_number($result['lost']['def']), $LNG['sys_gain'], $LNG['Metal'], pretty_number($steal['metal']), $LNG['Crystal'], pretty_number($steal['crystal']), $LNG['Deuterium'], pretty_number($steal['deuterium']), $LNG['Norio'], pretty_number($steal['norio']), $LNG['sys_debris'], $LNG['Metal'], pretty_number($result['debree']['att'][0]+$result['debree']['def'][0]), $LNG['Crystal'], pretty_number($result['debree']['att'][1]+$result['debree']['def'][1]), $LNG['Norio'], pretty_number($result['debree']['att'][2]+$result['debree']['def'][2]));
			
				SendSimpleMessage($this->_fleet['fleet_owner'], 0, $this->_fleet['fleet_start_time'], 3, $LNG['sys_mess_tower'], $LNG['sys_mess_attack_report'], $MessageAtt);
			break;
			case 5:
				$this->KillFleet();
				$Message	= $LNG['sys_expe_lost_fleet_'.mt_rand(1,4)];
			break;
			case 6:
            # http://owiki.de/Expedition#Ver.C3.A4nderte_Flugzeit
            $MoreTime       = mt_rand(0, 100);
            $Wrapper        = array();
            $Wrapper[]      = 2;
            $Wrapper[]      = 2;
            $Wrapper[]      = 2;
            $Wrapper[]      = 2;
            $Wrapper[]      = 2;
            $Wrapper[]      = 2;
            $Wrapper[]      = 2;
            $Wrapper[]      = 3;
            $Wrapper[]      = 3;
            $Wrapper[]      = 5;
            if($MoreTime < 75) {
				$this->UpdateFleet('fleet_end_time', ($this->_fleet['fleet_end_time'] - $this->_fleet['fleet_end_stay']) + ($this->_fleet['fleet_end_stay'] - $this->_fleet['fleet_start_time']) * $Wrapper[mt_rand(0, 9)]);
                $Message = $LNG['sys_expe_time_slow_'.mt_rand(1,6)];
            } else {
                $this->UpdateFleet('fleet_end_time', max(1, ($this->_fleet['fleet_end_time'] - $this->_fleet['fleet_end_stay']) - ($this->_fleet['fleet_end_stay'] - $this->_fleet['fleet_start_time']) / 3 * $Wrapper[mt_rand(0, 9)]));
                $Message = $LNG['sys_expe_time_fast_'.mt_rand(1,3)];
            }
            break;
			default:
				$Message	= $LNG['sys_expe_nothing_'.mt_rand(1,8)];
			break;
		}
			
		SendSimpleMessage($this->_fleet['fleet_owner'], 0, $this->_fleet['fleet_end_stay'], 15, $LNG['sys_mess_tower'], $LNG['sys_expe_report'], $Message);
		$this->UpdateFleet('fleet_mess', 1);
		$this->SaveFleet();
	}
	
	function ReturnEvent()
	{
		global $LANG;
		$LNG			= $LANG->GetUserLang($this->_fleet['fleet_owner']);
		$Message 		= sprintf($LNG['sys_expe_back_home'], $LNG['Metal'], pretty_number($this->_fleet['fleet_resource_metal']), $LNG['Crystal'], pretty_number($this->_fleet['fleet_resource_crystal']),  $LNG['Deuterium'], pretty_number($this->_fleet['fleet_resource_deuterium']), $LNG['Darkmatter'], pretty_number($this->_fleet['fleet_resource_darkmatter']), $LNG['Norio'], pretty_number($this->_fleet['fleet_resource_norio']));
		SendSimpleMessage($this->_fleet['fleet_owner'], 0, $this->_fleet['fleet_end_time'], 15, $LNG['sys_mess_tower'], $LNG['sys_expe_report'], $Message);
		$this->RestoreFleet();
	}
}

?>