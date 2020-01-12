<?php

/**
 _  \_/ |\ | /��\ \  / /\    |��) |_� \  / /��\ |  |   |��|�` | /��\ |\ |5
 �  /�\ | \| \__/  \/ /--\   |��\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core.
 * @author: Copyright (C) 2011 by Brayan Narvaez (Prinick) developer of xNova Revolution
 * @author web: http://www.bnarvaez.com
 * @link: http://www.xnovarevforum.com.ar

 * @package 2Moons
 * @author Slaver <slaver7@gmail.com>
 * @copyright 2009 Lucky <douglas@crockford.com> (XGProyecto)
 * @copyright 2011 Slaver <slaver7@gmail.com> (Fork/2Moons)
 * @license http://www.gnu.org/licenses/gpl.html GNU GPLv3 License
 * @version 1.3 (2011-01-21)
 * @link http://code.google.com/p/2moons/

 * Please do not remove the credits
*/

class ShowBuildingsPage
{       
        public function GetRestPrice($Element)
        {
                global $pricelist, $resource, $LNG, $USER, $PLANET;

                $array = array(
                        'metal'      => $LNG['Metal'],
                        'crystal'    => $LNG['Crystal'],
                        'deuterium'  => $LNG['Deuterium'],
                        'norio'      => $LNG['Norio'],
                        'energy_max' => $LNG['Energy'],
                        'darkmatter' => $LNG['Darkmatter'],
                );
                
                $restprice      = array();
                
                foreach ($array as $ResType => $ResTitle)
                {
                        if ($pricelist[$Element][$ResType] == 0)
                                continue;

                        $cost = floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $PLANET[$resource[$Element]]));
                        
