<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'igensite.com'; 				  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'igensit2';                 // SMTP username
$mail->Password = 'Q09uuH1jp8';                          // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->setFrom('igensit2@igensite.com','IGensite Email');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress('mrjimmy18@gmail.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

$message = '
<html>
<head>
<meta charset="utf-8">
</head>
<body style="background-color:#FFFFFF;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-family:sans-serif;line-height:1.5em;" >
<div class="container" style="width:100%;float:left;display:inline-block;text-align:center;" >
<div class="topic" style="width:100%;padding-top:3%;padding-bottom:3%;padding-right:0%;padding-left:0%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#000000;font-size:1.2em;font-weight:bold;" >ยืนยันการสั่งซื้อเลขที่ #324502</div>
<div class="info" style="width:100%;padding-top:3%;padding-bottom:3%;padding-right:0%;padding-left:0%;float:left;display:inline-block;" >
	<p style="font-size:1.2em;" >กรุณาชำระภายใน 30 กันยายน 2558 เวลา 16:40 (1 วัน)</p>
	<p class="payments" style="font-size:3em;font-weight:bold;" >7,390.00 ฿</p>
	<p class="note" style="font-size:1em;color:#AAAAAA;" >หากเกินกำหนดชำระเงินแล้ว สินค้าจะหลุดจอง ขอบคุณค่ะ</p>
</div>
<div class="bank" style="width:94%;padding-top:3%;padding-bottom:3%;padding-right:3%;padding-left:3%;float:left;display:inline-block;background-color:#FAFAFA;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;font-size:1.2em;text-align:left;" >
	<div class="caption" style="color:#AAAAAA;font-size:0.8em;" >ช่องทางการโอนเงิน</div>
	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
		<p class="name">ธนาคารกรุงไทย</p>
		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
	</div>
	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
		<p class="name">ธนาคารกรุงไทย</p>
		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
	</div>
	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
		<p class="name">ธนาคารกรุงไทย</p>
		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
	</div>
	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
		<p class="name">ธนาคารกรุงไทย</p>
		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
	</div>
	<div class="bank-items" style="width:100%;float:left;display:inline-block;border-bottom-width:1px;border-bottom-style:dotted;border-bottom-color:#CCCCCC;" >
		<p class="name">ธนาคารกรุงไทย</p>
		<p>เลขบัญชี <b>235-345244-3</b> (Puwadon Sricharoen)</p>
	</div>
</div>
<div class="confirm" style="width:60%;padding-top:10%;padding-bottom:10%;padding-right:20%;padding-left:20%;float:left;display:inline-block;" >
	<a href="http://dotdotdot.local/order_detail.php?id=1" style="text-decoration:none;" >
	<div class="button" style="text-decoration:none;background-color:#000000;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:#FFFFFF;padding-top:5%;padding-bottom:5%;padding-right:10%;padding-left:10%;font-size:1.2em;" >ยืนยันการโอนเงิน</div>
	</a>
</div>
<div class="footer" style="width:100%;float:left;display:inline-block;border-top-width:1px;border-top-style:solid;border-top-color:#000000;font-size:1em;padding-top:3%;padding-bottom:3%;padding-right:0%;padding-left:0%;font-weight:bold;" >
	<span class="text" style="text-align:right;float:left;" >dotdotdot limited 2016</span>
	<a href="http://dotdotdot.local/order_detail.php?id=1" style="text-decoration:none;color:#000000;float:right;" >ตรวจสอบรายการสินค้า</a></div>
</div>
</body>
</html>
';

$mail->Subject = 'ทดสอบส่ง email จาก igensite.com';
$mail->Body    = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//$mail->isHTML(true);                                  // Set email format to HTML
$mail->CharSet = 'UTF-8';

if(!$mail->send()) {
    echo 'Message could not be sent.<br>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>