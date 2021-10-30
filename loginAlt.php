<?php
/*
 * PHP-Webseitenschutz - anmeldung.php
 * - https://werner-zenk.de
 */

session_start();
include "login-benutzer/benutzer.php"; // Pfadangabe beachten!


$msg = '';
// Anmeldung überprüfen
if (isset($_POST["login"])) {
    if (isset($BENUTZER_PASS[$_POST["name"]]) && 
        password_verify($_POST["passwort"], $BENUTZER_PASS[$_POST["name"]])) {

  // Session setzen
  session_regenerate_id();
  $_SESSION["benutzername"] = trim($_POST["name"]);

  // Zur "geschützten"-Seite nach der Anmeldung weiterleiten.
  // Gegebenenfalls muss diese hier angepasst werden!
  header("Location: admin.php"); // Pfadangabe beachten!
 }else {
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

   // Zur Anmeldung weiterleiten.
   header("Location: index.php");
}
?>
<!--die hesd einbindung braucht es für die css-->
<?php include ("./head.php"); ?>



<div class="solid1">
    <h1 class="solid">ADMIN ANMELDUNG</h1>
</div>
<div class="container">
    <article class="card nothelfer">
        <div class="text">
            <h3>BITTE GEBEN SIE IHR USERNAME UND PASSWORT EIN</h3>
            <p class="inhalttext">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>">
                <fieldset class="login-position">
                    <h4 style="color:red;"><?php echo $msg; ?></h4>

                    <label>USERNAME: </label>
                    <input type="text" name="name" placeholder="username" required="required" autocomplete="username"
                        autofocus="autofocus">

                    <label>PASSWORT:</label>
                    <input type="password" name="passwort" placeholder="password" required="required"
                        autocomplete="current-password">
                </fieldset>
            </form>
            <input type="submit" name="login" value="Login">
        </div>

    </article>
</div>