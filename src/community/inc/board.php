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
            $params = [ ':bcode' => $bcode ];
            if(isset($paramArr['sn']) && $paramArr['sn'] != '' && isset($paramArr['sf']) && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                        case 1 : 
                            $where .= "AND (subject LIKE CONCAT('%', :sf, '%') OR (content LIKE CONCAT('%', :sf2, '%'))) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'], ':sf2' => $paramArr['sf']];
                            break;  //  제목 + 내용
                        case 2 :    
                            $where .= "AND (subject LIKE CONCAT('%', :sf, '%')) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'] ];
                            break;  //  제목
                        case 3 : 
                            $where .= "AND (content LIKE CONCAT('%', :sf, '%')) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'] ];
                            break;  //  내용
                        case 4 : 
                            $where .= "AND (name=:sf) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'] ];
                            break;  //  글쓴이
                }

            }

            $sql = "SELECT idx, id, subject, name, hit, DATE_FORMAT(create_at, '%Y-%m-%d %H:%i') AS create_at 
                    FROM fitboard  ". $where ." 
                    ORDER BY idx DESC LIMIT ".$start.",".$limit;     // 1페이지면 0, 5, 2페이지면 5, 5, 10, 5, 10, 5
                    
            $stmt = $this->conn->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }

        //  전체 글 수 구하기
        public function total($bcode, $paramArr){

            $where = "WHERE bcode=:bcode ";
            $params = [ ':bcode' => $bcode ];
            if(isset($paramArr['sn']) && $paramArr['sn'] != '' && isset($paramArr['sf']) && $paramArr['sf'] != ''){
                switch($paramArr['sn']){
                        case 1 : 
                            $where .= "AND (subject LIKE CONCAT('%', :sf, '%') OR (content LIKE CONCAT('%', :sf2, '%'))) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'], ':sf2' => $paramArr['sf']];
                            break;  //  제목 + 내용
                        case 2 :    
                            $where .= "AND (subject LIKE CONCAT('%', :sf, '%')) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'] ];
                            break;  //  제목
                        case 3 : 
                            $where .= "AND (content LIKE CONCAT('%', :sf, '%')) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'] ];
                            break;  //  내용
                        case 4 : 
                            $where .= "AND (name=:sf) "; 
                            $params = [ ':bcode' => $bcode, ':sf' => $paramArr['sf'] ];
                            break;  //  글쓴이
                }

            }

            $sql = "SELECT COUNT(*) AS cnt
                    FROM fitboard  ". $where;                    
            $stmt = $this->conn->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            $row = $stmt->fetch();
            return $row['cnt'];
        }


    }
?>