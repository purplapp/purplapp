<?php

class Mention {
	private $access_token = ACCESS_TOKEN;
	public $userID1 = null;
	public $userID2 = null;
	public $user_info_1 = null;
	public $user_number_1 = null;
	public $user_info_2 = null;
	public $user_number_2 = null;
	public $usermention1to2 = null;
	public $usermention1to2annot = null;
	public $usermention2to1 = null;
	public $usermention2to1annot = null;
	
	public function setUserID1($get) {
		$this->userID1 = preg_replace('/^@?([a-zA-Z0-9_]+)$/', '@$1', $get);
		$this->mentionid1 = preg_replace('/^@?([a-zA-Z0-9_]+)$/', '$1', $get);
	}

	public function setUserID2($get) {
		$this->userID2 = preg_replace('/^@?([a-zA-Z0-9_]+)$/', '@$1', $get);
		$this->mentionid2 = preg_replace('/^@?([a-zA-Z0-9_]+)$/', '$1', $get);
	}
	
	public function getUserInfo1() {
		$id1 = $this->userID1;
		$url = "https://api.app.net/users/".$id1."?access_token=".ACCESS_TOKEN."&include_user_annotations=1";
		
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->user_info_1 = $obj->data;
			$this->user_number_1 = $obj->data->id;			
		}
	}

	public function getUserInfo2() {
		$id2 = $this->userID2;
		$url = "https://api.app.net/users/".$id2."?access_token=".ACCESS_TOKEN."&include_user_annotations=1";
		
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->user_info_2 = $obj->data;
			$this->user_number_2 = $obj->data->id;			
		}
	}

	public function getMention1to2() {
		$mentionid1 = $this->mentionid1;
		$creatorid1 = $this->user_number_2;
		$url = "https://api.app.net/posts/search?access_token=".ACCESS_TOKEN."&mentions=".$mentionid1."&creator_id=".$creatorid1."&include_post_annotations=1&count=-1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->usermention1to2 = $obj->data[0];
			$this->usermention1to2annot = $obj->data[0]->annotations;
		}
	}

	public function getMention2to1() {
		$mentionid2 = $this->mentionid2;
		$creatorid2 = $this->user_number_1;
		$url = "https://api.app.net/posts/search?access_token=".ACCESS_TOKEN."&mentions=".$mentionid2."&creator_id=".$creatorid2."&include_post_annotations=1&count=-1";

		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->usermention2to1 = $obj->data[0];
			$this->usermention2to1annot = $obj->data[0]->annotations;			
		}
	}
}
?>