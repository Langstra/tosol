<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 18-11-14
 * Time: 15:27
 */


require LIBS_PATH . "passwordhash.php";

class UserModel extends Model{


    private $validation_rules = array(
        'nickname' => 'required|max_length,12',
        'password' => 'required|min_length,6|max_length,24',
        'password_2' => 'required|min_length,6|max_length,24',
        'first_name' => 'required|max_length,16',
        'last_name' => 'required|max_length,16',
        'email_address' => 'required|valid_email',
    );

    private $mandated_fields = array('nickname','password','password_2','first_name','last_name','email_address');


    function __construct($db)
    {
        parent::__construct($db);
    }

    /**
     * @param $user_info Array with user information
     *      keys to use are:
     *          nickname:   Nickname for the user
     *          password:   Password the user uses
     *          password_2
     *          first_name: First name
     *          last_name:  Last name
     *          birthday:   Users birthday
     *          email_address: User's email address
     *          o2auth_id:  ID used when logging in with o2auth
     *          o2auth_provider:    Provider of o2auth when using
     */
    public function register($user_info)
    {
        $valid = true;
        $empty_fields = array();
        foreach($this->mandated_fields as $val) {
            if(!in_array($val, array_keys($user_info)) || empty($user_info[$val])) {
                $valid = false;
                $empty_fields[] = $val;
            }
        }
        $used_fields = array();
        if($valid) {
            if($this->nickname_used($user_info['nickname'])) {
                $used_fields[] = 'nickname';
            }
            if($this->email_used($used_fields['email_address'])) {
                $used_fields[] = 'email_address';
            }
        } else {
            return $empty_fields;
        }
        if($valid) {
            $user_info['password'] = create_hash($user_info['password']);
            array_splice($user_info, array_search('password_2', array_keys($user_info)), 1);
            array_splice($user_info, array_search('csrf', array_keys($user_info)), 1);
            $params = array();
            $sql = "INSERT INTO user (";
            foreach($user_info as $key => $value) {
                $sql .= $key.",";
            }
            $sql = substr($sql, 0, -1);
            $sql .= ") VALUES (";
            foreach($user_info as $key => $value) {
                $sql .= " :".$key.",";
                $params[':'.$key] = $value;
            }
            $sql = substr($sql, 0, -1);
            $sql .= ")";
            $query = $this->db->prepare($sql);
            $query->execute($params);
            return "Succes";
        }
    }

    private function nickname_used($nickname)
    {
        $sql = "SELECT COUNT(*) as users FROM user WHERE nickname = :nickname";
        $query = $this->db->prepare($sql);
        $parameters = array(':nickname' => $nickname);
        $query->execute($parameters);
        return $query->users != 0;
    }

    private function email_used($email)
    {
        $sql = "SELECT COUNT(*) as users FROM user WHERE email_address = :email";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);
        return $query->users != 0;
    }
}