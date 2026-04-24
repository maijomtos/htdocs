<?php
$resultMessage = "";
$currentYearBE = date("Y") + 543; // คำนวณปี พ.ศ. ปัจจุบัน

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['fullname']); 
    $birthYear = intval($_POST['birth_year']);
    $activity = $_POST['activity'];
    
    $age = $currentYearBE - $birthYear;

    // กำหนดเกณฑ์อายุขั้นต่ำ
    $rules = [
        "Workshop Programming" => 15,
        "Hackathon" => 18,
        "Research Conference" => 20
    ];

    $minAge = $rules[$activity] ?? 0;

    // สร้างข้อความผลลัพธ์
    $resultMessage = "<h3>ผลการตรวจสอบ:</h3>";
    $resultMessage .= "ชื่อ: $name <br>";
    $resultMessage .= "อายุ: $age ปี <br>";

    if ($age >= $minAge) {
        $resultMessage .= "<b style='color: black;'>คุณสามารถเข้าร่วมกิจกรรม $activity ได้</b>";
    } else {
        $resultMessage .= "<b style='color: black;'>ขออภัย อายุของคุณไม่ถึงเกณฑ์ (ต้องอายุ $minAge ปีขึ้นไป สำหรับ $activity)</b>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบลงทะเบียนกิจกรรมมหาวิทยาลัย</title>
</head>
<body>
    <h2>ลงทะเบียนเข้าร่วมกิจกรรม</h2>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        ชื่อผู้สมัคร: <input type="text" name="fullname" required><br><br>
        
        ปีเกิด (พ.ศ.): <input type="number" name="birth_year" placeholder="เช่น 2550" required><br><br>
        
        ประเภทกิจกรรม: 
        <select name="activity">
            <option value="Workshop Programming">Workshop Programming </option>
            <option value="Hackathon">Hackathon </option>
            <option value="Research Conference">Research Conference </option>
        </select><br><br>
        
        <button type="submit">สิทธิ์เข้าร่วม</button>
    </form>

    <hr>

    <?php 
    if ($resultMessage != "") {
        echo $resultMessage;
    }
    ?>
</body>
</html>