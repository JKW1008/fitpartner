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

        //  댓글 목록
        public function list($pidx){
            $sql = "SELECT * FROM comment WHERE pidx=:pidx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":pidx" => $pidx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);            
            return $stmt->fetchAll();
        }

        //  댓글 삭제
        public function delete($pidx, $idx){
            //  댓글 갯수 감소
            $sql = "UPDATE fitboard SET comment_cnt=comment_cnt-1 WHERE idx=:pidx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":pidx" => $pidx ];
            $stmt->execute($params);

            //  댓글 삭제
            $sql = "DELETE FROM comment WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->execute($params);
        }

        //  댓글 수정
        public function update($arr){
            $sql = "UPDATE comment SET content=:content WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":content" => $arr['content'], ":idx" => $arr['idx'] ];
            $stmt->execute($params);
        }
        
        public function getInfo($idx){
            $sql = "SELECT * FROM comment WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);            
            return $stmt->fetch();
        }
    }
?>