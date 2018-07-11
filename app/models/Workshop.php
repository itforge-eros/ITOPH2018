<?php
    class Workshop {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getWorkshops(){
            $this->db->query("SELECT * FROM workshops");
            return $this->db->resultSet();
        }

        public function getWorkshopBySlug($slug){
            $this->db->query('SELECT * FROM workshops WHERE slug = :slug');
            $this->db->bind(":slug", $slug);
            $row =$this->db->single();
            return $row;
        }

    }