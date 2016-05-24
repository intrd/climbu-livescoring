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

?>
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
    <div class="result"></div>
</div>
<script>
    $( "button#confirm_logout" ).click(function( event ) {
        event.preventDefault();
        $.ajax({
          type: "POST",
          url: "ajax_logout.php",
          success: function(data){
            $( ".result" ).html( data );
          }
        });
        
    });
</script>