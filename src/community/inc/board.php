<?php
    class Board{
        // 멤버 변수, 프로퍼티
        private $conn;

        // 생성자
        public function __construct($db){
            $this->conn = $db;
        }
        
        //  게시판 목록
        public function list(){
            $sql = "SELECT idx, name, btype, cnt, DATE_FORMAT(create_at, '%Y-%m-%d %H:%i') AS create_at 
                    FROM fitboard_manage
                    ORDER BY idx ASC ";
                    
            $stmt = $this->conn->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>