<?php

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;
    public $html = null;
    public $csrf = null;
    public $L;

    /**
     * Whenever a controller is created, open a database connection too and load "the models".
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->html = $this->loadModel("Html");
        $this->loadLib('csrf');
        $this->csrf = new \Csrf\CsrfToken(300);
        $this->L = new LangQuery();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    /**
     * Loads the "models".
     * @return object models
     */
    /**
     * loads the models with the given name.
     * @param $name string name of the models
     */
    public function loadModel($name)
    {
        $path = MODELS_PATH . strtolower($name) . '_model.php';
        if (file_exists($path)) {
            require $path;
            // The "Model" has a capital letter as this is the second part of the models class name,
            // all models have names like "LoginModel"
            $modelName = $name . 'Model';
            // return the new models object while passing the database connection to the models
            return new $modelName($this->db);
        } else {
            return "File does not exist";
        }
    }

    /**
     * loads the models with the given name.
     * @param $name string name of the models
     */
    public function loadLib($name)
    {
        $path = LIBS_PATH . strtolower($name) . '.php';
        if (file_exists($path)) {
            require $path;

            return true;
        } else {
            return false;
        }
    }
}
