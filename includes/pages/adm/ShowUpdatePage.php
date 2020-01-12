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
set_time_limit(0);

function exitupdate($LOG){
	$Page	= "";
	if(is_array($LOG['debug'])) {
		foreach($LOG['debug'] as $key => $content) {
			$Page .= $content."<br>";
		}
	}
	
	if(is_array($LOG['update'])) {
		foreach($LOG['update'] as $rev => $content) {
			foreach($content as $file => $status) {
				$Page.= "File ".$file." (Rev. ".$rev."): ".$status."<br>";
			}
		}
	}
		
	if(is_array($LOG['finish'])) {	
		foreach($LOG['finish'] as $key => $content) {
			$Page .= $content."<br>";
		}
	}
	$Page .= "<br><a href='?page=update'>".$LNG['up_weiter']."</a>";

	$template = new template();
	$template->message($Page, false, 0, true);
				
	exit;
}

function getDatafromServer($action)
{
	global $LNG;
	if(!function_exists('ftp_connect'))
		return "Update function not on this Server avalible!";
	
	$Patchlevel	= explode(".",$GLOBALS['CONF']['VERSION']);
	if($_REQUEST['action'] == 'history')
		$Level		= 0;	
	elseif(isset($Patchlevel[2]))
		$Level		= $Patchlevel[2];
	else
		$Level		= 1060;
		
	if(function_exists('curl_init')) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://2moons.cc/update/index.php?action=".$action);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Patchlevel: ".$Level));
		curl_setopt($ch, CURLOPT_USERAGENT, "2Moons Update API (r".$Patchlevel[2].")");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$DATA	=	curl_exec($ch);
		$info = curl_getinfo($ch);
		if($info['http_code'] != 200)
			return "UpdateServer not avalible HTTP Code: ".$info['http_code'];

		curl_close($ch);
		return unserialize($DATA);
	} elseif(function_exists('fsockopen')) {
		$fp = @fsockopen("2moons.cc", 80, $errno, $errstr, 30);
		if (!$fp) {
			return "Can't create fsockopen Session (Error: ".$errstr.")";
		} else {
			$DATA	= "";
			$out 	= "GET /update/index.php?action=".$action." HTTP/1.1\r\n";
			$out 	.= "Host: 2moons.cc\r\n";
			$out 	.= "Patchlevel: ".$Level."\r\n";
			$out 	.= "User-Agent: 2Moons Update API (r".$Patchlevel[2].")\r\n";
			$out 	.= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			while ($line = fgets($fp)) $DATA .= $line; 
			fclose($fp);
			$DATA 	= substr($DATA, strpos($DATA, "\r\n\r\n") + 4);	
			return unserialize($DATA);
		}
	} elseif(function_exists('file_get_contents') && ini_get('allow_url_fopen') == 1) {
		$opts 			= array('http' => array('method'=> "GET", 'header'=> "Patchlevel: ".$Level."\r\nUser-Agent: 2Moons Update API (r".$Patchlevel[2].")\r\n"));
		$context 		= stream_context_create($opts);
		ob_start();
		echo file_get_contents("http://2moons.cc/update/index.php?action=".$action, FALSE, $context);
		$Data 	= ob_get_clean();
		if(false === ($DATA = unserialize($Data)))
			return $LNG['up_update_server']."<br>".substr(strip_tags($Data), strpos(strip_tags($Data), 'failed to open stream: ') + 23);
		else
			return $DATA;
	} else {
		return "Update function not on this Server avalible!";
	}

}

