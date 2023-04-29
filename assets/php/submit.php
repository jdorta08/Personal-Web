<?php
require 'phpmailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
  
    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
      echo "Please fill in all required fields";
    } else {
      // Send email
      $to = "jdweb@javiwebs.com";
      $subject = "New form submission JaviWebs";
      $body = "Name: $name\nEmail: $email\nMessage: $message";
  
      if (mail($to, $subject, $body)) {
        echo "Thank you for your submission!";
      } else {
        echo "There was an error sending your message. Please try again later.";
      }
    }
  }
  
  ?>
  