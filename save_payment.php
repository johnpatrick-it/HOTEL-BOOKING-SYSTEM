<?php
require_once 'dbconn.php';
require 'C:\Users\Patrick\Downloads\HOTEL BOOKING SYSTEM\PHPmailer\src\Exception.php';//papalit ako nung path 
require 'C:\Users\Patrick\Downloads\HOTEL BOOKING SYSTEM\PHPmailer\src\PHPMailer.php';//papalit ako nung path 
require 'C:\Users\Patrick\Downloads\HOTEL BOOKING SYSTEM\PHPmailer\src\SMTP.php';//papalit ako nung path 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); //Ewan ko dito hindi ko maayos basta wag nalang i-delete

$guest_id = isset($_POST['guest_id']) ? intval($_POST['guest_id']) : 0;
$paymentMethod = isset($_POST['payment-method']) ? $_POST['payment-method'] : '';
$cost = isset($_POST['cost']) ? intval($_POST['cost']) : 0;

$sql = "UPDATE guests SET payment_method = '$paymentMethod', cost = $cost WHERE guest_id = $guest_id";
$result = $conn->query($sql);

if ($result) {

  $guestDataSql = "SELECT email, name, check_in_date, check_out_date FROM guests WHERE guest_id = $guest_id";
  $guestDataResult = $conn->query($guestDataSql);
  $guestData = $guestDataResult->fetch_assoc();
  $guestEmail = $guestData['email'];
  $guestName = $guestData['name'];
  $check_in_date = $guestData['check_in_date'];
  $check_out_date = $guestData['check_out_date'];

  $mail->SMTPDebug = 0;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'baranggaymapulanglupa@gmail.com';
  $mail->Password = 'nvgeadocuwfaohao';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  
  $mail->setFrom('baranggaymapulanglupa@gmail.com', 'VermsHotel');
  $mail->addAddress($guestEmail);
  
  $mail->Subject = 'Payment Details';
$mail->Body = "Dear $guestName,\n\nThank you for your booking. Here are your payment details, please save a copy of this and present it to our desk:\n\nGuest ID: $guest_id\nName: $guestName\nCheck-in Date: $check_in_date\nCheck-out Date: $check_out_date\nPayment Method: $paymentMethod\nTotal Cost: $cost";

try {
    $mail->send();
    header("Location: index.php");
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

$conn->close();
?>
