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
 
function ShowLoginPage()
{
	global $USER, $LNG;
	if(isset($_REQUEST['admin_pw']) && md5($_REQUEST['admin_pw']) == $USER['password']) {
		$_SESSION['admin_login']	= md5($_REQUEST['admin_pw']);
		redirectTo('admin.php');
	}

	$template	= new template();

	$template->assign_vars(array(	
		'adm_login'			=> $LNG['adm_login'],
		'adm_password'			=> $LNG['adm_password'],
		'adm_absenden'			=> $LNG['adm_absenden'],
	));
	$template->show('adm/LoginPage.tpl');
}
?>