<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 18-11-14
 * Time: 0:08
 */

require_once LIBS_PATH . "passwordhash.php";

class AuthModel extends Model{

    function __construct($db)
    {
        parent::__construct($db);
    }

    public function logged_in()
    {
        return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']);
    }

    public function get_username()
    {
        return $this->logged_in() ? $_SESSION['username'] : False;
    }

    /**
     * @param $user_info array - Must contain the keys username and password
     */
    public function login($user_info)
    {
        $this->gump->sanitize($user_info);
        $sql  = "SELECT * FROM user WHERE nickname = :nicname";
        $query = $this->db->prepare($sql);
        $parameters = array(':nicname' => $user_info['username']);
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if(validate_password($user_info['password'], $result['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user_info['username'];
            return true;
        } else {
            return false;
        }
    }
}