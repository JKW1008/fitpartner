<?php
    

    class Reservation{
        // 멤버 변수, 프로퍼티
        private $conn;

        // 생성자
        public function __construct($db){
            $this->conn = $db;
        }

        public function getInfo($companyname) {
            $sql = "SELECT * FROM reservation WHERE companyname=:company_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":company_name", $companyname);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
        
            return $stmt->fetch();
        }

        public function edit($marr) {
            $sql = "UPDATE reservation SET companyname=:companyname, name=:name, email=:email, phone_number=:phone_number, content=:content WHERE companyname=:oldname";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':companyname', $marr['companyname']);
            $stmt->bindValue(':name', $marr['name']);
            $stmt->bindValue(':email', $marr['email']);
            $stmt->bindValue(':phone_number', $marr['phone_number']);
            $stmt->bindValue(':content', $marr['content']);
            $stmt->bindValue(':oldname', $marr['old']);
            return $stmt->execute();
        }

        // 상담 완료 체크
        public function check($idx){
            $sql = "UPDATE reservation SET counseled = 1 WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
            $stmt->execute();
        }

        //  예약 목록 가져오기
        public function list($page, $limit, $paramArr){
            $start = ($page - 1) * $limit;
            $where = "";

            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'companyname'; break;
                    case 2 : $sn_str = 'name'; break;
                }

                $where = " WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT idx, companyname, name, email, DATE_FORMAT(create_at, '%Y-%m-%d %H:%i') AS create_at, counseled 
                    FROM reservation  ". $where ." 
                    ORDER BY idx DESC LIMIT ".$start.",".$limit;     // 1페이지면 0, 5, 2페이지면 5, 5, 10, 5, 10, 5
                    
            $stmt = $this->conn->prepare($sql);

            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function total($paramArr){

            $where = "";

            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'companyname'; break;
                    case 2 : $sn_str = 'name'; break;
                }

                $where = "  WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT COUNT(*) cnt FROM reservation ". $where;
            $stmt = $this->conn->prepare($sql);

            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }

        public function getInfoFromIdx($idx){
            $sql = "SELECT * FROM reservation WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":idx", $idx);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function reservation_del($idx){
            $sql = "DELETE FROM reservation WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }

        public function getAllData(){

            $sql = "SELECT * FROM reservation ORDER BY idx ASC";
                    
            $stmt = $this->conn->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>