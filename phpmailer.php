<?php
<<<<<<< HEAD
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Load Composer's autoloader
require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$PSW = $_ENV['PSW'];


$firstname = $lastname = $street = $plz = $email = $telefon = $kategorie = $nachricht = "";
$errors = array(
    'firstname' => '', 'lastname' => '', 'street' => '', 'plz' => '',
    'email' => '', 'telefon' => '', 'kategorie' => '', 'nachricht' => ''
);

$alertSuccess = "";
$alertError = "";
$alert = "";

//form validation
if (isset($_POST['submit'])) {

    //check firstname
    if (empty($_POST["firstname"])) {
        $errors["firstname"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Vorname ein!</span>";
    } else {
        $firstname = $_POST["firstname"];
        if (!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ.;:,]+$/", $firstname)) {
            $errors["firstname"] = "<span class='errors' style='color: red;' >Vorname darf nur Buchstaben enthalten!</span>";
        }
    }

    //check lastname
    if (empty($_POST["lastname"])) {
        $errors["lastname"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Nachname ein!</span>";
    } else {
        $lastname = $_POST["lastname"];
        if (!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ.;:,]+$/", $lastname)) {
            $errors["lastname"] = "<span class='errors' style='color: red;' >Nachname darf nur Buchstaben enthalten!</span>";
        }
    }
    //check street
    if (empty($_POST["street"])) {
        $errors["street"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Strasse ein!</span>";
    } else {
        $street = $_POST["street"];
        if (!preg_match('/^[ A-Za-z  0-9_äÄöÖüÜßçÇ.;:,]+$/', $street)) {
            $errors["street"] = "<span class='errors' style='color: red;' >Street darf nur Buchstaben und Zahlen enthalten!</span>";
        }
    }
    //check plz
    if (empty($_POST["plz"])) {
        $errors["plz"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Plz und Ort ein!</span>";
    } else {
        $plz = $_POST["plz"];
        if (!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ.;:,]+$/", $plz)) {
            $errors["plz"] = "<span class='errors' style='color: red;' >PLZ darf nur Buchstaben und Zahlen enthalten!</span>";
        }
    }
    //check email
    if (empty($_POST["email"])) {
        $errors["email"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Ihre email ein!</span>";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "<span class='errors' style='color: red;' >Falscher Format, Email überprüfen!</span>";
        }
    }
    //check telefon
    if (empty($_POST["telefon"])) {
        $errors["telefon"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Telefon ein!</span>";
    } else {
        $telefon = $_POST["telefon"];
        if (!preg_match("/^[+ 0-9]+/", $telefon)) {
            $errors["telefon"] = "<span class='errors' style='color: red;' >Telefon darf nur Zahlen enthalten!</span>";
        }
    }
    //check kategorie
    if (empty($_POST["kategorie"])) {
        $errors["kategorie"] = "<span class='errors' style='color: red;' >Bitte eine Auswahl treffen!</span>";
    } else {
        $kategorie = $_POST["kategorie"];
        if (!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ]+$/", $kategorie)) {
            $errors["kategorie"] = "<span class='errors' style='color: red;' >Kategorie dürfen nur Buchstaben enthalten!</span>";
        }
    }
    //check textarea = nachricht
    if (empty($_POST["nachricht"])) {
        $nachricht = "";
    } else {
        $nachricht = strip_tags(nl2br(htmlspecialchars($_POST["nachricht"])));
    }
    if (!empty($errors)) {
        $allErrors = join($errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //php mailer
    try {
        $mail->isSMTP();
        $mail->Host = 'asmtp.mail.hostpoint.ch';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@sado.ch'; // email-Adresse, die Sie als SMTP-Server verwenden möchten
        $mail->Password = $PSW; // email address Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = '587';
        $mail->CharSet = "utf-8";

        $mail->setFrom('info@sado.ch', $_POST["email"]); // von wo kommt die mail//$mail->setFrom('ossicom880@gmail.com'); 
        //Gmail-Adresse, die Sie als SMTP-Server verwendet haben
        $mail->addAddress('info@sado.ch'); //auf diese email erhalten
        $mail->addAddress('sadush.ajrulai@gmail.com'); //auf diese email erhalten
        $mail->addReplyTo($_POST["email"]); //antwort an

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "Kontakt Anfrage für: $kategorie, Fahrschule sado.ch";
        $mail->AltBody = strip_tags($_POST["email"]);
        $mail->Body = '<h3>Anrede: ' . $_POST['anrede'] .
            '<br><br>Vorname: ' . $_POST['firstname'] .
            '<br><br>Nachname: ' . $_POST['lastname'] .
            '<br><br>Strasse / Nr: ' . $_POST['street'] .
            '<br><br>Postleitzahl: ' . $_POST['plz'] .
            '<br><br>Email: ' . $_POST['email'] .
            '<br><br>Telefon: ' . $_POST['telefon'] .
            '<br><br>Kategorie: ' . $_POST['kategorie'] .
            '<br><br>Nachricht: ' . $_POST['nachricht'] . '</h3>';



        //recaptcha
        $response   = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;
        // google rechaptcha im phpmailer.php von sado-drivingschool     
        $privatekey = "the secret key hier"; //Enter your secret key here

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'secret' => $privatekey,
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ));

        $resp = json_decode(curl_exec($ch));
        curl_close($ch);

        if (!$response) {
            echo '<div class="g-recaptcha alert-error">
=======
        // Import PHPMailer classes into the global namespace
        // These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        // Load Composer's autoloader
        require 'vendor/autoload.php';

        $firstname = $lastname = $street = $plz = $email = $telefon = $kategorie = $nachricht = "";
        $errors = array(
            'firstname'=>'', 'lastname'=>'', 'street'=>'', 'plz'=>'',
            'email'=>'', 'telefon'=>'', 'kategorie'=>'', 'nachricht'=>''
        );

        $alertSuccess = "" ;
        $alertError = "" ;
        $alert = "" ;
       
        //form validation
        if(isset($_POST['submit'])){

            //check firstname
            if(empty($_POST["firstname"])){
                $errors["firstname"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Vorname ein!</span>";
            }else{
                $firstname = $_POST["firstname"];
                if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ.;:,]+$/", $firstname)){
                    $errors["firstname"] = "<span class='errors' style='color: red;' >Vorname darf nur Buchstaben enthalten!</span>";
                }
            } 
        
             //check lastname
             if(empty($_POST["lastname"])){
                $errors["lastname"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Nachname ein!</span>";
            }else{
                $lastname = $_POST["lastname"];
                if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ.;:,]+$/", $lastname)){
                    $errors["lastname"] = "<span class='errors' style='color: red;' >Nachname darf nur Buchstaben enthalten!</span>";
                }
            } 
             //check street
             if(empty($_POST["street"])){
                $errors["street"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Strasse ein!</span>";
            }else{
                $street = $_POST["street"];
                if(!preg_match('/^[ A-Za-z  0-9_äÄöÖüÜßçÇ.;:,]+$/', $street)){
                    $errors["street"] = "<span class='errors' style='color: red;' >Street darf nur Buchstaben und Zahlen enthalten!</span>";
                }
            } 
             //check plz
             if(empty($_POST["plz"])){
                $errors["plz"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Plz und Ort ein!</span>"; 
            }else{
                $plz = $_POST["plz"];
                if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ.;:,]+$/", $plz)){
                    $errors["plz"] = "<span class='errors' style='color: red;' >PLZ darf nur Buchstaben und Zahlen enthalten!</span>";
                }
            } 
             //check email
             if(empty($_POST["email"])){
                $errors["email"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Ihre email ein!</span>";
            }else{
                $email = $_POST["email"];
                if(!filter_var($email, FILTER_VALIDATE_EMAIL )){
                    $errors["email"] = "<span class='errors' style='color: red;' >Falscher Format, Email überprüfen!</span>"; 
                }
            } 
             //check telefon
             if(empty($_POST["telefon"])){
                $errors["telefon"] = "<span class='errors' style='color: red;' >Bitte tragen Sie Telefon ein!</span>"; 
            }else{
                $telefon = $_POST["telefon"];
                if(!preg_match("/^[+ 0-9]+/", $telefon)){
                    $errors["telefon"] = "<span class='errors' style='color: red;' >Telefon darf nur Zahlen enthalten!</span>";
                }
            } 
             //check kategorie
             if(empty($_POST["kategorie"])){
                $errors["kategorie"] = "<span class='errors' style='color: red;' >Bitte eine Auswahl treffen!</span>"; 
            }else{
                $kategorie = $_POST["kategorie"];
                if(!preg_match("/^[A-Za-z 0-9_äÄöÖüÜßçÇ]+$/", $kategorie)){
                    $errors["kategorie"] = "<span class='errors' style='color: red;' >Kategorie dürfen nur Buchstaben enthalten!</span>"; 
                }
            }
            //check textarea = nachricht
            if(empty($_POST["nachricht"])){
                $nachricht = "";
            }else{
                $nachricht = strip_tags(nl2br(htmlspecialchars ($_POST["nachricht"])));
            } 
            if (!empty($errors)) {
                $allErrors = join($errors);
                $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
            }     
            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
        //php mailer
            try{
            $mail->isSMTP();
            $mail->Host = 'asmtp.mail.hostpoint.ch';
            $mail->SMTPAuth = true;
            $mail->Username = 'info@sado.ch'; // email-Adresse, die Sie als SMTP-Server verwenden möchten
            $mail->Password = 'your email password'; // email address Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = '587';
            $mail->CharSet = "utf-8";

            $mail->setFrom('info@sado.ch', $_POST["email"]); // von wo kommt die mail//$mail->setFrom('ossicom880@gmail.com'); 
            //Gmail-Adresse, die Sie als SMTP-Server verwendet haben
            $mail->addAddress('info@sado.ch');//auf diese email erhalten
            $mail->addAddress('sadush.ajrulai@gmail.com');//auf diese email erhalten
            $mail->addReplyTo($_POST["email"]); //antwort an

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "Kontakt Anfrage für: $kategorie, Fahrschule sado.ch" ;
            $mail->AltBody = strip_tags($_POST["email"]);
            $mail->Body = '<h3>Anrede: ' . $_POST['anrede'] .
                '<br><br>Vorname: ' . $_POST['firstname'] .
                '<br><br>Nachname: ' . $_POST['lastname'] .
                '<br><br>Strasse / Nr: ' . $_POST['street'] .
                '<br><br>Postleitzahl: ' . $_POST['plz'] .
                '<br><br>Email: ' . $_POST['email'] .
                '<br><br>Telefon: ' . $_POST['telefon'] .
                '<br><br>Kategorie: ' . $_POST['kategorie'] .
                '<br><br>Nachricht: ' . $_POST['nachricht'] . '</h3>';
            


            //recaptcha
            $response   = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;
            $privatekey = "the secret key from recaptcha hier"; //Enter your secret key here

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                'secret' => $privatekey,
                'response' => $response,
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ));
        
            $resp = json_decode(curl_exec($ch));
            curl_close($ch);

            if(!$response){
                echo '<div class="g-recaptcha alert-error">
>>>>>>> 9a7a96ad5de70aaa96f69350589ff5263a7a3069
                        Please check the captcha form.
                    </div>';
        }

        if ($resp->success) {

            //ende recaptcha


            if ($mail->send());
            $alertSuccess = '<div class="alert-success">
                         <span>Vielen Dank,' . $firstname . ' deine kontaktdaten wurden übermittelt!<br>
                        Wir werden uns so rasch wie möglich bei dir melden.<br><br>
                        Du wirst in 15 Sekunden auf die Home Seite weitergeleitet!
                        </span> 
                        </div>';
        } else {
            $alertError =   '<div class= "alert-error" >
                   <p>Da hat was nicht geklappt! Bitte versuchenSie es später nocheinmal! </p>
                </div>';
        }
    } catch (Exception $e) {
        $alert = '<div id="alert-error">
                        <span>' . $e->getMessage() . ' </span>
                    </div>';
<<<<<<< HEAD
    }
    header("refresh:15;url=index.php ");
}
=======
            }header("refresh:15;url=index.php ");
       
}     
>>>>>>> 9a7a96ad5de70aaa96f69350589ff5263a7a3069
