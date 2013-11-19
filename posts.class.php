<?php

class Posts {
	private $access_token = ACCESS_TOKEN;
	public $user_data = null;
	public $user_id = null;
	public $posts = null;
	public $clubs = array( 
			"🍞 - RollClub" => 500
			,"🍰 - CrumpetClub" => 1000
			,"🍥 - BitesizeCookieClub" => 2000
			,"☎️ - CrunchClub" => 2600
			,"📡 - MysteryScienceClub" => 3000
			,"👟 - LDRClub" => 5000
			,"💻 - IBMPCClub" => 8088
			,"🍪 - CookieClub" => 10000
			,"💉 - SpinalTapClub" => 11000
			,"🍳 - BreakfastClub" => 20000
			,"💎 - CaratClub" => 24000
			,"🍛 - PeshawarClub" => 25000
			,"✈️ - MileHighClub" => 30000
			,"⭕️ - PiClub" => 31416
			,"🐳 - TowelClub" => 42000
			,"🐷 - BaconClub" => 50000
			,"🔱 - CommodoreClub" => 64000
			,"Ⓜ️ - MotorolaClub" => 68000
			,"🎶 - TromboneClub" => 76000
			,"📶 - WiFiClub" => 80211
			,"🗼 - TowerOfBabble" => 100000
			,"MacClub" => 128000
			,"TwitterLeaverClub" => 144000
			,"GetALifeNoSrslyClub" => 200000
			,"MeaninglessPostCountClub" => 231568
			,"ADNClub" => 256000
			,"PensionersClub" => 401000
			,"LaughterClub" => 555000
			,"GatesClub" => 640000
			,"JoyLuckClub" => 888000
			,"MillionairesClub" => 1000000
			);
	public $memberclubs = array();

	public function setUserID($get) {
		if(!preg_match('/^@[a-zA-Z0-9]+$/', $get)) {
			$this->user_id = "@".$get;
		} else {
			$this->user_id = $get;
		}
	}

	public function get_http_response_code($url) {
		$headers = get_headers($url);
		return substr($headers[0], 9, 3);
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
			$this->user_data = $obj->data;
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
