<?php
 //ANZEIGEN UND BEARBEITEN
 require_once './db_verbinden.php';
 require_once './htmlhelfer.php';
 
 htmlanfang();
 if ($stmt = $mysqli->prepare('SELECT id, titel, text FROM begriffe')) {
    $stmt->execute();
    $stmt->bind_result($id, $titel, $text);
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
       
        while ($stmt->fetch()) {
            $titel = htmlspecialchars($titel);
            $text = htmlspecialchars($text);
            $id = (int)$id;
            
            echo "<div class='solid1'>".
                         "<div class='solid' >AKTUELLE INFOS ANZEIGE AUF DER WEBSEITE!<br> ". 
                                "<h3 id='aktuelleinfos'>AKTUELLE INFOS!</h3> ";
                                echo "<p> $titel </p>";
                                echo "<p>  $text </p>";
                        " </div>";
                "</div>"; 
"</div>";
?>
<div style="display:flex; justify-content:space-around;  margin-top: 5em">
    <button style="padding: 0.5em; margin: 1em; border: solid 2px green;"><a
            href="bearbeiten.php?id=<?php echo $id; ?>">Bearbeiten</a></button>
    <button style="padding: 0.5em; margin: 1em; border: solid 2px red;"><a href="loeschen.php?id=<?php echo $id; ?>"
            onclick="return confirm('wirklich löschen?')">Löschen</a></button>
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
htmlende();
?>
<!-- Link um sich abzumelden, Pfadangabe beachten! -->
<h2><a href="login.php?abmeldung">Abmelden</a></h2>
<h2><a href="admin.php">Zur Adminsite</a></h2>