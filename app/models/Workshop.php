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

        public function getWorkshopRegistrators(){
            $this->db->query('
                SELECT * 
                FROM registrations 
                WHERE (category = :multimedia) OR (category = :se) OR (category = :networks) OR (category = :datascience)');
            $this->db->bind(":multimedia", "multimedia");
            $this->db->bind(":se", "se");
            $this->db->bind(":networks", "networks");
            $this->db->bind(":datascience", "datascience");
            return $this->db->resultSet();
        }

    }