<?php

class CtGeoRedirect {
    private $fetch_url = 'http://www.geoplugin.net/php.gp?ip=';
    private $user_ip;

    public function __construct() {
    	$this->user_ip = $_SERVER['REMOTE_ADDR'];
    }
}

?> 