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

?>
<!--
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
-->
<div class="modal-header"> 
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>     
    <h4 class="modal-title">Logout</h4>
</div> 
<div class="modal-body"> 
    <div class="te">
        <?php echo _("Do you really want to exit?"); ?>
    </div>     
</div> 
<div class="modal-footer"> 
    <button id="confirm_logout" name="confirm_logout" type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>   
    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>     
</div>
<script>
    $( "button#confirm_logout" ).click(function( event ) {
        event.preventDefault();
		$.post("ajax_logout.php", {"can_logout" : true}, function(data){
		   if(data.can_logout)
		      window.location.replace("/#home");
   	   		  location.reload();
                window.location.replace("/#home");
                location.reload();
		}, "json");
    });
</script>