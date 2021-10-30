<?php
/*
 * PHP-Webseitenschutz - geheim.php - (utf-8)
 * - https://werner-zenk.de
 * Dieses PHP-Script muss an den Anfang jeder
 *  Datei die geschützt werden soll.
 */
session_start();
if (!isset($_SESSION["benutzername"])) {
 // Zur Anmeldung weiterleiten (Pfadangabe beachten!)
 header("Location: login.php");
 exit;
}
?>
<!--require sql db -->
<?php 
require_once './db_verbinden.php';
require_once './htmlhelfer.php';
include("./head.php");
?>
<div class="solid1">
    <h1 class="solid">HALLO <?=$_SESSION["benutzername"];?>, WILLKOMMEN IM ADMINBEREICH
        <?php require ("./mainkontakt.php"); ?></h1>
</div>

<?php

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'anzeigen.php';
if (empty($_POST['titel'])) {
   
    ?>
<div class="cards">
    <article class="card cardadmin">
        <form method="post" style="margin:1em;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div><?php echo $db_ok;?></div>
            <h2 style="color: blue;">Neue Infos hier Eintragen!</h2>
            <label for="titel">Titel </label>
            <input type="text" name="titel" id="titel" maxlength="50"><br><br>
            <label for="text">Text </label>
            <textarea name="text" id="text" rows="5" cols="40"></textarea>

            <div style="display:flex; justify-content: space-between;  margin: 1em">
                <input type="submit" style="padding: 0.5em; border: solid 2px blue;" value="Eintragen">
                <button style="padding: 0.5em; ; border: solid 2px black;"><a
                        href="login.php?abmeldung">Abmelden</a></button>
                <div>

        </form>
    </article>

    <?php
    
} else {
    if ($stmt = $mysqli->prepare('INSERT INTO begriffe (titel, text) VALUES (?, ?)')) {
        $titel = $_POST['titel'];
        $text = $_POST['text'];
        $stmt->bind_param('ss', $titel, $text);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        header("Location: http://$host$uri/$extra");
    }
}
//ANZEIGEN UND BEARBEITEN

if ($stmt = $mysqli->prepare('SELECT id, titel, text FROM begriffe')) {
    $stmt->execute();
    $stmt->bind_result($id, $titel, $text);
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        ?>


    <?php
        while ($stmt->fetch()) {
            $titel = htmlspecialchars($titel);
            $text = htmlspecialchars($text);
            $id = (int)$id;
            
            echo "<div class='solid1' id='solide'>".
                         "<div class='solid' id='solide2' >AKTUELLE INFOS ANZEIGE AUF DER WEBSEITE!<br> ". 
                                "<h3 id='aktuelleinfos'>AKTUELLE INFOS!</h3> ";
                                echo "<p> $titel </p>";
                                echo "<p>  $text </p>";
                        " </div>";
                "</div>"; 
"</div>";
?>
    <div style="display:flex; justify-content:space-around;  margin-top: 5em">
        <button style="padding: 0.5em;  border: solid 2px green;"><a
                href="bearbeiten.php?id=<?php echo $id; ?>">Bearbeiten</a></button>
        <button style="padding: 0.5em; border: solid 2px red;"><a href="loeschen.php?id=<?php echo $id; ?>"
                onclick="return confirm('wirklich löschen?')">Löschen</a></button>
        <button style="padding: 0.5em;  border: solid 2px black;"><a href="login.php?abmeldung">Abmelden</a></button>
    </div>
    <?php
        }
        $stmt->close();
        ?>
    <?php
    }
}
$mysqli->close();


?>


    <?php

?>