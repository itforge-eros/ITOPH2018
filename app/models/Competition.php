<?php
    class Competition {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function addCompetition($data){
            $this->db->query('INSERT INTO competitions (title, slug, short_description, full_description, logo_src) VALUES(:title, :slug, :short_description, :full_description, :logo_src)');
            // Bind values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':slug', $data['slug']);
            $this->db->bind(':short_description', $data['short_description']);
            $this->db->bind(':full_description', $data['full_description']);
            $this->db->bind(':logo_src', $data['logo_src']);
    
            // Execute
            if($this->db->execute()){
            return true;
            } else {
            return false;
            }
        }

        public function updateCompetition($data){
            $this->db->query('UPDATE competitions SET title = :title, slug = :slug, short_description = :short_description, full_description = :full_description, logo_src = :logo_src WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':slug', $data['slug']);
            $this->db->bind(':short_description', $data['short_description']);
            $this->db->bind(':full_description', $data['full_description']);
            $this->db->bind(':logo_src', $data['logo_src']);
            
            // Execute
            if($this->db->execute()){
            return true;
            } else {
            return false;
            }
        }

        public function getCompetitions(){
            $this->db->query("SELECT * FROM competitions");
            return $this->db->resultSet();
        }

        public function getCompetitionById($id){
            $this->db->query('SELECT * FROM competitions WHERE id = :id');
            $this->db->bind(":id", $id);
            $row =$this->db->single();
            return $row;
        }

        public function getCompetitionBySlug($slug){
            $this->db->query('SELECT * FROM competitions WHERE slug = :slug');
            $this->db->bind(":slug", $slug);
            $row =$this->db->single();
            return $row;
        }

    }