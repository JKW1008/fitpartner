<?php
    //  댓글 관리 class
    class Comment{
        private $conn;

        //  생성자
        public function __construct($db){
            $this->conn = $db;
        }

        //  댓글 등록
        public function input($arr){
            $sql = "INSERT INTO comment (pidx, id, content, create_at, ip) VALUES (
                :pidx, :id, :content, NOW(), :ip)";

            $stmt = $this->conn->prepare($sql);
            $params = [ 
                "pidx" => $arr['pidx'], 
                "id" => $arr['id'],
                "content" => $arr['content'],
                "ip" => $_SERVER["REMOTE_ADDR"]
            ];

            $stmt->execute($params);

            //  댓글 수 1증가
            $sql = "UPDATE fitboard SET comment_cnt = comment_cnt + 1 WHERE idx = :idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $arr['pidx'] ]; // 댓글이 속한 게시물의 인덱스(pidx)를 참조
            $stmt->execute($params);            
        }

        public function list($pidx){
            $sql = "SELECT * FROM comment WHERE pidx=:pidx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":pidx" => $pidx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);            
            return $stmt->fetchAll();
        }
    }
?>