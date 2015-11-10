<?php
class UserController extends UserModel{

    public $id;
    public $email;
    public $phone;
    public $name;
    public $facebook_id;
    public $facebook_name;
    public $verify_code;
    public $forget_code;
    public $status;
    public $total_payment;


    // time
    public $create_time_facebook_format;
    public $create_time_thai_format;

    public $notification_count;

    // Token
    public $token;

    // Current order
    public $current_order_id;
    public $current_order_total;
    public $current_order_amount;
    public $current_order_payment;

    public function GetUser($param){
        // Setup
        $param['device']        = DEVICE_TYPE;
        $param['model']         = DEVICE_MODEL;
        $param['os']            = DEVICE_OS;
        $param['browser']       = DEVICE_BROWSER;
        $param['user_agent']    = htmlentities($_SERVER['HTTP_USER_AGENT']);
        $param['expired']       = time() + (60*60*24*7);  // 1 Week.

        // Get MemberData
        $data = parent::GetUserProcess($param);
        $dataset_token = parent::GetTokenProcess($param);

        if(empty($dataset_token['tk_token'])){
            $param['new_token'] = $this->GenerateMemberKey($param);
            parent::CreateTokenProcess($param);
            $dataset_token = parent::GetTokenProcess($param);
        }

        // Setdata
        $this->id                   = $data['me_id'];
        $this->email                = $data['me_email'];
        $this->phone                = $data['me_phone'];
        $this->name                 = $data['me_name'];
        $this->facebook_id          = $data['me_fb_id'];
        $this->facebook_name        = $data['me_fb_name'];
        $this->notification_count   = parent::CountNotificationProcess(array('member_id' => $this->id));

        $this->create_time_facebook_format  = $data['user_create_time_facebook_format'];
        $this->create_time_thai_format      = $data['user_create_time_thai_format'];

        $this->verify_code          = $data['me_verify_code'];
        $this->fotget_code          = $data['me_fotget_code'];
        $this->status               = $data['me_status'];

        $this->total_payment        = parent::GetTotalPaymentProcess(array('member_id' => $this->id));

        // Current Order
        $current_order = parent::GetCurrentOrderProcess(array('member_id' => $this->id));
        $this->current_order_id     = $current_order['od_id'];
        $this->current_order_total  = $current_order['od_total'];
        $this->current_order_amount = $current_order['od_amount'];
        $this->current_order_payments = $current_order['od_payments'];

        // Token key
        $this->token                = $dataset_token['tk_token'];

        setcookie('token_key',$this->token, COOKIE_TIME);
        setcookie('member_id',$this->id, COOKIE_TIME);

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

    private function GenerateMemberKey($param){
        return md5(time().$_SERVER['HTTP_USER_AGENT']);
    }



    public function RegisterUser($param){

        // User already checking send (id,facebook_id,email,phone)
        $member_id = parent::AlreadyUserProcess($param);

        if(empty($member_id)){
            // Register new user
            if($param['refer'] == "form"){
                $param['password']      = $this->PasswordEncrypt($param['password']);
                $param['verify_code']   = $this->EmailCodeGenerate($param['email']);
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

    public function ForgetPassword($param){
        $email = $param['email'];

        if(!empty($email))
            $forget_code = md5($email.PRIVETE_KEY.time());
        else
            return false;

        parent::UpdateForgetCodeProcess(array('email' => $email, 'forget_code' => $forget_code));

        $dataset['email']       = $email;
        $dataset['forget_code'] = $forget_code;

        return $dataset;
    }

    public function ChangePasswordByForget($param){
        $new_password = $this->PasswordEncrypt($param['password']);
        parent::ChangePasswordByForgetProcess(array(
            'email'         => $param['email'],
            'forget_code'   => $param['forget_code'],
            'password'      => $new_password,
        ));
    }

    public function ChangePassword($param){
        $param['password'] = $this->PasswordEncrypt($param['password']);
        parent::ChangePasswordProcess($param);
    }



    // Update user info by Customer edit on website
    public function UpdateUserInfo($param){
        parent::UpdateUserInfoProcess($param);
    }

    // Update name and phone by money confirm form
    public function UpdateNamePhone($param){
        parent::UpdateNamePhoneProcess($param);
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

    private function EmailCodeGenerate($email){
        if(!empty($email)){
            $email = md5(PRIVETE_KEY.$email.PRIVETE_KEY);
        }
        return $email;
    }

    public function Verified($param){
        $member_id = parent::VerifyChecking(array('email' => $param['email'],'verify_code'=> $param['verify_code']));

        if(!empty($member_id)){
            parent::VerifiedProcess(array('member_id' => $member_id));
            return true;
        }
        else{
            return false;
        }
    }
}
?>