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