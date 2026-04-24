<pre>
<?php
$md5 = "not_set";
if ( isset($_GET['md5']) ) {
    $md5 = $_GET['md5'];
    $show = 15; // จำนวนรอบที่จะแสดง log (โจทย์มักจะให้โชว์ 15 รายการแรก)
    
    // เริ่มต้นจับเวลา
    $time_pre = microtime(true);

    // ตัวอักษรที่ต้องการสุ่ม (ในที่นี้สมมติว่าเป็นตัวเลข 4 หลัก)
    $txt = "0123456789";

    for($i=0; $i<strlen($txt); $i++) {
        $ch1 = $txt[$i];
        for($j=0; $j<strlen($txt); $j++) {
            $ch2 = $txt[$j];
            for($k=0; $k<strlen($txt); $k++) {
                $ch3 = $txt[$k];
                for($l=0; $l<strlen($txt); $l++) {
                    $ch4 = $txt[$l];
                    
                    // รหัสที่สุ่มได้ในรอบนี้
                    $try = $ch1.$ch2.$ch3.$ch4;
                    
                    // ตรวจสอบ MD5
                    $check = hash('md5', $try);
                    
                    // แสดงผล Log 15 รายการแรกตามเงื่อนไขวิชา
                    if ( $show > 0 ) {
                        print "$check $try\n";
                        $show = $show - 1;
                    }

                    // ถ้าเจอค่าที่ตรงกัน!
                    if ( $check == $md5 ) {
                        $goodtext = $try;
                        break 4; // ออกจากทุกลูป
                    }
                }
            }
        }
    }
    // คำนวณเวลาที่ใช้
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";
}
?>
</pre>
<h1>MD5 cracker</h1>
<p>PIN: <?= isset($goodtext) ? htmlentities($goodtext) : "Not found"; ?></p>
<form>
<input type="text" name="md5" size="40" />
<input type="submit" value="Crack MD5"/>
</form>