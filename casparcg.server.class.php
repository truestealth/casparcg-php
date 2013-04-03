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
	
	private function printResult($result, $type = ""){
	    switch ($type) {
	        case 'echo':
	            echo implode("\n",$result['message']);
	            break;
	        case 'html'
	            echo implode("</br>",$result['message']);
	            break;
            case 'vardump'
                var_dump($result['message']);
                break;
            case 'printr'
                print_r($result['message']);
                break;
	    }
	    return $result;
	}
	
	private function getResult(){
	    $ret = fgets($this->connection);
	    
	    if($ret===false) return false;	// Did we get results?
	    
	    $result = array(
	        'code' => str_replace("\r\n","",$ret),
	        'message' => array();
	    );
	    
	    while(($ret=fgets($this->connection))!==false) {
	    	if($ret=="\r\n") { return $result; }
	    	$result['message'][] = str_replace("\r\n","",$ret);
	    }
	    return $result;
	}
	
	public function cinf($filename){
	    $command = "CINF " . $filename;
	    
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}
	
	public function cls(){
	    $command = "CLS";
	    
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}
	
	public function tls($folder = "./"){
	    $command = "TLS " . $folder;
	    
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}
	
	public function version($component = "SERVER"){
	    $command = "VERSION " . strtoupper($component);
	    
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}
	
	public function info($channel = "", $layer ""){
	    $command = "INFO ";
	
		if(intval($channel)){
			$command .= $channel;
			if(intval($layer)){
			    $command .= "-" . $layer;
			}
		}
		else{
			$command .= strtoupper($channel);
		}
		
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}
	
	public function diag(){
	    $command = "DIAG";
	    
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}
	
	public function bye(){
	    $command = "BYE";
	    
		fwrite($this->connection,  $command);
		
		if($result = getResult()){
		    return printResult($result);
		}
		else{
		    echo 'Unknown error';
		}
	}

}