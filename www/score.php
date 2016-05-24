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
                $athletes_count = new db("athletes","custom:
                    SELECT count(*) FROM athletes WHERE active=1
                    ",false);
                reset($athletes_count);
                $athletes_count = current( (Array)$athletes_count );
                $kk=key($athletes_count);
                $athletes_count=$athletes_count->$kk;
        ?>
            <div id="orderlist" style="width:480px;float:left;padding:5px;height:449px;"><?php echo _("Loading...");?></div>
                <script>
                    var c = 0;
                    setInterval(function(){ 
                        if (c><?php echo $athletes_count;?>){
                            c=0;
                        }
                        $.get( "ajax_rank.php", { cat: 'all', start: c, qty: '20' } )
                            .done(function( data ) {
                                $( "#orderlist" ).html( data );
                        });
                        c = c + 20;            
                    }, 5000);

                    if (location.hash == "#score") {
                        $('html').css('background-color','black');
                        $('#scorediv').css('color','white');
                        $('#scorediv').css('background-color','black');
                        $('#scorediv').css('margin-top','-20px');
                    }else{
                        $('#scorediv').css('color','');
                        $('#scorediv').css('background-color','');
                        $('#scorediv').css('margin-top','');
                    }
                </script>  
            </div>

            <div id="orderlist_attempts" style="width:440px;float:left;padding:5px;height:449px;"><?php echo _("Loading...");?></div>
                <script>
                    var c_attempts = 0;
                    setInterval(function(){ 
                        if (c_attempts><?php echo $athletes_count;?>){
                            c_attempts=0;
                        }
                        $.get( "score_tops.php", { cat: 'all', start: c_attempts, qty: '12' } )
                            .done(function( data ) {
                                $( "#orderlist_attempts" ).html( data );
                        });
                        //c_attempts = c_attempts + 20;            
                    }, 5000);
                </script>  
            </div>

        
