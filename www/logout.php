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
* @license Creative Commons Attribution-ShareAlike 4.0 - http://creativecommons.org/licenses/by-sa/4.0/
* Dependencies: Yes, details at README.md
*/

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