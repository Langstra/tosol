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

        if(isset($_POST['csrf'])) {
            $this->register_return = $this->user->register($_POST);
        }
        require APP . 'views/_templates/hp_header.php';
        require APP . 'views/user/register.php';
        require APP . 'views/_templates/hp_footer.php';
    }

} 