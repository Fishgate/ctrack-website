<?php

class CtrackGeoRedirect {
    private $db;
	public $tbl_name = 'ctrack_geo_redirect';
	private $redirect_tbl_rows;
    private $fetch_url = 'http://www.geoplugin.net/php.gp?ip=';
    private $user_ip;
    private $redirects_array = array();

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    	$this->tbl_name = $wpdb->prefix . $this->tbl_name;
    	$this->user_ip = $_SERVER['REMOTE_ADDR'];
    }

    private function tblIsEmpty($tbl_name) {
    	$this->tblCount = $this->db->get_var("SELECT COUNT(*) FROM $tbl_name");

    	if($this->tblCount > 0) {
    		return false;
    	}else{
    		return true;
    	}
    }

    public function fetchRedirects() {
    	if(!$this->tblIsEmpty($this->tbl_name)) {
    		return $this->db->get_results("SELECT * FROM $this->tbl_name");
    	}else{
    		return false;
    	}
    }

    private function preparePost($post) {
		foreach($post['redirect-code'] as $key => $value) {
			array_push( $this->redirects_array, array($key, $value, $post['redirect-url'][$key]) );
		}

		return $this->redirects_array;
    }

    public function updateRedirectsTbl(){
        
    }
}

?> 