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

include_once("../config.php");
use php\intrdCommons as i;
use climbu\engine as cu;

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
                        <th></th>                    
                        <th>Tops</th>                             
                        <th>Flashs</th>
                        <th>Σ Flashs</th> 
                        <th>3 tops</th>
                        <th>Σ 3 tops</th> 
                        <th>Σ</th>                        
                    </tr>                         
                </thead>                     
                <tbody style="display: table-row-group;"> 
                    <?php
                    //echo $start;
                    $score_m=cu::get_rank_group($cat,$start,$qty);
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
                        //if($position["gender"]=="female") $color_gender="red"; 
                        echo"
                        <tr style='background-color: $color;'> 
                            <td style=\"padding:1px;\">".$pos."</td>
                            <td style=\"padding:1px;\">".$key."</span></td>
                            <td style=\"padding:1px;\">".$position["tops"]."</td>
                            <td style=\"padding:1px;\">".$position["flashs"]."</td>
                            <td style=\"padding:1px;\">".$position["flashs_sum"]."</td>
                            <td style=\"padding:1px;\">".$position["bonus"]."</td>
                            <td style=\"padding:1px;\">".$position["bonusx_sum"]."</td>
                            <td style=\"padding:1px;\">".$position["total"]."</td>
                        </tr>
                        ";
                    }
                    ?>                                       
                </tbody>
            </table>
            <?php  if (isset($listall)) i::vd($userorders); ?>
        </div>                     
</ul>