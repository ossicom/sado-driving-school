<?php
/*
 * PHP-Webseitenschutz - anmeldung.php
 * - https://werner-zenk.de
 */

session_start();
include_once ("./login-benutzer/benutzer.php"); // Pfadangabe beachten!

$msg = '';
// Anmeldung überprüfen
if (isset($_POST["anmeldung"])) {
  if (isset($BENUTZER_PASS[trim($_POST["name"])]) && 
      $BENUTZER_PASS[trim($_POST["name"])] === $_POST["passwort"]) {

    // Session setzen
    session_regenerate_id();
    $_SESSION["benutzername"] = trim($_POST["name"]);

    // Zur "geschützten"-Seite nach der Anmeldung weiterleiten.
    // Gegebenenfalls muss diese hier angepasst werden!
    header("Location: ./admin.php"); // Pfadangabe beachten!
  } else {
    $msg = 'Username oder Passwort falsch!';
  }
}

// Abmeldung
if (isset($_GET["abmeldung"])) {

  // Session und Cookies löschen
 unset($_SESSION["benutzername"]);
  $_SESSION = [];
  if (ini_get("session.use_cookies")) {
   $params = session_get_cookie_params();
   setcookie(session_name(), '', time() - 42000, $params["path"],
    $params["domain"], $params["secure"], $params["httponly"]);
  }
  session_destroy();

   // Wenn logout zur index.php weiterleiten.
   header("Location: ./index.php ");
}
?>
<?php include ("./head.php"); ?>

<div class="solid1">
    <h1 class="solid">ADMIN ANMELDUNG</h1>
</div>

<div class="solid1" style="margin-top: 8em; ">
    <article class="solid">
        <div class="text">
            <h3 style="margin:1em;">BITTE GEBEN SIE IHR USERNAME UND PASSWORT EIN</h3>
            <p class="inhalttext">
            <form method="post" style="margin:5em;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
                ?>">
                <fieldset>
                    <h4 style="color:red;"><?php echo $msg; ?></h4>

                    <label> </label>
                    <input type="text" name="name" placeholder="USERNAME" required="required" autocomplete="username"
                        autofocus="autofocus">


                    <label> </label>
                    <input type="password" name="passwort" placeholder="PASSWORT" required="required"
                        autocomplete="current-password">


                    <input type="submit" style="padding:0.5em; font-size:1em; border: solid red 0.1em; margin:1em;"
                        name="anmeldung" value="Anmelden">
                </fieldset>
            </form>
            </p>
        </div>
    </article>
</div>