<?php
    class Board {   //  게시판 클래스   
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        //  글 등록
        public function input($arr){
            $sql = "INSERT INTO fitboard( bcode, id, name, subject, content, files, ip, create_at) VALUES(
                :bcode, :id, :name, :subject, :content, :files, :ip, NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':bcode'  , $arr['bcode'  ]);
            $stmt->bindValue(':id'     , $arr['id'     ]);
            $stmt->bindValue(':name'   , $arr['name'   ]);
            $stmt->bindValue(':subject', $arr['subject']);
            $stmt->bindValue(':content', $arr['content']);
            $stmt->bindValue(':files'  , $arr['files'  ]);
            $stmt->bindValue(':ip'     , $arr['ip'     ]);

            $stmt->execute();
        }

        //  글 목록
        public function list($bcode, $page, $limit, $paramArr){
            $start = ($page - 1) * $limit;
            $where = "WHERE bcode=:bcode ";

            if(isset($paramArr['sn']) && $paramArr['sn'] != '' && isset($paramArr['sf']) && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'name'; break;
                    case 2 : $sn_str = 'id'; break;
                    case 3 : $sn_str = 'email'; break;
                }

                $where .= " ". $sn_str."=:sf ";
            }

            $sql = "SELECT idx, id, subject, name, hit, DATE_FORMAT(create_at, '%Y-%m-%d %H:%i') AS create_at 
                    FROM fitboard  ". $where ." 
                    ORDER BY idx DESC LIMIT ".$start.",".$limit;     // 1페이지면 0, 5, 2페이지면 5, 5, 10, 5, 10, 5
                    
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':bcode', $bcode);

            if(isset($paramArr['sf']) && $paramArr['sf'] != ''){
                $stmt->bindValue(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        //  전체 글 수 구하기
        public function total($bcode, $paramArr){

            $where = "WHERE bcode=:bcode ";

            if(isset($paramArr['sn']) && $paramArr['sn'] != '' && isset($paramArr['sf']) && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                    case 1 : $sn_str = 'name'; break;
                    case 2 : $sn_str = 'id'; break;
                    case 3 : $sn_str = 'email'; break;
                }

                $where .= "AND ". $sn_str."=:sf ";
            }

            $sql = "SELECT COUNT(*) cnt FROM fitboard ". $where;
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':bcode', $bcode);

            if(isset($paramArr['sf']) && $paramArr['sf'] != ''){
                $stmt->bindValue(':sf', $paramArr['sf']);
            }

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row['cnt'];
        }


    }
?>