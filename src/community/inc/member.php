<?php
    class Member{
        // 멤버 변수, 프로퍼티
        private $conn;

        // 생성자
        public function __construct($db){
            $this->conn = $db;
        }

        // 아이디 중복체크용 멤버 함수, 메소드
        public function id_exist($id){
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }
    }
?>