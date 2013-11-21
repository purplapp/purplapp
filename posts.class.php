<?php

class Posts {
	private $access_token = ACCESS_TOKEN;
	public $user_data = null;
	public $user_id = null;
	public $posts = null;
	public $clubs = array( 
			 "<i class='icon-f-bread'></i> Roll Club - 500" => 500
			,"<i class='icon-f-cake-plain'></i> Crumpet Club - 1000" => 1000
			,"<i class='icon-f-telephone-handset'></i> BitesizeCookie Club - 2000" => 2000
			,"<i class='icon-f-breads'></i> Crunch Club - 2600" => 2600
			,"<i class='icon-f-magnifier-left'></i> MysteryScience Club - 3000" => 3000
			,"<i class='icon-f-shoe'></i> LDR Club - 5000" => 5000
			,"<i class='icon-f-computer'></i> IBMPC Club - 8088" => 8088
			,"<i class='icon-f-cookie-bite'></i> Cookie Club - 10000" => 10000
			,"<i class='icon-f-pipette'></i> SpinalTap Club - 11000" => 11000
			,"<i class='icon-f-cup'></i> Breakfast Club - 20000" => 20000
			,"<i class='icon-f-diamond'></i> Carat Club - 24000" => 24000
			,"<i class='icon-f-compass'></i> Peshawar Club - 25000" => 25000
			,"<i class='icon-f-paper-plane'></i> MileHigh Club - 30000" => 30000
			,"<i class='icon-f-chart-pie-separate'></i> Pi Club - 31416" => 31416
			,"<i class='icon-f-water'></i> Towel Club - 42000" => 42000
			,"<i class='icon-f-hamburger'></i> Bacon Club - 50000" => 50000
			,"<i class='icon-f-crown'></i> Commodore Club - 64000" => 64000
			,"<i class='icon-f-globe'></i> Motorola Club - 68000" => 68000
			,"<i class='icon-f-music-beam-16'></i> Trombone Club - 76000" => 76000
			,"<i class='icon-f-network-clouds'></i> WiFi Club - 80211" => 80211
			,"<i class='icon-f-language'></i> Tower Of Babble Club - 100000" => 100000
			,"<i class='icon-f-mac-os'></i> Mac Club - 128000" => 128000
			,"<i class='icon-f-balloon-twitter'></i> TwitterLeaver Club - 144000" => 144000
			,"<i class=''></i> GetALifeNoSrsly Club - 200000" => 200000
			,"<i class=''></i> MeaninglessPostCount Club - 231568" => 231568
			,"<i class=''></i> ADN Club - 256000" => 256000
			,"<i class=''></i> Pensioners Club - 401000" => 401000
			,"<i class=''></i> Laughter Club - 555000" => 555000
			,"<i class=''></i> Gates Club - 640000" => 640000
			,"<i class=''></i> JoyLuck Club - 888000" => 888000
			,"<i class=''></i> Millionaires Club - 1000000" => 1000000
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
