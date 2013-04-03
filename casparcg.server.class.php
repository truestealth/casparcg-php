<?php

namespace CasparCG;

class Server
{

	private $hostname = "127.0.0.1";
	private $port = "5250";
	private $username = "";
	private $password = "";
	private $connection = null;
	
	function __construct($hostname = "127.0.0.1",$port = "5250",$username = "",$password = "") {
		$this->hostname = $hostname;
		$this->port = $port;
		$this->username = $username;
		$this->password = $password;
		
		$this->connection = fsockopen($hostname, $port, $errno, $errstr, 10); 
	}
	
	private function getResult(){
	
	}
	
	public function info($channel = "", $layer ""){
		if(intval($channel)){
			
		}
		else{
			
		}
		
		fwrite($this->connection,  $out);
		
		if($result = getResult()){
		
		}
		
		
		if($ret===false) return false;	// Did we get results?
		if(intval($ret[0]) >=4) {
		    $this->error=str_replace("\r\n","",$ret); // Check for resultcode 4xx or 5xx
		    return false;
		}
		$this->result=str_replace("\r\n","",$ret);
		return true;
	}

}