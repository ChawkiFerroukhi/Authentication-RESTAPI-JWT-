<?php

    class User {
        private $db;
        private $table_name = "users";


        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $age;
        public $phone;
        public $joindate;
        public $image;
        public $password;

        public function __construct($db){

            $this->db = $db;

        }

        public function register(){

            // if user already exists to be added

            // sanitize

            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->joindate=htmlspecialchars(strip_tags($this->joindate));
            $this->image=htmlspecialchars(strip_tags($this->image));
            $this->password=htmlspecialchars(strip_tags($this->password));

            $query = "INSERT INTO 
                        " . $this->table_name . " 
                        SET firstname = '".$this->firstname."',
                            lastname= '".$this->lastname."',
                            email= '".$this->email."',
                            age= '".$this->age."',
                            phone= '".$this->phone."',
                            joindate= '".$this->joindate."',
                            image= '".$this->image."',
                            password= '".$this->password."'";

            $this->db->query($query);

            if($this->db->affected_rows > 0){
                return true;
            }
                return false;
        }

        public function login() {

            $query = "SELECT id, firstname, lastname, email, age, phone, joindate, image, password
                        FROM 
                            " . $this->table_name . "
                        WHERE 
                            email='".$this->email."'
                            ";


            $record = $this->db->query($query);

            return $record;


            

        }
    }






?>