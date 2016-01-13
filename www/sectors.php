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
        <div style="margin-top:10px;">
            <center><h3 class="media-heading"><?php echo _("Sectors & Points"); ?></h3></center>
        </div>

        

        <?php 
            $sectors=new data("sectors","all");
            foreach($sectors as $sector){
                $sectordata=get_sectordata($sector->id);
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


       