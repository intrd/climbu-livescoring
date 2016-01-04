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

include_once("../config.php");

//sleep(3);

//$_POST=db_clean_sqli($_POST);

if (strlen($_POST['password']) < 3){
    echo'
        <div class="result alert alert-danger" data-pg-id="159"> 
             <strong data-pg-id="160">Invalid data!</strong> check email format, or your password is too short.        
         </div>
    ';
    die;
}

require_once($ext_path."php-mcrypt256CBC/functions.php");

$client=$_POST["username"];
$user = new data("users","filter:username|".$_POST["username"]); 
if(count((array)$user)==1){
  $user = reset($user); 

  $password=$_POST["password"];
  $upassword=$user->password;
  
  /* for crypdb */
  //$password=$_POST["username"]."|:|".$_POST["password"];
  //$upassword=mc_decrypt($user->password);
  
  if ($password!=$upassword){
    echo'
      <div class="result alert alert-danger" data-pg-id="159"> 
        <strong data-pg-id="160">Error!</strong> wrong password or invalid user.        
      </div>
    ';
    die;
  }
}else{
  echo'
    <div class="result alert alert-danger" data-pg-id="159"> 
      <strong data-pg-id="160">Error!</strong> wrong password or invalid user.        
    </div>
  ';
  die;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userdata'])){
  //$user->ip=$_SERVER['REMOTE_ADDR'];
  $userdata = new data("users","filter:username='$client'",false); 
  $userdata = $userdata->{0};
  $userdata->levels=1;
  $userdata = mc_encrypt(json_encode($userdata));
  $_SESSION["userdata"]=$userdata;

  $yweek=date('W-Y', time());
  $_SESSION["yweek"]=$yweek;
  fwrite_a($viewlog,"&nbsp;&nbsp; @ [".date('Y-m-d h:i:s')."] $client - Logged: ".$_SERVER['REMOTE_ADDR']."@".$_SERVER['PHP_SELF']."<br>\n");

  setcookie("userdata", $_SESSION["userdata"]);
}
//vd($results);

echo '<script>window.location.reload(true);</script>';

echo'
  <div class="result alert alert-success" data-pg-id="159"> 
      <strong data-pg-id="160">Well done!</strong> user logged.        
  </div>
  <script>
    window.location.replace("/#score");
    location.reload();
  </script>
';
?>