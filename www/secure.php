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

/*add this to restricted pages 
if($levels!=1){
    die("Error: security.");
}*/
include("../config.php");
use php\mcrypt256cbc as cry;
use php\intrdCommons as i;

$levels=0;
$account="account";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_COOKIE["userdata"]) and !isset($_SESSION["userdata"])){
    $_SESSION["userdata"]=$_COOKIE["userdata"];
}

if (isset($_SESSION["userdata"])){
    $userdata = json_decode(cry::mc_decrypt($_SESSION["userdata"],ENCRYPTION_KEY));
    //vd($userdata);
    if (isset($userdata->levels)){
        $levels=$userdata->levels;
        $account=$userdata->username;
        $client=$account;
        i::fwrite_a($viewlog,"&nbsp;&nbsp;&nbsp;&nbsp; >> [".date('Y-m-d h:i:s')."] $account - Action: ".$_SERVER['REMOTE_ADDR']."@".$_SERVER['PHP_SELF']."<br>\n");

        
    }else{
    	die("Error: Security error 332, please relogin...");
    }
}




?>