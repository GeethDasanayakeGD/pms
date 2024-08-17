<?php
include '../db_conn.php'; 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_REQUEST["username"];
    $gender = $_REQUEST["gender"];
    $VehicleType = $_REQUEST["VehicleType"];
    $vehicleNumber = $_REQUEST["vehicleNumber"];
    $nic = $_REQUEST["nic"];
    $phonenumber = $_REQUEST["phonenumber"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $date_time = date("Y-m-d H:i:s");
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] == UPLOAD_ERR_OK) {
        $temp = $_FILES["img"]["tmp_name"];
        $name_x = $_FILES["img"]["name"];
        $name = "pic_" . date('YmdHis') . "_" . rand(10, 999999) . "_" . $name_x;
        $destination = "../images/uploads/" . $name;
        if (move_uploaded_file($temp, $destination)) {
            $sql = "INSERT INTO user (username, gender, VehicleType, vehicleNumber, nic, phonenumber, email, password, img, date_time) VALUES ('$username', '$gender', '$VehicleType', '$vehicleNumber', '$nic', '$phonenumber', '$email', '$password', '$name', '$date_time')";
        } else {
            echo "Error uploading image.";
            exit; 
        }
    } else {
        $sql = "INSERT INTO user (username, gender, VehicleType, vehicleNumber, nic, phonenumber, email, password, date_time) VALUES ('$username', '$gender', '$VehicleType', '$vehicleNumber', '$nic', '$phonenumber', '$email', '$password', '$date_time')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "<script>";echo "alert('Registration successfully Please log in Again');";echo "window.location.replace('../Login.php');";echo "</script>";
    } else {
        echo "<script>";echo "alert('Already signed up with this nic number.');";echo "window.location.replace('../Register.php');";echo "</script>"; 
    }
$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User registration</title>
</head>
<body>
<h3>if you are not redirected <a href="../">Click here</a></h3>
</body>
</html>
