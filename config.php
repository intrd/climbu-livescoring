<?php 
/**
 * The ClimbU Livescoring is a multiplatform application that allows anyone to manage/display real-time scores. Originally developed for climbing competition(marathon) but can be easily adapted to other sports, other formats.
* 
* @package intrd/climbu-livescoring
* @version 3.0
* @tags competition, score, display, php, climbing, ranking
* @link http://github.com/intrd/climbu-livescoring
* @author intrd (Danilo Salles) - http://dann.com.br
* @copyright (CC-BY-SA-4.0) 2016, intrd
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0
* Dependencies: 
* - php >=5.3.0
* - intrd/php-common >=1.0.x-dev <dev-master
* - intrd/sqlite-dbintrd >=1.0.x-dev <dev-master
* - intrd/php-mcrypt256CBC >=1.0.x-dev <dev-master
*** @docbloc 1.1 */

require __DIR__ . '/vendor/autoload.php';
use php\mcrypt256cbc as cry;

ini_set('session.gc_maxlifetime', 172800);
session_set_cookie_params(172800);

date_default_timezone_set('America/Sao_Paulo'); //set your timezone
$debug=false; //enable sql debugging
if (!defined('ENCRYPTION_KEY')) define('ENCRYPTION_KEY', "13678347678834841483847458183479"); //your privatekey to decrypt user DB passwords

$root=dirname(__FILE__)."/";
$tmp_path=$root."TMP/";
$data_path=$root."DATA/";
$log_path=$root."LOG/";

$db_path=$data_path."climbu-livescoring.dat";
$viewlog=$log_path."viewlog.html"; //www logfile
$cookie=$tmp_path."cookie_climbu"; 
$browser_agent="Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0";

//$language = "pt_BR.UTF-8";
$language = "en_US.UTF-8";
if (isset($_COOKIE["userdata"]) ){
	$userdata = json_decode(cry::mc_decrypt($_COOKIE["userdata"], ENCRYPTION_KEY));
	if (isset($userdata->language)) $language = $userdata->language;
}
putenv("LANG=" . $language); 
setlocale(LC_ALL, $language);
$domain = "default";
bindtextdomain($domain, $root."langs"); 
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);

?>
