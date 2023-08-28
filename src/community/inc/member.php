<?php
    class Member{
        // 멤버 변수, 프로퍼티
        private $conn;

        // 생성자
        public function __construct($db){
            $this->conn = $db;
        }

        // 아이디 중복체크용 멤버 함수, 메소드
        public function id_exists($id){
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }


        // 이메일 중복체크용 멤버 함수
        public function email_exists($eamil){
            $sql = "SELECT * FROM users WHERE email=:email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $eamil);
            $stmt->execute();

            return $stmt->rowCount() ? true : false;
        }
        
        // 이메일 형식체크
        public function email_format_check($email){
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        // 회원정보 입력
        public function input($marr){

            // 단방향 암호화 
            $new_hash_password = password_hash($marr['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO users(id, name, password, email, zipcode, addr1, addr2, photo, create_at, ip) VALUES
                    (:id, :name, :password, :email, :zipcode, :addr1, :addr2, :photo, NOW(), :ip)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email'   , $marr['email']);
            $stmt->bindParam(':id'      , $marr['id']);
            $stmt->bindParam(':name'    , $marr['name']);
            $stmt->bindParam(':password', $new_hash_password);
            $stmt->bindParam(':zipcode' , $marr['zipcode']);
            $stmt->bindParam(':addr1'   , $marr['addr1']);
            $stmt->bindParam(':addr2'   , $marr['addr2']);
            $stmt->bindParam(':photo'   , $marr['photo']);
            $stmt->bindParam(':ip'      , $_SERVER['REMOTE_ADDR']);
            $stmt->execute();
        }

        // 로그인
        public function login($id, $pw){

            // password_verify($password, $new_password);

            $sql = "SELECT password FROM users WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if($stmt->rowCount()){
                $row = $stmt->fetch();

                if(password_verify($pw, $row['password'])){
                    $sql = "UPDATE users SET login_dt=NOW() WHERE id=:id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }


        // 로그아웃
        public function logout() {
            session_start();
            session_destroy();

            die('<script>self.location.href="../index.php";</script>');
        }

        // 정보 가져오기
        public function getInfo($id){
            $sql = "SELECT * FROM users WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetch();
        }

        public function edit($marr){
            $sql = "UPDATE users SET name=:name, email=:email, zipcode=:zipcode, addr1=:addr1, addr2=:addr2, photo=:photo";
        
            $params = [
                ':name' => $marr['name'], 
                ':email' => $marr['email'],
                ':zipcode' => $marr['zipcode'],
                ':addr1' => $marr['addr1'],
                ':addr2' => $marr['addr2'],
                ':photo' => $marr['photo'],
                ':id' => $marr['id']
            ];
        
            if($marr['password'] != ''){
                // 단방향 암호화 
                $new_hash_password = password_hash($marr['password'], PASSWORD_DEFAULT);
                $params[':password'] = $new_hash_password;
                $sql .= ", password=:password"; // 비밀번호 업데이트할 때만 추가
            }
        
            $sql .= " WHERE id=:id";
        
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
        }

        //  회원 목록 가져오기
        public function list($page, $limit, $paramArr){
            $start = ($page - 1) * $limit;
            $where = "";

            if($paramArr['sn'] != '' && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'name'; break;
                    case 2 : $sn_str = 'id'; break;
                    case 3 : $sn_str = 'email'; break;
                }

                $where = " WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT idx, id, name, email, DATE_FORMAT(create_at, '%Y-%m-%d %H:%i') AS create_at 
                    FROM users  ". $where ." 
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
                    case 1 : $sn_str = 'name'; break;
                    case 2 : $sn_str = 'id'; break;
                    case 3 : $sn_str = 'email'; break;
                }

                $where = "  WHERE ".$sn_str."=:sf ";
            }

            $sql = "SELECT COUNT(*) cnt FROM users ". $where;
            $stmt = $this->conn->prepare($sql);

            if($where != ''){
                $stmt->bindParam(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }


        // 회원 목록
        public function getAllData(){

            $sql = "SELECT * FROM users ORDER BY idx ASC";
                    
            $stmt = $this->conn->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        // 회원 삭제
        public function member_del($idx){
            $sql = "DELETE FROM users WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idx', $idx);
            $stmt->execute();
        }
    }
?>