<?php
class ConfigModel extends Database{

	public function GetConfigProcess(){
		parent::query('SELECT * FROM dd_config');
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	public function ListConfigProcess($group){
		parent::query('SELECT * FROM dd_config WHERE cf_group = :group');
		parent::bind(':group', $group);
		parent::execute();
		$dataset = parent::resultset();
		return $dataset;
	}

	// Config Update
	public function UpdateEmailConfigProcess($param){
		// Email Host
		parent::query('UPDATE dd_config SET cf_value = :host WHERE cf_key = "email_host"');
		parent::bind(':host', $param['email_host']);
		parent::execute();

		// Email Username
		parent::query('UPDATE dd_config SET cf_value = :username WHERE cf_key = "email_username"');
		parent::bind(':username', $param['email_username']);
		parent::execute();

		// Email Password
		parent::query('UPDATE dd_config SET cf_value = :password WHERE cf_key = "email_password"');
		parent::bind(':password', $param['email_password']);
		parent::execute();

		// Email Port
		parent::query('UPDATE dd_config SET cf_value = :port WHERE cf_key = "email_port"');
		parent::bind(':port', $param['email_port']);
		parent::execute();

		// Email Address
		parent::query('UPDATE dd_config SET cf_value = :address WHERE cf_key = "email_address"');
		parent::bind(':address', $param['email_address']);
		parent::execute();

		// Email Name
		parent::query('UPDATE dd_config SET cf_value = :name WHERE cf_key = "email_name"');
		parent::bind(':name', $param['email_name']);
		parent::execute();
	}

	public function UpdateFacebookSDKConfigProcess($param){
		// Facebook App ID
		parent::query('UPDATE dd_config SET cf_value = :app_id WHERE cf_key = "facebook_app_id"');
		parent::bind(':app_id', $param['facebook_app_id']);
		parent::execute();

		// Facebook App Secret
		parent::query('UPDATE dd_config SET cf_value = :app_secret WHERE cf_key = "facebook_app_secret"');
		parent::bind(':app_secret', $param['facebook_app_secret']);
		parent::execute();
	}

	public function UpdateMetaConfigProcess($param){
		// Title
		parent::query('UPDATE dd_config SET cf_value = :title WHERE cf_key = "meta_title"');
		parent::bind(':title', $param['meta_title']);
		parent::execute();

		// Description
		parent::query('UPDATE dd_config SET cf_value = :description WHERE cf_key = "meta_description"');
		parent::bind(':description', $param['meta_description']);
		parent::execute();

		// Sitename
		parent::query('UPDATE dd_config SET cf_value = :sitename WHERE cf_key = "meta_sitename"');
		parent::bind(':sitename', $param['meta_sitename']);
		parent::execute();

		// Author
		parent::query('UPDATE dd_config SET cf_value = :author WHERE cf_key = "meta_author"');
		parent::bind(':author', $param['meta_author']);
		parent::execute();

		// Keyword
		parent::query('UPDATE dd_config SET cf_value = :keyword WHERE cf_key = "meta_keyword"');
		parent::bind(':keyword', $param['meta_keyword']);
		parent::execute();
	}
}
?>