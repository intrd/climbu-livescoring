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

include("../config.php");
?>

        <?php 
            $categs=new data("categories","all");
            foreach ($categs as $categ){
                $categ=$categ->name;
                $athletes_count = new data("athletes","custom:
                    SELECT count(*) FROM athletes WHERE active=1 and category='$categ'
                    ",false);
                reset($athletes_count);
                $athletes_count = current( (Array)$athletes_count );
                $kk=key($athletes_count);
                $athletes_count=$athletes_count->$kk;
        ?>
            <div id="orderlist_<?php echo $categ;?>" style="width:380px;float:left;padding:5px;height:250px;"><?php echo _("Loading...");?></div>
            <script>
                var c<?php echo $categ;?> = 0;
                setInterval(function(){ 
                    if (c<?php echo $categ;?>><?php echo $athletes_count;?>){
                        c<?php echo $categ;?>=0;
                    }
                    $.get( "ajax_rank.php", { cat: '<?php echo $categ;?>', start: c<?php echo $categ;?>, qty: '10' } )
                        .done(function( data ) {
                            $( "#orderlist_<?php echo $categ;?>" ).html( data );
                    });
                    c<?php echo $categ;?> = c<?php echo $categ;?> + 10;            
                }, 5000);

                if (location.hash == "#score") {
                    $('#scorediv').css('color','white');
                    $('#scorediv').css('background-color','black');
                    $('#scorediv').css('margin-top','-20px');
                }else{
                    $('#scorediv').css('color','');
                    $('#scorediv').css('background-color','');
                    $('#scorediv').css('margin-top','');
                }
            </script>  
        <?php } ?>


        <div style="float:left;width:100%;margin-bottom:10px;"><?php echo _("<small><b>Tip</b>: Use ctrl+mouseroll to adjust on your display.</small>");?></div>
