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

include("../config.php");
?>

        <?php 
                $athletes_count = new data("athletes","custom:
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
                        $.get( "score_tops.php", { cat: 'all', start: c_attempts, qty: '20' } )
                            .done(function( data ) {
                                $( "#orderlist_attempts" ).html( data );
                        });
                        c_attempts = c_attempts + 20;            
                    }, 5000);
                </script>  
            </div>

        
