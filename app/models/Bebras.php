<?php
    class Bebras {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getBebrasRegistrators(){
            $this->db->query('SELECT * FROM registrations WHERE (category = :bebras)');
            $this->db->bind(":bebras", "bebras");
            return $this->db->resultSet();
        }

    }