<?php

if ($SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
}

$to = "jdweb@javiwebs.com";
$subject = "New form submission from JaviWebs";
$body = "Name: $name\nEmail: $email\nMessage: $message";

