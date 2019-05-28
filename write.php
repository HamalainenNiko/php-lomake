<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$feedback = htmlspecialchars($_POST['feedback']);
$date = date("d/m : H:i :");

if(isset($name) && isset($email) && isset($feedback)){
    $data = $name . '<br>' . $email . '<br>' . $feedback . "\r\n";
    $ret = file_put_contents('feedback.txt', $date.$data, FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    } else {
        echo "Palaute lähetetty.";


        $toEmail = 'niko02.hamalainen@gmail.com';
        $subject = 'Uutta palautetta nimimerkiltä ' .$name;
        $body = '<h2>Palautetta</h2>
        <h4>Nimi</h4><p>'.$name.'</p>
        <h4>Sähköposti</h4><p>'.$email.'</p>
        <h4>Palaute</h4><p>'.$feedback.'</p>
        <h4>linkki</h4>' echo '<a href="http://it.esedu.fi/~niko.hamalainen4/PHP-Palautelomake/php-lomake/"';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " .$email . "\r\n";
        
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