<?php 
/**
 * ClimbU - Dynamic and open source live scoring for competitions
 * 
* @package climbu-livescoring
* @version 2.0
* @link https://github.com/intrd/climbu-livescoring/
* @category system
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* @license Creative Commons Attribution-ShareAlike 4.0 International License - http://creativecommons.org/licenses/by-sa/4.0/
* Dependencies: 
* 	https://github.com/intrd/php-adminer/
* 	https://github.com/intrd/php-common/
* 	https://github.com/intrd/sqlite-dbintrd/
* 	https://github.com/intrd/php-mcrypt256CBC/
*/

ini_set('session.gc_maxlifetime', 172800);
session_set_cookie_params(172800);

//change this variables..
date_default_timezone_set('America/Sao_Paulo'); //set your timezone
$debug=false; //for sql debugging
$homehost="192.168.0.100"; //change to local network address
$viewlog="viewlog.html"; //www logfile
$admin="intrd"; //admin username
$score_title="Maratona de boulder CTF (ED. 2016)"; //set your score display title
$navbar_title="Placar (CT Ferragut)"; //set your navbar display title
if (!defined('ENCRYPTION_KEY')) define('ENCRYPTION_KEY', "13678347678834841483847458183479"); //your privatekey to decrypt user DB passwords

$root=dirname(__FILE__)."/";
$ext_path=$root."../";
$tmp_path=$ext_path."TMP/";
$data_path=$ext_path."DATA/";

$db_path=$root."data/climbu-livescoring.dat";
$browser_agent="Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0";
if (isset($_SERVER['REMOTE_ADDR']) and $_SERVER['REMOTE_ADDR']=="127.0.0.1") $homehost="localhost:90";
$homeurl="http://$homehost";
$cookie=$tmp_path."cookie_climbu"; 

//$language = "pt_BR.UTF-8";
$language = "en_US.UTF-8";
if (isset($_COOKIE["userdata"]) ){
	require_once($ext_path."php-mcrypt256CBC/functions.php");
	$userdata = json_decode(mc_decrypt($_COOKIE["userdata"]));
	if (isset($userdata->language)) $language = $userdata->language;
}
putenv("LANG=" . $language); 
setlocale(LC_ALL, $language);
$domain = "default";
bindtextdomain($domain, $root."langs"); 
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);

include_once("classes.php");
include_once("functions.php");



?>
