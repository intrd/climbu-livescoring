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

require_once($ext_path."php-common/functions.php"); //calling intrd common functions

function get_sectordata($sector){
	$sectors = new data('sectors',"filter:id='$sector'",false); 
	$sector=$sectors->{0};
	//vd($sector);
	//die;
	$boulderdata=array();
	$boulders = new data('boulders',"all"); 
	foreach ($boulders as $key=>$boulder){
		$boulderdata[$key]=(array)$boulder;
		if($key==0) {
			$boulderdata[$key]["value_top"] = $sector->value_start;
			$boulderdata[$key]["value_flash"] = $boulderdata[$key]["value_top"]+$sector->value_flashincrease;
		}else{
			$boulderdata[$key]["value_top"] = $boulderdata[$key-1]["value_top"]+$sector->value_interval;
			$boulderdata[$key]["value_flash"] = $boulderdata[$key]["value_top"]+$sector->value_flashincrease;
		}
	}
	$data["sector"]=$sector;
	$data["boulders"]=$boulderdata;
	return $data;
}

function get_boulder($sectorid,$bouldernumber){
	$sectordata=get_sectordata($sectorid);
	$boulder=$sectordata["boulders"][$bouldernumber-1];
	return $boulder;
}

function get_rank($category,$start=false,$qty=false){
	//$athletes = new data("athletes","filter:category='$category' and active='1'",false);
	//SELECT * FROM ".DBIntrd::$table." WHERE ".$filter
	$athletes = new data("athletes","custom:
		SELECT athletes.name,athletes.id,athletes.category FROM athletes WHERE active=1 and category='$category'
		",false);
	
	$total=count((array)$athletes);
	if ($start>$total) $start = 0;
	//echo $start;

	/*$count_flash = new data("attempts","custom:
		SELECT athlete,count(ascent) FROM attempts WHERE ascent=1 GROUP BY athlete 
		",false);

	$count_tops = new data("attempts","custom:
			SELECT athlete,count(ascent) FROM attempts WHERE ascent=0 GROUP BY athlete 
			",false);*/

	foreach($athletes as $key=>$athlete){
		$athlete_name=$athlete->name;
		$athlete_id=$athlete->id;
		$athlete_cat=$athlete->category;
		$score[$athlete_name]["id"]=$athlete_id;
		$score[$athlete_name]["category"]=$athlete_cat;
		//vd($athelete_name);
		//die;
		$attempts = new data("attempts","filter:athlete='$athlete_name' and ascent=0",false);
		$score[$athlete_name]["attempts"] = count( (array)$attempts );

		$ascents = new data("attempts","filter:athlete='$athlete_name' and ascent=1",false);
		$score[$athlete_name]["tops"] = count( (array)$ascents );
		$sum=0;
		foreach($ascents as $ascent){
			$value=get_boulder($ascent->sector,$ascent->boulder)["value_top"];
			$sum=$sum+$value;
		}
		$score[$athlete_name]["tops_sum"]=$sum;

		$flashs = new data("attempts","filter:athlete='$athlete_name' and ascent=2",false);
		$score[$athlete_name]["flashs"] = count( (array)$flashs );
		$sum=0;
		foreach($flashs as $flash){
			$value=get_boulder($flash->sector,$flash->boulder)["value_flash"];
			$sum=$sum+$value;
		}
		$score[$athlete_name]["flashs_sum"]=$sum;
		$score[$athlete_name]["total"]=$score[$athlete_name]["flashs_sum"]+$score[$athlete_name]["tops_sum"];
		
	}

	array_sort_by_column($score,"total",SORT_DESC);


	//vd($score);
	//die;
	//}
	$score = array_slice($score, $start, $qty);

	return $score;
}

function get_queue($table,$yweek,$user,$starttime,$status,$listall=false){
	if ($listall){
		$result = new data($table,"filter:yweek like '$yweek'",false); 
	}else{
		$result = new data($table,"filter:yweek like '$yweek' and user='$user' and status like $status",false);
	}
	foreach($result as $key=>$value){
		//unset($result->{0});
		if(strtotime($value->datetime)<strtotime($starttime)){
			unset($result->$key);
		}
	}
	return $result;
}


?>