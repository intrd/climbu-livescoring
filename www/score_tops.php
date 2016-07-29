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

$qtdy=$_REQUEST["qty"];
$atts=$_REQUEST["atts"];
?>
        <?php 
            //$sec=$userdata->sector;
            if ($atts==0){
              $tops = new db("attempts","filter:(ascent='1' or ascent='2') ORDER BY id DESC limit $qtdy;"); 
            }else{
              $tops = new db("attempts","filter:(ascent>='0') ORDER BY id DESC limit $qtdy;");  
            }
            $boulders=cu::get_sectordata();
            $boulders=$boulders["boulders"];
            //vd($boulders);
            //die;
            ?>
            <div style="margin-top:5px;">
                <center><h4 class="media-heading"><?php echo _("Latest tops"); ?></h4></center>
            </div>
                    <div class="table-responsive" style="font-size:10px;">
                        <table class="table table-bordered">
                          <th><?php echo _("#"); ?></th>
                          <th><?php echo _("Group"); ?></th>
                          <th><?php echo _("Boulder"); ?></th>
                          <th><?php echo _("Sec"); ?></th>
                          <th><?php echo _("T/F"); ?></th>
                          <th><?php echo _("Ref."); ?></th>
                          <th><?php echo _("Value"); ?></th>
                          <th><?php echo _("Bn"); ?></th>
                          <th><?php echo _("Time"); ?></th>
                        <?php
                          if(isset($col)) unset($col); 
                          foreach ($tops as $top){
                            //echo $top->boulder;
                            $boulder=$boulders[($top->boulder-1)];
                            $sector=$top->sector;
                            $group=$top->athlete_group;
                            $datetime=$top->datetime;
                            $bonus=$top->bonus;
                            //vd($boulder);
                            $col=$boulder["color"];
                            $val=$top->value;
                            //var_dump($top);
                            if ($top->ascent==1) { $asc="Top"; } 
                            if ($top->ascent==2) { $asc="Flash"; } 
                            if ($top->ascent==0) { $asc="Attempt"; } 
                          ?>
                          <tr>
                            <td style='background-color:<?php if ($top->bonus>1) { echo"grey";}?>'><?php echo $top->athlete; ?></td>
                            <td><?php echo $group; ?></td>
                            <td style='background-color: <?php echo $col;?>'><?php echo strtoupper($top->boulder_letter); ?></td>      
                            <td><?php echo $sector; ?></td>
                            <td style='background-color:<?php if ($val==0) { echo"white";}?>'><?php echo $asc; ?></td>
                            <td><?php echo $top->user; ?></td>
                            <td><?php echo $val; ?></td>
                            <td><?php echo $bonus; ?></td>
                            <td><?php echo $datetime; ?></td>
                          </tr>
                        <?php } ?>
                        </table>
                    </div>
                


       