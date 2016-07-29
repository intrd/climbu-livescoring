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
use php\intrdCommons as i;
use database\dbintrd as db;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["userdata"])) i::fwrite_a($viewlog,"[".date('Y-m-d h:i:s')."] ".$_SERVER['REMOTE_ADDR']." visited... "."@".$_SERVER['PHP_SELF']."<br>\n");

$configs = new db('configs',"filter:name='navbar_title'",false); 
$navbar_title=$configs->{0}->value;

?>

<!DOCTYPE html>
<html>
<head>
	<title>ClimbU</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/jquery.loadmask.css" rel="stylesheet" type="text/css">
	<link href="assets/Font-Awesome-master/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="icon" type="image/png" href="imgs/favicon.ico" />
</head>
<body>
	<div class="navbar navbar-inverse navbar-static-top" role="navigation" style="background-color:#013220;">
	    <div class="container-fluid">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a id="homelogo" data-toggle="tab" data-tab-always-refresh="true" data-target="#home" class="navbar-brand" href="#"><i class="-o -o fa fa-2x fa-signal pull-RIGHT s" style="margin-top:-9px;"></i> <?php echo $navbar_title; ?></a>
	            
	        </div>
	        <?php include('navbar.php'); ?>
	    </div>
	</div>
	
	<div id="loading-indicator" style="border:1px dotted black;
	width:150px;
	padding:10px;
	position: fixed; left: 50%; top: 50%;
	z-index:999999; 
	background-color:white;
	color:#333;
	text-align:center;
	display:none;
	">
		<img src="imgs/gears.gif">
		loading...
	</div>
	<div class="main_alert"></div>

	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content"></div>
	    </div>
	</div>
	<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content"></div>
	    </div>
	</div>
	<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content"></div>
	    </div>
	</div>

	<!-- Tab pane contents -->         
	<div class="container-fluid" id="scorediv" >
	    <div class="tab-content">
	        <div class="tab-pane" id="attempt"></div>
	        <div class="tab-pane active" id="score"></div>
	        <div class="tab-pane" id="sectors"></div>
	        <div class="tab-pane" id="tops"></div>
	    </div>
	</div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="assets/js/jquery.loadmask.js"></script>
    <script src="assets/js/bootstrap-remote-tabs.js"></script>
    <script src="assets/js/jquery.stickytabs.js"></script>
    <script>         
        $('#nav1.navbar-nav').stickyTabs();
        //$('#nav3.navbar-nav').stickyTabs();
        
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
     
        $( "a#homelogo" ).click(function() {
        	//alert('j');
        	window.location.replace("./#score");
        });

        $( "#nav1.navbar-nav" ).click(function() {
        	clearInterval(timer1);
        	clearInterval(timer2);
        	$("#superfooter").show();
        	$('#scorediv').css('color','');
        	$('#scorediv').css('background-color','');
        	$('#scorediv').css('margin-top','');
        });

        

        if (location.hash == '') {
        	window.location.replace("./#attempt");
        }

        if (location.hash == 'attempt') {
        	//window.location.replace("./#attempt");
        }

        $(document).ajaxSend(function(event, request, settings) {
            $('#loading-indicator').show();
        });
        $(document).ajaxComplete(function(event, request, settings) {
            $('#loading-indicator').hide();
        });

    </script>

    <p id="superfooter" style="padding:5px; background-color:#013220; color: #9D9D9D;">
    	ClimbU / Open source live scoring for competitions by <a href="http://dann.com.br">intrd</a><br>
    </p>



</body>
</html>

