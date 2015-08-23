<?php
class UserController extends UserModel{

    public $id;
    public $email;
    public $name;
    public $fname;
    public $lname;
    public $link;
    public $verified;
    public $gender;
    public $career;
    public $about;
    public $token_id;
    public $token;
    public $register_time;
    public $update_time;
    public $visit_time;
    public $priority;
    public $ip;
    public $key;
    public $type;
    public $status;
    // Notification
    public $count_notif;

    public function GetMember($param){
        $param['device']        = DEVICE_TYPE;
        $param['model']         = DEVICE_MODEL;
        $param['os']            = DEVICE_OS;
        $param['browser']       = DEVICE_BROWSER;
        $param['user_agent']    = htmlentities($_SERVER['HTTP_USER_AGENT']);
        $param['expired']       = time() + (60*60*24*7);

        // Get MemberData
        $data = parent::GetMemberProcess($param);

        // Token Checking
        $token = parent::GetTokenProcess($param);

        if($token['token'] == ''){
            
            // Create token
            $param['token'] = $this->GenerateMemberKey($param);
            parent::CreateTokenProcess($param);

            // Get token
            $token = parent::GetTokenProcess($param);
        }

        // Setdata
        $this->id =             $data['me_id'];
        $this->email =          $data['me_email'];
        $this->name =           $data['me_name'];
        $this->fname =          $data['me_fname'];
        $this->lname =          $data['me_lname'];
        $this->link =           $data['me_link'];
        $this->verified =       $data['me_verified'];
        $this->gender =         $data['me_gender'];
        $this->token_id =       $token['token_id'];
        $this->token =          $token['token'];
        $this->register_time =  $data['me_register_time'];
        $this->update_time =    $data['me_update_time'];
        $this->visit_time =     $data['me_visit_time'];
        $this->priority =       $data['me_priority'];
        $this->ip =             $data['me_ip'];
        $this->key =            $data['me_key'];
        $this->type =           $data['me_type'];
        $this->status =         $data['me_status'];
        $this->count_notif =    parent::CountNotificationProcess(array('member_id' => $this->id));
    }

    public function Authentication_token($param){
        $param['device']        = DEVICE_TYPE;
        $param['model']         = DEVICE_MODEL;
        $param['user_agent']    = htmlentities($_SERVER['HTTP_USER_AGENT']);

        $user_id                = $param['member_id'];
        $user_token             = $param['token'];

        $tokenData              = parent::GetTokenProcess($param);

        if($user_id == $tokenData['member_id'] && $user_token == $tokenData['token'])
            return true;
        else
            return false;
    }

    public function RegisterUser($param){
        if(parent::AlreadyUserProcess($param)){
            // Register new user
            parent::RegisterUserProcess($param);
        }
        else{
            // Update user info
        }
    }

    // Saved Visit time for member visit to this site
    public function MemberVisit($param){
        parent::MemberVisitProcess($param);
    }

    public function CookieChecking(){
        if(!empty($_COOKIE['member_id'])){
            // Have Cookie
            return true; 

        }
        else{
            // Not Have Cookie
            return false; 
        }
    }

	public function SessionMemberOnline(){
    	if(!empty($_SESSION['member_id'])){
            // Member is Online
      		return true; 

    	}
    	else{
            // Member is Offline
    		return false; 
    	}
    }
}
?>