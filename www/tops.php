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
use climbu\engine as cu;
?>
        <?php 
            $sec=$userdata->sector;
            $tops = new db("attempts","filter:sector='$sec' and (ascent='1' or ascent='2') order by datetime desc"); 
            $boulders=cu::get_sectordata($sec);
            $boulders=$boulders["boulders"];
            //vd($boulders);
            //die;
            ?>
            <div style="margin-top:10px;">
                <center><h3 class="media-heading"><?php echo _("Sector")." ".$sec; ?></h3></center>
            </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                          <th><?php echo _("Athlete"); ?></th>
                          <th><?php echo _("Boulder"); ?></th>
                          <th><?php echo _("Top or Flash"); ?></th>
                          <th><?php echo _("Referee"); ?></th>
                          <th><?php echo _("Value"); ?></th>
                        <?php
                          if(isset($col)) unset($col); 
                          foreach ($tops as $top){
                            //echo $top->boulder;
                            $boulder=$boulders[($top->boulder-1)];
                            //vd($boulder);
                            $col=$boulder["color"];
                            //$val=
                            //vd($col);
                            if ($top->ascent==1) { $asc="Top"; $val=$boulder["value_top"]; } 
                            if ($top->ascent==2) { $asc="Flash"; $val=$boulder["value_flash"]; } 
                          ?>
                          <tr>
                            <td><?php echo $top->athlete; ?></td>
                            <td style='background-color: <?php echo $col;?>'><?php echo strtoupper($top->boulder_letter); ?></td>
                            <td><?php echo $asc; ?></td>
                            <td><?php echo $top->user; ?></td>
                            <td>+<?php echo $val; ?></td>
                          </tr>
                        <?php } ?>
                        </table>
                    </div>
                


       