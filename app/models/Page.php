<?php
    class Page {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPages(){
            $this->db->query('SELECT * FROM pages');

            $results = $this->db->resultSet();

            return $results;
        }

        public function addPage($data){
            $this->db->query('INSERT INTO pages (title, content, slug) VALUES(:title, :content, :slug)');
            // Bind values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':content', $data['content']);
            $this->db->bind(':slug', $data['slug']);
    
            // Execute
            if($this->db->execute()){
            return true;
            } else {
            return false;
            }
        }

        public function getPageBySlug($slug){
            $this->db->query('SELECT * FROM pages WHERE slug = :slug');
            $this->db->bind(":slug", $slug);
            $row =$this->db->single();
            return $row;
        }
    }