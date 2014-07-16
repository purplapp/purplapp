<?php

class PostClubs {
	public $user_posts = null;
	public $club_count = null;

	public $clubs = array(
		array("name" => "#RollClub", "url" => "RollClub", "nicecount" => "500", "count" => "500")
		,array("name" => "#CrumpetClub", "url" => "CrumpetClub", "nicecount" => "1 000", "count" => "1000")
		,array("name" => "#NoonClub", "url" => "NoonClub", "nicecount" => "1 200", "count" => "1200")
		,array("name" => "#BitesizeCookieClub", "url" => "BitesizeCookieClub", "nicecount" => "2 000", "count" => "2000")
		,array("name" => "#CrunchClub", "url" => "CrunchClub", "nicecount" => "2 600", "count" => "2600")
		,array("name" => "#MysteryScienceClub", "url" => "MysteryScienceClub", "nicecount" => "3 000", "count" => "3000")
		,array("name" => "#LDRClub", "url" => "LDRClub", "nicecount" => "5 000", "count" => "5000")
		,array("name" => "#IBMPCClub", "url" => "IBMPCClub", "nicecount" => "8 088", "count" => "8088")
		,array("name" => "#CookieClub", "url" => "CookieClub", "nicecount" => "10 000", "count" => "10000")
		,array("name" => "#SpinalTapClub", "url" => "SpinalTapClub", "nicecount" => "11 000", "count" => "11000")
		,array("name" => "#BreakfastClub", "url" => "BreakfastClub", "nicecount" => "20 000", "count" => "20000")
		,array("name" => "#CaratClub", "url" => "CaratClub", "nicecount" => "24 000", "count" => "24000")
		,array("name" => "#PeshawarClub", "url" => "PeshawarClub", "nicecount" => "25 000", "count" => "25000")
		,array("name" => "#MileHighClub", "url" => "MileHighClub", "nicecount" => "30 000", "count" => "30000")
		,array("name" => "#PiClub", "url" => "PiClub", "nicecount" => "31 416", "count" => "31416")
		,array("name" => "#TowelClub", "url" => "TowelClub", "nicecount" => "42 000", "count" => "42000")
		,array("name" => "#HitmanClub", "url" => "HitmanClub", "nicecount" => "47 000", "count" => "47000")
		,array("name" => "#BaconClub", "url" => "BaconClub", "nicecount" => "50 000", "count" => "50000")
		,array("name" => "#BrowncoatClubClub", "url" => "BrowncoatClubClub", "nicecount" => "57 000", "count" => "57000")
		,array("name" => "#CommodoreClub", "url" => "CommodoreClub", "nicecount" => "64 000", "count" => "64000")
		,array("name" => "#MotorolaClub", "url" => "MotorolaClub", "nicecount" => "68 000", "count" => "68000")
		,array("name" => "#TromboneClub", "url" => "TromboneClub", "nicecount" => "76 000", "count" => "76000")
		,array("name" => "#WiFiClub", "url" => "WiFiClub", "nicecount" => "80 211", "count" => "80211")
		,array("name" => "#PajamaClub", "url" => "PajamaClub", "nicecount" => "90 000", "count" => "90000")
		,array("name" => "#TowerOfBabbleClub", "url" => "TowerOfBabbleClub", "nicecount" => "100 000", "count" => "100000")
		,array("name" => "#OrbitClub", "url" => "OrbitClub", "nicecount" => "110 000", "count" => "110000")
		,array("name" => "#MacClub", "url" => "MacClub", "nicecount" => "128 000", "count" => "128000")
		,array("name" => "#TwitterLeaverClub", "url" => "TwitterLeaverClub", "nicecount" => "140 000", "count" => "140000")
		,array("name" => "#GetALifeNoSrslyClub", "url" => "GetALifeNoSrslyClub", "nicecount" => "200 000", "count" => "200000")
		,array("name" => "#MeaninglessPostCountClub", "url" => "MeaninglessPostCountClub", "nicecount" => "231 568", "count" => "231568")
		,array("name" => "#ADNClub", "url" => "ADNClub", "nicecount" => "256 000", "count" => "256000")
		,array("name" => "#PensionersClub", "url" => "PensionersClub", "nicecount" => "401 000", "count" => "401000")
		,array("name" => "#LaughterClub", "url" => "LaughterClub", "nicecount" => "555 000", "count" => "555000")
		,array("name" => "#GatesClub", "url" => "GatesClub", "nicecount" => "640 000", "count" => "640000")
		,array("name" => "#JoyLuckClub", "url" => "JoyLuckClub", "nicecount" => "888 000", "count" => "888000")
		,array("name" => "#MillionairesClub", "url" => "MillionairesClub", "nicecount" => "1 000 000", "count" => "1000000")
	); 

	public $memberclubs = array();

	public function setUserPost($get) {
		$this->user_posts = $get;
	}
	
	public function setUserID($get) {
		$this->user_id = $get;
		$user_id = $this->user_id;
		$this->user_id_formatted = number_format($user_id, 0, '.', ' ');
	}
	
	public function setAlpha($get) {
		$this->alpha = $get;
	}

