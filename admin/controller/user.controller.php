<?php
class UserController extends UserModel{

    public $id;
    public $email;
    public $phone;
    public $name;
    public $facebook_id;
    public $facebook_name;
    public $current_order_id;
    public $type;
    public $token;

    // time
    public $create_time_facebook_format;
    public $create_time_thai_format;


    // Set and Unset administrator
    public function SetAdmin($param){
        parent::SetAdminProcess($param);
    }
    public function UnsetAdmin($param){
        parent::UnsetAdminProcess($param);
    }





    public function GetUser($param){
        
        $param['device']        = DEVICE_TYPE;
        $param['model']         = DEVICE_MODEL;
        $param['os']            = DEVICE_OS;
        $param['browser']       = DEVICE_BROWSER;
        $param['user_agent']    = htmlentities($_SERVER['HTTP_USER_AGENT']);
        $param['expired']       = time() + (60*60*24*7);  // 1 Week.

        // Get MemberData
        $data = parent::GetUserProcess($param);
        $dataset_token = parent::GetTokenProcess($param);

        // Setdata
        $this->id =             $data['me_id'];
        $this->email =          $data['me_email'];
        $this->phone =          $data['me_phone'];
        $this->name =           $data['me_name'];
        $this->facebook_id =    $data['me_fb_id'];
        $this->facebook_name =  $data['me_fb_name'];
        $this->type                 = $data['me_type'];
        $this->token                = $dataset_token['tk_token'];

        setcookie('token_key',$this->token, COOKIE_TIME);
        setcookie('member_id',$this->id, COOKIE_TIME);

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

    public function Authentication(){
        $param['member_id']     = MEMBER_ID;
        $param['device']        = DEVICE_TYPE;
        $param['user_agent']    = htmlentities($_SERVER['HTTP_USER_AGENT']);

        // Parameter: member_id, device, user_agent
        $dataset = parent::GetTokenProcess($param);
        
        $token_key_cookie       = $_COOKIE['token_key'];

        if($token_key_cookie == $dataset['tk_token'] && !empty($param['member_id'])){
            return true;
        }
        else{
            return false;
        }
    }

    public function RegisterUser($param){
        if(parent::AlreadyUserProcess($param)){
            // Register new user
            $member_id = parent::RegisterUserProcess($param);
        }
        else{
            // Update user info
            if(!empty($param['fb_id'])){
                parent::UpdateUserProcess($param);
            }
        }

        return $member_id;
    }

    public function UpdateUserInfo($param){
        parent::UpdateUserInfoProcess($param);
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

    // List all Member
    public function ListAllMember($param){
        $data = parent::ListAllMemberProcess($param);
        $this->Render('customer-items',$param['current_id'],$data);
    }

    private function Render($mode,$current_id,$data){
        foreach ($data as $var){
            if($mode == "customer-items"){
                include'template/user/user.items.php';
            }
        }
        unset($data);
    }
}
?>