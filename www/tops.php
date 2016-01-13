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
            $sec=$userdata->sector;
            $tops = new data("attempts","filter:sector='$sec' and (ascent='1' or ascent='2')"); 
            ?>
            <div style="margin-top:10px;">
                <center><h3 class="media-heading"><?php echo _("Sector")." ".$sec; ?></h3></center>
            </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                          <th><?php echo _("Athlete"); ?></th>
                          <th><?php echo _("Boulder"); ?></th>
                          <th><?php echo _("Ascent"); ?></th>
                          <th><?php echo _("Referee"); ?></th>
                        <?php foreach ($tops as $top){ 
                            if ($top->ascent==1) { $asc="Top"; } 
                            if ($top->ascent==2) { $asc="Flash"; } 
                          ?>
                          <tr>
                            <td><?php echo $top->athlete; ?></td>
                            <td><?php echo strtoupper($top->boulder_letter); ?></td>
                            <td><?php echo $asc; ?></td>
                            <td><?php echo $top->user; ?></td>
                          </tr>
                        <?php } ?>
                        </table>
                    </div>
                


       