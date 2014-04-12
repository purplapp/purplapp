<?php

class Lookup {
	private $access_token = ACCESS_TOKEN;
	public $channelID = null;
	public $channel_info = null;
	public $channel_posts = null;
	
	public function setChannelID($get) {
		$this->channelID = $get;
	}
	
	public function getBroadcastChannel() {
		$id = $this->channelID;
		$url = "https://api.app.net/channels/".$id."?access_token=".ACCESS_TOKEN."&include_channel_annotations=1";
		
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->channel_info = $obj->data;
		}
	}
	
	public function getBroadcastPosts() {
		$id = $this->channelID;
		$url = "https://api.app.net/channels/".$id."/messages?access_token=".ACCESS_TOKEN."&include_message_annotations=1&count=5&include_deleted=0";
		
		$json = @file_get_contents($url);
		if($json == false) {
			return false;
		} else {
			$obj = json_decode($json); 
			$this->channel_posts = $obj->data;
		}
	}
}
?>