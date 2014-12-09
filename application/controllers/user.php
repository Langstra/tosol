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


    public function register()
    {
        $this->user = $this->loadModel("User");

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

            if(!isset($_POST['username']) || empty($_POST['username'])) {
                $this->login_error[] = array('field' => "username", 'rule' => 'validate_required');
            } elseif (!isset($_POST['password']) || empty($_POST['password'])) {
                $this->login_error[] = array('field' => "password", 'rule' => 'validate_required');
            } else {

                $this->login_error = $this->auth->login($_POST);
                if ($this->login_error === true) {
                    unset($this->login_error);
                    unset($_POST);
                } else {
                    $this->login_error[] = array('field' => "password", 'rule' => 'validate_correct');
                }
            }
        } else {
            $this->login_error[] = array('field' => "csrf", 'rule' => 'validate_token');
        }

        require VIEWS_PATH . '_templates/hp_header.php';
        require VIEWS_PATH . 'user/login.php';
        require VIEWS_PATH . '_templates/hp_footer.php';
    }

} 