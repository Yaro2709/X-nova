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

if (!allowedTo(str_replace(array(dirname(__FILE__), '\\', '/', '.php'), '', __FILE__))) exit;

function ShowConfigPage()
{
	global $CONF, $LNG, $USER, $LANG;
	if (!empty($_POST))
	{
		$CONF['game_disable']			= isset($_POST['closed']) && $_POST['closed'] == 'on' ? 1 : 0;
		$CONF['noobprotection'] 		= isset($_POST['noobprotection']) && $_POST['noobprotection'] == 'on' ? 1 : 0;
		$CONF['debug'] 					= isset($_POST['debug']) && $_POST['debug'] == 'on' ? 1 : 0;
		$CONF['adm_attack'] 			= isset($_POST['adm_attack']) && $_POST['adm_attack'] == 'on' ? 1 : 0;		
		$CONF['OverviewNewsFrame']  	= isset($_POST['newsframe']) && $_POST['newsframe'] == 'on' ? 1 : 0;
		$CONF['capaktiv'] 				= isset($_POST['capaktiv']) && $_POST['capaktiv'] == 'on' ? 1 : 0;
		$CONF['reg_closed'] 			= isset($_POST['reg_closed']) && $_POST['reg_closed'] == 'on' ? 1 : 0;
		$CONF['user_valid']				= isset($_POST['user_valid']) && $_POST['user_valid'] == 'on' ? 1 : 0;
		$CONF['ga_active'] 				= isset($_POST['ga_active']) && $_POST['ga_active'] == 'on' ? 1 : 0;
		$CONF['bgm_active'] 			= isset($_POST['bgm_active']) && $_POST['bgm_active'] == 'on' ? 1 : 0;
		$CONF['mail_active'] 			= isset($_POST['mail_active']) && $_POST['mail_active'] == 'on' ? 1 : 0;
		
		$CONF['OverviewNewsText']		= $_POST['NewsText'];
		$CONF['close_reason']			= request_var('close_reason', '', true);
		$CONF['game_name']				= request_var('game_name', '', true);
		$CONF['uni_name']				= request_var('uni_name', '', true);
		$CONF['forum_url'] 				= request_var('forum_url', '', true);
		$CONF['game_speed'] 			= (2500 * request_var('game_speed', 0.0));
		$CONF['fleet_speed'] 			= (2500 * request_var('fleet_speed', 0.0));
		$CONF['resource_multiplier']	= request_var('resource_multiplier', 0.0);
		$CONF['halt_speed']				= request_var('halt_speed', 0.0);
		$CONF['initial_fields']			= request_var('initial_fields', 0);
		$CONF['metal_basic_income']		= request_var('metal_basic_income', 0);
		$CONF['crystal_basic_income']	= request_var('crystal_basic_income', 0);
		$CONF['deuterium_basic_income']	= request_var('deuterium_basic_income', 0);
		$CONF['norio_basic_income']	    = request_var('norio_basic_income', 0);		
		$CONF['lang']					= request_var('lang', '');
		$CONF['Defs_Cdr']				= request_var('Defs_Cdr', 0);
		$CONF['Fleet_Cdr']				= request_var('Fleet_Cdr', 0);
		$CONF['noobprotectiontime']		= request_var('noobprotectiontime', 0);
		$CONF['noobprotectionmulti']	= request_var('noobprotectionmulti', 0);
		$CONF['min_build_time']			= request_var('min_build_time', 0);
		$CONF['ga_key']					= request_var('ga_key', '', true);
		$CONF['bgm_file']				= request_var('bgm_file', '', true);
		$CONF['mail_use']				= request_var('mail_use', 0);
		$CONF['smail_path']				= request_var('smail_path', '');
		$CONF['smtp_host']				= request_var('smtp_host', '', true);
		$CONF['smtp_port']				= request_var('smtp_port', 0);
		$CONF['smtp_user']				= request_var('smtp_user', '', true);
		$CONF['smtp_sendmail']			= request_var('smtp_sendmail', '', true);
		$CONF['smtp_pass']				= request_var('smtp_pass', '', true);
		$CONF['smtp_ssl']				= request_var('smtp_ssl', '');
		$CONF['trade_allowed_ships']	= request_var('trade_allowed_ships', '');
		$CONF['trade_charge']			= request_var('trade_charge', 0.0);
		
		update_config(array(
			'noobprotectiontime'	=> $CONF['noobprotectiontime'],
			'noobprotectionmulti'	=> $CONF['noobprotectionmulti'],
			'noobprotection'		=> $CONF['noobprotection'],
			'Defs_Cdr'				=> $CONF['Defs_Cdr'],
			'Fleet_Cdr'				=> $CONF['Fleet_Cdr'],
			'game_disable'			=> $CONF['game_disable'],
			'close_reason'			=> $CONF['close_reason'],
			'OverviewNewsFrame'		=> $CONF['OverviewNewsFrame'],
			'reg_closed'			=> $CONF['reg_closed'],
			'OverviewNewsText'		=> $CONF['OverviewNewsText'],
			'game_name'				=> $CONF['game_name'],
			'uni_name'				=> $CONF['uni_name'],
			'forum_url'				=> $CONF['forum_url'],
			'game_speed'			=> $CONF['game_speed'],
			'fleet_speed'			=> $CONF['fleet_speed'],
			'resource_multiplier'	=> $CONF['resource_multiplier'],
			'halt_speed'			=> $CONF['halt_speed'],
			'initial_fields'		=> $CONF['initial_fields'],
			'metal_basic_income'	=> $CONF['metal_basic_income'],
			'crystal_basic_income'	=> $CONF['crystal_basic_income'],
			'deuterium_basic_income'=> $CONF['deuterium_basic_income'],
			'norio_basic_income'    => $CONF['norio_basic_income'],			
			'debug'					=> $CONF['debug'],
			'adm_attack'			=> $CONF['adm_attack'],
			'lang'					=> $CONF['lang'],
			'min_build_time'		=> $CONF['min_build_time'],
			'user_valid'			=> $CONF['user_valid'],
			'trade_charge'			=> $CONF['trade_charge'],
			'trade_allowed_ships'	=> $CONF['trade_allowed_ships']
		), false, $_SESSION['adminuni']);
		update_config(array(	
			'mail_active'			=> $CONF['mail_active'],
			'mail_use'				=> $CONF['mail_use'],
			'smail_path'			=> $CONF['smail_path'],
			'smtp_host'				=> $CONF['smtp_host'],
			'smtp_port'				=> $CONF['smtp_port'],
			'smtp_user'				=> $CONF['smtp_user'],
			'smtp_pass'				=> $CONF['smtp_pass'],
			'smtp_ssl'				=> $CONF['smtp_ssl'],
			'smtp_sendmail'			=> $CONF['smtp_sendmail'],
			'ga_active'				=> $CONF['ga_active'],
			'ga_key'				=> $CONF['ga_key'],
			'bgm_active'			=> $CONF['bgm_active'],
			'bgm_file'				=> $CONF['bgm_file'],
			'capaktiv'				=> $CONF['capaktiv'],
			'capprivate'			=> $CONF['capprivate'],
			'cappublic'				=> $CONF['cappublic'],
			'min_js'				=> $CONF['min_js']
		), true);
		
		if($CONF['adm_attack'] === 0) {
		@mysql_query("UPDATE ".USERS." SET `authattack` = '0' WHERE `uni` = '".$_SESSION['adminuni']."");
		}
	}
	
	$template	= new template();
	$template->assign_vars(array(
		'se_server_parameters'			=> $LNG['se_server_parameters'],
		'se_name'						=> $LNG['se_name'],
		'se_game_name'					=> $LNG['se_game_name'],
		'se_uni_name'					=> $LNG['se_uni_name'],
		'se_cookie_advert'				=> $LNG['se_cookie_advert'],
		'se_lang'						=> $LNG['se_lang'],
		'se_general_speed'				=> $LNG['se_general_speed'],
		'se_fleet_speed'				=> $LNG['se_fleet_speed'],
		'se_halt_speed'					=> $LNG['se_halt_speed'],
		'se_normal_speed'				=> $LNG['se_normal_speed'],
		'se_normal_speed_fleet'			=> $LNG['se_normal_speed_fleet'],
		'se_resources_producion_speed'	=> $LNG['se_resources_producion_speed'],
		'se_normal_speed_resoruces'		=> $LNG['se_normal_speed_resoruces'],
		'se_normal_speed_halt'			=> $LNG['se_normal_speed_halt'],
		'se_forum_link'					=> $LNG['se_forum_link'	],
		'se_server_op_close'			=> $LNG['se_server_op_close'],
		'se_server_status_message'		=> $LNG['se_server_status_message'],
		'se_server_planet_parameters'	=> $LNG['se_server_planet_parameters'],
		'se_initial_fields'				=> $LNG['se_initial_fields'],
		'se_metal_production'			=> $LNG['se_metal_production'],
		'se_admin_protection'			=> $LNG['se_admin_protection'],
		'se_crystal_production'			=> $LNG['se_crystal_production'],
		'se_deuterium_production'		=> $LNG['se_deuterium_production'],
		'se_norio_production'		    => $LNG['se_norio_production'],		
		'se_several_parameters'			=> $LNG['se_several_parameters'],
		'se_min_build_time'				=> $LNG['se_min_build_time'],
		'se_reg_closed'					=> $LNG['se_reg_closed'],
		'se_verfiy_mail'				=> $LNG['se_verfiy_mail'],
		'se_min_build_time_info'		=> $LNG['se_min_build_time_info'],
		'se_verfiy_mail_info'			=> $LNG['se_verfiy_mail_info'],
		'se_fields'						=> $LNG['se_fields'],
		'se_per_hour'					=> $LNG['se_per_hour'],
		'se_debug_mode'					=> $LNG['se_debug_mode'],
		'se_title_admins_protection'	=> $LNG['se_title_admins_protection'],
		'se_debug_message'				=> $LNG['se_debug_message'],
		'se_ships_cdr_message'			=> $LNG['se_ships_cdr_message'],
		'se_def_cdr_message'			=> $LNG['se_def_cdr_message'],
		'se_ships_cdr'					=> $LNG['se_ships_cdr'],
		'se_def_cdr'					=> $LNG['se_def_cdr'],
		'se_noob_protect'				=> $LNG['se_noob_protect'],
		'se_noob_protect3'				=> $LNG['se_noob_protect3'],
		'se_noob_protect2'				=> $LNG['se_noob_protect2'],
		'se_noob_protect_e2'			=> $LNG['se_noob_protect_e2'],
		'se_noob_protect_e3'			=> $LNG['se_noob_protect_e3'],
		'se_trader_head'				=> $LNG['se_trader_head'],
		'se_trader_ships'				=> $LNG['se_trader_ships'],
		'se_trader_charge'				=> $LNG['se_trader_charge'],
		'se_news_head'					=> $LNG['se_news_head'],
		'se_news_active'				=> $LNG['se_news_active'],
		'se_news_info'					=> $LNG['se_news_info'],
		'se_news'						=> $LNG['se_news'],
		'se_news_limit'					=> $LNG['se_news_limit'],
		'se_smtp'						=> $LNG['se_smtp'],
		'se_mail_active'				=> $LNG['se_mail_active'],
		'se_mail_use'					=> $LNG['se_mail_use'],
		'se_smail_path'					=> $LNG['se_smail_path'],
		'se_smtp_info'					=> $LNG['se_smtp_info'],
		'se_smtp_host'					=> $LNG['se_smtp_host'],
		'se_smtp_host_info'				=> $LNG['se_smtp_host_info'],
		'se_smtp_ssl'					=> $LNG['se_smtp_ssl'],
		'se_smtp_ssl_info'				=> $LNG['se_smtp_ssl_info'],
		'se_smtp_port'					=> $LNG['se_smtp_port'],
		'se_smtp_port_info'				=> $LNG['se_smtp_port_info'],
		'se_smtp_user'					=> $LNG['se_smtp_user'],
		'se_smtp_pass'					=> $LNG['se_smtp_pass'],
		'se_smtp_sendmail'				=> $LNG['se_smtp_sendmail'],
		'se_smtp_sendmail_info'			=> $LNG['se_smtp_sendmail_info'],
		'se_google'						=> $LNG['se_google'],
		'se_google_active'				=> $LNG['se_google_active'],
		'se_google_info'				=> $LNG['se_google_info'],
		'se_google_key'					=> $LNG['se_google_key'],
		'se_google_key_info'			=> $LNG['se_google_key_info'],
		'se_bgm_login'					=> $LNG['se_bgm_login'],
		'se_bgm_active'					=> $LNG['se_bgm_active'],
		'se_bgm_info'					=> $LNG['se_bgm_info'],
		'se_bgm_file'					=> $LNG['se_bgm_file'],
		'se_bgm_file_info'				=> $LNG['se_bgm_file_info'],
		'se_google_key_info'			=> $LNG['se_google_key_info'],
		'se_save_parameters'			=> $LNG['se_save_parameters'],
		'game_name'						=> $CONF['game_name'],
		'uni_name'						=> $CONF['uni_name'],
		'game_speed'					=> ($CONF['game_speed'] / 2500),
		'fleet_speed'					=> ($CONF['fleet_speed'] / 2500),
		'resource_multiplier'			=> $CONF['resource_multiplier'],
		'halt_speed'					=> $CONF['halt_speed'],
		'forum_url'						=> $CONF['forum_url'],
		'initial_fields'				=> $CONF['initial_fields'],
		'metal_basic_income'			=> $CONF['metal_basic_income'],
		'crystal_basic_income'			=> $CONF['crystal_basic_income'],
		'deuterium_basic_income'		=> $CONF['deuterium_basic_income'],
		'norio_basic_income'		    => $CONF['norio_basic_income'],		
		'game_disable'					=> $CONF['game_disable'],
		'close_reason'					=> $CONF['close_reason'],
		'debug'							=> $CONF['debug'],
		'adm_attack'					=> $CONF['adm_attack'],
		'defenses'						=> $CONF['Defs_Cdr'],
		'shiips'						=> $CONF['Fleet_Cdr'],
		'noobprot'						=> $CONF['noobprotection'],
		'noobprot2'						=> $CONF['noobprotectiontime'],
		'noobprot3'						=> $CONF['noobprotectionmulti'],
		'mail_active'					=> $CONF['mail_active'],
		'mail_use'						=> $CONF['mail_use'],
		'smail_path'					=> $CONF['smail_path'],
		'smtp_host' 					=> $CONF['smtp_host'],
		'smtp_port' 					=> $CONF['smtp_port'],
		'smtp_user' 					=> $CONF['smtp_user'],
		'smtp_pass' 					=> $CONF['smtp_pass'],
		'smtp_sendmail' 				=> $CONF['smtp_sendmail'],
		'smtp_ssl'						=> $CONF['smtp_ssl'],
		'user_valid'           	 		=> $CONF['user_valid'],
	    'newsframe'                 	=> $CONF['OverviewNewsFrame'],
        'reg_closed'                	=> $CONF['reg_closed'],
        'NewsTextVal'               	=> $CONF['OverviewNewsText'],  
		'capprivate' 					=> $CONF['capprivate'],
		'cappublic' 	   				=> $CONF['cappublic'],
		'capaktiv'      	           	=> $CONF['capaktiv'],
		'min_build_time'    	        => $CONF['min_build_time'],
	    'ga_active'               		=> $CONF['ga_active'],
		'ga_key'           				=> $CONF['ga_key'],
        'bgm_active'               		=> $CONF['bgm_active'],
		'bgm_file'           			=> $CONF['bgm_file'],
		'trade_allowed_ships'        	=> $CONF['trade_allowed_ships'],
		'trade_charge'		        	=> $CONF['trade_charge'],
		'Selector'						=> array('langs' => $LANG->getAllowedLangs(false), 'mail' => $LNG['se_mail_sel'], 'encry' => array('' => $LNG['se_smtp_ssl_1'], 'ssl' => $LNG['se_smtp_ssl_2'], 'tls' => $LNG['se_smtp_ssl_3'])),
		'lang'							=> $CONF['lang'],
	));
	
	$template->show('adm/ConfigBody.tpl');
}

?>