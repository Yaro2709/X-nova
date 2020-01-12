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

function ShowMessagesPage()
{
	global $USER, $PLANET, $CONF, $dpath, $LNG, $db, $UNI;

	$MessCategory  	= request_var('messcat',0);
	$MessPageMode  	= request_var('mode', '');
	$DeleteWhat    	= request_var('deletemessages','');
	$Send 		  	= request_var('send',0);
	$OwnerID       	= request_var('id', 0);
	$Subject 		= request_var('subject', '', true);
	
	$MessageType   	= array ( 0, 1, 2, 3, 4, 5, 15, 50, 99, 100, 999);
	$TitleColor    	= array ( 0 => '#FFFF00', 1 => '#FF6699', 2 => '#FF3300', 3 => '#FF9900', 4 => '#773399', 5 => '#009933', 15 => '#6495ed', 50 => '#666600', 99 => '#007070', 100 => '#ABABAB', 999 => '#CCCCCC');

	$template		= new template();
	
	switch ($MessPageMode)
	{
		case 'write':
			$template->isDialog(true);		
			$OwnerRecord = $db->uniquequery("SELECT a.galaxy, a.system, a.planet, b.username, b.id_planet FROM ".PLANETS." as a, ".USERS." as b WHERE b.id = '".$OwnerID."' AND a.id = b.id_planet;");

			if (!$OwnerRecord)
				#$template->message($LNG['mg_error'], false, 0, true);
				exit($LNG['mg_error']);
			
			if ($Send)
			{
				$Owner   = $OwnerID;
				$Message = makebr(request_var('text', '', true));
				$From    = $USER['username'].' ['.$USER['galaxy'].':'.$USER['system'].':'.$USER['planet'].']';
				
				/*if(connection_aborted())
					exit;
				SendSimpleMessage($OwnerID, $USER['id'], '', 1, $From, $Subject, $Message);*/
				$IsValid = $_SESSION['mestoken'] == $OwnerID;
 					unset($_SESSION['mestoken']);

 					if($IsValid) {
  						SendSimpleMessage($OwnerID, $USER['id'], TIMESTAMP, 1, $From, $Subject, $Message);	
 					}
				exit($LNG['mg_message_send']);
			}

			$_SESSION['mestoken']	= $OwnerID;
			$template->assign_vars(array(	
				'mg_send_new'	=> $LNG['mg_send_new'],
				'mg_send_to'	=> $LNG['mg_send_to'],
				'mg_send'		=> $LNG['mg_send'],
				'mg_message'	=> $LNG['mg_message'],
				'mg_characters'	=> $LNG['mg_characters'],
				'mg_subject'	=> $LNG['mg_subject'],
				'mg_empty_text'	=> $LNG['mg_empty_text'],
				'subject'		=> (empty($Subject)) ? $LNG['mg_no_subject'] : $Subject,
				'id'			=> $OwnerID,
				'username'		=> $OwnerRecord['username'],
				'galaxy'		=> $OwnerRecord['galaxy'],
				'system'		=> $OwnerRecord['system'],
				'planet'		=> $OwnerRecord['planet'],
			));
			
			$template->show("mensajes/message_send_form.tpl");		
		break;
		default:
			$PlanetRess = new ResourceUpdate();
			$PlanetRess->CalcResource();
			$PlanetRess->SavePlanetToDB();
			
			$template->loadscript('message.js');
			
			$db->query("UPDATE ".USERS." SET new_message=0 WHERE id= '".$USER['id']."';");
			$MessOut	= $db->countquery("SELECT COUNT(*) FROM ".MESSAGES." WHERE message_sender = '".$USER['id']."';");
			$OpsList	= array();
			$TotalMess	= array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 15 => 0, 50 => 0, 99 => 0, 100 => 0, 999 => 0);
			$UnRead		= array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 15 => 0, 50 => 0, 99 => 0, 100 => 0, 999 => 0);
			$GameOps 	= $db->query("SELECT `username`, `email` FROM ".USERS." WHERE `universe` = '".$UNI."' AND`authlevel` != '".AUTH_USR."' ORDER BY `username` ASC;");		
			while($Ops = $db->fetch_array($GameOps))
			{	
				$OpsList[]	= array(
					'username'	=> $Ops['username'],
					'email'		=> $Ops['email'],
				);
			}
			$db->free_result($GameOps);

			$UsrMess 	= $db->query("SELECT `message_type`, `message_unread` FROM ".MESSAGES." WHERE `message_owner` = '".$USER['id']."' OR `message_type` = '50';");	
			while ($CurMess = $db->fetch_array($UsrMess))
			{
				$UnRead[$CurMess['message_type']]		+= $CurMess['message_unread'];
				$TotalMess[$CurMess['message_type']]	+= 1;
			}
			
			$db->free_result($UsrMess);
			
			$UnRead[50]			+= $USER['new_gmessage'];
			$UnRead[100]		= is_array($UnRead) ? array_sum($UnRead) : 0;
			$TotalMess[100]		= is_array($TotalMess) ? (array_sum($TotalMess) - $TotalMess[50]) : 0;
			$TotalMess[999]		= $MessOut;
			
			
			foreach($TitleColor as $MessageID => $MessageColor) {
				$MessageList[$MessageID]	= array(
					'color'		=> $MessageColor,
					'unread'	=> !empty($UnRead[$MessageID]) ? $UnRead[$MessageID] : 0,
					'total'		=> !empty($TotalMess[$MessageID]) ? $TotalMess[$MessageID] : 0,
					'lang'		=> $LNG['mg_type'][$MessageID],
				);
			}
			
			$template->assign_vars(array(	
				'MessageList'		=> $MessageList,
				'OpsList'			=> $OpsList,
				'mg_overview'		=> $LNG['mg_overview'],
				'mg_game_operators'	=> $LNG['mg_game_operators'],
			));
			
			$template->show("mensajes/message_overview.tpl");
		break;
	}
}
?>