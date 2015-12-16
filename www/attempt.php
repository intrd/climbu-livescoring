<?php
/**
 * ClimbU - Dynamic and open source live scoring for competitions
 * 
* @package climbu-livescoring
* @version 2.0
* @category system
* @author intrd - http://dann.com.br/
* @copyright 2015 intrd
* license: Creative Commons Attribution-ShareAlike 4.0 International License - http://creativecommons.org/licenses/by-sa/4.0/
* @link https://github.com/intrd/climbu-livescoring/
* Dependencies: 
*   https://github.com/intrd/php-adminer/
*   https://github.com/intrd/php-common/
*   https://github.com/intrd/sqlite-dbintrd/
*   https://github.com/intrd/php-mcrypt256CBC/
*/

include("../config.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
        $categories= new data("categories","all");
        foreach ($categories as $category){
            $athlets_list= new data("athletes","filter:category|".$category->name);
            $cat=$category->name;
            if ($cat=="male") $cat = _("male");
            if ($cat=="female") $cat = _("female");
        ?>
         <a href="#" class="list-group-item" data-toggle="collapse" data-target="#<?php echo $category->name;?>" data-parent="#menu"><i class="<?php echo $category->icon;?>"></i><?php echo ucfirst($cat);?><span class="label label-info pull-right"><?php echo count((array)$athlets_list);?></span></a>
         <div id="<?php echo $category->name;?>" class="sublinks collapse">
             <div class="list-group-item small">
                <table class="table"> 
                    <thead> 
                        <tr style="display: table-row;"> 
                            <th>#</th>  
                            <th><?php echo _("Athlete"); ?></th>     
                            <th><?php echo _("Attempt"); ?></th>  
                            <th>Top</th>                                          
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
                                echo'
                                        <tr style="display: table-row;"> 
                                            <td>'.$athlet_id.'</td>  
                                            <td>'.$athlet_name.'</td>                           
                                            <td>
                                                '.$active_icon.'
                                            </td>   
                                            <td>
                                                '.$flash_icon.'
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

