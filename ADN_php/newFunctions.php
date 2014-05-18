<?php

class PostClubs {
	public $user_posts = null;

	public $clubs = array(
		array("name" => "#RollClub", "url" => "http://alpha.jvimedia.org/hashtags/RollClub", "count" => "500")
		,array("name" => "#CrumpetClub", "url" => "http://alpha.jvimedia.org/hashtags/CrumpetClub", "count" => "1 000")
		,array("name" => "#NoonClub", "url" => "http://alpha.jvimedia.org/hashtags/NoonClub", "count" => "1 200")
		,array("name" => "#BitesizeCookieClub", "url" => "http://alpha.jvimedia.org/hashtags/BitesizeCookieClub", "count" => "2 000")
		,array("name" => "#CrunchClub", "url" => "http://alpha.jvimedia.org/hashtags/CrunchClub", "count" => "2 600")
		,array("name" => "#MysteryScienceClub", "url" => "http://alpha.jvimedia.org/hashtags/MysteryScienceClub", "count" => "3 000")
		,array("name" => "#LDRClub", "url" => "http://alpha.jvimedia.org/hashtags/LDRClub", "count" => "5 000")
		,array("name" => "#IBMPCClub", "url" => "http://alpha.jvimedia.org/hashtags/IBMPCClub", "count" => "8 088")
		,array("name" => "#CookieClub", "url" => "http://alpha.jvimedia.org/hashtags/CookieClub", "count" => "10 000")
		,array("name" => "#SpinalTapClub", "url" => "http://alpha.jvimedia.org/hashtags/SpinalTapClub", "count" => "11 000")
		,array("name" => "#BreakfastClub", "url" => "http://alpha.jvimedia.org/hashtags/BreakfastClub", "count" => "20 000")
		,array("name" => "#CaratClub", "url" => "http://alpha.jvimedia.org/hashtags/CaratClub", "count" => "24 000")
		,array("name" => "#PeshawarClub", "url" => "http://alpha.jvimedia.org/hashtags/PeshawarClub", "count" => "25 000")
		,array("name" => "#MileHighClub", "url" => "http://alpha.jvimedia.org/hashtags/MileHighClub", "count" => "30 000")
		,array("name" => "#PiClub", "url" => "http://alpha.jvimedia.org/hashtags/PiClub", "count" => "31 416")
		,array("name" => "#TowelClub", "url" => "http://alpha.jvimedia.org/hashtags/TowelClub", "count" => "42 000")
		,array("name" => "#HitmanClub", "url" => "http://alpha.jvimedia.org/hashtags/HitmanClub", "count" => "47 000")
		,array("name" => "#BaconClub", "url" => "http://alpha.jvimedia.org/hashtags/BaconClub", "count" => "50 000")
		,array("name" => "#BrowncoatClubClub", "url" => "http://alpha.jvimedia.org/hashtags/BrowncoatClubClub", "count" => "57 000")
		,array("name" => "#CommodoreClub", "url" => "http://alpha.jvimedia.org/hashtags/CommodoreClub", "count" => "64 000")
		,array("name" => "#MotorolaClub", "url" => "http://alpha.jvimedia.org/hashtags/MotorolaClub", "count" => "68 000")
		,array("name" => "#TromboneClub", "url" => "http://alpha.jvimedia.org/hashtags/TromboneClub", "count" => "76 000")
		,array("name" => "#WiFiClub", "url" => "http://alpha.jvimedia.org/hashtags/WiFiClub", "count" => "80 211")
		,array("name" => "#PajamaClub", "url" => "http://alpha.jvimedia.org/hashtags/PajamaClub", "count" => "90 000")
		,array("name" => "#TowerOfBabbleClub", "url" => "http://alpha.jvimedia.org/hashtags/TowerOfBabbleClub", "count" => "100 000")
		,array("name" => "#MacClub", "url" => "http://alpha.jvimedia.org/hashtags/MacClub", "count" => "128 000")
		,array("name" => "#TwitterLeaverClub", "url" => "http://alpha.jvimedia.org/hashtags/TwitterLeaverClub", "count" => "140 000")
		,array("name" => "#GetALifeNoSrslyClub", "url" => "http://alpha.jvimedia.org/hashtags/GetALifeNoSrslyClub", "count" => "200 000")
		,array("name" => "#MeaninglessPostCountClub", "url" => "http://alpha.jvimedia.org/hashtags/MeaninglessPostCountClub", "count" => "231 568")
		,array("name" => "#ADNClub", "url" => "http://alpha.jvimedia.org/hashtags/ADNClub", "count" => "256 000")
		,array("name" => "#PensionersClub", "url" => "http://alpha.jvimedia.org/hashtags/PensionersClub", "count" => "401 000")
		,array("name" => "#LaughterClub", "url" => "http://alpha.jvimedia.org/hashtags/LaughterClub", "count" => "555 000")
		,array("name" => "#GatesClub", "url" => "http://alpha.jvimedia.org/hashtags/GatesClub", "count" => "640 000")
		,array("name" => "#JoyLuckClub", "url" => "http://alpha.jvimedia.org/hashtags/JoyLuckClub", "count" => "888 000")
		,array("name" => "#MillionairesClub", "url" => "http://alpha.jvimedia.org/hashtags/MillionairesClub", "count" => "1 000 000")
	); 

	public $memberclubs = array();

	public function setUserPost($get) {
		$this->user_posts = $get;
	}

	public function getClubs() {
		foreach($this->clubs as $club) {
			if($this->user_posts > preg_replace("/[^0-9,.]/", "", $club['count'])) {
				$this->memberclubs[] = "<a href='{$club['url']}'>{$club['name']}</a> ({$club['count']} posts)";
			}
		}
	}
}
?>