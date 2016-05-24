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
use climbu\engine as cu;
use database\dbintrd as db;
//vd($_POST);


if (isset($_POST["boulder"])){

	$postdata=$_POST;
	$postdata["user"]=$userdata->username;
	$postdata["sector"]=$userdata->sector;

	if ( !is_numeric($postdata["boulder"]) or !is_numeric($postdata["ascent"]) ){
			echo"<span style='color:red;'>"._("<b>Error</b>: Problem, register again!")."</span>";
			die;
	}

	$bould=cu::get_boulder($postdata["sector"],$postdata["boulder"]);
	$postdata["boulder_letter"]=$bould["letter"];


	$attempt = new db("attempts"); //CREATE a fresh new object (table=users structure without data when second argument is null) 
	foreach ($postdata as $key=>$value){
		$attempt->$key=$value;
	}

	//vd($attempt);
	//die;

	//$checkdup_target_object=$attempt->target_object;
	$checkdup_datetime=$attempt->datetime;
	$checkdup_athlete=$attempt->athlete;
	$checkdup_sector=$attempt->sector;
	$checkdup = new db("attempts","filter:athlete='$checkdup_athlete' and datetime='$checkdup_datetime'"); 
	if (isset($checkdup->{0}->id)){
		echo"<span style='color:red;'>"._("<b>Error</b>: processing your request, duplicated.")."</span>";
		die;
	}

	$checkdup_boulder=$postdata["boulder"];
	$checkdup = new db("attempts","filter:athlete='$checkdup_athlete' and boulder='$checkdup_boulder' and ascent='1' and sector='$checkdup_sector' "); 
	if (isset($checkdup->{0}->id)){
		echo"<span style='color:red;'>"._("<b>Error</b>: this athlete already registered this ascent!")."</span>";
		die;
	}
	$checkdup = new db("attempts","filter:athlete='$checkdup_athlete' and boulder='$checkdup_boulder' and ascent='2' and sector='$checkdup_sector' "); 
	if (isset($checkdup->{0}->id)){
		echo"<span style='color:red;'>"._("<b>Error</b>: this athlete already flashed this boulder!")."</span>";
		die;
	}


	if ($postdata["ascent"]==1){
		$checkdup = new db("attempts","filter:athlete='$checkdup_athlete' and boulder='$checkdup_boulder' and ascent='0' and sector='$checkdup_sector'"); 
		if (!isset($checkdup->{0}->id)){
			$attempt->ascent=2;
		}
	}

	//$bould=get_boulder($postdata["sector"],$postdata["boulder"]);
	//vd($attempt);
	//die;
	//$attempt->boulder_letter=1;
	//die;
	//die;

	if($attempt->save()){
		//echo "<b>Done</b>! added to queue...";
	} else{
		echo"<span style='color:red;'>"._("<b>Error</b>: processing your request, check your post data and try again or contact our support.")."</span>";
		die;
	}

	//header("Refresh:0");
	//echo"aaaa";
	echo _("<b>Done</b>: registered! :)");

	//header("Location: $homeurl"."/#attempt");
	//

	echo'
	<script>
		window.location.replace("/#attempt");
		location.reload();
	</script>
	';
}
?>