                        $restprice[$ResTitle] = pretty_number(max($cost - (($PLANET[$ResType]) ? $PLANET[$ResType] : $USER[$ResType]), 0));
                }

                return $restprice;
        }
        
        public function CancelBuildingFromQueue($PlanetRess)
        {
                global $PLANET, $USER;
                $CurrentQueue  = unserialize($PLANET['b_building_id']);
                if (empty($CurrentQueue))
                {
                        $PLANET['b_building_id']        = '';
                        $PLANET['b_building']           = 0;
                        return;
                }
        
                $Element                = $CurrentQueue[0][0];
                $BuildMode              = $CurrentQueue[0][4];

                $Needed                 = GetBuildingPrice ($USER, $PLANET, $Element, true, $BuildMode == 'destroy');
                $PLANET['metal']                += $Needed['metal'];
                $PLANET['crystal']              += $Needed['crystal'];
                $PLANET['deuterium']    += $Needed['deuterium'];
                $PLANET['norio']            += $Needed['norio'];
                $USER['darkmatter']             += $Needed['darkmatter'];
                array_shift($CurrentQueue);
                if (count($CurrentQueue) == 0) {
                        $PLANET['b_building']           = 0;
                        $PLANET['b_building_id']        = '';
                        FirePHP::getInstance(true)->log("Cola(Edificios): ".$PLANET['b_building_id']);
                } else {
                        $BuildEndTime   = TIMESTAMP;
                        foreach($CurrentQueue as $ListIDArray) {
                                if($Element == $ListIDArray[0] || empty($ListIDArray[0]))
                                        continue;
                                        
                                $BuildEndTime       += GetBuildingTime($USER, $PLANET, $ListIDArray[0], $ListIDArray[4] == 'destroy');
                                $ListIDArray[3]         = $BuildEndTime;
                                $NewQueueArray[]        = $ListIDArray;
                }               
                        if(empty($NewQueueArray)) {
                        $PLANET['b_building']           = TIMESTAMP;
                        $PLANET['b_building_id']        = serialize($NewQueueArray);
                        $PlanetRess->USER                       = $USER;
                        $PlanetRess->PLANET                     = $PLANET;
                        $PlanetRess->SetNextQueueElementOnTop();
                        $USER                                           = $PlanetRess->USER;
                        $PLANET                                         = $PlanetRess->PLANET;
        } else {
                        $PLANET['b_building']           = 0;
                        $PLANET['b_building_id']        = '';
                }
                
                return $ReturnValue;
        }
        }

        public function RemoveBuildingFromQueue($QueueID, $PlanetRess)
        {
                global $USER, $PLANET;
                if ($QueueID <= 1 || empty($PLANET['b_building_id']))
                        return;
                
                $CurrentQueue  = unserialize($PLANET['b_building_id']);
                $ActualCount   = count($CurrentQueue);
                if($ActualCount <= 1)
                        return $this->CancelBuildingFromQueue($PlanetRess);
                
                if(!isset($CurrentQueue[$QueueID - 2]))
                        return;
                
                $Element                = $CurrentQueue[$QueueID - 2][0];
                $BuildEndTime   = $CurrentQueue[$QueueID - 2][3];
                unset($CurrentQueue[$QueueID - 1]);
                $NewQueueArray  = array();
                foreach($CurrentQueue as $ID => $ListIDArray) {
                        if ($ID < $QueueID - 1) {
                                $NewQueueArray[]        = $ListIDArray;
                        } else {
                                if($Element == $ListIDArray[0])
                                        continue;
                                
                                $BuildEndTime       += GetBuildingTime($USER, $CPLANET, $ListIDArray[0]);
                                $ListIDArray[3]         = $BuildEndTime;
                                $NewQueueArray[]        = $ListIDArray;
                        }
                }
                $PLANET['b_building_id'] = serialize($NewQueueArray);           
                FirePHP::getInstance(true)->log("Cola(Edificios): ".$PLANET['b_building_id']);
                
        }

        public function AddBuildingToQueue ($Element, $AddMode = true)
        {
                global $PLANET, $USER, $resource;
                        
                $CurrentQueue           = unserialize($PLANET['b_building_id']);
                
                if (!empty($CurrentQueue)) {
                        $ActualCount    = count($CurrentQueue);
                } else {
                        $CurrentQueue   = array();
                        $ActualCount    = 0;
                }
                
                $CurrentMaxFields       = CalculateMaxPlanetFields($PLANET);


                if (($ActualCount == MAX_BUILDING_QUEUE_SIZE) || ($PLANET["field_current"] >= ($CurrentMaxFields - $ActualCount) && $AddMode))
                        return;
        
                if ($AddMode == true) {
                        $BuildMode              = 'build';
                        $BuildLevel             = $PLANET[$resource[$Element]] + 1;
                } else {
                        $BuildMode              = 'destroy';
                        $BuildLevel             = $PLANET[$resource[$Element]];
                }               

                if($ActualCount == 0)
                {       
                        if((!$AddMode && $PLANET[$resource[$Element]] == 0) || !IsElementBuyable($USER, $PLANET, $Element, true, $ForDestroy))
                                return;

                        $Resses                 = GetBuildingPrice($USER, $PLANET, $Element, true, !$AddMode);
                        $BuildTime      = GetBuildingTime($USER, $PLANET, $Element, !$AddMode); 
                                        
                        $PLANET['metal']                        -= $Resses['metal'];
                        $PLANET['crystal']                      -= $Resses['crystal'];
                        $PLANET['deuterium']            -= $Resses['deuterium'];
                        $PLANET['norio']                    -= $Resses['norio'];
                        $USER['darkmatter']                     -= $Resses['darkmatter'];
                        $BuildEndTime                           = TIMESTAMP + $BuildTime;
                        $PLANET['b_building_id']        = serialize(array(array($Element, $BuildLevel, $BuildTime, $BuildEndTime, $BuildMode)));
                        $PLANET['b_building']           = $BuildEndTime;
                } else {
                        $InArray = 0;
                        foreach($CurrentQueue as $QueueSubArray) {
                                if($QueueSubArray[0] == $Element) {
                                        if($QueueSubArray[4] == 'build')
                                                $InArray++;
                                        else
                                                $InArray--;
                            }                   
                        }       
                        $PLANET[$resource[$Element]] += $InArray;
                        $BuildTime                                = GetBuildingTime($USER, $PLANET, $Element, !$AddMode);
                        $PLANET[$resource[$Element]] -= $InArray;
                        $BuildEndTime                           = $CurrentQueue[$ActualCount - 1][3] + $BuildTime;
                        $BuildLevel                                     += $InArray;    
                        $CurrentQueue[]                         = array($Element, $BuildLevel, $BuildTime, $BuildEndTime, $BuildMode);
                        $PLANET['b_building_id']        = serialize($CurrentQueue);
                }
                FirePHP::getInstance(true)->log("Cola(Edificios): ".$PLANET['b_building_id']);
        }

        public function ShowBuildingQueue()
        {
                global $LNG, $CONF, $PLANET, $USER;
                
                if ($PLANET['b_building'] == 0)
                        return array();
                
                $CurrentQueue   = unserialize($PLANET['b_building_id']);

                $ListIDRow              = "";
                $ScriptData             = array();
        
        if (is_array($CurrentQueue)) {  
        foreach($CurrentQueue as $BuildArray) {
                        if ($BuildArray[3] < TIMESTAMP)
                                continue;

                        $ScriptData[] = array('element' => $BuildArray[0], 'level' => $BuildArray[1], 'time' => $BuildArray[2], 'name' => $LNG['tech'][$BuildArray[0]], 'mode' => (($BuildArray[4] == 'destroy') ? ' '.$LNG['bd_dismantle'] : ''), 'endtime' => $BuildArray[3], 'reload' => in_array($BuildArray[0], array(14, 15)));
                }
                return $ScriptData;
        }
        }
        
        public function __construct()
        {
                global $ProdGrid, $LNG, $resource, $reslist, $CONF, $db, $PLANET, $USER;

                include_once(ROOT_PATH . 'includes/functions/IsTechnologieAccessible.php');
                include_once(ROOT_PATH . 'includes/functions/GetElementPrice.php');
                
                $TheCommand     = request_var('cmd','');
        $Element        = request_var('building',0);
        $ListID         = request_var('listid',0);

                $PlanetRess     = new ResourceUpdate();
                $PlanetRess->CalcResource();
                
                
                if(!empty($Element) && $USER['urlaubs_modus'] == 0 && (IsTechnologieAccessible($USER, $PLANET, $Element) && in_array($Element, $reslist['allow'][$PLANET['planet_type']])) || $TheCommand == "cancel" || $TheCommand == "remove")
                {
                        if(($Element == 31 && $USER["b_tech_planet"] != 0) || (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id'])))
                                $TheCommand     = '';
                                
                        switch($TheCommand)
                        {
                                case 'cancel':
                                        $this->CancelBuildingFromQueue($PlanetRess);
                                break;
                                case 'remove':
                                        $this->RemoveBuildingFromQueue($ListID, $PlanetRess);
                                break;
                                case 'insert':
                                        $this->AddBuildingToQueue($Element, true);
                                break;
                                case 'destroy':
                                        $this->AddBuildingToQueue($Element, false);
                                break;
                        }
                }
                $PlanetRess->SavePlanetToDB();

                $Queue                          = $this->ShowBuildingQueue();
                
                $CanBuildElement        = (count($Queue) < MAX_BUILDING_QUEUE_SIZE) ? true : false;
                $CurrentMaxFields   = CalculateMaxPlanetFields($PLANET);
                $RoomIsOk                       = ($PLANET["field_current"] < ($CurrentMaxFields - count($Queue))) ? true : false;
                                
                $BuildEnergy            = $USER[$resource[113]];
                $BuildLevelFactor   = 10;
                $BuildTemp          = $PLANET['temp_max'];
                foreach($reslist['allow'][$PLANET['planet_type']] as $ID => $Element)
                {
                        if (!IsTechnologieAccessible($USER, $PLANET, $Element))
                                continue;

                        $HaveRessources         = IsElementBuyable ($USER, $PLANET, $Element, true, false);
                        if(in_array($Element, $reslist['prod']))
                        {
                                $BuildLevel             = $PLANET[$resource[$Element]];
                                $Need                   = floor(eval($ProdGrid[$Element]['formule']['energy']) * $CONF['resource_multiplier']);
                                $BuildLevel                        += 1;
                                $Prod                   = floor(eval($ProdGrid[$Element]['formule']['energy']) * $CONF['resource_multiplier']);
                                $EnergyNeed                     = $Prod - $Need;
                        } else
                                unset($EnergyNeed);
                                
                        $BulidLink              = '';
                        $NextBuildLevel         = $PLANET[$resource[$Element]] + 1;

		if($USER['raza'] == 0) {
		$skin_raza = "gultra";
		} elseif ($USER['raza'] == 1) {
		$skin_raza = "voltra";
		} 
                       
					   if ($RoomIsOk && $CanBuildElement)
                        $BulidLink = ($HaveRessources == true) ? '<a href="game.php?page=buildings&amp;cmd=insert&amp;building='.$Element.'"><img class="tooltip" name="<table><td>'.(($PLANET['b_building'] != 0) ? $LNG['bd_add_to_list'] : (($NextBuildLevel == 1) ? $LNG['bd_build'] : $LNG['bd_build_next_level'] . $NextBuildLevel)).'</td></table>" src="styles/theme/' .$skin_raza .'/imagenes/navegacion/construir.gif" /></a>' : '<img class="tooltip" name="<table><td>'.(($NextBuildLevel == 1) ? $LNG['no_recursos'] : $LNG['bd_build_next_level'] . $NextBuildLevel).'</td></table>" src="styles/theme/' .$skin_raza .'/imagenes/navegacion/construir_red.gif" />';
                        elseif ($RoomIsOk && !$CanBuildElement)
                                $BulidLink = '<img class="tooltip" name="<table><td>'.(($NextBuildLevel == 1) ? $LNG['bd_build'] : $LNG['bd_build_next_level'] . $NextBuildLevel) .'</td></table>" src="styles/theme/' .$skin_raza .'/imagenes/navegacion/construir_red.gif" />';
                        else
                                $BulidLink = '<img class="tooltip" name="<table><td>'.$LNG['bd_no_more_fields'].'</td></table>" src="styles/theme/' .$skin_raza .'/imagenes/navegacion/construir_red.gif" />'; 
                        if (($Element == 6 || $Element == 31) && $USER['b_tech'] > TIMESTAMP)
                                $BulidLink = '<img class="tooltip" name="<table><td>'.$LNG['bd_working'].'</td></table>" src="styles/theme/' .$skin_raza .'/imagenes/navegacion/construir_red.gif" />';
                        elseif (($Element == 15 || $Element == 21) && !empty($PLANET['b_hangar_id']))
                                $BulidLink = '<img class="tooltip" name="<table><td>'.$LNG['bd_working'].'</td></table>" src="styles/theme/' .$skin_raza .'/imagenes/navegacion/construir_red.gif" />';
                        
                        $BuildInfoList[]        = array(
                                'id'                    => $Element,
                                'name'                  => $LNG['tech'][$Element],
                                'descriptions'  => $LNG['res']['descriptions'][$Element],
                                'level'                 => $PLANET[$resource[$Element]],
                                'destroyress'   => array_map('pretty_number', GetBuildingPrice ($USER, $PLANET, $Element, true, true)),
                                'destroytime'   => pretty_time(GetBuildingTime($USER, $PLANET, $Element, true)),
                                'price'                 => GetElementPrice($USER, $PLANET, $Element, true),
                                'time'          => pretty_time(GetBuildingTime($USER, $PLANET, $Element)),
                                'EnergyNeed'    => (isset($EnergyNeed)) ? sprintf(($EnergyNeed < 0) ? $LNG['bd_need_engine'] : $LNG['bd_more_engine'] , shortly_number(abs($EnergyNeed)), $LNG['Energy']) : "",
                                'RealEnergy' => pretty_number(abs($EnergyNeed)),
                                'BuildLink'             => $BulidLink,
                                'restprice'             => $this->GetRestPrice($Element),
                        );
                }
                
                $template                       = new template();
                
                if ($PLANET['b_building'] != 0)
                {
                        $template->execscript('ReBuildView();Buildlist();');
                        $template->loadscript('buildlist.js');
                        $template->assign_vars(array(
                                'data'                          => json_encode(array('bd_cancel' => $LNG['bd_cancel'], 'bd_continue' => $LNG['bd_continue'], 'bd_finished' => $LNG['bd_finished'], 'build' => $Queue, 'nivel' => $LNG['bd_lvl'], 'raza_skin' => $skin_raza  )),
                        ));
                }
				
	if($USER['raza'] == 0) {
		$skin_raza = "gultra";
		} elseif ($USER['raza'] == 1) {
		$skin_raza = "voltra";
		} 
	
   	if($PLANET['metal_mine'] > 0 and $PLANET['crystal_mine'] == 0 and $PLANET['deuterium_sintetizer'] == 0 and $PLANET['solar_plant'] == 0 ) {
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1.jpg\" />";
	}
	if($PLANET['metal_mine'] > 0 and $PLANET['crystal_mine'] > 0 and $PLANET['deuterium_sintetizer'] == 0 and $PLANET['solar_plant'] == 0 ) {
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_2.jpg\" />";
	}
	if($PLANET['metal_mine'] > 0 and $PLANET['crystal_mine'] > 0 and $PLANET['deuterium_sintetizer'] > 0 and $PLANET['solar_plant'] == 0 ) {
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_2_3.jpg\" />";
	}
	if($PLANET['metal_mine'] > 0 and $PLANET['crystal_mine'] > 0 and $PLANET['deuterium_sintetizer'] > 0 and $PLANET['solar_plant'] > 0) {
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_2_3_4.jpg\" />";
	}
	if($PLANET['metal_mine'] > 0 and $PLANET['crystal_mine'] > 0 and $PLANET['solar_plant'] > 0 and $PLANET['deuterium_sintetizer'] == 0 ) {
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_2_4.jpg\" />";
	}
	if ( $PLANET['metal_mine'] > 0 and $PLANET['deuterium_sintetizer'] > 0 and $PLANET['solar_plant'] == 0 and $PLANET['crystal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_3.jpg\" />";
	}	
	if ( $PLANET['metal_mine'] > 0 and $PLANET['deuterium_sintetizer'] > 0 and $PLANET['solar_plant'] > 0 and $PLANET['crystal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_3_4.jpg\" />";
	}		
	if ( $PLANET['metal_mine'] > 0 and $PLANET['solar_plant'] > 0 and $PLANET['crystal_mine'] == 0 and $PLANET['deuterium_sintetizer'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/1_4.jpg\" />";
	}
	if ( $PLANET['crystal_mine'] > 0 and $PLANET['metal_mine'] == 0 and $PLANET['solar_plant'] == 0 and $PLANET['deuterium_sintetizer'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/2.jpg\" />";
	}
	if ( $PLANET['crystal_mine'] > 0 and $PLANET['deuterium_sintetizer'] > 0 and $PLANET['metal_mine'] == 0 and $PLANET['solar_plant'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/2_3.jpg\" />";
	}	
	if ( $PLANET['crystal_mine'] > 0 and $PLANET['deuterium_sintetizer'] > 0 and $PLANET['solar_plant'] > 0 and $PLANET['metal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/2_3_4.jpg\" />";
	}	
	if ( $PLANET['crystal_mine'] > 0 and $PLANET['solar_plant'] > 0 and $PLANET['deuterium_sintetizer'] == 0 and $PLANET['metal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/2_4.jpg\" />";
	}
	if ( $PLANET['deuterium_sintetizer'] > 0 and $PLANET['crystal_mine'] == 0 and $PLANET['solar_plant'] == 0 and $PLANET['metal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/3.jpg\" />";
	}		
	if ( $PLANET['deuterium_sintetizer'] > 0 and $PLANET['solar_plant'] > 0 and $PLANET['crystal_mine'] == 0 and $PLANET['metal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/3_4.jpg\" />";
	}
	if ( $PLANET['solar_plant'] > 0 and $PLANET['crystal_mine'] == 0 and $PLANET['deuterium_sintetizer'] == 0 and $PLANET['metal_mine'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/4.jpg\" />";
	}		
	if ( $PLANET['metal_mine'] == 0 and $PLANET['solar_plant'] == 0 and $PLANET['crystal_mine'] == 0 and $PLANET['deuterium_sintetizer'] == 0) { 
		$header_planeta = "<img src=\"styles/theme/" .$skin_raza ."/adds/recursos/default.jpg\" />";
	}
                $template->assign_vars(array(
                        'BuildInfoList'                 => $BuildInfoList,
                        'bd_lvl'                                => $LNG['bd_lvl'],
                        'bd_next_level'                 => $LNG['bd_next_level'],
                        'Metal'                                 => $LNG['Metal'],
                        'Crystal'                               => $LNG['Crystal'],
                        'Deuterium'                             => $LNG['Deuterium'],
                        'Norio'                                 => $LNG['Norio'],
                        'Darkmatter'                    => $LNG['Darkmatter'],
                        'bd_dismantle'                  => $LNG['bd_dismantle'],
                        'planetname'                            => $PLANET['name'],
                        'fgf_time'                              => $LNG['fgf_time'],
                        'bd_remaining'                  => $LNG['bd_remaining'],
                        'bd_jump_gate_action'   => $LNG['bd_jump_gate_action'],
                        'bd_price_for_destroy'  => $LNG['bd_price_for_destroy'],
                        'bd_destroy_time'               => $LNG['bd_destroy_time'],
						'header'								=> $header_planeta,
                ));
                        
                $template->show("construibles/buildings_overview.tpl");
        }
}
?>