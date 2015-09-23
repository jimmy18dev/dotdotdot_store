<?php
class Database{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
 
    private $dbh;
    private $error;
    private $stmt;
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){
    	$this->stmt = $this->dbh->prepare($query);
	}

	public function bind($param, $value, $type = null){
    	if (is_null($type)) {
        	switch (true) {
            	case is_int($value):
                	$type = PDO::PARAM_INT;
                	break;
            	case is_bool($value):
                	$type = PDO::PARAM_BOOL;
                	break;
            	case is_null($value):
                	$type = PDO::PARAM_NULL;
                	break;
            	default:
                	$type = PDO::PARAM_STR;
        	}
    	}
    	$this->stmt->bindValue($param, $value, $type);
	}
	public function execute(){
    	return $this->stmt->execute();
	}
	public function resultset(){
    	$this->execute();
    	return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	public function single(){
    	$this->execute();
    	return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function rowCount(){
    	return $this->stmt->rowCount();
	}
	public function lastInsertId(){
    	return $this->dbh->lastInsertId();
	}
	public function beginTransaction(){
    	return $this->dbh->beginTransaction();
	}
	public function endTransaction(){
    	return $this->dbh->commit();
	}
	public function cancelTransaction(){
    	return $this->dbh->rollBack();
	}
	public function debugDumpParams(){
    	return $this->stmt->debugDumpParams();
	}

    //Find Real IP address.
    public function GetIpAddress(){
        //check ip from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //to check ip is pass from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    // Text, Message to URL Friendly
    public function url_friendly_process($data){
        $data       = preg_replace('#[^-ก-๙a-zA-Z0-9]#u','-', $data);
        if(substr($data,0,1) == '-'){
            $data   = substr($data,1);
        }
        if(substr($data,-1) == '-'){
          $data     = substr($data,0,-1);
        }
        $data       = urldecode($data);
        $data       = str_replace(array('   ','  ',' '),array('-','-','-'),$data);
        $data       = str_replace(array('---','--'),array('-','-'),$data);
        
        //return rawurlencode($data);
        return ($data);
    }

    // Datetime to Thai Date format
    public function date_thaiformat($datetime){
        $monthText = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        $hour   = date("H",strtotime($datetime));
        $minute = date("i",strtotime($datetime));
        $year   = date('Y',strtotime($datetime))+543;
        $month  = date('n',strtotime($datetime));
        $date   = date('j',strtotime($datetime));

        $month  = $monthText[$month-1];
        return $date.' '.$month.' '.$year.' เวลา '.$hour.':'.$minute;
    }

    // Datetime to Facebook format
    public function date_facebookformat($datetime){
        $timestamp  = strtotime($datetime);
        $diff       = time() - $timestamp;

        $periods    = array('วินาที','นาที','ชั่วโมง');
        $words      = 'ที่แล้ว';
  
        if($diff < 30){
            $text   = "เมื่อสักครู่"; 
        }
        else if($diff < 60){
            $i      = 0;
            $diff   = ($diff == 1)?"":$diff;
            $text   = "$diff $periods[$i]$words"; 
        }
        else if($diff < 3600){
            $i      = 1;
            $diff   = round($diff/60);
            $diff   = ($diff == 3 || $diff == 4)?"":$diff;
            $text   = "$diff $periods[$i]$words"; 
        }
        else if($diff < 86400){
            // 1 Day
            $i      = 2;
            $diff   = round($diff/3600);
            $diff   = ($diff != 1)?$diff:"" . $diff ;   
            $text   = "$diff $periods[$i]$words"; 
        }
        else if($diff < 432000){
            // 5 Day
            $diff   = round($diff/86400);
            $text   = $diff.' วันที่แล้ว';                
        }
        else{
            $thMonth = array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
            
            $date   = date("j", $timestamp);
            $month  = $thMonth[date("m", $timestamp)-1];
            $y      = date("Y", $timestamp)+543;
            $t1     = "$date  $month";
            $t2     = "$date  $month  $y";    

            if($timestamp < strtotime(date("Y-01-01 00:00:00"))){
                $text = $t2;
            }
            else{         
                $text = $t1; 
            }
        }
        return $text;
    }

    // Get age by Datetime
    function dateDifference($date){

        $diff = strtotime($date) - time();

        if($diff < 10){
            $text   = 'ขณะนี้'; 
        }
        else if($diff < 60){
            $text   = $diff.' วินาที'; 
        }
        else if($diff < 3600){
            $diff   = round($diff/60);
            $text   = $diff.' นาที'; 
        }
        else if($diff < 86400){
            // 1 Day
            $diff   = floor($diff/3600);
            $text   = $diff.' ชั่วโมง'; 
        }
        else{
            $diff   = round($diff/86400);
            $text   = $diff.' วัน';                
        }

        return $text;
    }
}
?>