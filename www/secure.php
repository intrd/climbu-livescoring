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
*   https://github.com/intrd/php-adminer/
*   https://github.com/intrd/php-common/
*   https://github.com/intrd/sqlite-dbintrd/
*   https://github.com/intrd/php-mcrypt256CBC/
*/

/*add this to restricted pages 
if($levels!=1){
    die("Error: security.");
}*/
include("../config.php");

$levels=0;
$account="account";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_COOKIE["userdata"]) and !isset($_SESSION["userdata"])){
    $_SESSION["userdata"]=$_COOKIE["userdata"];
}

if (isset($_SESSION["userdata"])){
    require_once($ext_path."php-mcrypt256CBC/functions.php");
    $userdata = json_decode(mc_decrypt($_SESSION["userdata"]));
    //vd($userdata);
    if (isset($userdata->levels)){
        $levels=$userdata->levels;
        $account=$userdata->username;
        $client=$account;
        fwrite_a($viewlog,"&nbsp;&nbsp;&nbsp;&nbsp; >> [".date('Y-m-d h:i:s')."] $account - Action: ".$_SERVER['REMOTE_ADDR']."@".$_SERVER['PHP_SELF']."<br>\n");

        
    }else{
    	die("Error: Security error 332, please relogin...");
    }
}




?>