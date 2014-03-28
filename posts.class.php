<?php

class Posts {
	private $access_token = ACCESS_TOKEN;
	public $user_data = null;
	public $user_id = null;
	public $posts = null;
	public $clubs = array( 
			 "<i class='icon-f-bread'></i> - Roll Club - 500" => 500
			,"<i class='icon-f-cake'></i> - Crumpet Club - 1 000" => 1000
			,"<i class='icon-f-telephone-handset'></i> - BitesizeCookie Club - 2 000" => 2000
			,"<i class='icon-f-breads'></i> - Crunch Club - 2 600" => 2600
			,"<i class='icon-f-magnifier-left'></i> - MysteryScience Club - 3 000" => 3000
			,"<i class='icon-f-shoe'></i> - LDR Club - 5 000" => 5000
			,"<i class='icon-f-television'></i> - IBMPC Club - 8 088" => 8088
			,"<i class='icon-f-cookie'></i> - Cookie Club - 10 000" => 10000
			,"<i class='icon-f-pipette'></i> - SpinalTap Club - 11 000" => 11000
			,"<i class='icon-f-cup'></i> - Breakfast Club - 20 000" => 20000
			,"<i class='icon-f-diamond'></i> - Carat Club - 24 000" => 24000
			,"<i class='icon-f-compass'></i> - Peshawar Club - 25 000" => 25000
			,"<i class='icon-f-paper-plane'></i> - MileHigh Club - 30 000" => 30000
			,"<i class='icon-f-chart-pie'></i> - Pi Club - 31 416" => 31416
			,"<i class='icon-f-water'></i> - Towel Club - 42 000" => 42000
			,"<i class='icon-f-cutlery-knife'></i> - Hitman Club - 47 000" => 47000
			,"<i class='icon-f-piggy-bank-empty'></i> - Bacon Club - 50 000" => 50000
			,"<i class='icon-f-rocket-fly'></i> - BrowncoatClub - 57 000" => 57000
			,"<i class='icon-f-crown'></i> - Commodore Club - 64 000" => 64000
			,"<i class='icon-f-globe'></i> - Motorola Club - 68 000" => 68000
			,"<i class='icon-f-music-beam-16'></i> - Trombone Club - 76 000" => 76000
			,"<i class='icon-f-transmitter'></i> - WiFi Club - 80 211" => 80211
			,"<i class='icon-f-money'></i> - Pajama Club - 90 000" => 90000
			,"<i class='icon-f-language'></i> - Tower Of Babble Club - 100 000" => 100000
			,"<i class='icon-f-mac-os'></i> - Mac Club - 128 000" => 128000
			,"<i class='icon-f-balloon-twitter'></i> - TwitterLeaver Club - 144 000" => 144000
			,"<i class=''></i> GetALifeNoSrsly Club - 200 000" => 200000
			,"<i class=''></i> MeaninglessPostCount Club - 231 568" => 231568
			,"<i class=''></i> ADN Club - 256 000" => 256000
			,"<i class=''></i> Pensioners Club - 401 000" => 401000
			,"<i class=''></i> Laughter Club - 555 000" => 555000
			,"<i class=''></i> Gates Club - 640 000" => 640000
			,"<i class=''></i> JoyLuck Club - 888 000" => 888000
			,"<i class=''></i> Millionaires Club - 1 000 000" => 1000000
			);
	public $memberclubs = array();

	public function setUserID($get) {
		$this->user_id = preg_replace('/^@?([a-zA-Z0-9_]+)$/', '@$1', $get);
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
		$url = "https://alpha-api.app.net/stream/0/users/".$id."/?access_token=".ACCESS_TOKEN."&include_user_annotations=1&jsonp=parseResponse";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			if($obj->data->type == "human") {
				$this->user_data = $obj->data;
				$this->user_number = $obj->data->id;
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

	public function getUserPosts() {
		$id = $this->user_id;
		$url = "https://alpha-api.app.net/stream/0/users/".$id."/posts?access_token=".ACCESS_TOKEN."&count=1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->user_posts = $obj->data;
		}
	}

	public function getUserBroadcasts() {
		$user_number = $this->user_number;
		$url = "https://alpha-api.app.net/stream/0/channels/search?creator_id=".$user_number."&type=net.app.core.broadcast&include_annotations=1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->user_broadcasts = $obj->data;
		}
	}

	public function getUserPatter() {
		$user_number = $this->user_number;
		$url = "https://alpha-api.app.net/stream/0/channels/search?creator_id=".$user_number."&type=net.patter-app.room&include_annotations=1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->user_patter = $obj->data;
		}
	}	
}
?>