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
use database\dbintrd as db;
?>

        <?php 
        // echo $_REQUEST["ty"];
        // die;
                $athletes_count = new db("athletes","custom:
                    SELECT count(*) FROM athletes WHERE active=1
                    ",false);
                reset($athletes_count);
                $athletes_count = current( (Array)$athletes_count );
                $kk=key($athletes_count);
                $athletes_count=$athletes_count->$kk;
        ?>

            <div id="changenav1" style="margin-left:auto;margin-right:auto;float:left;width:100%;margin-top:-4px;">
                <center>
                    <div class="btn-group" data-toggle="buttons">
                      <label id="bt1" class="btn btn-success" style="padding:2px;border-radius:1;border-color:#013220;font-size:9px;background:#013220;">
                        <input type="radio" name="optionsn" id="individual" value="individual" autocomplete="off"> I
                      </label>
                      <label id="bt2" class="btn btn-success active" style="padding:2px;border-radius:0;border-color:#013220;font-size:9px;background:#013220;">
                        <input type="radio" name="optionsn" id="groups" value="groups" autocomplete="off" checked> | G |
                      </label>
                      <label id="bt3" class="btn btn-success" style="padding:2px;border-radius:1;border-color:#013220;font-size:9px;background:#013220;">
                        <input type="radio" name="optionsn" id="details" value="details" autocomplete="off"> AT
                      </label>
                      <label id="bt4" class="btn btn-success" style="padding:2px;border-radius:1;border-color:#013220;font-size:9px;background:#013220;">
                        <input type="radio" name="closenav" id="xxxx" autocomplete="off"> | x
                      </label>
                    </div>
                </center>
            </div>

            <div id="orderlist" style="width:50%;float:left;padding:5px;"><?php echo _("Loading...");?></div>
                <script>
                    var c = 0;
                    //location.reload();
                    //window.location.replace("/#score1");
                    clearInterval(timer1);
                    var timer1 = setInterval(function(){ 
                        if (c><?php echo $athletes_count;?>){
                            c=0;
                        }
                        var tyy = $('input[name=optionsn]:checked').val();
                        var ggg = 'ajax_rank_'+tyy+'.php';
                        //alert(ggg);
                        $.get( ggg, { cat: 'all', start: c, qty: '99999' } )
                            .done(function( data ) {
                                $( "#orderlist" ).html( data );
                        });
                        c = c + 99999;            
                    }, 5000);

                    //if (location.hash.indexOf("score") >= 0){
                    if (location.hash == "#score") {
                        $("#superfooter").hide();
                        $('html').css('background-color','black');
                        $('#scorediv').css('color','white');
                        $('#scorediv').css('background-color','black');
                        $('#scorediv').css('margin-top','-20px');
                    }else{
                        $('#scorediv').css('color','');
                        $('#scorediv').css('background-color','');
                        $('#scorediv').css('margin-top','');
                    }

                    $( "#bt4" ).click(function() {
                        event.preventDefault();
                        $("#changenav1").hide();
                    });

                    var qtyy=12;
                    var atts=0;

                    $( "#bt3" ).click(function() {
                        event.preventDefault();
                        $("#orderlist").hide();
                        clearInterval(timer1);
                        qtyy=99999;
                        atts=1;
                        $('#orderlist_attempts').css('width','100%');
                        //clearInterval(timer2);
                    });

                </script>  
            </div>

            <div id="orderlist_attempts" style="width:48%;float:left;padding:5px;"><?php echo _("Loading...");?></div>
                <script>
                    var c_attempts = 0;
                    clearInterval(timer2);
                    var timer2 = setInterval(function(){ 
                        if (c_attempts><?php echo $athletes_count;?>){
                            c_attempts=0;
                        }
                        $.get( "score_tops.php", { cat: 'all', start: c_attempts, qty: qtyy, atts: atts } )
                            .done(function( data ) {
                                $( "#orderlist_attempts" ).html( data );
                        });
                        //c_attempts = c_attempts + 20;            
                    }, 5000);
                </script>  
            </div>

            <div>
                <p id="superfooter" style="padding:5px; background-color:#013220; color: #9D9D9D;">
                    ClimbU / Open source live scoring for competitions by <a href="http://dann.com.br">intrd</a><br>
                </p>
            </div>
