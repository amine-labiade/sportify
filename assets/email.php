<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once (__DIR__ . '/../fpdf182/fpdf.php');
require_once (__DIR__ . '/qr.php');
require_once (__DIR__ . '/vendor/autoload.php');


 class PDF extends FPDF {
     function Header()
     {
        $this->SetFont('Times','i',25);
        $this->SetTextColor(200,75,66);
        $this->Cell(12);
        $this->Image('../images/logo/Sportify.png',10,10,40);
        $this->Cell(70);
        $this->Cell(100,30,'Ticket',0,1);
        $this->Ln(70);
     }
 }





 $pdf = new PDF('P','mm','A4');
 $pdf->AddPage();
 $pdf->SetFont('Arial','', 15);
 $pdf->SetTextColor(215,90,110);
 $pdf->Image( __DIR__ . "/qr.png", 47, 107, 35, 35, "png");
 unlink(__DIR__ . "/qr.png");
 $pdf->Cell(40,10,'',0,0);
 $pdf->Cell(35,10,'','LT',0);
 $pdf->Cell(40,10, 'Name:'  ,'T',0,'L');
 $pdf->Cell(25,10, $_SESSION['data'][1],'TR',0,'L');
 $pdf->Ln();
 $pdf->Cell(40,10,'',0,0);
 $pdf->Cell(35,10,'','L',0);
 $pdf->Cell(40,10, 'Staduim:' ,'',0,'L');
 $pdf->Cell(25,10, $_SESSION['data'][2],'R',0,'L');
 $pdf->Ln();
 $pdf->Cell(40,10,'',0,0);
 $pdf->Cell(35,10,'','L',0);
 $pdf->Cell(40,10, 'From:' ,'',0,'L');
 $pdf->Cell(25,10, $_SESSION['data'][3],'R',0,'L');
 $pdf->Ln();
 $pdf->Cell(40,10,'',0,0);
 $pdf->Cell(35,10,'','L',0);
 $pdf->Cell(40,10, 'To:' ,'',0,'L');
 $pdf->Cell(25,10, $_SESSION['data'][4],'R',0,'L');
 $pdf->Ln();
 $pdf->Cell(40,10,'',0,0);
 $pdf->Cell(35,10,'','L',0);
 $pdf->Cell(40,10, 'Duration:','',0,'L');
 $pdf->Cell(25,10, $_SESSION['data'][5] . 'h','R',0,'L');
 $pdf->Ln();
 $pdf->Cell(40,10,'',0,0);
 $pdf->Cell(35,10,'','LB',0);
 $pdf->Cell(40,10, 'Price:','B',0,'L');
 $pdf->Cell(25,10, $_SESSION['data'][6] . 'DH','BR',0,'L');
 $out = $pdf->output('','S');



 sendEmail($out);

 function sendEmail($out){
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'gcsp.666@gmail.com';                     // SMTP username
        $mail->Password   = 'tempEmail';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('gcsp.666@gmail.com', 'gcsp');
        $mail->addAddress($_SESSION['user']['email'],$_SESSION['user']['username'] );     // Add a recipient

        // Attachments
        $mail->addStringAttachment($out, 'ticket.pdf');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is your ticket';
        $mail->Body    = 'Thank you for using our service';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
 }
?>
