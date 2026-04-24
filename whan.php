<html>
<body>
 
Welcome <?php echo $_GET["name"]; ?><br>
Your email address is: <?php echo $_GET["email"]; ?>
 
</body>
</html>
 
<?php
// ================================
// ค่าระบบ
// ================================
$currentYear = 2569;
 
// ================================
// เตรียมตัวแปรเก็บข้อมูลผู้ใช้
// ================================
$users = [];
 
// ================================
// Function: คำนวณอายุ
// ================================
function calculateAge($birthYear, $currentYear) {
    return $currentYear - $birthYear;
}
 
// ================================
// Function: ตรวจสอบสิทธิ์
// ================================
function checkAccess($age, $birthYear, $currentYear) {
 
    // ตรวจสอบปีเกิดผิดปกติ
    if ($birthYear > $currentYear) {
        return "ข้อมูลปีเกิดไม่ถูกต้อง";
    }
 
    // ตรวจสอบอายุมากเกิน 120 ปี
    if ($age > 120) {
        return "กรุณาตรวจสอบข้อมูลอีกครั้ง";
    }
 
    // ตรวจสอบสิทธิ์การเข้าใช้งาน
    if ($age < 18) {
        return "❌ ไม่อนุญาตให้เข้าใช้งาน";
    } else {
        return "✔ อนุญาตให้เข้าใช้งาน";
    }
}
 
// ================================
// ประมวลผล Form
// ================================
$result = "";
if (isset($_POST['username']) && isset($_POST['birthYear'])) {
 
    $name = $_POST['username'];
    $birthYear = $_POST['birthYear'];
 
    // คำนวณอายุ
    $age = calculateAge($birthYear, $currentYear);
 
    // ตรวจสอบสิทธิ์
    $result = checkAccess($age, $birthYear, $currentYear);
 
    // บันทึกผู้ใช้ลง array
    if ($result == "✔ อนุญาตให้เข้าใช้งาน" || $result == "❌ ไม่อนุญาตให้เข้าใช้งาน") {
        $users[] = [
            "name" => $name,
            "age" => $age,
            "result" => $result
        ];
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Age Gate Web App</title>
</head>
<body>
 
<h2>ระบบตรวจสอบสิทธิ์เข้าใช้งานเว็บไซต์</h2>
 
<form method="post">
    ชื่อผู้ใช้:<br>
    <input type="text" name="username"><br><br>
 
    ปีเกิด (พ.ศ.):<br>
    <input type="number" name="birthYear"><br><br>
 
    <button type="submit">เพิ่มผู้ใช้</button>
</form>
 
<hr>
 
<?php
// แสดงผลลัพธ์หลังส่งฟอร์ม
if (!empty($result)) {
    echo "<h3>ผลการตรวจสอบ:</h3>";
    echo "ชื่อผู้ใช้: $name <br>";
    echo "อายุ: $age ปี <br>";
    echo "<strong>$result</strong><br><br>";
}
?>
 
<?php
// ================================
// แสดงผลผู้ใช้ทั้งหมด
// ================================
if (!empty($users)) {
    echo "<h3>รายชื่อผู้ใช้ทั้งหมด</h3>";
    foreach ($users as $user) {
        echo "ชื่อ: {$user['name']} - อายุ: {$user['age']} ปี - {$user['result']}<br>";
    }
}
?>
 
</body>
</html>
 