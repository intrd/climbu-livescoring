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

include("secure.php");

$can_logout = true;

if($can_logout){
	setcookie ("userdata", "", time() - 3600);
    session_destroy();

    echo '
    <div class="result alert alert-success" data-pg-id="159"> 
          <strong data-pg-id="160">THANK YOU!</strong>        
    </div>
    <script>
      window.location.replace("/#score");
      window.location.reload(true);
    </script>
    ';
}
?>