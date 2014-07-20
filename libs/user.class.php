<?php

class User {

    private $id;
    private $db;
    private $name;


    public function __construct(Sql $db){
        $this->db = $db;
    }
    public function getName(){
        return $this->name;
    }

}

?>
