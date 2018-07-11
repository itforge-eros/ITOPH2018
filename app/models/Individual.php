<?php
    class Individual {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getIndividualRegistrators(){
            $this->db->query('SELECT * FROM registrations WHERE (category = :individual)');
            $this->db->bind(":individual", "individual");
            return $this->db->resultSet();
        }

        public function deleteIndividualRegistrators($id){
            $this->db->query('DELETE FROM registrations WHERE id = :id');
            $this->db->bind(":id", $id);
            return $this->db->execute();
        }

    }