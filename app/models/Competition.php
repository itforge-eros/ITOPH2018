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

        public function addRegistration($data){

            $queryStmt = '
                INSERT INTO registrations (
                    category';
            if(!empty($data['team_name'])){
                $queryStmt .= ',team_name';
            }
            for($i=1; $i<=6; $i++){
                $queryStmt .= ',candidate0'.$i.'_name, candidate0'.$i.'_id, candidate0'.$i.'_age, candidate0'.$i.'_grade, candidate0'.$i.'_school, candidate0'.$i.'_email, candidate0'.$i.'_phone';
                if(empty($data['candidate02_name']) && $i == 1){break;}
                if(empty($data['candidate03_name']) && $i == 2){break;}
                if(empty($data['candidate04_name']) && $i == 3){break;}
            }
            if(!empty($data['teacher_name'])){
                $queryStmt .= ',teacher_name, teacher_phone, teacher_email';
            }
            $queryStmt .= ',registration_date, pdf_filename) VALUES(:category';
            if(!empty($data['team_name'])){
                $queryStmt .= ',:team_name';
            }
            for($i=1; $i<=6; $i++){
                $queryStmt .= ',:candidate0'.$i.'_name, :candidate0'.$i.'_id, :candidate0'.$i.'_age, :candidate0'.$i.'_grade, :candidate0'.$i.'_school, :candidate0'.$i.'_email, :candidate0'.$i.'_phone';
                if(empty($data['candidate02_name']) && $i == 1){break;}
                if(empty($data['candidate03_name']) && $i == 2){break;}
                if(empty($data['candidate04_name']) && $i == 3){break;}
            }
            if(!empty($data['teacher_name'])){
                $queryStmt .= ',:teacher_name, :teacher_phone, :teacher_email';
            }
            $queryStmt .= ',:registration_date, :pdf_filename)';

            
            $this->db->query($queryStmt);
            // Bind values
            $this->db->bind(':category', $data['category']);
            if(!empty($data['team_name'])){
                $this->db->bind(':team_name', $data['team_name']);
            }
            for($i=1; $i<=6; $i++){
                $this->db->bind(':candidate0'.$i.'_name', $data['candidate0'.$i.'_name']);
                $this->db->bind(':candidate0'.$i.'_id', $data['candidate0'.$i.'_id']);
                $this->db->bind(':candidate0'.$i.'_age', $data['candidate0'.$i.'_age']);
                $this->db->bind(':candidate0'.$i.'_grade', $data['candidate0'.$i.'_grade']);
                $this->db->bind(':candidate0'.$i.'_school', $data['candidate0'.$i.'_school']);
                $this->db->bind(':candidate0'.$i.'_email', $data['candidate0'.$i.'_email']);
                $this->db->bind(':candidate0'.$i.'_phone', $data['candidate0'.$i.'_phone']);
                if(empty($data['candidate02_name']) && $i == 1){break;}
                if(empty($data['candidate03_name']) && $i == 2){break;}
                if(empty($data['candidate04_name']) && $i == 3){break;}
            }
            if(!empty($data['teacher_name'])){
                $this->db->bind(':teacher_name', $data['teacher_name']);
                $this->db->bind(':teacher_phone', $data['teacher_phone']);
                $this->db->bind(':teacher_email', $data['teacher_email']);
            }
            $this->db->bind(':registration_date', $data['registration_date']);
            $this->db->bind(':pdf_filename', $data['pdf_filename']);
    
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
            
        }

        public function getRegistrations(){
            $this->db->query("SELECT * FROM registrations");
            return $this->db->resultSet();
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