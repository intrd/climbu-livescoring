<?php
/**
 * ClimbU - Dynamic and open source live scoring for competitions
 * 
* @package climbu-livescoring
* @version 2.0
* @category system
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* license: Creative Commons Attribution-ShareAlike 4.0 International License - http://creativecommons.org/licenses/by-sa/4.0/
* @link https://github.com/intrd/climbu-livescoring/
* Dependencies: 
* 	https://github.com/intrd/php-adminer/
* 	https://github.com/intrd/php-common/
* 	https://github.com/intrd/sqlite-dbintrd/
* 	https://github.com/intrd/php-mcrypt256CBC/
*/

include("config.php");
require_once($ext_path."php-mcrypt256CBC/functions.php");

$users["intrd"]="meuovo123!";


foreach ($users as $u=>$p){
	$password=$u."|:|".$p;
	$upassword=mc_encrypt($password);
	echo "$password => $upassword\n";
}
?>