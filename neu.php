<?php
require_once ('./db_verbinden.php');
require_once ('./htmlhelfer.php');

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'anzeigen.php';
if (empty($_POST['titel'])) {
    htmlanfang();
    ?>
<div class="cards">
    <article class="card">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div><?php echo $db_ok;?></div>
            <h2 style="color: blue;">Neue Infos hier Eintragen!</h2>
            <label for="titel">Titel </label>
            <input type="text" name="titel" id="titel" maxlength="50"><br><br>
            <label for="text">Text </label>
            <textarea name="text" id="text" rows="5" cols="40"></textarea><br><br>
            <input type="submit" style="padding: 0.5em; border: solid 2px blue;" value="Eintragen"><br><br>
        </form>
    </article>
</div>
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
?>