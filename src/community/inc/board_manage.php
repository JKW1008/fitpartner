<?php
    class BoardManage{
        // 멤버 변수, 프로퍼티
        private $conn;

        // 생성자
        public function __construct($db){
            $this->conn = $db;
        }
        
        //  게시판 목록
        public function list(){
            $sql = "SELECT idx, name, bcode, btype, cnt, DATE_FORMAT(create_at, '%Y-%m-%d %H:%i') AS create_at 
                    FROM fitboard_manage
                    ORDER BY idx ASC ";
                    
            $stmt = $this->conn->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        //  게시판 생성
        public function create($arr){
            $sql = "INSERT INTO fitboard_manage(name, bcode, btype, create_at) VALUES
                    (:name, :bcode, :btype, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $arr['name']);
            $stmt->bindParam(':bcode', $arr['bcode']);
            $stmt->bindParam(':btype', $arr['btype']);

            $stmt->execute();
        }

        //  게시판 정보 수정
        public function update($arr){
            $sql = "UPDATE fitboard_manage SET name=:name, btype=:btype WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $arr['name']);
            $stmt->bindParam(':btype', $arr['btype']);
            $stmt->bindParam(':idx', $arr['idx']);

            $stmt->execute();
        }

        //  게시판 idx로 게시판 정보 가져오기
        public function getBcode($idx){
            $sql = "SELECT bcode FROM fitboard_manage WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
            $stmt->execute();
            return $row = $stmt->fetch();
        }

        //  게시판 삭제
        public function delete($idx){
            //  bcode
            $bcode = $this->getBcode($idx);

            $sql = "DELETE FROM fitboard_manage WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();

            $sql = "DELETE FROM fitboard WHERE bcode=:bcode";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':bcode', $bcode);
            $stmt->execute();
        }


        //  게시판 코드 생성
        public function bcode_create(){
            $letter = range('a', 'z');
            $bcode = '';
            for($i = 0; $i < 6; $i++){
                $r = rand(0, 25);
                $bcode .= $letter[$r];
            }

            return $bcode;
        }

        //  게시판 정보 불러오기
        public function getInfo($idx){
            $sql = "SELECT * FROM fitboard_manage WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':idx', $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        //  게시판 코드로 게시판 명 가져오기
        public function getBoardName($bcode){
            $sql = "SELECT name FROM fitboard_manage WHERE bcode=:bcode";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":bcode", $bcode);
            $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
            $stmt->execute();
            
            return $stmt->fetch();
        }
    }
?>