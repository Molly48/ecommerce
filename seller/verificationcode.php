<?php
include '../DBConnection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//require 'C:\xampp\htdocs\fypdiploma\PHPMailer-master\PHPMailer-master\src\Exception.php';
//require 'C:\xampp\htdocs\fypdiploma\PHPMailer-master\PHPMailer-master\src\PHPMailer.php';
//require 'C:\xampp\htdocs\fypdiploma\PHPMailer-master\PHPMailer-master\src\SMTP.php';


if (isset($_POST["register"])) {
    $name = $_POST["sellername"];
    $email = $_POST["emailaddress"];
    //$password = $_POST["password"];
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 1;
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.yahoo.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nurulamirah4803@gmail.com'; //ni molly punya
        $mail->Password = 'amirahazli'; //ni molly punya pass betul2  ni nak letk jugk ?
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465; 
        $mail->setFrom('nurulamirah4803@gmail.com', 'Nurul Amirah'); //ni pun sama
        $mail->addAddress($email, $name);
        $mail->isHTML(true);

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

        $mail->Subject = 'Email verification';
        $mail->Body = '<p>Your verification code is <b style="font-size: 30px;">' . $verification_code . '</b></p>';
        $mail->send();

        $encrypted_password = password_hash("password", PASSWORD_DEFAULT);

        $conn = mysqli_connect("localhost:3306", "root", "", "fypdiploma");

        $sql = "INSERT INTO users (name, email, password, verification_code, email_verified_at) VALUES (?, ?, ?, ?, NULL)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $encrypted_password, $verification_code);
        mysqli_stmt_execute($stmt);

        echo '<script>alert("We have sent a verification code to your email.")</script>';

        header("Location: shopperverify.php?email=" . $email);
        exit();


    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    //echo 'success or not?';
} 
?>