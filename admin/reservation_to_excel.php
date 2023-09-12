<?php
    include './inc_common.php';
    include '../inc/dbconfig.php';

    $db = $pdo;

    include "../inc/reservation.php";

    $reser = new Reservation($db);

    $rs = $reser->getAllData();
 
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=reservation.xls");
    header("Content-Description: PHP8 Generated Data");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
.title {
    font-size: 25px;
    text-align: center;
    font-weight: 900;
}
</style>

<body>
    <table>
        <tr>
            <td colspan="6" class="title">예약 목록</td>
        </tr>
    </table>
    <table border="1">
        <tr>
            <td>업체명</td>
            <td>대표명</td>
            <td>이메일</td>
            <td>대표전화</td>
            <td>문의내용</td>
            <td>상담여부</td>
            <td>등록일시</td>
        </tr>
        <?php
        
            foreach($rs AS $row){
                $check = '';
                if($row['counseled'] === 0){
                    $check = "상담전";
                }else if($row['counseled'] === 1){
                    $check = "상담 완료";
                }
                echo '
                    <tr>
                        <td>'.$row['copanyname'].'</td>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['eamil'].'</td>
                        <td>'.$row['phone_numeber'].'</td>
                        <td>'.$row['content'].'</td>
                        <td>'.$check.'</td>
                        <td>'.$row['create_at'].'</td>
                    </tr>
                ';
            }
        ?>
    </table>
</body>

</html>