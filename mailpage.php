<?php
session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


$alert = ["message"];
$message = ["success", "danger"];

//setzen der value variablaen
$anrede        = isset($_POST["anrede"])          ? strip_tags(trim($_POST["anrede"]))     : "";
$firstname     = isset($_POST["firstname "])      ? strip_tags(trim($_POST["firstname "]))     : "";
$lastname      = isset($_POST["lastname "])       ? strip_tags(trim($_POST["lastname "]))     : "";
$street        = isset($_POST["street"])          ? strip_tags(trim($_POST["street"]))     : "";
$plz           = isset($_POST["plz"])             ? strip_tags(trim($_POST["plz"]))     : "";
$email         = isset($_POST["email"])           ? strip_tags(trim($_POST["email"]))     : "";
$phone         = isset($_POST["phone"])           ? strip_tags(trim($_POST["phone"]))     : "";
$kategorie     = isset($_POST["kategorie"])       ? strip_tags(trim($_POST["kategorie"]))     : "";
$textarea      = isset($_POST["textarea"])        ? strip_tags(trim($_POST["textarea"]))  : "";



if (isset($_POST["submit"])) {

    if (
        $_POST["anrede"] && $_POST["firstname"] && $_POST["lastname"] && $_POST["street"]
        && $_POST["plz"] && $_POST["email"] && $_POST["phone"]  && $_POST["kategorie"] && $_POST["textarea"]
    ) {

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                              // SMTPDebug=2;Enable verbose debug output
            $mail->isSMTP();                                   // Send using SMTP
            $mail->SMTPKeepAlive = true;                       // canli tutmasi icin
            $mail->Host       = 'srvc25.turhost.com';          // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                          // Enable SMTP authentication
            $mail->Username   = 'info@sado.ch';                // SMTP username
            $mail->Password   = '???';                         // SMTP password von turhost damain email info@asyarentmarmaris.com
            $mail->SMTPSecure = `PHPMailer::ENCRYPTION_SMTPS`; // Für turhost ssl verbindung! Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                           // TCP port to connect to
            $mail->CharSet    = "utf-8";

            //Recipients-setFrom= von wo kommt die mail(eigene domain), addAddress=adresse hinzufügen, addReplyTo = Antwort an, addCC = Weiterleitung an
            $mail->setFrom('info@sado.ch', $_POST["email"]);    // von wo kommt die mail
            $mail->addAddress('info@sado.ch');                  // Fügen sie ein ämpfenger zu
            $mail->addAddress('ossicom@hotmail.com');           // Name is optional
            $mail->addReplyTo($_POST["email"]);                 //antwort an



            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Neue Anfrage www.sado.ch';
            $mail->AltBody = strip_tags($_POST["email"]);
            $mail->Body = '<h3>Anrede:<br> ' . $_POST['isim'] . '<br><br>Firstname:<br> ' . $_POST['firstname'] . '<br><br>Lastname:<br> '
                . $_POST['lastname'] . '<br><br>Street:<br> ' . $_POST['street'] . '<br><br>Plz:<br> '
                . $_POST['plz'] . '<br><br>Email:<br> ' . $_POST['email'] . '<br><br>Phone:<br> ' . $_POST['phone'] .
                '<br><br>Kategorie:<br> ' . $_POST['kategorie'] . '<br><br>Nachricht:<br> ' . $_POST['textarea'] . '</h3>';

                if ($mail->send()) {

                    $alert = array(
                   "message" => "Tesekkür ederiz, Rezervasyon isteğiniz iletilmistir!",
                   "type"    => "success"
               );
                   }else {
                    $alert = array(
                   "message" => "Lütfen bos alanlari doldurunuz!",
                   "type"    => "danger"
                   );
               }
       
               } catch (Exception $e) {
                   $alert = array(
                       "message" => $e->getMessage(),
                       "type"    => "danger"
                   );
               }
             }
                else {
                   
                    $alert = array(
                   "message" => "Lütfen tüm alanlari doldurunuz!",
                   "type"    => "danger"
                   );
               }
               
               
               $_SESSION["alert"] = $alert;
                header("location: http://localhost:8888/SADOS/");
                 exit;
}

//diese unteren zeilen gehören zum spamschutz
$anrede     = tuersteher($_REQUEST['anrede']);
$firstname  = tuersteher($_REQUEST['firstname']);
$lastname   = tuersteher($_REQUEST['lastname']);
$street     = tuersteher($_REQUEST['street']);
$plz        = tuersteher($_REQUEST['plz']);
$email      = tuersteher($_REQUEST['email']);
$phone      = tuersteher($_REQUEST['phone']);
$kategorie  = tuersteher($_REQUEST['kategorie']);
$textarea   = tuersteher($_REQUEST['textarea']);
// hier ist der spamschutz 
function tuersteher($zum_testen)
{
    if (preg_match("/(to:|cc:|bcc:|from:|subject:|reply-to:|content-type:|MIME-Version:|multipart\/mixed|Content-Transfer-Encoding:)/ims", $zum_testen)) {
        echo "Schauen Sie mal bei www.fang-den-hacker.de vorbei!";
        // es wird also alles abgebrochen, wenn Gefahr in Verzug ist
        exit;
    }

    if (preg_match("/%0A|\\r|%0D|\\n|%00|\\0|%09|\\t|%01|%02|%03|%04|%05|%06|%07|%08|%09|%0B|%0C|%0E|%0F|%10|%11|%12|%13/i", $zum_testen)) {
        echo "Schauen Sie mal bei www.fang-den-hacker.de vorbei!";
        // es wird also alles abgebrochen, wenn Gefahr in Verzug ist
        exit;
    }
}