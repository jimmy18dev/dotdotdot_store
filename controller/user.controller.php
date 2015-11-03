<?php
class UserController extends UserModel{

    public $id;
    public $email;
    public $phone;
    public $name;
    public $facebook_id;
    public $facebook_name;
    public $current_order_id;

    // time
    public $create_time_facebook_format;
    public $create_time_thai_format;

    public $notification_count;

    public function GetUser($param){
        // Get MemberData
        $data = parent::GetUserProcess($param);

        // Setdata
        $this->id =             $data['me_id'];
        $this->email =          $data['me_email'];
        $this->phone =          $data['me_phone'];
        $this->name =           $data['me_name'];
        $this->facebook_id =    $data['me_fb_id'];
        $this->facebook_name =  $data['me_fb_name'];
        $this->notification_count = parent::CountNotificationProcess(array('member_id' => $this->id));

        $this->create_time_facebook_format = $data['user_create_time_facebook_format'];
        $this->create_time_thai_format = $data['user_create_time_thai_format'];

        // Current Order
        $this->current_order_id = parent::GetCurrentOrderProcess($param);

        if(empty($this->current_order_id)){
            $order_checking = parent::CheckingAlreadyOrderProcess($param); // return order_id
            if(empty($order_checking))
                $this->current_order_id = parent::CreateOrderProcess($param);
        }
    }

    public function RegisterUser($param){

        // User already checking send (id,facebook_id,email,phone)
        $member_id = parent::AlreadyUserProcess($param);

        if(empty($member_id)){
            // Register new user
            if($param['refer'] == "form"){
                $param['password'] = $this->PasswordEncrypt($param['password']);
            }
            $member_id = parent::RegisterUserProcess($param);
        }
        else{
            if($param['refer'] == "facebook"){
                // Update userinfo by Login with Facebook button
                if(!empty($param['fb_id'])){
                    parent::UpdateInfoByFacebookProcess($param);
                }
            }
        }

        return $member_id;
    }

    public function UpdateUserInfo($param){
        parent::UpdateUserInfoProcess($param);
    }

    public function LoginUserProcess($param){
        $param['email']     = $param['username'];
        $param['phone']     = $param['username'];
        $param['password']  = $this->PasswordEncrypt($param['password']);
        
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

    private function PasswordEncrypt($password){
        if(!empty($password)){
            $password = md5($password.PRIVETE_KEY);
        }
        return $password;
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