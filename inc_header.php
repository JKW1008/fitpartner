<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= (isset($g_title) && $g_title != '') ? $g_title : '네카라쿠베' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="shortcut icon" href="./images/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <?php
        if(isset($js_array)){
            foreach($js_array AS $var){
                echo '<script src="'.$var.'?v='.date('YmdHis').'"></script>'.PHP_EOL;
            }
        }    
    ?>
</head>

<body>
    <div class="container">
        <header class="d-flex  justify-content-center py-3 mb-4 border-bottom">
            <a href="/"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
                style="width: 10%;">
                <img src="./images/Fit Partner.png" alt="" style="width: 100%" class="me-5" />
            </a>

            <ul class="nav nav-pills">
                <?php 
                    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : ''; 
                    $ses_level = (isset($_SESSION['ses_level']) && $_SESSION['ses_level'] != '') ? $_SESSION['ses_level'] : '';


                    if($ses_id != ''){
                 // 로그인 상태
                ?>
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($menu_code == 'home') ? 'active' : ''; ?>"
                        aria-current="page">Home</a>
                </li>
                <li class="nav-item"><a href="company.php"
                        class="nav-link <?= ($menu_code == 'company') ? 'active' : ''; ?>">회사소개</a></li>

                <?php
                        if($ses_level == 10){
                ?>
                <li class="nav-item"><a href="./admin/"
                        class="nav-link <?= ($menu_code == 'member') ? 'active' : ''; ?>">Admin</a></li>
                <?php
                        }else{ 
                ?>
                <li class="nav-item"><a href="mypage.php"
                        class="nav-link <?= ($menu_code == 'member') ? 'active' : ''; ?>">My Page</a></li>
                <?php
                        }
                ?>

                <?php
                    foreach($boardArr AS $row){
                        echo '<li class="nav-item"><a href="board.php?bcode='.$row['bcode'].'" class="nav-link';
                        if(isset($_GET['bcode']) && $_GET['bcode'] == $row['bcode']){
                            echo ' active';
                        }
                        echo '">'.$row['name'].'</a></li>';
                    }
                ?>


                <li class="nav-item"><a href="./pg/logout.php"
                        class="nav-link <?= ($menu_code == 'login') ? 'active' : ''; ?>">로그아웃</a></li>
                <?php
                    }else{
                        // 로그인 안된 상태
                ?>
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($menu_code == 'home') ? 'active' : ''; ?>"
                        aria-current="page">Home</a>
                </li>
                <li class="nav-item"><a href="company.php"
                        class="nav-link <?= ($menu_code == 'company') ? 'active' : ''; ?>">회사소개</a></li>
                <li class="nav-item"><a href="stipulation.php"
                        class="nav-link <?= ($menu_code == 'member') ? 'active' : ''; ?>">회원가입</a></li>
                <li class="nav-item"><a href="board.php"
                        class="nav-link <?= ($menu_code == 'board') ? 'active' : ''; ?>">게시판</a></li>
                <li class="nav-item"><a href="login.php"
                        class="nav-link <?= ($menu_code == 'login') ? 'active' : ''; ?>">로그인</a></li>
                <?php
                    }
                ?>
            </ul>
        </header>