<?php

/**
 * @package Class SQL
 * @version 0.1
 */
class Sql {

    private $connect = null;
    public $result = null;
    private $last_query = null;
    private $error = null;
    private $config = array();

    public function __construct($server = '', $login = '', $pass = '', $dbname = null) {
        self::connect($server, $login, $pass, $dbname);
    }

    public function importSetting(Settings $setting) {
        if ($setting instanceof Settings) {
            $this->config = $setting->Value();
        }
    }

    public function connect($server = '', $login = '', $pass = '', $dbname = null) {
        $this->connect = mysql_connect($server, $login, $pass);
        if ($dbname != null) {
            mysql_select_db($dbname, $this->connect);
        }
    }

    public function selectDatabase($dbname) {
        mysql_select_db($dbname, $this->connect);
    }

    public function query($query) {
        $this->last_query = $query;
        $this->result = mysql_query($query, $this->connect);
        if ($this->result) {
            $this->error = false;
            return true;
        } else {
            $this->error = mysql_error($this->connect);
            return false;
        }
    }

    public function getError() {
        return $this->error;
    }

    public function getLastQuery() {
        return $this->last_query;
    }

}

?>