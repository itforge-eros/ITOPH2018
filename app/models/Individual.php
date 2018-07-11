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

    }