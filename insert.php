<?php
// ตั้งค่าการเชื่อมต่อกับฐานข้อมูล MySQL
$servername = "sautechnology.com";
$username = "u231198616_s6319410013";
$password = "S@u6319410013";
$dbname = "u231198616_s6319410013_db";

// รับข้อมูลที่ส่งมาจากแอปพลิเคชัน
$productname = $_POST['productname'];
$description = $_POST['description'];
$price = $_POST['price'];
$amount = $_POST['amount']; // ตัวแปรใหม่สำหรับข้อมูล amount
$image = $_POST['image'];

// สร้างการเชื่อมต่อกับฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL โดยใช้ prepared statement
$sql = "INSERT INTO stproduct (productname, description, price, amount, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// ตรวจสอบว่า statement ถูกสร้างสำเร็จหรือไม่
if ($stmt === false) {
    die("MySQL prepare error: " . $conn->error);
}

// ผูกตัวแปรกับ parameters ใน SQL statement
$stmt->bind_param("ssdis", $productname, $description, $price, $amount, $image);

// ทำการแทรกข้อมูล
if ($stmt->execute()) {
    // สร้างข้อมูล JSON สำหรับการตอบกลับ
    $response = array("status" => "success", "message" => "New record created successfully");
    echo json_encode($response);
} else {
    // สร้างข้อมูล JSON สำหรับการตอบกลับ
    $response = array("status" => "error", "message" => "Error: " . $stmt->error);
    echo json_encode($response);
}

// ปิด statement
$stmt->close();

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
