<?php

class Posts {
	private $access_token = ACCESS_TOKEN;
	public $user_data = null;
	public $user_id = null;
	public $posts = null;
	public $user_number = null;
	public $user_posts = null;
	// public $user_broadcasts = null;
	// public $user_patter = null;
	// public $first_user_mention = null;
	// public $first_user_post = null;

	public $clubs = array(
		array("icon" => "bread", "name" => "Roll Club", "count" => "500")
		,array("icon" => "cake", "name" => "Crumpet Club", "count" => "1 000")
		,array("icon" => "clock", "name" => "Noon Club", "count" => "1 200")
		,array("icon" => "telephone-handset", "name" => "BitesizeCookie Club", "count" => "2 000")
		,array("icon" => "breads", "name" => "Crunch Club", "count" => "2 600")
		,array("icon" => "magnifier-left", "name" => "MysteryScience Club", "count" => "3 000")
		,array("icon" => "shoe", "name" => "LDR Club", "count" => "5 000")
		,array("icon" => "television", "name" => "IBMPC Club", "count" => "8 088")
		,array("icon" => "cookie", "name" => "Cookie Club", "count" => "10 000")
		,array("icon" => "pipette", "name" => "SpinalTap Club", "count" => "11 000")
		,array("icon" => "cup", "name" => "Breakfast Club", "count" => "20 000")
		,array("icon" => "diamond", "name" => "Carat Club", "count" => "24 000")
		,array("icon" => "compass", "name" => "Peshawar Club", "count" => "25 000")
		,array("icon" => "paper-plane", "name" => "MileHigh Club", "count" => "30 000")
		,array("icon" => "chart-pie", "name" => "Pi Club", "count" => "31 416")
		,array("icon" => "water", "name" => "Towel Club", "count" => "42 000")
		,array("icon" => "cutlery-knife", "name" => "Hitman Club", "count" => "47 000")
		,array("icon" => "piggy-bank-empty", "name" => "Bacon Club", "count" => "50 000")
		,array("icon" => "rocket-fly", "name" => "BrowncoatClub Club", "count" => "57 000")
		,array("icon" => "crown", "name" => "Commodore Club", "count" => "64 000")
		,array("icon" => "globe", "name" => "Motorola Club", "count" => "68 000")
		,array("icon" => "music-beam-16", "name" => "Trombone Club", "count" => "76 000")
		,array("icon" => "transmitter", "name" => "WiFi Club", "count" => "80 211")
		,array("icon" => "money", "name" => "Pajama Club", "count" => "90 000")
		,array("icon" => "language", "name" => "Tower Of Babble Club", "count" => "100 000")
		,array("icon" => "mac-os", "name" => "Mac Club", "count" => "128 000")
		,array("icon" => "balloon-twitter", "name" => "TwitterLeaver Club", "count" => "140 000")
		,array("icon" => "", "name" => "GetALifeNoSrsly Club", "count" => "200 000")
		,array("icon" => "", "name" => "MeaninglessPostCount Club", "count" => "231 568")
		,array("icon" => "", "name" => "ADN Club", "count" => "256 000")
		,array("icon" => "", "name" => "Pensioners Club", "count" => "401 000")
		,array("icon" => "", "name" => "Laughter Club", "count" => "555 000")
		,array("icon" => "", "name" => "Gates Club", "count" => "640 000")
		,array("icon" => "", "name" => "JoyLuck Club", "count" => "888 000")
		,array("icon" => "", "name" => "Millionaires Club", "count" => "1 000 000")
		);

	public $memberclubs = array();

	public function setUserID($get) {
		$this->user_id = preg_replace('/^@?([a-zA-Z0-9_]+)$/', '@$1', $get);
	}

	public function getPosts() {
		$id = $this->user_id;
		$url = "https://api.app.net/users/".$id."?access_token=".ACCESS_TOKEN."&include_user_annotations=1";
		
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->posts = $obj->data->counts->posts;
			$this->user_data = $obj->data;
			$this->user_number = $obj->data->id;			
		}
	}

	public function getClubs() {
		foreach($this->clubs as $club) {
			if($this->posts > preg_replace("/[^0-9,.]/", "", $club['count'])) {
				$this->memberclubs[] = "<i class='icon-f-{$club[icon]}'></i> - {$club[name]} - <b>{$club[count]}</b>";
			}
		}
	}

	public function getUserPosts() {
		$id = $this->user_id;
		$url = "https://api.app.net/users/".$id."/posts?access_token=".ACCESS_TOKEN."&count=1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->user_posts = $obj->data;
		}
	}

	public function getFirstPost() {
		$user_number = $this->user_number;
		$url = "https://api.app.net/posts/search?access_token=".ACCESS_TOKEN."&creator_id=".$user_number."&count=-1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->first_user_post = $obj->data;
		}
	}

	public function getFirstMention() {
		$user_number = $this->user_number;
		$url = "https://api.app.net/users/".$user_number."/mentions?access_token=".ACCESS_TOKEN."&count=-1";
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->first_user_mention = $obj->data;
		}
	}

	public function getUserBroadcasts() {
		$user_number = $this->user_number;
		$url = "https://api.app.net/channels/search?creator_id=".$user_number."&type=net.app.core.broadcast&include_message_annotations=1";

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
		$url = "https://api.app.net/channels/search?creator_id=".$user_number."&type=net.patter-app.room&include_message_annotations=1";

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