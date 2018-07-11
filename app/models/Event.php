<?php
    class Event {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getEvents(){
            $this->db->query("SELECT * FROM events");
            return $this->db->resultSet();
        }
    }