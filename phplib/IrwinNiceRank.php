<?php
	class NiceRank {
		public $nicerank = null;

		public function setUserID($get) {
			$this->user_id = $get;
		}
		
		public function getNiceRank() {
			$id = $this->user_id;
			$url = "http://api.search-adn.net/user/nicerank?ids=".$id."&show_details=Y";

			$json = @file_get_contents($url);
			if($json == false) {
				return false;
			} else {
				$obj = json_decode($json); 
				$this->nicerank = $obj->data;
			}
		}
		
	}
?>