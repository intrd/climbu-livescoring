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
            $categs=new db("categories","all");
            foreach ($categs as $categ){
                $categ=$categ->name;
                $athletes_count = new db("athletes","custom:
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
