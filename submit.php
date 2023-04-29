<?php

//Load Composer's autoloader
require 'vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Mailer function by JaviWebs to send emails using PHP mailer library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //GET THE FIELDS FROM THE REQUEST
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);


    // Check that data was sent to the mailer.
    if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Host       = 'smpt.example.com';                     //Set the SMTP server to send through
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        $mail->Username   = 'email@example.com';                     //SMTP username
        $mail->Password   = 'correct';                               //SMTP password
        
    
        //Recipients
        $mail->setFrom('email@javiwebs.com', $name);
        $mail->addAddress('jdweb@javiwebs.com', 'JaviWebs');     //Add a recipient
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New Contact from JaviWebs';
        
        // Email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message: $message\n";

        // Send the email.
        if (mail('email@javiwebs.com', 'New Contact from JaviWebs', $email_content)) {
            // Set a 200 (okay) response code.
            mail->send();
            http_response_code(200);
            //echo "Thank You! Your message has been sent to JaviWebs. I will get in touch soon.";
			//header("Location:thankyou.html");
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }
        /*$mail->send();
            echo 'Message has been sent';*/
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

}else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }





