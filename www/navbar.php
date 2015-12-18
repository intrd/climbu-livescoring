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

require_once("../config.php");

//$levels=1;

include("secure.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$yweek=date('W-Y', time());
$_SESSION["yweek"]=$yweek;

$hidden="style='display:block;'";
if (($levels)<1){
    $hidden="style='display:none;'";
}
$hidden_onlogged="style='display:block;'";
if (($levels)>=1){
    $hidden_onlogged="style='display:none;'";

    $usu=$userdata->username;
    $attempt_count = new data("attempts","all"); 
    $attempt_count = count((array)$attempt_count);
    //$top_count = new data("attempts","filter:user='$usu' and ascent='1'"); 
    //$top_count = count((array)$top_count);
    //$flash_count = new data("attempts","filter:user='$usu' and ascent='2'"); 
    //$flash_count = count((array)$flash_count);

}else{
}
?>
<!--
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
-->  
<script>
   
</script>
<div class="navbar-collapse collapse" >
    <ul id="nav2" class="nav navbar-nav navbar-right"> 
        <li>
            <a data-toggle="dropdown" href="#">
                <i class="et-down fa fa-child fa-lg"></i> <?php echo $account;?>  <b class="caret"></b>
            </a>             
            <ul class="dropdown-menu" role="menu">                 
                <li <?php echo $hidden_onlogged; ?>>
                    <a href="login.php" data-toggle="modal" data-target="#login">Login</a>
                </li>                                               
                <li <?php echo $hidden; ?> >
                    <a href="about.php" data-toggle="modal" data-target="#about"><?php echo _("About ClimbU"); ?></a>
                </li>
                <li <?php echo $hidden; ?> >
                    <a href="logout.php" data-toggle="modal" data-target="#logout">Logout</a>
                </li>
            </ul>             
        </li>
    </ul>
    <ul id="nav1" class="nav navbar-nav navbar-right">
        <li>
            <a id="aattempt" href="#attempt" data-toggle="tab" data-tab-always-refresh="true" data-tab-url="attempt.php" <?php echo $hidden; ?> ><i class="fa fa-check-square-o fa-fw fa-lg"></i> <?php echo _("register"); ?></a>
        </li>
        <li>
            <a href="#score" data-toggle="tab" data-tab-url="score.php" data-tab-always-refresh="true" style="display: block;"><i class="fa fa-pie-chart"></i> <?php echo _("score"); ?></a>
        </li>
        <li>
            <a href="#sectors" data-toggle="tab" data-tab-url="sectors.php" data-tab-always-refresh="true" style="display: block;"><i class="fa fa-tags"></i> <?php echo _("points"); ?></a>
        </li>
    </ul>
    <ul id="nav3" class="nav navbar-nav navbar-right" >
        <li>
            <a class="nav_spent" <?php echo $hidden; ?> >
                <?php echo "Total: ".$attempt_count;?></span>
            </a>
        </li>
    </ul>
</div>