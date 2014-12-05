<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 18-11-14
 * Time: 0:08
 */

class Auth {

    function __construct()
    {
        session_start();
    }

    public function logged_in()
    {
        return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']);
    }

    public function get_username()
    {
        return $this->logged_in() ? $_SESSION['username'] : False;
    }
}