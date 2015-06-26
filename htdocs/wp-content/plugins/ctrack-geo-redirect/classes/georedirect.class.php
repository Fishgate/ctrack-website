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
    	$this->tblCount = $this->db->get_var("SELECT COUNT(*) FROM $tbl_name;");

    	if($this->tblCount > 0) {
    		return false;
    	}else{ 
    		return true;
    	}
    }

    private function rowExists($value) {
        $this->rowCount = $this->db->get_var($this->db->prepare("SELECT COUNT(*) FROM $this->tbl_name WHERE fieldnum = %s;", $value));

        if($this->rowCount > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function fetchRedirects() {
    	if(!$this->tblIsEmpty($this->tbl_name)) {
    		return $this->db->get_results("SELECT * FROM $this->tbl_name ORDER BY fieldnum ASC;");
    	}else{
    		return false;
    	}
    }

    private function preparePost($post) {
    	foreach($post['redirect-code'] as $key => $value) {
            if( 
                empty(trim($post['redirect-code'][$key])) || 
                empty(trim($post['redirect-url'][$key])) 
            ){
                //omit this row
            }else{
                array_push( $this->redirects_array, array(trim($key), trim($value), trim($post['redirect-url'][$key])) );
            }

    	}

        return $this->redirects_array;
    }
    
    public function updateRedirects($post) {
        $this->results      = array();
        $this->updatedRows  = 0;
        $this->insertedRows = 0;

        if($this->postData = $this->preparePost($post)) {
            foreach ($this->postData as $key => $row) {
                $this->row_id           = $row['0'];
                $this->row_countrycode  = strtoupper($row['1']);
                $this->row_redirecturl  = urlencode($row['2']);

                if ( $this->rowExists($row['0']) ) {
                    //update
                    $this->query = $this->db->prepare("UPDATE $this->tbl_name SET countrycode = %s, redirecturl = %s WHERE fieldnum = %s", $this->row_countrycode, $this->row_redirecturl, $this->row_id);

                    try {
                        if($this->result = $this->db->query($this->query)){
                            $this->updatedRows++;
                        }
                    }catch(Exception $e) {
                        throw new Exception($this->db->last_error);
                    }
                }else{
                    //insert
                    $this->query = $this->db->prepare("INSERT INTO $this->tbl_name (fieldnum, countrycode, redirecturl) VALUES (%s, %s, %s);", $this->row_id, $this->row_countrycode, $this->row_redirecturl);

                    try {
                        $this->result = $this->db->query($this->query);
                        $this->insertedRows++;
                    }catch(Exception $e){
                        throw new Exception($this->db->last_error);
                    }
                }
            }

            return json_encode(array("updatedRows" => $this->updatedRows, "insertedRows" => $this->insertedRows));
        }else{
            return false;
        }
    }


    public static function removeRedirect($post) {

    }
    
}
?>