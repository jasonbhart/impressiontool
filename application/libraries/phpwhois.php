<?php

class Phpwhois
{
	var $whois = '';
	
    public function __construct()
    {
        require_once APPPATH."/third_party/phpwhois/whois.main.php";
		$this->whois = new Whois();
    }
}
