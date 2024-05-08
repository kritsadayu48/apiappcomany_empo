<?php
// ตั้งค่าการเชื่อมต่อกับฐานข้อมูล MySQL
$servername = "sautechnology.com";
$username = "u231198616_s6319410013";
$password = "S@u6319410013";
$dbname = "u231198616_s6319410013_db";

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้าจากตาราง stproduct
$sql = "SELECT * FROM stproduct";

// ดึงข้อมูลสินค้าจากฐานข้อมูล
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลสินค้าหรือไม่
if ($result->num_rows > 0) {
    // สร้าง array เพื่อเก็บข้อมูลสินค้า
    $products = array();

    // วนลูปเพื่อดึงข้อมูลแต่ละแถวจากผลลัพธ์
    while($row = $result->fetch_assoc()) {
        // เพิ่มข้อมูลสินค้าลงใน array
        $products[] = $row;
    }

    // ส่งข้อมูลสินค้าในรูปแบบ JSON กลับไปยังแอปพลิเคชัน
    echo json_encode($products);
} else {
    // ถ้าไม่พบข้อมูลสินค้า
    echo "0 results";
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
