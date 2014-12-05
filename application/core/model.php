<?php

require LIBS_PATH . 'gump.php';

class Model
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }

        $this->gump = new GUMP();
    }
}
