<?php

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$feedback = htmlspecialchars($_POST['feedback']);

if(isset($name) && isset($email) && isset($feedback)){
    $data = $name . '  ' . $email . '  ' . $feedback . "\r\n";
    $ret= file_put_contents('yeet.txt', $data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    } else {
        echo "$ret bytes written to file";

        $toEmail = 'niko02.hamalainen@gmail.com';
        $subject = 'Uutta palautetta nimimerkiltä ' .$name;
        $body = '<h2>Palautetta</h2>
        <h4>Nimi</h4><p>'.$name.'</p>
        <h4>Sähköposti</h4><p>'.$email.'</p>
        <h4>Palaute</h4><p>'.$feedback.'</p>';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " .$name .$email . "\r\n";
        
        if(mail($toEmail, $subject, $body, $headers)){
            $msg = 'Sähköposti lähetetty';
            $msgClass = 'alert-success';
        } else {
            $msg = 'Sähköpostin lähetys epäonnistui';
            $msgClass = 'alert-danger';
        }
    }
} 
else {
    die('no post data to process');
} 
?>