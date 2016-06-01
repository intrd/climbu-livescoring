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

namespace climbu;
use database\dbintrd as db;
use php\intrdCommons as i;

class engine {
	public function get_sectordata($sector=false){
		//global $data_path;
		//echo $data_path;
		if (!$sector){
			$sectors = new db('sectors',"filter:id>0",false);	
		}else{
			$sectors = new db('sectors',"filter:id='$sector'",false);	
		}
		 
		$sector=$sectors->{0};
		//vd($sector);
		//die;
		$boulderdata=array();
		$boulders = new db('boulders',"all"); 
		//var_dump($boulders);
		$x=1;
		foreach ($boulders as $key=>$boulder){
			$k=pow($x,2);
			$boulderdata[$key]=(array)$boulder;
			if($key==0) {
				$boulderdata[$key]["value_top"] = $sector->value_start*$k;
				$boulderdata[$key]["value_flash"] = $boulderdata[$key]["value_top"]+$sector->value_flashincrease*$k;
			}else{
				$boulderdata[$key]["value_top"] = $boulderdata[$key-1]["value_top"]+$sector->value_interval*$k;
				$boulderdata[$key]["value_flash"] = $boulderdata[$key]["value_top"]+$sector->value_flashincrease*$k;
			}
			$x++;
		}
		$data["sector"]=$sector;
		$data["boulders"]=$boulderdata;
		//die;
		return $data;
	}

	public function get_boulder($sectorid,$bouldernumber){
		$sectordata=engine::get_sectordata($sectorid);
		$boulder=$sectordata["boulders"][$bouldernumber-1];
		return $boulder;
	}

	public function get_rank($category,$start=false,$qty=false){
		global $limit_sumrank;
		//$athletes = new data("athletes","filter:category='$category' and active='1'",false);
		//SELECT * FROM ".DBIntrd::$table." WHERE ".$filter
		if($category=="all"){
			$athletes = new db("athletes","custom:
				SELECT athletes.name,athletes.id,athletes.category,athletes.gender FROM athletes WHERE active=1
				",false);
		}else{
			$athletes = new db("athletes","custom:
				SELECT athletes.name,athletes.id,athletes.category,athletes.gender FROM athletes WHERE active=1 and category='$category'
				",false);
		}

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
			//vd($athlete);
			//die;
			$athlete_name=$athlete->name;
			$athlete_id=$athlete->id;
			$athlete_cat=$athlete->category;
			$score[$athlete_name]["id"]=$athlete_id;
			$score[$athlete_name]["category"]=$athlete_cat;
			$score[$athlete_name]["gender"]=$athlete->gender;
			//vd($athelete_name);
			//die;
			$attempts = new db("attempts","filter:athlete='$athlete_name' and ascent=0",false);
			$score[$athlete_name]["attempts"] = count( (array)$attempts );

			$ascents = new db("attempts","filter:athlete='$athlete_name' and ascent=1",false);
			$score[$athlete_name]["tops"] = count( (array)$ascents );
			$sum=0;
			$topx=array();
			foreach($ascents as $ascent){
				$value=engine::get_boulder($ascent->sector,$ascent->boulder)["value_top"];
				$topx[]=$value;
				$sum=$sum+$value;
			}
			$score[$athlete_name]["tops_sum"]=$sum;

			$flashs = new db("attempts","filter:athlete='$athlete_name' and ascent=2",false);
			$score[$athlete_name]["flashs"] = count( (array)$flashs );
			$sum=0;
			$flashx=array();
			foreach($flashs as $flash){
				$value=engine::get_boulder($flash->sector,$flash->boulder)["value_flash"];
				$flashx[]=$value;
				$sum=$sum+$value;
			}
			$score[$athlete_name]["flashs_sum"]=$sum;
			$score[$athlete_name]["total"]=$score[$athlete_name]["flashs_sum"]+$score[$athlete_name]["tops_sum"];

			if ($limit_sumrank){
				$sumx=array();
				$sumx=array_merge($topx,$flashx);
				arsort($sumx);
				$sumx=array_slice($sumx,0,$limit_sumrank);
				//var_dump($sumx);
				$score[$athlete_name]["total"]=array_sum($sumx);
			}
			
		}

		i::array_sort_by_column($score,"total",SORT_DESC);


		//vd($score);
		//die;
		//}
		$score = array_slice($score, $start, $qty);

		return $score;
	}

	public function get_queue($table,$yweek,$user,$starttime,$status,$listall=false){
		if ($listall){
			$result = new db($table,"filter:yweek like '$yweek'",false); 
		}else{
			$result = new db($table,"filter:yweek like '$yweek' and user='$user' and status like $status",false);
		}
		foreach($result as $key=>$value){
			//unset($result->{0});
			if(strtotime($value->datetime)<strtotime($starttime)){
				unset($result->$key);
			}
		}
		return $result;
	}

}


?>