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

include_once("../config.php");
use php\mcrypt256cbc as cry;
use database\dbintrd as db;
use php\intrdCommons as i;
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

$client=$_POST["username"];
$user = new db("users","filter:username|".$_POST["username"]); 
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
  $userdata = new db("users","filter:username='$client'",false); 
  $userdata = $userdata->{0};
  $userdata->levels=1;
  $userdata = cry::mc_encrypt(json_encode($userdata), ENCRYPTION_KEY);
  $_SESSION["userdata"]=$userdata;

  $yweek=date('W-Y', time());
  $_SESSION["yweek"]=$yweek;
  i::fwrite_a($viewlog,"&nbsp;&nbsp; @ [".date('Y-m-d h:i:s')."] $client - Logged: ".$_SERVER['REMOTE_ADDR']."@".$_SERVER['PHP_SELF']."<br>\n");

  setcookie("userdata", $_SESSION["userdata"]);
}
//vd($results);

echo '
  <div class="result alert alert-success" data-pg-id="159"> 
    <strong data-pg-id="160">Well done!</strong> user logged.        
  </div>
  <script>
    window.location.replace("/#attempt");
    location.reload();
  </script>
';
//echo '<script>window.location.reload(true);</script>';

/*echo'
  <div class="result alert alert-success" data-pg-id="159"> 
      <strong data-pg-id="160">Well done!</strong> user logged.        
  </div>
  <script>
    window.location.replace("/#score");
    location.reload();
  </script>
';*/
?>