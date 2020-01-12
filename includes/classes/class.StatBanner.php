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

class StatBanner {

	private $textcolor = "00FFFF";
	private $source = "styles/images/banner.png";
	
	// Function to center text in the created banner
	private function CenterTextBanner($z,$y,$zone) {
		$a = strlen($z);
		$b = imagefontwidth($y);
		$c = $a*$b;
		$d = $zone-$c;
		$e = $d/2;
		return $e;
	}

	public function GetData($id)
	{
		global $db;
		return $db->uniquequery("SELECT a.username, b.build_points, b.fleet_points, b.defs_points, b.tech_points, b.total_points, b.total_rank, c.name, c.galaxy, c.system, c.planet, d.game_name, d.users_amount FROM ".USERS." as a, ".STATPOINTS." as b, ".PLANETS." as c ,".CONFIG." as d WHERE a.id = '".$id."' AND b.stat_type = '1' AND b.id_owner = '".$id."' AND c.id = a.id_planet AND d.uni = a.universe;");
	}

	public function CreateBanner($Query) {
		global $LNG;
		$image  = imagecreatefrompng($this->source);
		$date   = date(DATEFORMAT);

		// Variables
		$b_univ   = $Query['game_name'];
		$b_user   = $Query['username'];
		$b_planet = $Query['name'];
		$b_xyz    = "[".$Query['galaxy'].":".$Query['system'].":".$Query['planet']."]";
		$b_lvl    = $Query['total_rank']  ."/".$Query['users_amount'];
		$b_build  = $LNG['ub_buildings'].": ".shortly_number($Query['build_points']);
		$b_fleet  = $LNG['ub_fleets'].": ".shortly_number($Query['fleet_points']);
		$b_def    = $LNG['ub_defenses'] .": ".shortly_number($Query['defs_points']);
		$b_search = $LNG['ub_researh'] .": ".shortly_number($Query['tech_points']);
		$b_total  = $LNG['ub_points'] .": ".shortly_number($Query['total_points']);

		// Colors
		$red    = hexdec(substr($this->textcolor,0,2));
		$green  = hexdec(substr($this->textcolor,2,4));
		$blue   = hexdec(substr($this->textcolor,4,6));
		$select = imagecolorallocate($image,$red,$green,$blue);

		// Display
		// Univers name
		imagestring($image, 1, $this->CenterTextBanner($b_univ,1,653), 57, $b_univ, $select);
		// Today date
		imagestring($image, 1, $this->CenterTextBanner($date,1,653), 65, $date, $select);
		// Player name
		imagestring($image, 3, 15, 12, $b_user, $select);
		// Player b_planet
		imagestring($image, 3, 150, 12, $b_planet." ".$b_xyz, $select);
		// Player level
		imagestring($image, 10, $this->CenterTextBanner($b_lvl,10,795), 40, $b_lvl, $select);
		// Player stats
		imagestring($image, 2, 15,  30, $b_build,  $select);
		imagestring($image, 2, 15,  45, $b_fleet,  $select);
		imagestring($image, 2, 170, 30, $b_search, $select);
		imagestring($image, 2, 170, 45, $b_def,  $select);
		imagestring($image, 2, 15,  60, $b_total,  $select);

		// Creat and delete banner
		ImagePNG($image);
		imagedestroy($image);
	}
	
	public function CreateUTF8Banner($Query) {
		global $LNG, $LANG;
		$image  = imagecreatefrompng($this->source);
		$date   = date(DATEFORMAT);

		$Font	= ROOT_PATH.'styles/arial.ttf';
		// Variables
		$b_univ   = iconv("UTF-8", "koi8-r", $Query['game_name']);
		$b_user   = iconv("UTF-8", "koi8-r", $Query['username']);
		$b_planet = iconv("UTF-8", "koi8-r", $Query['name']);
		$b_xyz    = "[".$Query['galaxy'].":".$Query['system'].":".$Query['planet']."]";
		$b_lvl    = $Query['total_rank']  ."/".$Query['users_amount'];
		$b_build  = $LNG['ub_buildings'] .": ".shortly_number($Query['build_points']);
		$b_fleet  = $LNG['ub_fleets'] .": ".shortly_number($Query['fleet_points']);
		$b_def    = $LNG['ub_defenses'] .": ".shortly_number($Query['defs_points']);
		$b_search = $LNG['ub_researh'] .": ".shortly_number($Query['tech_points']);
		$b_total  = $LNG['ub_points'] .": ".shortly_number($Query['total_points']);


		// Colors
		$red    = hexdec(substr($this->textcolor,0,2));
		$green  = hexdec(substr($this->textcolor,2,4));
		$blue   = hexdec(substr($this->textcolor,4,6));
		$select = imagecolorallocate($image,$red,$green,$blue);

		// Display
        // Univers name
        imagettftext($image, 7, 0, $this->CenterTextBanner($b_univ, 1, 630), 65, $select, $Font, LanguageConv::ToCyrillic($b_univ));
        // Today date
        imagettftext($image, 7, 0, $this->CenterTextBanner($date, 1, 630), 75, $select, $Font, $date);
        // Player name
        imagettftext($image, 10, 0, 15, 18, $select, $Font, LanguageConv::ToCyrillic($b_user));
        // Player b_planet
        imagettftext($image, 10, 0, 150, 18, $select, $Font, LanguageConv::ToCyrillic($b_planet." ".$b_xyz));
        // Player level
        imagettftext($image, 14, 0, $this->CenterTextBanner($b_lvl,10,795), 46, $select, $Font, $b_lvl);
        // Player stats
        imagettftext($image, 10, 0, 15,  36, $select, $Font, LanguageConv::ToCyrillic($b_build));
        imagettftext($image, 10, 0, 15,  51, $select, $Font, LanguageConv::ToCyrillic($b_fleet));
        imagettftext($image, 10, 0, 230, 36, $select, $Font, LanguageConv::ToCyrillic($b_search));
        imagettftext($image, 10, 0, 230, 51, $select, $Font, LanguageConv::ToCyrillic($b_def));
        imagettftext($image, 10, 0, 15,  66, $select, $Font, LanguageConv::ToCyrillic($b_total));
		// Creat and delete banner
		ImagePNG($image);
		imagedestroy($image);
	}
}

class LanguageConv {

//  Translate iso encoding to unicode
    function iso2uni ($isoline) {
		$uniline	= '';
		for ($i=0; $i < strlen($isoline); $i++){
			$thischar=substr($isoline, $i, 1);
			$charcode=ord($thischar);
			$uniline.=($charcode>175) ? "&#" . (1040+($charcode-176)). ";" : $thischar;
		}
		return $uniline;
    }

    function ToCyrillic($aTxt) {
		if(false) {
			$aTxt = convert_cyr_string($aTxt,  "w",  "k"); 
		}
		$isostring = convert_cyr_string($aTxt,  "k",  "i");
		$unistring = LanguageConv::iso2uni($isostring);
		return $unistring;
    }
}
?>