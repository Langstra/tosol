<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 18-11-14
 * Time: 0:08
 */

require LIBS_PATH . "passwordhash.php";

class Auth extends Model{

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
     * @param $username - Username
     * @param $password - Password of the user
     */
    public function login($username, $password)
    {

    }
}