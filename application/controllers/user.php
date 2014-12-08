<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 18-11-14
 * Time: 23:40
 */

class User extends Controller {

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
        require APP . 'views/_templates/hp_header.php';
        require APP . 'views/user/register.php';
        require APP . 'views/_templates/hp_footer.php';
    }

} 