	public function getClubs() {
		$orphanblack = true;
		foreach($this->clubs as $club) {
			if($this->user_posts > preg_replace("/[^0-9,.]/", "", $club['count'])) {
				if($this->user_posts > ($this->user_id > preg_replace("/[^0-9,.]/", "", $club['count'])) && $orphanblack) {
					$this->memberclubs[] = "<a href='{$this->alpha}hashtags/OrphanBlackClub' target='_blank'>#OrphanBlackClub</a> <i>({$this->user_id_formatted} posts)</i>";
					$orphanblack = false;
				}
				$this->memberclubs[] = "<a href='{$this->alpha}hashtags/{$club['url']}' target='_blank'>{$club['name']}</a> <i>({$club['nicecount']} posts)</i>";
				$this->club_count = $this->club_count + 1;
			}
		}
	}
	
	public function nextClubs() {
		$orphanblack = true;
		foreach($this->clubs as $club) {
			if($this->user_posts < preg_replace("/[^0-9,.]/", "", $club['nicecount'])) {
				if($this->user_posts < ($this->user_id > preg_replace("/[^0-9,.]/", "", $club['count'])) && $orphanblack) {
					$this->nextclubs[] = "<a href='{$this->alpha}hashtags/OrphanBlackClub' target='_blank'>#OrphanBlackClub</a> <i>({$this->user_id_formatted} posts)</i>";
					$orphanblack = false;
				}
				$until = $club['count'] - $this->user_posts;
				$this->nextclubs[] = "<a href='{$this->alpha}hashtags/{$club['url']}' target='_blank'>{$club['name']}</a> <i>({$club['nicecount']} posts - in {$until} posts)</i>";
			}	
		}	
	}
}

class PostData {

	/** 
		* A sweet interval formatting, will use the two biggest interval parts. 
		* On small intervals, you get minutes and seconds. 
		* On big intervals, you get months and days. 
		* Only the two biggest parts are used. 
		* 
		* @param DateTime $start 
		* @param DateTime|null $end 
		* @return string 
	*/ 
	
	public function formatDateDiff($start, $end=null) { 
	    if(!($start instanceof DateTime)) { 
	        $start = new DateTime($start); 
	    } 
	    
	    if($end === null) { 
	        $end = new DateTime(); 
	    } 
	    
	    if(!($end instanceof DateTime)) { 
	        $end = new DateTime($start); 
	    } 
	    
	    $interval = $end->diff($start); 
	    $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;}; // adds plurals 
	    
	    $format = array(); 
	    if($interval->y !== 0) { 
	        $format[] = "%y ".$doPlural($interval->y, "year"); 
	    } 
	    if($interval->m !== 0) { 
	        $format[] = "%m ".$doPlural($interval->m, "month"); 
	    } 
	    if($interval->d !== 0) { 
	        $format[] = "%d ".$doPlural($interval->d, "day"); 
	    } 
	    if($interval->h !== 0) { 
	        $format[] = "%h ".$doPlural($interval->h, "hour"); 
	    } 
	    if($interval->i !== 0) { 
	        $format[] = "%i ".$doPlural($interval->i, "minute"); 
	    } 
	    if($interval->s !== 0) { 
	        if(!count($format)) { 
	            return "less than a minute"; 
	        } else { 
	            $format[] = "%s ".$doPlural($interval->s, "second"); 
	        } 
	    } 
	    
	    // We use the two biggest parts 
	    if(count($format) > 1) { 
	        $format = array_shift($format)." and ".array_shift($format); 
	    } else { 
	        $format = array_pop($format); 
	    } 
	    
	    // Prepend 'since ' or whatever you like 
	    return $interval->format($format); 
	} 
}

class BirthdayData {
	public function isValidTimeStamp($timestamp){
	    return ((string) (int) $timestamp === $timestamp) 
	        && ($timestamp <= PHP_INT_MAX)
	        && ($timestamp >= ~PHP_INT_MAX);
	}
	
	public function strReplaceAssoc(array $replace, $subject) { 
	   return str_replace(array_keys($replace), array_values($replace), $subject);    
	} 
	
	public function birthdayDateConverstion($birthday) {
		$replace = array( 
			'xxxx' => '1970', 
		); 
		
		if (strpos($birthday,'xxx') !== false) {
		    $birthday_changed = $this->strReplaceAssoc($replace,$birthday);
		    $flag = true;
		} else {
			$birthday_changed = $birthday;
			$flag = false;
		}
				
		// convert the changed birthday (if necessary) into unix timestamp
		$unix_birthday_changed = strtotime($birthday_changed);
		$unix_birthday_changed_integer = (string) $unix_birthday_changed;
		
		// check if it is a valid unix timestamp or not
		$unix_yes_no = $this->isValidTimeStamp($unix_birthday_changed_integer);
		
		if ($unix_yes_no){
			if ($flag == false) {
				$date_changed = date("jS F Y", $unix_birthday_changed);
			} else {
				$date_changed = date("jS F ", $unix_birthday_changed);		
			}
			return $date_changed;		
		} else {
			return $birthday_changed;		
		}
	}
}
?>