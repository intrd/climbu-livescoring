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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$showprices=false;
if (isset($_SESSION["userdata"])){
    include("secure.php");
    if($levels!=1){
        die("Error: security.");
    }
    $uname=$userdata->username;
    //vd($userdata);
    $sector=$userdata->sector;
    $showprices=true;
}else{
    $uname=false;
}

//vd($_SESSION["userdata"]);
//echo $uname;

?>



<div class="modal fade" id="boulder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div id="menu" style="">
    <div class="panel list-group">
        <?php
        $genders= new db("genders","all");
        //vd($categories);
        //die;
        foreach ($genders as $gender){
            //$athlets_list= new data("athletes","filter:category|".$category->name);
            $gender_tr=$gender->name;
            //vd("custom:SELECT * FROM athletes WHERE active=1 AND category LIKE '%-$gender%'");
            //die;
            $athlets_list = new db("athletes","custom:SELECT * FROM athletes WHERE active=1 and gender='".$gender->name."'",false);
            if ($gender_tr=="male") $gender_tr = _("male");
            if ($gender_tr=="female") $gender_tr = _("female");
        ?>
         <a href="#" class="list-group-item" data-toggle="collapse" data-target="#<?php echo $gender->name;?>" data-parent="#menu"><i class="<?php echo $gender->icon;?>"></i>&nbsp;&nbsp;&nbsp;<?php echo ucfirst($gender_tr);?><span class="label label-info pull-right"><?php echo count((array)$athlets_list);?></span></a>
         <div id="<?php echo $gender->name;?>" class="sublinks collapse">
             <div class="list-group-item small">
                <table class="table"> 
                    <thead> 
                        <tr style="display: table-row;"> 
                            <th>#<?php echo $gender->name;?></th>  
                            <th><?php echo _("Group"); ?></th> 
                            <th><?php echo _("Athlete"); ?></th>     
                            <th><?php echo _("Choose"); ?></th>                                         
                        </tr>                     
                    </thead>                 
                    <tbody>
                        <?php 
                            foreach ($athlets_list as $key => $athlet){
                                if ($athlet->active==1){
                                    $active_icon='<i class="fa fa-2x fa-circle-o fa-fw text-primary"></i>';
                                    $active_icon2='<i class="fa fa-2x fa-bolt fa-fw text-danger"></i>';
                                     if (!$uname) {
                                        $active_icon='<a href="login.php" data-toggle="modal" data-target="#login">'.$active_icon.'</a>';
                                    }else{
                                        $active_icon='<a href="ajax_boulder.php?top=0&id='.$athlet->id.'&user='.$uname.'" data-toggle="modal" data-target="#boulder">'.$active_icon.'</a>';
                                        $flash_icon='<a href="ajax_boulder.php?top=1&id='.$athlet->id.'&user='.$uname.'" data-toggle="modal" data-target="#boulder">'.$active_icon2.'</a>';
                                    }

                                }else{
                                    $active_icon='<i class="fa fa-2x fa-ban fa-fw text-danger"></i>';
                                }
                                //$prod=product_nameformat($product->name);
                                $athlet_id=$athlet->id;
                                $athlet_name=$athlet->name;
                                $athlet_group=$athlet->group;
                                echo'
                                        <tr style="display: table-row;"> 
                                            <td>'.$athlet_id.'</td>  
                                            <td>'.$athlet_group.'</td>    
                                            <td>'.$athlet_name.'</td>                           
                                            <td>
                                                '.$active_icon.'
                                            </td>   
                                                              
                                        </tr> 
                                    ';
                            }
                        ?>
                    </tbody>
                </table>
             </div>
         </div>
        <?php } ?>
    </div>
    <?php
    if (!$showprices) {
        echo'
          <div class="alert alert-warning" data-pg-id="d159"> 
            <strong data-pg-id="160">Login w/ your account</strong> to register attempts...        
          </div>
        ';
    }

    ?>
</div>

