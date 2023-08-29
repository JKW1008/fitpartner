<?php
    $host = "svc.sel4.cloudtype.app";
    $user = "test";
    $pass = "1234";
    $db = "dsl";
    $port = "30105";

    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] );
    define('ADMIN_DIR'    , DOCUMENT_ROOT . '/admin'  );
    define('DATA_DIR'     , DOCUMENT_ROOT . '/data'   );
    define('PROFILE_DIR'  , DATA_DIR      . '/profile');
    define('BOARD_DIR'    , DATA_DIR      . '/board'  );    // 파일이 저장될 절대 경로
    define('BOARD_WEB_DIR', 'data/board'              );    // 웹에서 확인하는 경로

    try {
        // PDO 객체를 생성하여 데이터베이스에 연결
        $dsn = "mysql:host=$host;port=$port;dbname=$db";
        $pdo = new PDO($dsn, $user, $pass);

        // PDO 연결 설정
        // Prepared Statement를 지원하지 않는 경우 데이터베이스의 기능을 사용하도록 해줌
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); // 쿼리 버퍼링을 활성화
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // PDO 객체가 에러를 처리하는 방식 정함

        // 연결이 정상적으로 설정되었을 때, 이곳에서 데이터베이스 쿼리를 실행하거나 다른 작업을 수행할 수 있습니다.

        // 생성한 PDO 객체를 반환
        return $pdo;
        // echo "연결성공";
    } catch (PDOException $e) {
        echo $e->getMessage();
        // 예외 처리
        // echo "데이터베이스 연결 실패: " . $e->getMessage();
        // 실패 시, NULL을 반환하거나 다른 방식으로 처리할 수도 있습니다.
        return null;
    }
?>