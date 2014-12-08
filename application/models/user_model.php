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
        'nickname' => 'required|max_len,12',
        'password' => 'required|min_len,6|max_len,24',
        'first_name' => 'required|max_len,16',
        'last_name' => 'required|max_len,16',
        'email_address' => 'required|valid_email',
        'birthday' => 'date'
    );

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
        $this->gump->sanitize($user_info);
        $validated = $this->gump->validate($user_info, $this->validation_rules);

        if($validated === true) {
            $user_info['nickname'] = strtolower($user_info['nickname']);
            $errors = array();
            if($this->nickname_used($user_info['nickname'])) {
                $errors[] = array('field' => 'nickname', 'rule' => 'validate_unique');
            }
            if($this->email_used($user_info['email_address'])) {
                $errors[] = array('field' => 'email_address', 'rule' => 'validate_unique');
            }
            if($user_info['password'] != $user_info['password_2']) {
                $errors[] = array('field' => 'password_2', 'rule' => 'validate_match');
            }
            if(sizeof($errors) != 0) {
                $validated = $errors;
            }
        }

        if($validated === true) {
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
            return $query->execute($params);
        } else {
            return $validated;
        }
    }

    private function nickname_used($nickname)
    {
        $sql = "SELECT COUNT(*) as users FROM user WHERE nickname = :nickname";
        $query = $this->db->prepare($sql);
        $parameters = array(':nickname' => $nickname);
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->users != 0;
    }

    private function email_used($email)
    {
        $sql = "SELECT COUNT(*) as users FROM user WHERE email_address = :email";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result->users != 0;
    }
}