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

include("../config.php");
include("secure.php");
if($levels!=1){
    die("Error: security.");
}
use php\intrdCommons as i;
use database\dbintrd as db;
use climbu\engine as cu;
//include($ext_path."php-simple_httpauth/index.php");

$id = $_REQUEST['id'];
$clientp = $_REQUEST['user'];
$top = $_REQUEST['top'];
//$clientp = "";
//vd($clientp);

if ($clientp!=$userdata->username){
	die("Security error, please relogin.");
}

// /vd($_POST);
 
if(!$id) {
	return false;
}

if($top==1){
	$topname="top";
	$stylecolor="red";
}else{
	$topname="attempt";
	$stylecolor="blue";
}

$usu=$userdata;
$sector=$usu->sector;

$athlete = new db('athletes',"filter:id='$id'",false); 
$athlete=$athlete->{0};
 
//$sector=3;
$sectordata=cu::get_sectordata($sector);
//vd($sectordata);
//die;

$sector=$sectordata["sector"];
$boulderdata=$sectordata["boulders"];

//vd($boulderdata[1]);
//die;

//sleep(5);
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title"><?php echo _("Registering top|attempt"); ?></span> @ <?php echo _("sector"); ?> <?php echo $sector->id; ?></h4>
</div>
<div class="modal-body">
	<form name="neworder" id="neworder">
		
		<h5 class="media-heading"><?php echo _("Referee"); ?>: <?php echo $usu->username; ?></h5>
		<h5 class="media-heading"><?php echo _("Athlete"); ?>: <?php echo ucfirst($athlete->name);?> (#<?php echo ucfirst($athlete->id);?>)</h5>

		<div class="btn-group" style="width:100%;" data-toggle="buttons">
		  <?php
		  //vd($boulderdata);
		  	$c=1;
			foreach ($boulderdata as $boulder){
				if ($c<=count($boulderdata)/2)
			  	echo'
				  <label class="btn btn-lg" style="width:20%;border:1px dotted;background-color:'.$boulder["color"].';">
				    <input type="radio" name="boulder" id="boulder'.$boulder["id"].'" value="'.$boulder["id"].'" autocomplete="off">'.strtoupper($boulder["letter"]).'
				  </label>
			  	';
			  	$c++;
			} 
			echo "</div><br>";
		echo '<div class="btn-group" style="width:100%;" data-toggle="buttons">';
		  	$c=1;
			foreach ($boulderdata as $boulder){
				if ($c>count($boulderdata)/2)
			  	echo'
				  <label class="btn btn-lg" style="width:20%;border:1px dotted;background-color:'.$boulder["color"].';">
				    <input type="radio" name="boulder" id="boulder'.$boulder["id"].'" value="'.$boulder["id"].'" autocomplete="off">'.strtoupper($boulder["letter"]).'
				  </label>
			  	';
			  	$c++;
			} 
		  ?>
		</div>
		<div class="checkbox">
		  <label><input name="ascent" type="radio" value="0"><?php echo ucfirst(_("attempt")); ?></label>
		</div>
		<div class="checkbox">
		  <label><input name="ascent" type="radio" value="1">Top</label>
		</div>

		<?php echo _("Date/time"); ?>: <?php echo date('d/m/Y h:i:s');?>

		<input type="hidden" name="athlete" value="<?php echo $athlete->name; ?>">
		<input type="hidden" name="datetime" value="<?php echo date('Y-m-d h:i:s'); ?>">
		<br>
		<div class="result"></div>
		<br>
		
		<button type="submit" class="btn btn-primary"><?php echo _("Register"); ?></button>
	</form>
</div>
<div class="modal-footer"> 
	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _("Fechar"); ?></button>     
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){	
		$(':radio').change(function () {
		        //$(':radio[name=' + this.name + ']').parent().removeClass('style1');
		        $(':radio[name=' + this.name + ']').parent().css("border","1px dotted");
		        $(':radio[id=' + this.id + ']').parent().css("border","2px solid");
		});

	});
</script>

<style>
.style1 {
    border: yellow;
}
</style>

<script>
    $( "form#neworder" ).submit(function( event ) {
        event.preventDefault();
        var datas = $(this).serialize();
        //alert(datas);
        $.ajax({
          type: "POST",
          url: "ajax_attempt.php",
          data: datas,
          success: function(data){
            $( ".result" ).html( data );
          }
        });
    });
</script>