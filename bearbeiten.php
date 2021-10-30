<?php
require_once './db_verbinden.php';
require_once './htmlhelfer.php';
require './head.php';
$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'admin.php';
if (empty($_POST['titel'])) {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header("Location: http://$host$uri/$extra");
    }
    
    $id = $_GET['id'];
    $sql = 'SELECT id, titel, text FROM begriffe WHERE id=?';
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($id, $titel, $text);
        $stmt->fetch();
        $stmt->close();
        $mysqli->close();
        $titel = htmlspecialchars($titel);
        $text = htmlspecialchars($text);
        $id = (int)$id;
        ?>
<div class="cards">
    <article class="card">
        <form method="post" style="margin:1em; action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
            <h2 style="color: green;">Die vorhandenen Infos aktualisieren!</h2>
            <label for="titel">Titel </label>
            <input type="text" name="titel" id="titel" maxlength="50" value="<?php echo $titel; ?>"><br><br>
            <label for="text">Text </label>
            <textarea name="text" id="text" rows="5" cols="40"><?php echo $text; ?>
            </textarea><br><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" style="padding: 0.5em; border: solid 2px blue;" value="Aktualisieren"><br><br>
        </form>
    </article>
</div>
<?php
        
    }
}  // Ende empty
else {
    $id = (int)$_POST['id'];
    $sql = 'UPDATE begriffe SET titel=?, text=? WHERE id=?';
    if ($stmt = $mysqli->prepare($sql)) {
        $titel = $_POST['titel'];
        $text = $_POST['text'];
        $stmt->bind_param('ssi', $titel, $text, $id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        header("Location: http://$host$uri/$extra");
    }
}
?>