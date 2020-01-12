<?php
/**
 _  \_/ |\ | /¯¯\ \  / /\    |¯¯) |_¯ \  / /¯¯\ |  |   |´¯|¯` | /¯¯\ |\ |6
 ¯  /¯\ | \| \__/  \/ /--\   |¯¯\ |__  \/  \__/ |__ \_/   |   | \__/ | \|Core Redesigned.
 * @author: Copyright (C) 2011 by Brayan Narvaez (Prinick) developer of xNova Revolution
 * @author: Copyright (C) 2017 by Yamil Readigos Hurtado (YamilRH) <ireadigos@gmail.com> Redesigned of xNova Revolution 6.1
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

# Primero se define la constante de root
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
# Llamamos el archivo madre
include(ROOT_PATH . 'includes/common.php'); 

# Saqueamos la variable $CONF para ver sus contenidos
# Generada en common.php: $CONF = $db->uniquequery("SELECT HIGH_PRIORITY * FROM `".CONFIG."` WHERE `uni` = '".$UNI."';");
echo "Tenga en cuenta que el contenido se mostrara de acuerdo al usuario actual en sesi&oacute;n, pero es valido.<br /><hr />";
echo "<h3>Array \$CONF[]. </h3>";
foreach($CONF as $key => $conf) {
	echo "<b>Name:</b>	" .$key ." <b>Value:</b> " .$conf ."<br />";
}
echo "<hr />";

# Saqueamos la variable $USER para ver sus contenidos
# Generada en common.php: $USER	= $db->uniquequery("SELECT u.*, s.`total_points`, s.`total_rank` FROM ".USERS." as u LEFT JOIN ".STATPOINTS." as s ON s.`id_owner` = u.`id` AND s.`stat_type` = '1' WHERE u.`id` = '".$_SESSION['id']."';");
echo "<h3>Array \$USER[]. </h3>";
foreach($USER as $key => $conf) {
	echo "<b>Name:</b>	" .$key ." <b>Value:</b> " .$conf ."<br />";
}
echo "<hr />";

# Saqueamos la variable $PLANET para ver sus contenidos
# Es generada en common.php lo siguiente: $PLANET = $db->uniquequery("SELECT * FROM `".PLANETS."` WHERE `id` = '".$_SESSION['planet']."';");
echo "<h3>Array \$PLANET[]. </h3>";
foreach($PLANET as $key => $conf) {
	echo "<b>Name:</b>	" .$key ." <b>Value:</b> " .$conf ."<br />";
}
echo "<hr />";

# El elemento $db es un objeto y su valor proviene de includes/classes/class.MySQLi.php en donde se define la clase, se declara en common.php de la siguiente manera: $db 	= new DB_MySQLi();
?>