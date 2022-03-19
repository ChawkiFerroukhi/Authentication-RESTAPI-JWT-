<?php 

    class Database {

    

    public $db;
    public function getConnection() {
        $this->db = null;

        try{
            $this->db = new mysqli('localhost', 'root', '', 'socialnetwork');
        }catch(Exception $e) {
            echo "Failed to connect to the database" . $e->getMessage();
        }

        return $this->db;
    }

    }

?>