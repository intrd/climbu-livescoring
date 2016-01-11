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
<div class="modal-header"> 
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>     
    <h4 class="modal-title">Login</h4>
</div> 
<div class="modal-body"> 
    <div class="te">
        <form role="form" name="login_form" id="login_form">
            <div class="form-group">
                <label class="control-label" for="exampleInputUsername"><?php echo _("Username"); ?></label>
                <input name="username" class="form-control" id="exampleInputUsername" placeholder="Enter" type="username">
            </div>
            <div class="form-group">
                <label class="control-label" for="exampleInputPassword1"><?php echo _("Password"); ?></label>
                <input name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" type="password">
            </div>
            <div class="result"></div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>     
</div> 
<div class="modal-footer"> 
    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("Close"); ?></button>     
</div>
<script>
    $( "form#login_form" ).submit(function( event ) {
        event.preventDefault();
        var datas = $(this).serialize();
        //alert(datas);
        $.ajax({
          type: "POST",
          url: "ajax_login.php",
          data: datas,
          success: function(data){
            $( ".result" ).html( data );
          }
        });
    });
</script>