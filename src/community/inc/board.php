<?php
    class Board {   //  게시판 클래스   
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }
    }
?>