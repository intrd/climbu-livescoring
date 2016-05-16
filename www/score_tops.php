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
            $tops = new data("attempts","filter:(ascent='1' or ascent='2')"); 
            $boulders=get_sectordata($sec);
            $boulders=$boulders["boulders"];
            //vd($boulders);
            //die;
            ?>
            <div style="margin-top:5px;">
                <center><h4 class="media-heading"><?php echo _("Lastest tops"); ?></h4></center>
            </div>
                    <div class="table-responsive" style="font-size:10px;">
                        <table class="table table-bordered">
                          <th><?php echo _("Athlete"); ?></th>
                          <th><?php echo _("Boulder"); ?></th>
                          <th><?php echo _("Sector"); ?></th>
                          <th><?php echo _("Top or Flash"); ?></th>
                          <th><?php echo _("Referee"); ?></th>
                          <th><?php echo _("Value"); ?></th>
                        <?php
                          if(isset($col)) unset($col); 
                          foreach ($tops as $top){
                            //echo $top->boulder;
                            $boulder=$boulders[($top->boulder-1)];
                            $sector=$top->sector;
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
                            <td><?php echo $sector; ?></td>
                            <td><?php echo $asc; ?></td>
                            <td><?php echo $top->user; ?></td>
                            <td>+<?php echo $val; ?></td>
                          </tr>
                        <?php } ?>
                        </table>
                    </div>
                


       