function ShowUpdatePage()
{
	global $LNG, $CONF, $db;
	if(isset($_REQUEST['version']))
	{
		$Temp	= explode('.', $_REQUEST['version']);
		$Temp	= array_map('intval', $Temp);
		update_config(array('VERSION' => $Temp[0].'.'.$Temp[1].'.'.$Temp[2]), true);
	}
	
	$Patchlevel	= explode(".",$GLOBALS['CONF']['VERSION']);
	if($_REQUEST['action'] == 'history')
		$Level		= 0;	
	elseif(isset($Patchlevel[2]))
		$Level		= $Patchlevel[2];
			
	switch($_REQUEST['action'])
	{
		case "download":
			$UpdateArray 	= getDatafromServer('getupdate');
			if(!is_array($UpdateArray['revs']))
				exitupdate(array('debug' => array('noupdate' => $LNG['up_kein_update'])));

			require_once(ROOT_PATH.'includes/libs/zip/zip.lib.php');				
			$SVN_ROOT		= $UpdateArray['info']['svn'];
			
			$zipfile 	= new zipfile();
			$TodoDelete	= "";
			$Files		= array('add' => array(), 'edit' => array(), 'del' => array());
			$FirstRev	= 0;
			$LastRev	= 0;
			foreach($UpdateArray['revs'] as $Rev => $RevInfo) 
			{
				if(!empty($RevInfo['add']))
				{
					foreach($RevInfo['add'] as $File)
					{	
						if(in_array($File, $Files['add']) || strpos($File, '.') === false)
							continue;
							
						$Files['add'][] = $File;
						
						$zipfile->addFile(@file_get_contents($SVN_ROOT.$File), str_replace("/trunk/", "", $File), $RevInfo['timestamp']);					
					}
				}
				if(!empty($RevInfo['edit']))
				{
					foreach($RevInfo['edit'] as $File)
					{	
						if(in_array($File, $Files['edit']) || strpos($File, '.') === false) 
							continue;
							
							$Files['edit'][] = $File;
							
							$zipfile->addFile(@file_get_contents($SVN_ROOT.$File), str_replace("/trunk/", "", $File), $RevInfo['timestamp']);
						
					}
				}
				if(!empty($RevInfo['del']))
				{
					foreach($RevInfo['del'] as $File)
					{
						if(in_array($File, $Files['del']) || strpos($File, '.') === false)
							continue;
						$Files['del'][] = $File;

						$TodoDelete	.= str_replace("/trunk/", "", $File)."\r\n";
					}
				}
				if($FirstRev === 0)
					$FirstRev = $Rev;
					
				$LastRev = $Rev;
			}	
			
			if(!empty($TodoDelete))
				$zipfile->addFile($TodoDelete, "!TodoDelete!.txt", $RevInfo['timestamp']);
			
			update_config(array('VERSION' => $Patchlevel[0].".".$Patchlevel[1].".".$LastRev), true);
			// Header f�r Download senden
			$File	= $zipfile->file(); 		
			header("Content-length: ".strlen($File));
			header("Content-Type: application/force-download");
			header('Content-Disposition: attachment; filename="patch_'.$FirstRev.'_to_'.$LastRev.'.zip"');
			header("Content-Transfer-Encoding: binary");

			// Zip File senden
			echo $File; 
			exit;			
		break;
		case "update":
			require_once(ROOT_PATH.'includes/libs/ftp/ftp.class.php');
			require_once(ROOT_PATH.'includes/libs/ftp/ftpexception.class.php');
			$UpdateArray 	= getDatafromServer('getupdate');
			if(!is_array($UpdateArray['revs']))
				exitupdate(array('debug' => array('noupdate' => $LNG['up_kein_update'])));
				
			$SVN_ROOT		= $UpdateArray['info']['svn'];
			$CONFIG 		= array("host" => $CONF['ftp_server'], "username" => $CONF['ftp_user_name'], "password" => $_POST['password'], "port" => 21); 
			try
			{
				$ftp = FTP::getInstance(); 
				$ftp->connect($CONFIG);
				$LOG['debug']['connect']	= $LNG['up_ftp_ok'];
			}
			catch (FTPException $error)
			{
				$LOG['debug']['connect']	= $LNG['up_ftp_error']."".$error->getMessage();
				exitupdate($LOG);
			}	
						
			if($ftp->changeDir($CONF['ftp_root_path']))
			{
				$LOG['debug']['chdir']	= $LNG['up_ftp_change']."".$CONF['ftp_root_path']."): ".$LNG['up_ftp_ok'];
			}
			else
			{
				$LOG['debug']['chdir']	= $LNG['up_ftp_change']."".$CONF['ftp_root_path']."): ".$LNG['up_ftp_change_error'];
				exitupdate($LOG);
			}
			$Files	= array('add' => array(), 'edit' => array(), 'del' => array());
			$Check	= 0;
			foreach($UpdateArray['revs'] as $Rev => $RevInfo) 
			{
				if($Check === 0)
				{
					$Check = 1;
					if($Rev - 1 != $Level) {
						$LOG['debug']['rev']	= "UpdateServer requrie Revision ".($Rev - 1).".";
						exitupdate($LOG);
					}
				}
				
				if(!empty($RevInfo['add']))
				{
					foreach($RevInfo['add'] as $File)
					{
						if(in_array($File, $Files['add']))
							continue;	
						$Files['add'][] = $File;
						if($File == "/trunk/updates/update_".$Rev.".sql") {
							$db->multi_query(str_replace("prefix_", DB_PREFIX, @file_get_contents($SVN_ROOT.$File)));
							continue;
						} elseif($File == "/trunk/updates/update_".$Rev.".php") {
							require($SVN_ROOT.$File);
						} else {
							if (strpos($File, '.') !== false) {		
								$Data = fopen($SVN_ROOT.$File, "r");
								if ($ftp->uploadFromFile($Data, str_replace("/trunk/", "", $File))) {
									$LOG['update'][$Rev][$File]	= $LNG['up_ok_update'];

								} else {
									$LOG['update'][$Rev][$File]	= $LNG['up_error_update'];
								}
								fclose($Data);
							} else {
								if ($ftp->makeDir(str_replace("/trunk/", "", $File), 1)) {
									if(PHP_SAPI == 'apache2handler')
										$ftp->chmod(str_replace("/trunk/", "", $File), '0777');
									else
										$ftp->chmod(str_replace("/trunk/", "", $File), '0755');
										
									$LOG['update'][$Rev][$File]	= $LNG['up_ok_update'];
								} else {
									$LOG['update'][$Rev][$File]	= $LNG['up_error_update'];
								}				
							}
						}
					}
				}
				if(!empty($RevInfo['edit']))
				{
					foreach($RevInfo['edit'] as $File)
					{	
						if(in_array($File, $Files['edit']))
							continue;
						$Files['edit'][] = $File;
						if (strpos($File, '.') !== false) {
							if($File == "/trunk/updates/update_".$Rev.".sql")
							{
								$db->multi_query(str_replace("prefix_", DB_PREFIX, @file_get_contents($SVN_ROOT.$File)));
								continue;
							} else {
								$Data = fopen($SVN_ROOT.$File, "r");
								if ($ftp->uploadFromFile($Data, str_replace("/trunk/", "", $File))) {
									$LOG['update'][$Rev][$File]	= $LNG['up_ok_update'];
								} else {
									$LOG['update'][$Rev][$File]	= $LNG['up_error_update'];
								}
								fclose($Data);
							}
						}
					}
				}
				if(!empty($RevInfo['del']))
				{
					foreach($RevInfo['del'] as $File)
					{
						if(in_array($File, $Files['del']))
							continue;
							
						$Files['del'][] = $File;
						if (strpos($File, '.') !== false) {
							if ($ftp->delete(str_replace("/trunk/", "", $File))) {
								$LOG['update'][$Rev][$File]	= $LNG['up_delete_file'];
							} else {
								$LOG['update'][$Rev][$File]	= $LNG['up_error_delete_file'];
							}
						} else {
							if ($ftp->removeDir(str_replace("/trunk/", "", $File), 1 )) {
								$LOG['update'][$Rev][$File]	= $LNG['up_delete_file'];
							} else {
								$LOG['update'][$Rev][$File]	= $LNG['up_error_delete_file'];
							}						
						}
					}
				}
				$LastRev = $Rev;
			}
			$LOG['finish']['atrev'] = $LNG['up_update_ok_rev']." ".$LastRev;
			// Verbindung schlie�en
			ClearCache();
			update_config(array('VERSION' => $Patchlevel[0].".".$Patchlevel[1].".".$LastRev), true);
			exitupdate($LOG);
		break;
		default:
			$template 	= new template();
			
			$RevList	= '';
			$Update		= '';
			$Info		= '';
			
			$UpdateArray	= getDatafromServer('update');
			if(!is_array($UpdateArray)) {
				$template->message($UpdateArray);
			} else {
				if(is_array($UpdateArray['revs'])) {
					foreach($UpdateArray['revs'] as $Rev => $RevInfo) 
					{
						if(!(empty($RevInfo['add']) && empty($RevInfo['edit'])) && $Patchlevel[2] < $Rev){
							$Update		= "<tr><td><a href=\"#\" onclick=\"openPWDialog();return false;\">Update</a>".(function_exists('gzcompress') ? " - <a href=\"?page=update&amp;action=download\">".$LNG['up_download_patch_files']."</a>":"")."</td></tr>";
							$Info		= "<tr><th colspan=\"5\">".$LNG['up_aktuelle_updates']."</th></tr>";
						}
						
						$edit	= "";
						if(!empty($RevInfo['edit']) || is_array($RevInfo['edit'])){
							foreach($RevInfo['edit'] as $file) {							
								$edit	.= '<a href="http://code.google.com/p/2moons/source/diff?spec=svn'.$Rev.'&r='.$Rev.'&format=side&path='.$file.'" target="diff">'.str_replace("/trunk/", "", $file).'</a><br>';
							}
						}

						$RevList .= "<tr>
						".(($Patchlevel[2] == $Rev)?"<th colspan=5>".$LNG['up_momentane_version']."</th></tr><tr>":((($Patchlevel[2] - 1) == $Rev)?"<th colspan=5>".$LNG['up_alte_updates']."</th></tr><tr>":""))."
						<th>".(($Patchlevel[2] == $Rev)?"<font color=\"red\">":"")."".$LNG['up_revision']."" . $Rev . " ".date(TDFORMAT, $RevInfo['timestamp'])." ".$LNG['ml_from']." ".$RevInfo['author'].(($Patchlevel[2] == $Rev)?"</font>":"")."</th></tr>
						<tr><td>".makebr($RevInfo['log'])."</th></tr>
						".((!empty($RevInfo['add']))?"<tr><td>".$LNG['up_add']."<br>".str_replace("/trunk/", "", implode("<br>\n", $RevInfo['add']))."</b></td></tr>":"")."
						".((!empty($RevInfo['edit']))?"<tr><td>".$LNG['up_edit']."<br>".$edit."</b></td></tr>":"")."
						".((!empty($RevInfo['del']))?"<tr><td>".$LNG['up_del']."<br>".str_replace("/trunk/", "", implode("<br>\n", $RevInfo['del']))."</b></td></tr>":"")."
						</tr>";
					}
				}			
				$template->assign_vars(array(	
					'up_password_title'	=> $LNG['up_password_title'],
					'up_password_info'	=> $LNG['up_password_info'],
					'up_password_label'	=> $LNG['up_password_label'],
					'up_submit'			=> $LNG['up_submit'],
					'up_version'		=> $LNG['up_version'],
					'version'			=> $CONF['VERSION'],
					'RevList'			=> $RevList,
					'Update'			=> $Update,
					'Info'				=> $Info,
				));
					
				$template->show('adm/UpdatePage.tpl');
			}
		break;
	}
}
?>