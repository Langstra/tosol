<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 18-11-14
 * Time: 23:40
 */

class User extends Controller {


    private $user;
    public $registration_error;
    public $login_error;

    function __construct()
    {
        $this->user = $this->loadModel("User");
    }

    public function register()
    {


        if(isset($_POST['csrf']) && $this->csrf->checkToken()) {
            $this->registration_error = $this->user->register($_POST);
            if($this->registration_error === true) {
                unset($this->registration_error);
            }
        } else {
            $this->registration_error[] = array('field' => "csrf", 'rule' => 'validate_token');
        }
        require VIEWS_PATH . '_templates/hp_header.php';
        require VIEWS_PATH . 'user/register.php';
        require VIEWS_PATH . '_templates/hp_footer.php';
    }

    public function login() {
        if(isset($_POST['csrf']) && $this->csrf->checkToken()) {
            $this->login_error = $this->user->login($_POST);
            if($this->login_error === true) {
                unset($this->login_error);
            }
        } else {
            $this->login_error[] = array('field' => "csrf", 'rule' => 'validate_token');
        }

        require VIEWS_PATH . '_templates/hp_header.php';
        require VIEWS_PATH . 'user/login.php';
        require VIEWS_PATH . '_templates/hp_footer.php';
    }

} 