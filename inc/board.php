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

        //  글 보기
        public function view($idx){
            $sql = "SELECT * FROM fitboard WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            return $stmt->fetch();
        }

        //  글 조회수 +1
        public function hitInc($idx){
            $sql = "UPDATE fitboard SET hit=hit+1 WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->execute($params);
        }

        //  파일 목록 업데이트
        public function updateFileList($idx, $files, $downs){
            $sql = "UPDATE fitboard SET files=:files, downhit=:downs WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx, ":files" => $files, ":downs" => $downs ];
            $stmt->execute($params);
        }

        //  첨부파일 구하기
        public function getAttachFile($idx, $th){
            $sql = "SELECT files FROM fitboard WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            $row = $stmt->fetch();

            $filelist = explode('?', $row['files']);

            return $filelist[$th] .'|'. count($filelist);
        }

        //  다운로드 횟수 구하기
        public function getDownhit($idx){
            $sql = "SELECT downhit FROM fitboard WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":idx" => $idx ];
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute($params);
            $row = $stmt->fetch();

            return $row['downhit'];
        }

        //  다운로드 횟수 증가 시키기
        public function increaseDownhit($idx, $downhit){
            $sql = "UPDATE fitboard SET downhit=:downhit WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":downhit" => $downhit, ":idx" => $idx ];
            $stmt->execute($params);
        }

        //  last_reader 값 변경
        public function updateLastReader($idx, $str){
            $sql = "UPDATE fitboard SET last_reader=:last_reader WHERE idx=:idx";
            $stmt = $this->conn->prepare($sql);
            $params = [ ":last_reader" => $str, ":idx" => $idx];
            $stmt->execute($params);
        }

        //  파일 첨부
        public function file_attach($files, $file_cnt){
            if(sizeof($files['name']) > 3 ){
                $arr = [ "result" => "file_upload_count_exceed" ];
                die(json_encode($arr));
            }

            $tmp_arr = [];
            foreach($files['name'] AS $key => $val){
                // $files['name'][$key];
                $full_str = '';

                $tmparr = explode('.', $files['name'][$key]);
                $ext = end($tmparr);

                $not_allowed_file_ext = ['txt', 'exe', 'xls', 'dmg', 'php', 'js'];

                if(in_array($ext, $not_allowed_file_ext)){
                    $arr = [ 'result' => 'not_allowed_file' ];
                    die(json_encode($arr));
                }

                $flag = rand(1000, 9999);
                $filename = 'a'. date('YmdHis') . $flag .'.'. $ext;
                $file_ori = $files['name'][$key];

                copy($files['tmp_name'][$key], BOARD_DIR .'/'. $filename);
            
                $full_str = $filename .'|'. $file_ori;
                $tmp_arr[] = $full_str;
            };
            return implode('?', $tmp_arr);
        }
    }
?>