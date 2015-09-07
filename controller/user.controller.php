<?php
class UserController extends UserModel{

    public $id;
    public $email;
    public $phone;
    public $name;
    public $facebook_id;
    public $facebook_name;
    public $current_order_id;

    public function GetUser($param){
        // Get MemberData
        $data = parent::GetUserProcess($param);
        $this->current_order_id = parent::CurrentOrderProcess($param);

        // Setdata
        $this->id =             $data['me_id'];
        $this->email =          $data['me_email'];
        $this->phone =          $data['me_phone'];
        $this->name =           $data['me_name'];
        $this->facebook_id =    $data['me_fb_id'];
        $this->facebook_name =  $data['me_fb_name'];
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

    public function LoginUserProcess($param){
        $param['email'] = $param['username'];
        $param['phone'] = $param['username'];
        
        $user_id = parent::LoginUserProcess($param);

        if(!empty($user_id) && $user_id != 0){
            $_SESSION['member_id'] = $user_id;
            setcookie('member_id', $user_id, COOKIE_TIME);
            return true;
        }
        else{
            return false;
        }
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

    // Saved Visit time for member visit to this site
    public function MemberVisit($param){
        parent::MemberVisitProcess($param);
    }
}
?>