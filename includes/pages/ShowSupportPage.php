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

class ShowSupportPage 
{
	public function ShowSupportPage()
	{
		$action 		= request_var('action', "");
		$id 			= request_var('id', 0);
		
		$PlanetRess = new ResourceUpdate();
		$PlanetRess->CalcResource();
		$PlanetRess->SavePlanetToDB();
		
		switch($action){
			case 'newticket':
				$this->CreaeTicket();
			break;
			case 'send':
				$this->UpdateTicket($id);
			break;
			default:
				$this->ShowSupportTickets();
			break;
		}
	}

	private function CreaeTicket()
	{
		global $USER, $UNI, $db, $LNG;
		
		$subject = request_var('subject','',true);
		$text 	 = makebr(request_var('text','',true));

		$template	= new template();
		
		#if(empty($text) || empty($subject)) {
		if(empty($text) || empty($subject) || $_SESSION['supptoken'] != $USER['id']) {
			$template->message($LNG['sendit_error_msg'], "game.php?page=support", 3);
			exit;
		}
		
		$SQL  = "INSERT ".SUPP." SET ";
		$SQL .= "`player_id` = '". $USER['id'] ."',";
		$SQL .= "`subject` = '". $db->sql_escape($subject) ."',";
		$SQL .= "`text` = '" .$db->sql_escape($text) ."',";
		$SQL .= "`time` = '". TIMESTAMP ."',";
		$SQL .= "`status` = '1',";
		$SQL .= "`universe` = '".$UNI."';";
		$db->query($SQL);
		
		$template->message($LNG['sendit_t'], "game.php?page=support", 3);
	}
	
	private function UpdateTicket($TicketID) 
	{
		global $USER, $db, $LNG;
		
		$text = request_var('text','',true);
		$template	= new template();	
		#if(empty($text))
		if(empty($text) || $_SESSION['supptoken'] != $USER['id'])
			exit($template->message($LNG['sendit_error_msg'],"game.php?page=support", 3));
		
		$ticket = $db->uniquequery("SELECT text FROM ".SUPP." WHERE `id` = '".$TicketID."';");

		$text 	= $ticket['text'].'<br><br><hr>'.$USER['username'].' schreib am '.date("d. M Y H:i:s", TIMESTAMP).'<br><br>'.makebr($text).'';
		$db->query("UPDATE ".SUPP." SET `text` = '".$db->sql_escape($text) ."',`status` = '3' WHERE `id` = '". $db->sql_escape($TicketID) ."';");
		$template->message($LNG['sendit_a'],"game.php?page=support", 3);
	}
	
	private function ShowSupportTickets()
	{
		global $USER, $PLANET, $db, $LNG;
				
		$query			= $db->query("SELECT ID,time,text,subject,status FROM ".SUPP." WHERE `player_id` = '".$USER['id']."';");
		$TicketsList	= array();
		while($ticket = $db->fetch_array($query)){	
			$TicketsList[$ticket['ID']]	= array(
				'status'	=> $ticket['status'],
				'subject'	=> $ticket['subject'],
				'date'		=> date(TDFORMAT,$ticket['time']),
				'text'		=> html_entity_decode($ticket['text'], ENT_NOQUOTES, "UTF-8"),
			);
		}

		$_SESSION['supptoken']	= $USER['id'];
		$db->free_result($query);
		$template	= new template();
		$template->loadscript('support.js');
		
		$template->assign_vars(array(	
			'TicketsList'			=> $TicketsList,
			'text'					=> $LNG['text'],
			'supp_header'			=> $LNG['supp_header'],
			'ticket_id'				=> $LNG['ticket_id'],
			'subject'				=> $LNG['subject'],
			'status'				=> $LNG['status'],
			'ticket_posted'			=> $LNG['ticket_posted'],
			'supp_send'				=> $LNG['supp_send'],
			'supp_close'			=> $LNG['supp_close'],
			'supp_open'				=> $LNG['supp_open'],
			'supp_admin_answer'		=> $LNG['supp_admin_answer'],
			'supp_player_answer'	=> $LNG['supp_player_answer'],
			'supp_ticket_close'		=> $LNG['supp_ticket_close'],	
			'subject'				=> $LNG['subject'],
			'status'				=> $LNG['status'],
			'ticket_new'			=> $LNG['ticket_new'],		
		));
			
		$template->show("support_overview.tpl");
	}
}
?>