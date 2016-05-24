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
        <div style="margin-top:10px;">
            <center><h3 class="media-heading"><?php echo _("Sectors & Points"); ?></h3></center>
        </div>

        

        <?php 
            $sectors=new db("sectors","all");
            foreach($sectors as $sector){
                $sectordata=cu::get_sectordata($sector->id);
                ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                          <th><?php echo _("Sector");?> <?php echo $sectordata["sector"]->id;?></th>
                          <?php foreach ($sectordata["boulders"] as $boulder){
                            echo "<th style='text-align: center;background-color: ".$boulder["color"]."'>".strtoupper($boulder["letter"])."</th>";
                          }
                          ?>
                          <tr>
                            <td>Top</td>
                            <?php foreach ($sectordata["boulders"] as $boulder){
                              $topvalue=$boulder["value_top"];
                              echo "<td align='center' style='background-color: ".$boulder["color"]."'>".$topvalue."</td>";
                            }?>
                          </tr>
                          <tr>
                              <td>Flash</td>
                              <?php foreach ($sectordata["boulders"] as $boulder){
                                $flashvalue=$boulder["value_flash"];
                                echo "<td  align='center' style='background-color: ".$boulder["color"]."'>".$flashvalue."</td>";
                              }?>
                          </tr>
                        </table>
                    </div>
                <?php
            }
        ?>


       