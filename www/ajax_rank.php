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
                        <th><?php echo ucfirst($catg); ?>Catg</th>                       
                        <th>Tops</th>                             
                        <th>Flashs</th>
                        <th>Σ Flashs</th>   
                        <th>Σ</th>                        
                    </tr>                         
                </thead>                     
                <tbody style="display: table-row-group;"> 
                    <?php
                    //echo $start;
                    $score_m=get_rank($cat,$start,$qty);
                    //vd($score_m);
                    //die;
                    $pos=$start;
                    foreach($score_m as $key=>$position){
                        $pos++;
                        if ($pos % 2 == 0) {
                        	///$color="#2F4F4F";
                            $color="#333";
                        }else{
                        	$color="black";
                        }
                        $color_gender="blue";
                        if($position["gender"]=="female") $color_gender="red"; 
                        echo"
                        <tr style='background-color: $color;'> 
                            <td style=\"padding:1px;\">".$pos."</td>
                            <td style=\"padding:1px;\">".$key."(<span style='color:$color_gender;'>".ucfirst($position["gender"][0])."</span>)</td>
                            <td style=\"padding:1px;\">".ucfirst($position["category"])."</td>
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