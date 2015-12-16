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

include_once("../config.php");


$cat=$_REQUEST["cat"];
$start=$_REQUEST["start"];
$qty=$_REQUEST["qty"];

if ($cat=="male") $catg = _("male");
if ($cat=="female") $catg = _("female");
?>


<ul class="media-list" style="font-size:12px;"> 
    <li class="media"> 
        <a class="pull-left" href="#"> </a> 
        <div class="media-body"> 
            <table class="table orders_table"> 
                <thead> 
                    <tr> 
                        <th>#</th>   
                        <th><?php echo ucfirst($catg); ?></th>                          
                        <th>Tops</th>                             
                        <th>Flashs</th>
                        <th>Σ Flashs</th>   
                        <th>Σ</th>                        
                    </tr>                         
                </thead>                     
                <tbody style="display: table-row-group;"> 
                    <?php
                    $score_m=get_rank($cat,$start,$qty);
                    $pos=0;
                    foreach($score_m as $key=>$position){
                        $pos++;
                        if ($pos % 2 == 0) {
                        	$color="#F0FFF0";
                        }else{
                        	$color="white";
                        }
                        
                        echo"
                        <tr style='background-color: $color;'> 
                            <td style=\"padding:1px;\">".$pos."</td>
                            <td style=\"padding:1px;\">".$key."</td>
                            <td style=\"padding:1px;\">".$position["tops"]."</td>
                            <td style=\"padding:1px;\">".$position["flashs"]."</td>
                            <td style=\"padding:1px;\">".$position["flashs_sum"]."</td>
                            <td style=\"padding:1px;\">".$position["total"]."</td>
                        </tr>
                        ";
                    }
                    ?>                                       
                </tbody>
            </table>
            <?php  if (isset($listall)) vd($userorders); ?>
        </div>                     
</ul>