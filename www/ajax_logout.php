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
    /*echo'
      <div class="result alert alert-success" data-pg-id="159"> 
          <strong data-pg-id="160">THANK YOU!</strong>        
      </div>
      <script>
        window.location.replace("/#home");
        location.reload();
      </script>
    ';*/
}
?>