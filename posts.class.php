<?php

class Posts {
	private $access_token = ACCESS_TOKEN;
	public $user_data = null;
	public $user_id = null;
	public $posts = null;
	public $clubs = array( 
			 "Roll Club" => 500
			,"Crumpted Club" => 1000
			,"BitesizeCookie Club" => 2000
			,"Crunch Club" => 2600
			,"MysteryScience Club" => 3000
			,"LDR Club" => 5000
			,"IBMPC Club" => 8088
			,"Cookie Club" => 10000
			,"SpinalTap Club" => 11000
			,"Breakfast Club" => 20000
			,"Carat Club" => 24000
			,"Peshawar Club" => 25000
			,"MileHigh Club" => 30000
			,"Pi Club" => 31416
			,"Towel Club" => 42000
			,"Bacon Club" => 50000
			,"Commodore Club" => 64000
			,"Motorola Club" => 68000
			,"Trombone Club" => 76000
			,"WiFi Club" => 80211
			,"Tower Of Babble Club" => 100000
			,"Mac Club" => 128000
			,"TwitterLeaver Club" => 144000
			,"GetALifeNoSrsly Club" => 200000
			,"MeaninglessPostCount Club" => 231568
			,"ADN Club" => 256000
			,"Pensioners Club" => 401000
			,"Laughter Club" => 555000
			,"Gates Club" => 640000
			,"JoyLuck Club" => 888000
			,"Millionaires Club" => 1000000
			);
	public $memberclubs = array();

	public function setUserID($get) {
		if(!preg_match('/^@[a-zA-Z0-9]+$/', $get)) {
			$this->user_id = "@".$get;
		} else {
			$this->user_id = $get;
		}
	}

	public function getPosts() {
		$id = $this->user_id;
		$url = "https://alpha-api.app.net/stream/0/users/".$id."?access_token=".ACCESS_TOKEN."&include_user_annotations=1?callback=awesome?jsonp=parseResponse";
		
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->posts = $obj->data->counts->posts;	
		}
	}

	public function getData() {
		$id = $this->user_id;
		$url = "https://alpha-api.app.net/stream/0/users/".$id."?access_token=".ACCESS_TOKEN."&include_user_annotations=1?callback=awesome?jsonp=parseResponse";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			if($obj->data->type == "human") {
				$this->user_data = $obj->data;
			} else {
				return false;
			}
		}
	}

	public function getClubs() {

		foreach($this->clubs as $club => $count) {
			if($this->posts > $count) {
				$this->memberclubs[] = $club;
			}
		}
	}

}

?>