<?php
    class Registration {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getRegistrations(){
            $this->db->query("SELECT * FROM registrations");
            return $this->db->resultSet();
        }

        public function getRegistrationById($id){
            $this->db->query("SELECT * FROM registrations WHERE id = :id");
            $this->db->bind(":id", $id);
            return $this->db->single();
        }

        public function getRegistratorsBySlug($slug){
            $this->db->query('SELECT * FROM registrations WHERE category = :category');
            $this->db->bind(":category", $slug);
            return $this->db->resultSet();
        }

        public function getRegistratorsBySlugWithoutCategory($slug){
            $this->db->query('SELECT id, candidate01_name, candidate01_id, candidate01_age, candidate01_grade, candidate01_school, candidate01_email, candidate01_phone FROM registrations WHERE category = :category');
            $this->db->bind(":category", $slug);
            return $this->db->resultSet();
        }

        public function countRegistratorsBySlug($slug){
            $this->db->query('SELECT * FROM registrations WHERE category = :category');
            $this->db->bind(":category", $slug);
            return count($this->db->resultSet());
        }

        public function deleteRegistrationById($id){
            $this->db->query('DELETE FROM registrations WHERE id = :id');
            $this->db->bind(":id", $id);
            return $this->db->execute();
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

            $this->db->query("SET time_zone = '+7:00'");
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

        public function getCompetitionRegistrators(){
            $this->db->query('
                SELECT * 
                FROM registrations 
                WHERE (category = :security) OR (category = :game) OR (category = :skill) OR (category = :website)');
            $this->db->bind(":security", "security");
            $this->db->bind(":game", "game");
            $this->db->bind(":skill", "skill");
            $this->db->bind(":website", "website");
            return $this->db->resultSet();
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

        public function getColumnNamesBySlug($slug){
            $this->db->query('SELECT * FROM registrations WHERE category = :category');
            $this->db->bind(":category", $slug);
            return $this->db->columnNames();
        }

        public function getCompetitionRegistratorsColumnName(){
            $this->db->query('
                SELECT * 
                FROM registrations 
                WHERE (category = :security) OR (category = :game) OR (category = :skill) OR (category = :website)');
            $this->db->bind(":security", "security");
            $this->db->bind(":game", "game");
            $this->db->bind(":skill", "skill");
            $this->db->bind(":website", "website");
            return $this->db->columnNames();
        }

        public function getWorkshopColumnName(){
            $this->db->query('
                SELECT * 
                FROM registrations 
                WHERE (category = :multimedia) OR (category = :se) OR (category = :networks) OR (category = :datascience)');
            $this->db->bind(":multimedia", "multimedia");
            $this->db->bind(":se", "se");
            $this->db->bind(":networks", "networks");
            $this->db->bind(":datascience", "datascience");
            return $this->db->columnNames();
        }

    }