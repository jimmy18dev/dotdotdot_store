<?php
class ConfigController extends ConfigModel{

	public $email_host;
	public $email_username;
	public $email_password;
	public $email_port;
	public $email_address;
	public $email_name;

    public $facebook_app_id;
    public $facebook_app_secret;

    public $meta_title;
    public $meta_description;
    public $meta_sitename;
    public $meta_author;
    public $meta_keyword;

    public $email_status;
    public $facebook_status;

	public function GetConfig(){
        $dataset = parent::GetConfigProcess();

        foreach ($dataset as $var){
        	if($var['cf_key'] == 'email_host')
        		$this->email_host = $var['cf_value'];
        	else if($var['cf_key'] == 'email_username')
        		$this->email_username = $var['cf_value'];
        	else if($var['cf_key'] == 'email_password')
        		$this->email_password = $var['cf_value'];
        	else if($var['cf_key'] == 'email_port')
        		$this->email_port = $var['cf_value'];
        	else if($var['cf_key'] == 'email_address')
        		$this->email_address = $var['cf_value'];
        	else if($var['cf_key'] == 'email_name')
        		$this->email_name = $var['cf_value'];
            else if($var['cf_key'] == 'facebook_app_id')
                $this->facebook_app_id = $var['cf_value'];
            else if($var['cf_key'] == 'facebook_app_secret')
                $this->facebook_app_secret = $var['cf_value'];
            else if($var['cf_key'] == 'meta_title')
                $this->meta_title = $var['cf_value'];
            else if($var['cf_key'] == 'meta_description')
                $this->meta_description = $var['cf_value'];
            else if($var['cf_key'] == 'meta_sitename')
                $this->meta_sitename = $var['cf_value'];
            else if($var['cf_key'] == 'meta_author')
                $this->meta_author = $var['cf_value'];
            else if($var['cf_key'] == 'meta_keyword')
                $this->meta_keyword = $var['cf_value'];
    	}

        $this->facebook_status = $this->FacebookEnable();
        $this->email_status = $this->EmailEnable();
    }

    private function FacebookEnable(){
        if(!empty($this->facebook_app_id) && !empty($this->facebook_app_secret)){
            return true;
        }
        else{
            return false;
        }
    }

    private function EmailEnable(){
        if(!empty($this->email_host) && !empty($this->email_username) && !empty($this->email_password) && !empty($this->email_port) && !empty($this->email_address) && !empty($this->email_name)){
            return true;
        }
        else{
            return false;
        }
    }
}
?>