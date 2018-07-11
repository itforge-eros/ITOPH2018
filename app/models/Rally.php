<?php
    class Rally {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getRallys(){
            $this->db->query("SELECT * FROM rallys");
            return $this->db->resultSet();
        }
    }