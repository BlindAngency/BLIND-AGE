<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $location = htmlspecialchars($_POST['location']);
    $budget = htmlspecialchars($_POST['budget']);
    $interested = htmlspecialchars($_POST['interested']);
    $companyName = htmlspecialchars($_POST['companyName']);
    $website = htmlspecialchars($_POST['website']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host = 'localhost';                                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = false;                                    // Disable SMTP authentication (if no authentication is needed)
        $mail->Port = 25;                                           // TCP port to connect to

        // Recipients
        $mail->setFrom('no-reply@yourdomain.com', 'Your Name');
        $mail->addAddress('pedro@blind-age.com', 'Pedro');           // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Phone:</b> $phone</p>
            <p><b>Location:</b> $location</p>
            <p><b>Budget:</b> $budget</p>
            <p><b>Interested For:</b> $interested</p>
            <p><b>Company Name:</b> $companyName</p>
            <p><b>Website:</b> $website</p>
            <p><b>Message:</b> $message</p>
        ";
        $mail->AltBody = "New Contact Form Submission\n\nName: $name\nEmail: $email\nPhone: $phone\nLocation: $location\nBudget: $budget\nInterested For: $interested\nCompany Name: $companyName\nWebsite: $website\nMessage: $message";

        $mail->send();
        echo 'Message has been sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method";
}
?>
