<?php
include 'connect.php'; // เรียกไฟล์เชื่อมต่อมาใช้

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "INSERT INTO Internships (studentID, firstName, lastName, company, province, startDate, endDate) 
            VALUES (:id, :fname, :lname, :comp, :prov, :sdate, :edate)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':id'    => $_POST['studentID'],
        ':fname' => $_POST['firstName'],
        ':lname' => $_POST['lastName'],
        ':comp'  => $_POST['company'],
        ':prov'  => $_POST['province'],
        ':sdate' => $_POST['startDate'],
        ':edate' => $_POST['endDate']
    ]);

    echo "บันทึกสำเร็จ! <a href='display.php'>คลิกที่นี่เพื่อดูรายชื่อ</a>";
}
?>